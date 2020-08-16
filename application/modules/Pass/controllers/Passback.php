<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class Passback extends MX_Controller {
  public $accType = "";
  public $role = "";
  public $editpermission = true;
  public $deletepermission = true;
  function __construct() {
    $seturl = $this->uri->segment(3);
    if ($seturl != "settings") {
      $chk = modules::run('Home/is_main_module_enabled', 'pass');
      if (!$chk) {
        backError_404($this->data);
      }
    }
    $checkingadmin = $this->session->userdata('pt_logged_admin');
    $this->accType = $this->session->userdata('pt_accountType');
    $this->role = $this->session->userdata('pt_role');
    $this->data['userloggedin'] = $this->session->userdata('pt_logged_id');
    if (empty($this->data['userloggedin'])) {
      $urisegment = $this->uri->segment(1);
      $this->session->set_userdata('prevURL', current_url());
      redirect($urisegment);
    }
    if (!empty($checkingadmin)) {
      $this->data['adminsegment'] = "admin";
    }
    else {
      $this->data['adminsegment'] = "supplier";
    }
    if ($this->data['adminsegment'] == "admin") {
      $chkadmin = modules::run('Admin/validadmin');
      if (!$chkadmin) {
        redirect('admin');
      }
    }
    else {
      $chksupplier = modules::run('supplier/validsupplier');
      if (!$chksupplier) {
        redirect('supplier');
      }
    }
    $this->load->model('Pass/Pass_model');
    $this->data['appSettings'] = modules::run('Admin/appSettings');
    $this->load->library('Ckeditor');
    $this->data['ckconfig'] = array();
    $this->data['ckconfig']['toolbar'] = array(array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles'), array('NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'), array('Image', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'), array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'),);
    $this->data['ckconfig']['language'] = 'en';
//$this->data['ckconfig']['filebrowserUploadUrl'] =  base_url().'home/cmsupload';
    $this->load->helper('Pass/pass');
    $this->data['languages'] = pt_get_languages();
    $this->load->helper('xcrud');
    $this->data['c_model'] = $this->countries_model;
    $this->data['tripadvisor'] = $this->ptmodules->is_mod_available_enabled("tripadvisor");
    $this->data['addpermission'] = true;
    if ($this->role == "supplier" || $this->role == "admin") {
      $this->editpermission = pt_permissions("editpass", $this->data['userloggedin']);
      $this->deletepermission = pt_permissions("deletepass", $this->data['userloggedin']);
      $this->data['addpermission'] = pt_permissions("addpass", $this->data['userloggedin']);
    }
    $this->data['all_countries'] = $this->Countries_model->get_all_countries();
    $this->load->helper('settings');
    $this->load->model('Admin/Accounts_model');
    $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
    $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
  }
  function index() {
    if (!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission) {
      backError_404($this->data);
    }
    else {
      $xcrud = xcrud_get_instance();
      $xcrud->table('pt_pass');
      $xcrud->label('name', 'Name')
            ->label('sales_date', 'Sales date')
            ->label('type', 'Type')
            ->label('category_id', 'Category')
            ->label('note', 'Notes')
            ->label('html_note', 'HTML Notes');
      $xcrud->column_callback('sales_date', 'fmtDateTime');

      if ($this->editpermission) {
        $xcrud->button(base_url() . $this->data['adminsegment'] . '/pass/manage/{id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
        $xcrud->column_pattern('name', '<a href="' . base_url() . $this->data['adminsegment'] . '/pass/manage/{id}' . '">{value}</a>');
      }
      if ($this->deletepermission) {
        $delurl = base_url() . 'admin/passajaxcalls/delPass';
        $xcrud->multiDelUrl = base_url() . 'admin/passajaxcalls/delMultiplePass';
        $xcrud->button("javascript: delfunc('{id}','$delurl')", 'DELETE', 'fa fa-times', 'btn-danger', array('target' => '_self', 'id' => '{id}'));
      }
      $xcrud->limit(50);
      $xcrud->unset_add();
      $xcrud->unset_edit();
      $xcrud->unset_remove();
      $xcrud->unset_view();
      $this->data['content'] = $xcrud->render();
      $this->data['page_title'] = 'Pass Management';
      $this->data['main_content'] = 'temp_view';
      $this->data['header_title'] = 'Pass Management';
      $this->data['add_link'] = base_url() . $this->data['adminsegment'] . '/pass/add';
      $this->load->view('Admin/template', $this->data);
    }
  }

  function settings() {
    $isadmin = $this->session->userdata('pt_logged_admin');
    if (empty($isadmin)) {
      redirect($this->data['adminsegment'] . '/pass/');
    }
    $this->data['all_countries'] = $this->Countries_model->get_all_countries();

    $updatesett = $this->input->post('updatesettings');
    $addsettings = $this->input->post('add');
    $updatetypesett = $this->input->post('updatetype');
    if (!empty($updatesett)) {
      $this->Pass_model->updatePassSettings();
      redirect('admin/pass/settings');
    }

    if (!empty($addsettings)) {
      $id = $this->Pass_model->addCategoriesData();
      $this->Pass_model->updatePassCategoriesTranslation($this->input->post('translated'), $id);
      redirect('admin/pass/settings');
    }
    if (!empty($updatetypesett)) {
      $this->Pass_model->updateCategoriesData();
      // $this->Pass_model->updatePassCategoriesTranslation($this->input->post('translated'), $this->input->post('settid'));
      redirect('admin/pass/settings');
    }
    $this->data['passCategories'] = $this->Pass_model->get_pass_categories_data();
    $this->LoadXcrudPassCategories();
    $this->data['main_content'] = 'Pass/settings';
    $this->data['page_title'] = 'Pass Settings';
    $this->load->view('Admin/template', $this->data);
  }
// Add Pass
  public function add() {
    if (!$this->data['addpermission']) {
      backError_404($this->data);
    }
    else {
      $this->load->model('Admin/Uploads_model');
      $addpass = $this->input->post('submittype');;
      $this->data['submittype'] = "add";
      if (!empty($addpass)) {
        $this->form_validation->set_rules('name', 'Pass Name', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
          echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
        }
        else {
          $passid = $this->Pass_model->add_pass($this->data['userloggedin']);
          // $this->Pass_model->add_translation($this->input->post('translated'), $passid);
          $this->session->set_flashdata('flashmsgs', 'Pass added Successfully');
          echo "done";
        }
      }
      else {
        $this->data['main_content'] = 'Pass/manage';
        $this->data['page_title'] = 'Add Pass Card';
        $this->data['headingText'] = 'Add Pass Card';
        $this->data['pass_categories'] = $this->Pass_model->get_pass_categories_data();
        $this->data['all_pass'] = $this->Pass_model->select_related_pass($this->data['userloggedin']);
        $this->load->model('Admin/Locations_model');
        $this->data['locations'] = $this->Locations_model->getLocationsBackend();
        $this->load->view('Admin/template', $this->data);
      }
    }
  }

  function manage($id) {
    echo '<pre>';
    print_r($id);
    echo '</pre>';die;
    if (empty($id)) {
      redirect($this->data['adminsegment'] . '/pass/');
    }
    if (!$this->editpermission) {
      echo "<center><h1>Access Denied</h1></center>";
      backError_404($this->data);
    }
    else {
      $updatepass = $this->input->post('submittype');
      $this->data['submittype'] = "update";
      $passid = $this->input->post('id');
      if (!empty($updatepass)) {
        $this->form_validation->set_rules('name', 'Pass Name', 'trim|required');
        $this->form_validation->set_rules('passdesc', 'Description', 'trim|required');
        $this->form_validation->set_rules('passcity', 'Location', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
          echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
        }
        else {
          $this->Pass_model->update_pass($passid);
          // $this->Pass_model->update_translation($this->input->post('translated'), $passid);
          $this->session->set_flashdata('flashmsgs', 'Pass Updated Successfully');
          echo "done";
        }
      }
      else {
        @ $this->data['hdata'] = $this->Pass_model->get_pass_data($passlug);
        $comfixed = @ $this->data['hdata'][0]->pass_comm_fixed;
        $comper = $this->data['hdata'][0]->pass_comm_percentage;
        if ($comfixed > 0) {
          $this->data['passdepositval'] = $comfixed;
          $this->data['passdeposittype'] = "fixed";
        }
        else {
          $this->data['passdepositval'] = $comper;
          $this->data['passdeposittype'] = "percentage";
        }
        $taxfixed = $this->data['hdata'][0]->pass_tax_fixed;
        $taxper = $this->data['hdata'][0]->pass_tax_percentage;
        if ($taxfixed > 0) {
          $this->data['passtaxval'] = $taxfixed;
          $this->data['passtaxtype'] = "fixed";
        }
        else {
          $this->data['passtaxval'] = $taxper;
          $this->data['passtaxtype'] = "percentage";
        }
        if ($this->data['adminsegment'] == "supplier") {
          if ($this->data['userloggedin'] != $this->data['hdata'][0]->pass_owned_by) {
            redirect($this->data['adminsegment'] . '/pass/');
          }
        }
        $this->data['main_content'] = 'Pass/manage';
        $this->data['page_title'] = 'Manage Pass';
        $this->data['headingText'] = 'Update ' . $this->data['hdata'][0]->pass_title;
        $locInfo = pt_LocationsInfo($this->data['hdata'][0]->pass_city);
        $this->data['locationName'] = $locInfo->city . ", " . $locInfo->country;
        $this->data['checkin'] = $this->data['hdata'][0]->pass_check_in;
        $this->data['checkout'] = $this->data['hdata'][0]->pass_check_out;
        $this->data['hrelated'] = explode(",", $this->data['hdata'][0]->pass_related);
        $this->data['featuredfrom'] = pt_show_date_php($this->data['hdata'][0]->pass_featured_from);
        $this->data['featuredto'] = pt_show_date_php($this->data['hdata'][0]->pass_featured_to);
        $this->data['htypes'] = pt_get_hsettings_data("htypes");
        $this->data['hamts'] = pt_get_hsettings_data("hamenities");
        $this->data['passamt'] = explode(",", $this->data['hdata'][0]->pass_amenities);
        $this->data['hpayments'] = pt_get_hsettings_data("hpayments");
        $this->data['passpaytypes'] = explode(",", $this->data['hdata'][0]->pass_payment_opt);
        $this->data['all_pass'] = $this->Pass_model->select_related_pass($this->data['userloggedin']);
        $this->load->model('Admin/Locations_model');
        $this->data['locations'] = $this->Locations_model->getLocationsBackend();
        $this->data['passid'] = $this->data['hdata'][0]->pass_id;
        $this->load->view('Admin/template', $this->data);
      }
    }
  }

  function translate($passlug, $lang = null) {
    $this->load->library('Pass/Pass_lib');
    $this->Pass_lib->set_passid($passlug);
    $add = $this->input->post('add');
    $update = $this->input->post('update');
    if (empty($lang)) {
      $lang = $this->langdef;
    }
    else {
      $lang = $lang;
    }
    $this->data['lang'] = $lang;
    if (empty($passlug)) {
      redirect($this->data['adminsegment'] . '/pass/');
    }
    if (!empty($add)) {
      $language = $this->input->post('langname');
      $passid = $this->input->post('passid');
      $this->Pass_model->add_translation($language, $passid);
      redirect($this->data['adminsegment'] . "/pass/translate/" . $passlug . "/" . $language);
    }
    if (!empty($update)) {
      $slug = $this->Pass_model->update_translation($lang, $passlug);
      redirect($this->data['adminsegment'] . "/pass/translate/" . $slug . "/" . $lang);
    }
    $hdata = $this->Pass_lib->pass_details();
    if ($lang == $this->langdef) {
      $passdata = $this->Pass_lib->pass_short_details();
      $this->data['passdata'] = $passdata;
      $this->data['transpolicy'] = $passdata[0]->pass_policy;
      $this->data['transadditional'] = $passdata[0]->pass_additional_facilities;
      $this->data['transdesc'] = $passdata[0]->pass_desc;
      $this->data['transtitle'] = $passdata[0]->pass_title;
    }
    else {
      $passdata = $this->Pass_lib->translated_data($lang);
      $this->data['passdata'] = $passdata;
      $this->data['transid'] = $passdata[0]->trans_id;
      $this->data['transpolicy'] = $passdata[0]->trans_policy;
      $this->data['transadditional'] = $passdata[0]->trans_additional;
      $this->data['transdesc'] = $passdata[0]->trans_desc;
      $this->data['transtitle'] = $passdata[0]->trans_title;
    }
    $this->data['passid'] = $this->Pass_lib->get_id();
    $this->data['lang'] = $lang;
    $this->data['slug'] = $passlug;
    $this->data['language_list'] = pt_get_languages();
    if ($this->data['adminsegment'] == "supplier") {
      if ($this->data['userloggedin'] != $hdata[0]->pass_owned_by) {
        redirect($this->data['adminsegment'] . '/pass/');
      }
    }
    $this->data['main_content'] = 'Pass/translate';
    $this->data['page_title'] = 'Translate Pass';
    $this->load->view('Admin/template', $this->data);
  }

  function extras() {
    if ($this->data['adminsegment'] == "supplier") {
      $supplierPass = $this->Pass_model->all_pass($this->data['userloggedin']);
      $allpass = $this->Pass_model->all_pass();
      echo modules::run('Admin/extras/listings', 'pass', $allpass, $supplierPass);
    }
    else {
      $pass = $this->Pass_model->all_pass();
      echo modules::run('Admin/extras/listings', 'pass', $pass);
    }
  }

  function LoadXcrudPassCategories() {
    $xc = "xcrud";
    $xc = xcrud_get_instance();
    $xc->table('pt_pass_categories');
    $xc->order_by('id', 'asc');
    $xc->button('#sett{id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('data-toggle' => 'modal'));
    $delurl = base_url() . 'admin/passajaxcalls/delPassCategory';
    $xc->button("javascript: delfunc('{id}','$delurl')", 'DELETE', 'fa fa-times', 'btn-danger', array('target' => '_self', 'id' => '{id}'));
    $xc->search_columns('name,selected,status');
    $xc->label('name', 'Name')->label('selected', 'Selected')->label('status', 'Status');
    $xc->unset_add();
    $xc->unset_edit();
    $xc->unset_remove();
    $xc->unset_view();
    $xc->multiDelUrl = base_url() . 'admin/passajaxcalls/delMultiPassCategories/';
    $this->data['content_categories'] = $xc->render();
  }

  function reviews() {
    echo modules::run('Admin/Reviews/listings', 'pass');
  }
}