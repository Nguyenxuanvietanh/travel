<?php if ( ! defined('BASEPATH') ) exit ('No direct script access allowed');

class AjaxController extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function updateStatus()
    {
        $status = NULL;
        $modulename = $this->input->post('modulename');
        $moduleService = $this->App->service('ModuleService');
        $module = $moduleService->get($modulename);
        if($module->active) {
            $status = 0;
            $moduleService->disable($modulename);
        } else {
            $status = 1;
            $moduleService->enable($modulename);
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode([
            'status' => ($status) ? 'enabled' : 'disabled'
        ]));
    }

    public function updateOrder()
    {
        $modulename = $this->input->post('modulename');
        $order = $this->input->post('order');
        $moduleService = $this->App->service('ModuleService');
        if($order == 'up') {
            $moduleService->moveup($modulename);
        } else {
            $moduleService->movedown($modulename);
        }
    }
}