<?php

if (!defined('BASEPATH'))

  exit('No direct script access allowed');

class Pass extends MX_Controller {

  private $validlang;

  function __construct() {
    
    parent::__construct();

    $chk = modules::run('Home/is_main_module_enabled', 'pass');

    if (!$chk) {

      Module_404();

    }

    $this->load->library('Pass/Pass_lib');

    $this->load->model('Pass/Pass_model');

    $this->data['phone'] = $this->load->get_var('phone');

    $this->data['contactemail'] = $this->load->get_var('contactemail');

    $this->data['usersession'] = $this->session->userdata('pt_logged_customer');

    $this->data['appModule'] = "pass";
	
    $languageid = $this->uri->segment(2);

    $this->validlang = pt_isValid_language($languageid);

    if ($this->validlang) {

      $this->data['lang_set'] = $languageid;

    }

    else {

      $this->data['lang_set'] = $this->session->userdata('set_lang');

    }

    $defaultlang = pt_get_default_language();

    if (empty($this->data['lang_set'])) {

      $this->data['lang_set'] = $defaultlang;

    }

    $this->Pass_lib->set_lang($this->data['lang_set']);
    

    $this->data['modulelib'] = $this->Pass_lib;

    $this->passSettings = $this->Settings_model->get_front_settings('pass')[0];

    $_SESSION['custom_pass_checkin'] = date('d-m-Y');
    $_SESSION['custom_pass_checkout'] = date('d-m-Y', strtotime('+1 days'));
  }

  public function detail()
{
      $id = $this->input->get('id');
      if ($id) {
        $this->load->library('currconverter');
        $curr = $this->currconverter;
        $detail = $this->Pass_model->get_pass_detail($id)[0];
        $detail->ammount_text = $curr->code . ' ' . $curr->symbol . ' ' . $detail->ammount;
        $this->data['pass'] = $detail;

        $this->theme->view('modules/pass/details', $this->data, $this);
      }
      else {
        $this->listing();
      }
  }  



  public function index($passname = '', $html = false) {
        $city = $this->uri->segment(3);

        $searchform_checkin = $this->uri->segment(5);

        $searchform_checkout = $this->uri->segment(6);

        $this->load->library('Pass/Pass_calendar_lib');

        $this->data['loadMap'] = TRUE;

        $this->data['calendar'] = $this->Pass_calendar_lib;

        $settings = $this->Settings_model->get_front_settings('pass');

        $this->data['minprice'] = $settings[0]->front_search_min_price;

        $this->data['maxprice'] = $settings[0]->front_search_max_price;

        $this->data['checkin'] = $searchform_checkin;

        $this->data['checkout'] = $searchform_checkout;

      if(empty($passname)) {

          if ($this->validlang) {

              //$countryName = $this->uri->segment(3);

              //$cityName = $this->uri->segment(4);

              $passname = $this->uri->segment(5);

          }

          else {

              // $countryName = $this->uri->segment(2);

              // $cityName = $this->uri->segment(3);

              $passname = $this->uri->segment(4);

          }

      }
    $passname = 'test';
    $check = $this->Pass_model->pass_exists($passname);

    if ($check && !empty($passname)) {
      
      $this->Pass_lib->set_passid($passname);

      $this->data['module'] = $this->Pass_lib->pass_details();

      if($html) {
          return $this->theme->view('modules/pass/details', $this->data, $this, true);
      } else {
          $this->theme->view('modules/pass/details', $this->data, $this);
      }

    }

    else {

      $this->listing();

    }

  }



  function listing($page = 1)

