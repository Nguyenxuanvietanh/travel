<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

require_once dirname(__FILE__).'/Base.php';
require_once dirname(__FILE__).'/Collection.php';
		
class MX_Controller
{
	public $autoload = array();
	public $data = array();
	public $appSettings;
	public $App;

	public function __construct()
	{
        /** load the CI class for Modular Extensions **/
        require_once dirname(__FILE__).'/Base.php';
        require_once dirname(__FILE__).'/Collection.php';

		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;

		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);

		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		$this->appSettings = $this->Settings_model->get_settings_data();
        $this->data['app_settings'] = $this->appSettings;
		$settings = (array) current($this->appSettings);
        $settings = new StdClass();
        $settings->active_link = strtolower($this->uri->segments[1]);
		$this->data['appSettings'] = $settings;

        $this->load->library('Browser');
        $browser = new Browser();
        $this->data['ismobile'] = $browser->isMobile();

		// App magic box
		$this->App = new Collection();
		// Bootstrap service providers
		$this->bootstrapServicesProvider();

		$this->data['modulesList'] = $this->App->service('ModuleService')->all();
		$enabledModules = $this->App->service('ModuleService')->getEnableModules();
		$this->data['theme_url'] = $this->theme->_data['theme_url'];

		// for new menu
		$currentView = $settings->active_link;
		$firstModule = strtolower(current($enabledModules)->frontend->slug);
		if($currentView == 'home') {
			$this->data['active_menu'] = $firstModule;
			$this->data['is_home'] = true;
		} elseif($currentView == '' || strlen($currentView) == 2) { // locale string
			$this->data['active_menu'] = $firstModule;
			$this->data['is_home'] = true;
		} elseif(strpos($currentView, 'm-') !== false) {
			$this->data['active_menu'] = explode('-', $currentView)[1];
			$this->data['is_home'] = true;
		} else {
			$this->data['active_menu'] = $currentView;
			$this->data['is_home'] = false;
		}
	}

	/**
	 * Bootstrape app service provider.
	 */
	public function bootstrapServicesProvider()
	{
		$this->load->helper('directory');
		$providers = directory_map(APPPATH.'/providers');
		foreach($providers as $provider) {
			include_once APPPATH.'/providers/'.$provider;
			$class = rtrim($provider, '.php');
			$providerObject = new $class();
			$providerObject->register($this->App);
		}
	}

	public function __get($class) {
		return CI::$APP->$class;
	}

	public function frontData(){
		//$this->data['lang_set'] = $this->theme->_data['lang_set'];

		$headerMenu = getHeaderMenu($this->data['lang_set']);


		$this->data['headerMenu'] = $headerMenu;
		$this->data['ishome'] = $this->uri->segment(1);
		$this->data['currenturl'] = uri_string();

		$this->data['isRTL'] = isRTL($this->data['lang_set']);
		$this->data['allowreg'] = $this->data['app_settings'][0]->allow_registration;
		$this->data['allowsupplierreg'] = $this->data['app_settings'][0]->allow_supplier_registration;
		$this->data['tripmodule'] = $this->ptmodules->is_mod_available_enabled("tripadvisor");
		$this->data['mSettings'] = mobileSettings();
		$this->data['footersocials'] = pt_get_footer_socials();
		$this->data['languageList'] = pt_get_languages();

		return $this->data;


	}

	public function setMetaData($title = null, $desc = null, $keywords = null ){

		if(empty($title)){
			$this->data['pageTitle'] = $this->appSettings[0]->home_title;
		}else{
			$this->data['pageTitle'] = $title;
		}

		if(empty($desc)){
			$this->data['metadescription'] = $this->appSettings[0]->meta_description;
		}else{
			$this->data['metadescription'] = $desc;
		}

		if(empty($keywords)){
			$this->data['metakeywords'] = $this->appSettings[0]->keywords;
		}else{
			$this->data['metakeywords'] = $keywords;
		}


	}
}

if ( ! function_exists('app')) 
{		
	function app()
	{
 		$MX = new MX_Controller();
		return $MX->App;
	}
}