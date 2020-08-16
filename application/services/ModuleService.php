<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class ModuleService
{
    const DB_TABLE = 'modules';

    public function __construct()
    {
        /* copy a loader instance and initialize */
        $this->load = clone load_class('Loader');
        $this->load->initialize($this);
        $this->ci =& get_instance();

        $this->load->helper('file');
        $this->load->helper('directory');
        $this->moduleDotJson = 'module.json';
        $this->modulesDirPath = APPPATH . 'modules/';
        $this->moduleDotJsonContent = $this->modulesDirPath . '%s/' . $this->moduleDotJson;
    }

    /**
     * Dump modules into database.
     *
     * @return array
     */
    public function dump()
    {
        $modules = directory_map($this->modulesDirPath, 2);
        $modulesConfigurations = array();
        foreach ($modules as $module => $moduleFiles)
        {
            if(in_array($this->moduleDotJson, $moduleFiles))
            {
                $configFile = sprintf($this->moduleDotJsonContent, $module);
                $configFileMetaData = read_file($configFile);
                $_module = json_decode($configFileMetaData);
                $_moduleName = strtolower($_module->name);
                $this->ci->db->where("LOWER(name) = '{$_moduleName}'", NULL, FALSE);
                $is_exist = $this->ci->db->get(self::DB_TABLE)->num_rows();
                if($is_exist <= 0) {
                    $this->ci->db->set('name', $_module->name);
                    $this->ci->db->set('is_active', $_module->active);
                    $this->ci->db->set('settings', $configFileMetaData);
                    $this->ci->db->insert(self::DB_TABLE);
                }
            }
        }
    }

    /**
     * Modules list with conifgurations detail.
     *
     * @return array
     */
    public function all()
    {
        if($this->ci->db->query("SHOW TABLES LIKE 'modules'")) {
            $modules = $this->ci->db->get(self::DB_TABLE)->result();
            $modulesConfigurations = array();
            foreach ($modules as $module)
            {
                array_push($modulesConfigurations, json_decode($module->settings));
            }
            // Sort modules in ascending order
            usort($modulesConfigurations, function($a, $b) {
                return $a->order - $b->order;
            });
            return $modulesConfigurations;
        }
        return [];
    }

    /**
     * Get all enabled modules list
     *
     * @return array
     */
    public function getEnableModules()
    {
        $modules = $this->ci->db->where('is_active', 1)->get(self::DB_TABLE)->result();
        $modulesConfigurations = array();
        foreach ($modules as $module)
        {
            array_push($modulesConfigurations, json_decode($module->settings));
        }
        // Sort modules in ascending order
        usort($modulesConfigurations, function($a, $b) {
            return $a->order - $b->order;
        });
        return $modulesConfigurations;
    }

    /**
     * Get enabled modules list for quick booking.
     *
     * @return array
     */
    public function getQuickBookingModules()
    {
        $modules = $this->ci->db->where('is_active', 1)->get(self::DB_TABLE)->result();
        $modulesConfigurations = array();
        foreach ($modules as $module)
        {
            if (in_array(strtolower($module->name), ['cars','hotels','tours'])) {
                array_push($modulesConfigurations, json_decode($module->settings));
            }
        }
        // Sort modules in ascending order
        usort($modulesConfigurations, function($a, $b) {
            return $a->order - $b->order;
        });
        return $modulesConfigurations;
    }

    /**
     * Get single module
     *
     * @return array
     */
    public function get($module)
    {
        $module = $this->ci->db->where("LOWER(name) = '{$module}'", NULL, FALSE)->get(self::DB_TABLE)->row();
        return json_decode($module->settings);
    }

    /**
     * Enable module.
     *
     * @param  string
     * @return array
     */
    public function enable($module)
    {
        $settings = $this->get($module);
        $settings->active = 1;
        $this->ci->db->set('is_active', 1);
        $this->ci->db->set('settings', json_encode($settings));
        $this->ci->db->where("LOWER(name) = '{$module}'", NULL, FALSE);
        return $this->ci->db->update(self::DB_TABLE);
    }

    /**
     * Disable module.
     *
     * @param  string
     * @return array
     */
    public function disable($module)
    {
        $settings = $this->get($module);
        $settings->active = 0;
        $this->ci->db->set('is_active', 0);
        $this->ci->db->set('settings', json_encode($settings));
        $this->ci->db->where("LOWER(name) = '{$module}'", NULL, FALSE);
        return $this->ci->db->update(self::DB_TABLE);
    }

    /**
     * Update module by key and value.
     *
     * @param  string
     * @return array
     */
    public function update($module, $key, $val)
    {
        $settings = $this->get($module);
        $settings->{$key} = $val;
        $this->ci->db->set('settings', json_encode($settings));
        $this->ci->db->where("LOWER(name) = '{$module}'", NULL, FALSE);
        return $this->ci->db->update(self::DB_TABLE);
    }

    /**
     * Is module active or not.
     *
     * @param  string
     * @return array
     */
    public function isActive($module)
    {
        $this->ci->db->where("LOWER(name) = '{$module}'", NULL, FALSE);
        $is_active = $this->ci->db->get(self::DB_TABLE)->row()->is_active;
        return (!empty($is_active))?$is_active:"";
    }

    /**
     * Move up in order.
     *
     * @param  string
     * @return array
     */
    public function moveup($moduleName)
    {
        $allModules = $this->all();
        $currentModule = NULL;
        foreach($allModules as $module) {
            if(strtolower($module->name) == strtolower($moduleName)) {
                if( ! empty($currentModule) ) {
                    $this->update($moduleName, 'order', $currentModule->order);
                    $this->update($currentModule->name, 'order', $module->order);
                    break;
                }
            } else {
                $currentModule = $module;
            }
        }
    }

    /**
     * Move down in order.
     *
     * @param  string
     * @return array
     */
    public function movedown($moduleName)
    {
        $allModules = $this->all();
        foreach($allModules as $key => $module) {
            if(strtolower($module->name) == strtolower($moduleName) && isset($allModules[$key + 1])) {
                $nextModule = $allModules[$key + 1];
                if( ! empty($nextModule) ) {
                    $this->update($moduleName, 'order', $nextModule->order);
                    $this->update($nextModule->name, 'order', $module->order);
                    break;
                }
            }
        }
    }
}