  {
      // Pagination

      $this->load->library('pagination');

      $config['base_url'] = base_url('pass/listing');

      $config['total_rows'] = $this->db->get('pt_pass')->num_rows();

      $config['per_page'] = $this->passSettings->front_listings;

      $config['uri_segment'] = 3;

      $config['use_page_numbers'] = true;

      $config['full_tag_open'] = "<ul class='pagination'>";

      $config['full_tag_close'] ="</ul>";

      $config['num_tag_open'] = '<li>';

      $config['num_tag_close'] = '</li>';

      $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";

      $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

      $config['next_tag_open'] = "<li>";

      $config['next_tagl_close'] = "</li>";

      $config['prev_tag_open'] = "<li>";

      $config['prev_tagl_close'] = "</li>";

      $config['first_tag_open'] = "<li>";

      $config['first_tagl_close'] = "</li>";

      $config['last_tag_open'] = "<li>";

      $config['last_tagl_close'] = "</li>";

      $this->pagination->initialize($config);

      $this->data['pagination'] = $this->pagination->create_links();

      $limit = $config['per_page'];

      $offset = ($page - 1) * $limit;

      $country = 'NULL';

      $city = 'NULL';

      $this->data['module'] = $this->Pass_model->getAllPass($limit, $offset);

      $this->lang->load("front", $this->data['lang_set']);

      $this->data['amenities']   = $this->Pass_lib->getHotelAmenities();

      $this->data['moduleTypes'] = $this->Pass_lib->getHotelTypes();

      $settings = $this->Settings_model->get_front_settings('pass');

      $this->data['minprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_min_price);

      $this->data['maxprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_max_price);

      $this->data['currCode'] = $this->Pass_lib->currencycode;

      $this->data['currSign'] = $this->Pass_lib->currencysign;

      $this->data['langurl']  = base_url() . "pass/{langid}";

      $this->data['country']  = $country;

      $this->data['city']     = $city;

      $checkin = str_replace('/','-', $_SESSION['pass_checkin']);

      $checkout = str_replace('/','-', $_SESSION['pass_checkout']);

      $this->data['uri'] = base_url('pass/search');
      $this->data['detailpage_uri'] = base_url('pass/detail/%s/%s');

      // Load view

      $this->setMetaData('Search Results', "Hotel listings");

      $this->theme->view('modules/pass/listing', $this->data, $this);

  }



  function _listing($offset = null) {

    $this->data['loadMap'] = TRUE;

    $this->lang->load("front", $this->data['lang_set']);

    $this->data['sorturl'] = base_url() . 'pass/listings?';

    $settings = $this->Settings_model->get_front_settings('pass');

    $this->data['minprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_min_price);

    $this->data['maxprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_max_price);

    //$this->data['popular_pass'] = $this->Pass_model->popular_pass_front();

    $allpass = $this->Pass_lib->show_pass($offset);

    $this->data['moduleTypes'] = $this->Pass_lib->getHotelTypes();

    $this->data['amenities'] = $this->Pass_lib->getHotelAmenities();

    $this->data['checkin'] = @ $_GET['checkin'];

    $this->data['checkout'] = @ $_GET['checkout'];

    if (empty($checkin)) {

      $this->data['checkin'] = $this->Pass_lib->checkin;

    }

    if (empty($checkout)) {

      $this->data['checkout'] = $this->Pass_lib->checkout;

    }

    $chin = $this->Pass_lib->checkin;

    $chout = $this->Pass_lib->checkout;

    if (empty($chin) || empty($chout)) {

      $this->data['pricehead'] = trans('0396');

    }

    else {

      $this->data['pricehead'] = trans('0397') . " " . $this->Pass_lib->stay . " " . trans('0122');

    }

    $this->data['totalStay'] = $this->Pass_lib->stay;

    $this->data['adults'] = $this->Pass_lib->adults;

    $this->data['child'] = (int) $this->Pass_lib->children;

    $this->data['selectedLocation'] = $this->Pass_lib->selectedLocation;

    $this->data['module'] = $allpass['all_pass'];

    $this->data['info'] = $allpass['paginationinfo'];

    $this->data['currCode'] = $this->Pass_lib->currencycode;

    $this->data['currSign'] = $this->Pass_lib->currencysign;

    $this->data['langurl'] = base_url() . "pass/{langid}";

    $this->setMetaData($settings[0]->header_title, $settings[0]->meta_description, $settings[0]->meta_keywords);

    $this->theme->view('modules/pass/listing', $this->data, $this);

  }



  function search($name = null, $type = null, $category = null, $price = null)
  {
      
      $search_params = [
        'name'        => $this->input->get('name'),
        'type'        => $this->input->get('type'),
        'category_id' => $this->input->get('category_id'),
        'ammount'     => $this->input->get('ammount')
      ];
      // $search_result = $this->Pass_model->get_search_result($search_params);
      $search_result = $this->Pass_lib->show_pass($search_params);

      $this->data['module'] = $search_result['all_pass'];

      $this->data['info'] = $search_result['paginationinfo'];
      $this->data['pass_list'] = $search_result;
      $this->data['detailpage_uri'] = base_url('pass/detail/%s/%s/'.$checkin.'/'.$checkout.'/'.$adults.'/'.$childs);

      $this->setMetaData('Search Results', $country . " " . $city, $country . " " . $city);

      $this->theme->view('modules/pass/listing', $this->data, $this);

  }



  function _search($country = null, $city = null, $citycode = null, $offset = null) {

      $this->session->set_userdata(array(

          "pass_s2_id" => $citycode,

          "pass_s2_text" => $this->input->get('txtSearch'),

          "pass_checkin" => $this->input->get('checkin'),

          "pass_checkout" => $this->input->get('checkout'),

          "pass_adults" => $this->input->get('adults'),

          "pass_child" => $this->input->get('child'),

          "pass_mod_type" => $this->input->get('modType')

      ));

    $this->data['loadMap'] = TRUE;

    $surl = http_build_query($_GET);

    $this->data['sorturl'] = base_url() . 'pass/search?' . $surl . '&';

    $checkin = $this->input->get('checkin');

    $checkout = $this->input->get('checkout');

    $type = $this->input->get('type');

    $cityid = $this->input->get('searching');

    $modType = $this->input->get('modType');

    if (empty($country)) {

      $surl = http_build_query($_GET);

      $locationInfo = pt_LocationsInfo($cityid);

      $country = url_title($locationInfo->country, 'dash', true);

      $city = url_title($locationInfo->city, 'dash', true);

      $cityid = $locationInfo->id;

      if (!empty($cityid) && $modType == "location") {

        redirect('pass/search/' . $country . '/' . $city . '/' . $cityid . '?' . $surl);

      }

      else {

        if (!empty($cityid) && $modType == "pass") {

          $this->Pass_lib->set_id($cityid);

          $this->Pass_lib->pass_short_details();

          $title = $this->Pass_lib->title;

          $slug = $this->Pass_lib->slug;

          if (!empty($title)) {

            redirect('pass/' . $slug);

          }

        }

      }

    }

    else {

      if ($modType == "location") {

        $cityid = $citycode;

      }

      else {

        $cityid = "";

      }

      if (is_numeric($country)) {

        $offset = $country;

      }

    }

    if (array_filter($_GET)) {

      if (!empty($cityid) && $modType == "location") {

        $allpass = $this->Pass_lib->search_pass_by_text($cityid, $offset);

      }

      else {

        $allpass = $this->Pass_lib->search_pass($offset);

      }

      $this->data['module'] = $allpass['all'];

      $this->data['info'] = $allpass['paginationinfo'];

    }

    else {

      $this->data['module'] = array();

    }

    $this->data['checkin'] = @ $_GET['checkin'];

    $this->data['checkout'] = @ $_GET['checkout'];

    if (empty($checkin)) {

      $this->data['checkin'] = $this->Pass_lib->checkin;

    }

    if (empty($checkout)) {

      $this->data['checkout'] = $this->Pass_lib->checkout;

    }

    $chin = $this->Pass_lib->checkin;

    $chout = $this->Pass_lib->checkout;

    if (empty($chin) || empty($chout)) {

      $this->data['pricehead'] = trans('0396');

    }

    else {

      $this->data['pricehead'] = trans('0397') . " " . $this->Pass_lib->stay . " " . trans('0122');

    }

    $this->data['city'] = $cityid;

    $this->lang->load("front", $this->data['lang_set']);

    $this->data['selectedLocation'] = $cityid; //$this->Pass_lib->selectedLocation;

    $this->data['totalStay'] = $this->Pass_lib->stay;

    $this->data['adults'] = $this->Pass_lib->adults;

    $this->data['child'] = (int) $this->Pass_lib->children;

    $this->data['searchText'] = $this->input->get('txtSearch');

    $settings = $this->Settings_model->get_front_settings('pass');

    $this->data['amenities'] = $this->Pass_lib->getHotelAmenities();

    $this->data['moduleTypes'] = $this->Pass_lib->getHotelTypes();

    $this->data['minprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_min_price);

    $this->data['maxprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_max_price);

    $this->data['currCode'] = $this->Pass_lib->currencycode;

    $this->data['currSign'] = $this->Pass_lib->currencysign;

    $this->data['langurl'] = base_url() . "pass/{langid}";

    $this->setMetaData('Search Results', @ $country . " " . @ $city, @ $country . " " . @ $city);

    

    $this->theme->view('modules/pass/listing', $this->data, $this);

  }

    function book()
    {
      if($this->input->post()){
        $post_data = $this->input->post();
        $booking_id = $this->Pass_model->insert_pass_booking($post_data);
        if($booking_id){
          redirect(base_url() . 'invoice/pass/?id=' . $this->input->post('pass_id'));
        }
      }else{
        $this->data['pass_id'] = $this->input->get('pass_id');
        $this->theme->view('modules/pass/booking', $this->data, $this);
      }
    }


    function txtsearch() {

    echo $this->Pass_model->textsearch();

  }

  function roomcalendar() {

    $this->lang->load("front", $this->data['lang_set']);

    $this->load->library('Pass/Pass_calendar_lib');

    $this->data['calendar'] = $this->Pass_calendar_lib;

    $this->data['roomid'] = $this->input->post('roomid');

    $monthYear = explode(",", $this->input->post('monthyear'));

    $this->data['initialmonth'] = $monthYear[0];

    $this->data['year'] = $monthYear[1];

    $this->load->view('calendar', $this->data);

  }

  function _remap($method, $params = array()) {
    
    $funcs = get_class_methods($this);

    if (in_array($method, $funcs)) {
      
      return call_user_func_array(array($this, $method), $params);

    }

    else {

      $result = checkUrlParams($method, $params, $this->validlang);

      if ($result->showIndex) {

        $this->index();

      }

      else {

        $this->lang->load("front", $this->data['lang_set']);

        $this->data['sorturl'] = base_url() . 'pass/listings?';

        $settings = $this->Settings_model->get_front_settings('pass');

        $this->data['minprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_min_price);

        $this->data['maxprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_max_price);

        // $allpass = $this->Pass_lib->showPassByLocation($result, $result->offset);

        $this->data['moduleTypes'] = $this->Pass_lib->getHotelTypes();

        $this->data['amenities'] = $this->Pass_lib->getHotelAmenities();

        $this->data['checkin'] = @ $_GET['checkin'];

        $this->data['checkout'] = @ $_GET['checkout'];

        if (empty($checkin)) {

          $this->data['checkin'] = $this->Pass_lib->checkin;

        }

        if (empty($checkout)) {

          $this->data['checkout'] = $this->Pass_lib->checkout;

        }

        $chin = $this->Pass_lib->checkin;

        $chout = $this->Pass_lib->checkout;

        if (empty($chin) || empty($chout)) {

          $this->data['pricehead'] = trans('0396');

        }

        else {

          $this->data['pricehead'] = trans('0397') . " " . $this->Pass_lib->stay . " " . trans('0122');

        }

        $this->data['selectedLocation'] = $this->Pass_lib->selectedLocation;

        $this->data['module'] = $allpass['all_pass'];

        $this->data['info'] = $allpass['paginationinfo'];

        $this->data['currCode'] = $this->Pass_lib->currencycode;

        $this->data['currSign'] = $this->Pass_lib->currencysign;

        $this->data['langurl'] = base_url() . "pass/{langid}";

        $this->setMetaData($settings[0]->header_title, $settings[0]->meta_description, $settings[0]->meta_keywords);

        $this->theme->view('modules/pass/listing', $this->data, $this);

      }

    }

  }

}