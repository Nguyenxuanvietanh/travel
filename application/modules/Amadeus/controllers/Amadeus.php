<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
class Amadeus extends MX_Controller 
{
    public $sandbox_mode = false;

    public function __construct()
    {
        parent::__construct();
        modules::load('Front');
        $chk = $this->App->service('ModuleService')->isActive('amadeus');
        if (!$chk) { Error_404($this); }
        $this->data['lang_set'] = $this->session->userdata('set_lang');
        $this->data['phone'] = $this->load->get_var('phone');
        $this->data['contactemail'] = $this->load->get_var('contactemail');
        $defaultlang = pt_get_default_language();
        if (empty($this->data['lang_set'])) {
            $this->data['lang_set'] = $defaultlang;
        }
        $this->lang->load("front", $this->data['lang_set']);
        $this->data['hideLang'] = "show";
        $this->data['hideCurr'] = "";
        $this->data['appModule'] = 'amadeus';
        $this->load->module("Amadeus");
        $this->load->model('Amadeus/Amadeus_model');
        $this->load->library('Amadeus_lib');
        $this->data['search_form'] = ('');
        $this->load->helper("all");
    }

    public function index()
    {   
        if (empty($this->uri->segment(3)) && empty($this->uri->segment(4)) && empty($this->uri->segment(5))) {
            redirect(site_url('m-airlines'));
        }
        if ($this->uri->segment(12) == 'round') {
            $return_date = $this->uri->segment(14);
        } else {
            $return_date = "";
        }
        $this->session->set_userdata('origin',$this->uri->segment(3));
        $this->session->set_userdata('destination',$this->uri->segment(4));
        $this->data['moduleSetting'] = $this->App->service("ModuleService")->get("Amadeus");
        $param = array(
            'origin' => ($this->uri->segment(3))?strtoupper($this->uri->segment(3)):"",
            'destination' => ($this->uri->segment(4))?strtoupper($this->uri->segment(4)):"",
            'departureDate' => ($this->uri->segment(5))?date("Y-m-d",strtotime($this->uri->segment(5))):date('Y-m-d'),
            'totalpassengers' => intval($this->uri->segment(6)?$this->uri->segment(6):1),
            'madult' => intval($this->uri->segment(7)?$this->uri->segment(7):1),
            'mchildren' => intval($this->uri->segment(8)?$this->uri->segment(8):0),
            'minfant' => intval($this->uri->segment(9)?$this->uri->segment(9):0),
            'seniors' => intval($this->uri->segment(10)?$this->uri->segment(10):0),
            'class_type' => strtoupper($this->uri->segment(11)?$this->uri->segment(11):'economy'),
            'triptypename' => $this->uri->segment(12)?$this->uri->segment(12):'oneway',
            'nonStop' => $this->uri->segment(13)?$this->uri->segment(13):'true',
            'currency' => $this->session->userdata("currencycode"),
            'currencysymbol' => $this->session->userdata("currencysymbol"),
            'commission' => $this->data['moduleSetting']->apiConfig->commission,
            'return_date'=> $return_date
        );
        $data_from_library = $this->Amadeus_lib->index($param);
        $data_amadeus = json_decode($data_from_library,true);
        $this->data['pageTitle'] = "Search Results - From ".$data_amadeus['origin']." to ".$data_amadeus['destination'];
        $this->data['amadeus_data'] = $data_amadeus;
        $this->theme->view('modules/amadeus/listing',$this->data,$this);
    }

    public function airport_data(){
        $search = $this->input->get('q');
        $airport_data = $this->Amadeus_model->get_airport($search);
        $json = [];
        foreach ($airport_data as $code) {
            $json[] = ['id'=>$code['code'], 'text'=> $code['cityName']." - ".$code['name']. " (".$code['code'].")" ];
        }
        echo json_encode($json);
    }

    public function airlines(){
        $search = $this->input->get('q');
        $airport_data = $this->Amadeus_model->get_airline($search);
        $json = [];
        foreach ($airport_data as $code) {
            $json[] = ['id'=>$code['iata'], 'text'=> $code['airline']." (".$code['iata'].")" ];
        }
        echo json_encode($json);
    }

    public function booking(){
        $this->data['pageTitle'] = "Booking";
        $data = $this->input->post();
        if (empty($data)) {
            redirect(site_url('airlines'));
        } elseif(empty($data['flight_offers'])){
            redirect(site_url('airlines'));
        } else {
            $this->data['booking_data'] = $data;
            $this->data['countries'] = $this->Amadeus_model->countries();
            $this->theme->view('modules/amadeus/booking',$this->data,$this); 
        }
    }

