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

  public function detail(...$args)
  {
      if(count($args) == 2) {
        list($city,$passname) = $args;
        $searchform_checkin = $_SESSION['custom_pass_checkin'];
        $searchform_checkout = $_SESSION['custom_pass_checkout'];
        $adults = 2;
        $childs = 0;
      } else {
        list($city,$passname,$searchform_checkin,$searchform_checkout,$adults,$childs) = $args;
        if(empty($searchform_checkin)) {
          $searchform_checkin = $_SESSION['custom_pass_checkin'];
          $searchform_checkout = $_SESSION['custom_pass_checkout'];
        }
        $_SESSION['search_pass_checkin'] = '';
        $_SESSION['search_pass_checkout'] = '';
      }
      if(!empty($_SESSION['search_pass_checkin'])) {
        $searchform_checkin = $_SESSION['search_pass_checkin'];
      }
      if(!empty($_SESSION['search_pass_checkout'])) {
        $searchform_checkout = $_SESSION['search_pass_checkout'];
      }
      $_GET['checkin'] = $searchform_checkin;
      $_GET['checkout'] = $searchform_checkout;
      $_GET['adults'] = $adults;
      $_GET['child'] = $childs;
      $_GET['searching'] = "";
      $_GET['roomscount'] = "";
      $this->Pass_lib->checkin = $searchform_checkin;
      $this->Pass_lib->checkout = $searchform_checkout;
      $this->Pass_lib->stay = pt_count_days($searchform_checkin, $searchform_checkout);
      $this->Pass_lib->adults = $adults;
      $this->Pass_lib->children = $childs;
      $this->load->library('Pass/Pass_calendar_lib');
      $this->data['loadMap'] = TRUE;
      $this->data['calendar'] = $this->Pass_calendar_lib;
      $settings = $this->Settings_model->get_front_settings('pass');
      $this->data['minprice'] = $settings[0]->front_search_min_price;
      $this->data['maxprice'] = $settings[0]->front_search_max_price;
      $this->data['checkin'] = $searchform_checkin;
      $this->data['checkout'] = $searchform_checkout;
      $check = $this->Pass_model->pass_exists($passname);
      if ($check && !empty($passname)) {
        $this->Pass_lib->set_passid($passname);
        $this->data['module'] = $this->Pass_lib->pass_details();
        $this->data['hasRooms'] = $this->Pass_lib->totalRooms($this->data['module']->id);
        $this->data['rooms'] = $this->Pass_lib->pass_rooms($this->data['module']->id);
        // Availability Calender settings variables
        $this->data['from1'] = date("F Y");
        $this->data['to1'] = date("F Y", strtotime('+5 months'));
        $this->data['from2'] = date("F Y", strtotime('+6 months'));
        $this->data['to2'] = date("F Y", strtotime('+11 months'));
        $this->data['from3'] = date("F Y", strtotime('+12 months'));
        $this->data['to3'] = date("F Y", strtotime('+17 months'));
        $this->data['from4'] = date("F Y", strtotime('+18 months'));
        $this->data['to4'] = date("F Y", strtotime('+23 months'));
        $this->data['first'] = date("m") . "," . date("Y");
        $this->data['second'] = date("m", strtotime('+6 months')) . "," . date("Y", strtotime('+6 months'));
        $this->data['third'] = date("m", strtotime('+12 months')) . "," . date("Y", strtotime('+12 months'));
        $this->data['fourth'] = date("m", strtotime('+18 months')) . "," . date("Y", strtotime('+18 months'));
        // End Availability Calender settings variables
        $this->data['tripadvisorinfo'] = tripAdvisorInfo($this->data['module']->tripadvisorid);
        if (!empty($this->data['tripadvisorinfo']->rating)) {
            $tripAdvisorReviews = $this->Pass_lib->tripAdvisorData($this->data['module']->tripadvisorid, $this->data['tripadvisorinfo']);
            $this->data['reviews'] = $tripAdvisorReviews->reviews;
        }
        else {
            $this->data['reviews'] = $this->Pass_lib->passReviews($this->data['module']->id);
            $this->data['avgReviews'] = $this->Pass_lib->passReviewsAvg($this->data['module']->id);
        }
        $this->data['checkinMonth'] = strtoupper(date("F", convert_to_unix($this->Pass_lib->checkin)));
        $this->data['checkinDay'] = date("d", convert_to_unix($this->Pass_lib->checkin));
        $this->data['checkoutMonth'] = strtoupper(date("F", convert_to_unix($this->Pass_lib->checkout)));
        $this->data['checkoutDay'] = date("d", convert_to_unix($this->Pass_lib->checkout));
        // Split date for new date desing on pass single page
        $checkin = explode("/", $this->Pass_lib->checkin);
        $this->data['d1first'] = $checkin[0];
        $this->data['d1second'] = $checkin[1];
        $this->data['d1third'] = $checkin[2];
        $checkout = explode("/", $this->Pass_lib->checkout);
        $this->data['d2first'] = $checkout[0];
        $this->data['d2second'] = $checkout[1];
        $this->data['d2third'] = $checkout[2];
        $this->data['checkin'] = $this->Pass_lib->checkin;
        $this->data['checkout'] = $this->Pass_lib->checkout;
        // end Split date for new date desing on pass single page
        $this->lang->load("front", $this->data['lang_set']);
        $datetime1 = new DateTime($this->data['checkin']);
        $datetime2 = new DateTime($this->data['checkout']);
        $interval = $datetime1->diff($datetime2)->format('%a');
        $this->data['totalStay'] = $interval;
        $this->data['modulelib']->stay = $this->data['totalStay'];
        $this->data['adults'] = (empty($adults))?$this->Pass_lib->adults:$adults;
        $this->data['child'] = (empty($childs))?(int)$this->Pass_lib->children:$childs;
        $this->data['currencySign'] = $this->Pass_lib->currencysign;
        $this->data['lowestPrice'] = $this->Pass_lib->bestPrice($this->data['module']->id);
        $this->data['langurl'] = base_url() . "pass/{langid}/" . $this->data['module']->slug;
        $this->setMetaData($this->data['module']->title, $this->data['module']->metadesc, $this->data['module']->keywords);
        $this->data['city'] = $city;
        $this->data['checkin'] = (!empty($searchform_checkin))?$searchform_checkin:$this->data['checkin'];
        $this->data['checkin'] = str_replace('-','/',$this->data['checkin']);
        $this->data['checkout'] = (!empty($searchform_checkout))?$searchform_checkout:$this->data['checkout'];
        $this->data['checkout'] = str_replace('-','/',$this->data['checkout']);
        $this->data['passname'] = $passname;
        $this->data['city'] = $city;
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
    echo 'xxxx';die;
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



  function search(...$args)

  {
      $this->data['loadMap'] = TRUE;
      $country = "NULL";

      $city = "NULL";

      $priceRange = 0;

      $stars = 0;

      $propertyTypes = "";

      $amenities = "";

      $this->load->model('Pass/Pass_model');

      $fswitch = true;

      if(count($args) == 6) {

        list($country,$city,$checkin,$checkout,$adults,$childs) = $args;

        $select2 = array(

            "id" => $country.'/'.$city,

            "text" => ucwords($city).', '.ucwords(str_replace('-',' ',$country)),

            "type" => 'location'

        );

        $dataset = $this->Pass_model->searchByLocation($city);

      } else if(count($args) == 5) {

        // Deprecated

        list($passname,$checkin,$checkout,$adults,$childs) = $args;

        $select2 = array(

            "id" => $passname,

            "text" => ucwords(str_replace('-',' ',$passname)),

            "type" => 'pass'

        );

        $dataset = $this->Pass_model->searchByHotelname($passname);

      } else if(count($args) == 4) { // filters if user came from header menus

          list($stars,$priceRange,$propertyTypes,$amenities) = $args;

          $dataset = $this->Pass_model->getAllPassByFilter($args);

          $this->data['uri'] = base_url('pass/search');

          $fswitch = false;

      } else {

          list($country,$city,$checkin,$checkout,$adults,$childs,$stars,$priceRange,$propertyTypes,$amenities) = $args;

          $dataset = $this->Pass_model->searchByFilters($args);

      }

      $this->session->set_userdata(array(

          "pass_select2" => $select2,

          "pass_checkin" => str_replace('-','/',$checkin),

          "pass_checkout" => str_replace('-','/',$checkout),

          "pass_adults" => $adults,

          "pass_child" => $childs,

          "custom_pass_checkin" => $checkin,

          "custom_pass_checkout" => $checkout

      ));

      $_SESSION['search_pass_checkin'] = $checkin;
      $_SESSION['search_pass_checkout'] = $checkout;

      $this->data['module'] = $dataset;

      $this->lang->load("front", $this->data['lang_set']);

      $this->data['amenities'] = $this->Pass_lib->getHotelAmenities();

      $this->data['moduleTypes'] = $this->Pass_lib->getHotelTypes();

      $settings = $this->Settings_model->get_front_settings('pass');

      $this->data['minprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_min_price);

      $this->data['maxprice'] = $this->Pass_lib->convertAmount($settings[0]->front_search_max_price);

      $this->data['currCode'] = $this->Pass_lib->currencycode;

      $this->data['currSign'] = $this->Pass_lib->currencysign;

      $this->data['langurl']  = base_url() . "pass/{langid}";

      $this->data['country'] = $country;

      $this->data['city'] = $city;

      $this->data['priceRange'] = $priceRange;

      $this->data['starsCount'] = $stars;

      $this->data['fpropertyTypes'] = $propertyTypes;

      $this->data['famenities'] = $amenities;

      if($fswitch) {

        $this->data['uri'] = base_url('pass/search/'.$country.'/'.$city.'/'.$checkin.'/'.$checkout.'/'.$adults.'/'.$childs);

      }

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

    function book($passname)
    {

        $this->load->model('Admin/Countries_model');

        $this->data['allcountries'] = $this->Countries_model->get_all_countries();

        $check = $this->Pass_model->pass_exists($passname);

        $this->load->library("Paymentgateways");

        $this->data['hideHeader'] = "1";


        if ($check && !empty($passname)) {

            $this->load->model('Admin/Payments_model');

            $this->data['error'] = "";

            $this->Pass_lib->set_passid($passname);

            $passID = $this->Pass_lib->get_id();

            $roomID = $this->input->get('roomid');
            $rooms = $this->input->get('rooms');
            $roomsCount = $this->input->get('roomscount');
            $extrabeds = $this->input->get('extrabeds');

            $this->data['rooms'] = array();
            $this->data['module'] = array();
            $this->data['subitemid'] = array();
            $this->data['roomscount'] = array();
            $this->data['bedscount'] = array();
            $this->data['extrabedcharges'] = 0;
            $this->load->library('currconverter');

            foreach ($rooms as $index => $roomID) {
                $bookInfo = $this->Pass_lib->getBookResultObject($passID, $roomID, $roomsCount[$roomID], $extrabeds[$roomID]);
                array_push($this->data['module'], $bookInfo['pass']);
                $this->data['module'] = $bookInfo['pass'];

                $this->data['extraChkUrl'] = $bookInfo['pass']->extraChkUrl;

                $room = $bookInfo['room'];

                if ($room->price < 1 || $room->stay < 1) {

                    $this->data['error'] = "error";

                }

                $this->data['module_adults'] += $bookInfo['pass']->adults;
                $this->data['currSymbol'] = $room->currSymbol;
                $this->data['currCode'] = $room->currCode;

                // $taxAmount = $this->currconverter->removeComma($bookInfo['pass']->taxAmount);
                // $this->data['taxAmount'] += $taxAmount;
                // $depositAmount = $this->currconverter->removeComma($bookInfo['pass']->depositAmount);
                // $this->data['depositAmount'] += $depositAmount;

                $price = $this->currconverter->removeComma($room->price);
                $this->data['price'] += $price;

                array_push($this->data['rooms'], $room);
                array_push($this->data['subitemid'], $roomID);
                array_push($this->data['roomscount'], $roomsCount[$roomID]);
                // array_push($this->data['bedscount'], $extrabeds[$roomID]);
                $extrabedcharges = $this->currconverter->removeComma($room->extraBedCharges);
                $this->data['extrabedcharges'] += $extrabedcharges;
            }
            $this->data['bedscount'] = json_encode($extrabeds);
            $this->Pass_lib->setTax($this->data['price']);
            $this->data['taxAmount'] = $this->currconverter->convertPrice($this->Pass_lib->taxamount);
            $this->Pass_lib->setDeposit($this->data['price']);
            $this->data['depositAmount'] = $this->currconverter->convertPrice($this->Pass_lib->deposit);
            $this->load->library('Pass/Pass_lib');
            $this->Pass_lib->setDeposit($this->data['price']);
            $this->data['depositAmount'] = $this->Pass_lib->deposit;
            $this->data['price'] += $this->Pass_lib->taxamount;

            $this->load->model('Admin/Accounts_model');

            $loggedin = $this->loggedin = $this->session->userdata('pt_logged_customer');

            $this->lang->load("front", $this->data['lang_set']);

            $this->data['profile'] = $this->Accounts_model->get_profile_details($loggedin);
            $this->data['stay'] = pt_count_days($this->data['module']->checkin, $this->data['module']->checkout);

            $this->setMetaData($this->data['module']->title, $this->data['module']->metadesc, $this->data['module']->keywords);
            $this->theme->view('modules/pass/booking', $this->data, $this);

        } else {

            redirect("pass");

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

        $allpass = $this->Pass_lib->showPassByLocation($result, $result->offset);

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