    public function invoice(){
        $madult = $this->input->post("madult",true);
        $mchildren = $this->input->post("mchildren",true);
        $minfant = $this->input->post("minfant",true);
        $seniors = $this->input->post("seniors",true);
        $madult_passenger = ($madult['passenger'])?$madult['passenger']:0;
        $madult_total = ($madult['total'])?$madult['total']:0;
        $madult_tax = ($madult['totalTaxes'])?$madult['totalTaxes']:0;    
        $mchildren_passenger = ($mchildren['passenger'])?$mchildren['passenger']:0;
        $mchildren_total = ($mchildren['total'])?$mchildren['total']:0;
        $mchildren_tax = ($mchildren['totalTaxes'])?$mchildren['totalTaxes']:0;    
        $minfant_passenger = ($minfant['passenger'])?$minfant['passenger']:0;
        $minfant_total = ($minfant['total'])?$minfant['total']:0;
        $minfant_tax = ($minfant['totalTaxes'])?$minfant['totalTaxes']:0;    
        $seniors_passenger = ($seniors['passenger'])?$seniors['passenger']:0;
        $seniors_total = ($seniors['total'])?$seniors['total']:0;
        $seniors_tax = ($seniors['totalTaxes'])?$seniors['totalTaxes']:0;    

        $params  = array(
            'madult'=> $madult_passenger,
            'madult_price'=> $madult_total,
            'madult_tax'=>$madult_tax,
            'mchildren'=>$mchildren_passenger,
            'mchildren_price'=>$mchildren_total,
            'mchildren_tax'=>$mchildren_tax,
            'minfant'=>$minfant_passenger,
            'minfant_price'=>$minfant_total,
            'minfant_tax'=>$minfant_tax,
            'seniors'=>$seniors_passenger,
            'seniors_price'=>$seniors_total,
            'seniors_tax'=>$seniors_tax, 
            'currency' => $this->input->post("currency"),
            'totalTaxes' => $this->input->post("totalTaxes",true),
            'totalPrice' => $this->input->post("totalPrice",true),
            'commission'=>($this->input->post("total_with_commission",true))-($this->input->post("totalPrice",true)),
            'total_with_commission' => $this->input->post("total_with_commission",true),
            'total_amount_with_tax' => $this->input->post("total_amount_with_tax",true),
            'firstname' => clean($this->input->post("firstname",true)),
            'lastname' => clean($this->input->post("lastname",true)),
            'email' => clean($this->input->post("email",true)),
            'phone' => clean($this->input->post("phone",true)),
            'address' => clean($this->input->post("address",true)),
            'country' => clean($this->input->post("country",true)),
            'note' => clean($this->input->post("additionalnotes",true)),
            'created_on' => date("Y-m-d H:i:s")
        );
        $booking_id = $this->Amadeus_model->insert_booking($params);
        if ($booking_id > 0) {
            $booking_data = $this->input->post("booking_data");
            $count = count($booking_data['carrier_code']);
            for ($i=0; $i < $count ; $i++) {
                $flight_segment = array(
                    'booking_id'=> $booking_id,
                    'carrier_code' => $booking_data['carrier_code'][$i],
                    'iataCode_departure'=> $booking_data['iataCode_departure'][$i],
                    'iataCode_arrival'=> $booking_data['iataCode_arrival'][$i],
                    'departure_at'=> date("Y-m-d H:i:s", strtotime($booking_data['departure_at'][$i])),
                    'arrival_at'=>date("Y-m-d H:i:s", strtotime($booking_data['arrival_at'][$i])),
                    'create_on'=> date('Y-m-d H:i:s')
                );  
                $this->Amadeus_model->insert_flight_data($flight_segment);
            }
            $data['email'] = $this->input->post();
            $this->load->library('email');
            $this->email->from($this->email->mail_fromemail, $this->email->site_title);
            $this->email->to(clean($this->input->post("email")));
            $this->email->subject('Flight Booking Confirmation');

            $message  = $this->email->mail_header;
            // $message .= $this->load->view('email',$data,true);
            $message .= $this->email->mail_footer;
            $this->email->message($message);
            //$this->email->send();
            $status = array('status' => 1);
        } else {
            $status = array('status' => 0);
        }
        echo json_encode($status);
    }
    
    function redirect(){
        redirect(site_url("airlines"));
    }
}
