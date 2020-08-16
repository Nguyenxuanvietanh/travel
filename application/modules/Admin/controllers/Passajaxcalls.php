<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Passajaxcalls extends MX_Controller {

		public $isadmin;

		function __construct() {
			modules :: load('Admin');
			$this->load->model('Pass/Pass_model');
			$this->isadmin = $this->session->userdata('pt_logged_admin');
		}

		function makethumb() {
				$newthumb = $this->input->post('imgname');
				$passid = $this->input->post('itemid');
				$this->Pass_model->updatePassThumb($passid, $newthumb,"update");
		}

// delete multiple Pass

		public function delete_multiple_pass() {
				$passlist = $this->input->post('passlist');
				foreach ($passlist as $passid) {
						$this->Pass_model->delete_pass($passid);
				}
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}
// Delete Single pass

		public function delete_single_pass() {
				$passid = $this->input->post('passid');
				$this->Pass_model->delete_pass($passid);
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}

// update Pass order

		public function update_pass_order() {
		  $passid = $this->input->post('id');
		  $order = $this->input->post('order');
		  $this->db->select('pass_id');
          $total = $this->db->get('pt_pass')->num_rows();

          if($order > $total){
            echo '0';
          }else{
          $this->Pass_model->update_pass_order($passid, $order);
            echo '1';
          }

		}

// Disable multiple Pass

		public function disable_multiple_pass() {
				$passlist = $this->input->post('passlist');
				foreach ($passlist as $passid) {
						$this->Pass_model->disable_pass($passid);
				}
				$this->session->set_flashdata('flashmsgs', "Disabled Successfully");
		}
// Enable multiple Pass

		public function enable_multiple_pass() {
				$passlist = $this->input->post('passlist');
				foreach ($passlist as $passid) {
						$this->Pass_model->enable_pass($passid);
				}
				$this->session->set_flashdata('flashmsgs', "Enabled Successfully");
		}


// delete single pass unavailability

		public function delete_single_unavail() {
				$unavailid = $this->input->post('unavailid');
				$this->Pass_model->delete_unavail($unavailid);
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}

// delete multiple pass unavailability
		function delete_multiple_unavail() {
				$unlist = $this->input->post('unlist');
				foreach ($unlist as $id) {
						$this->Pass_model->delete_unavail($id);
				}
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}

// update featured pass option
		function update_featured() {
			if(!empty($this->isadmin )){
				$this->Pass_model->update_featured();
			  	echo "done";
			  }
		}

		function add_price() {
				$this->Pass_model->add_aprice();
		}

		function update_price() {
				$this->Pass_model->update_aprice();
				$this->session->set_flashdata('flashmsgs', "Updated Successfully");
		}

		function add_unavail_pass() {
				$this->Pass_model->add_unavail_pass();
		}

		function update_unavail() {
				$this->Pass_model->update_unavail_pass();
				$this->session->set_flashdata('flashmsgs', "Updated Successfully");
		}

		function delete_image() {
				$imgname = $this->input->post('imgname');
				$passid = $this->input->post('itemid');
				$imgid = $this->input->post('imgid');
				$this->Pass_model->delete_image($imgname,$imgid,$passid);
		}

        function deleteMultiplePassImages(){
          $data = $this->input->post('imgids');
          foreach($data as $d){
                $this->Pass_model->delete_image($d['imgname'],$d['imgid'],$d['itemid']);
          }


        }

        function deleteMultipleRoomImages(){
          $data = $this->input->post('imgids');
          foreach($data as $d){
                $this->Rooms_model->delete_image($d['imgname'],$d['imgid'],$d['itemid']);
          }


        }

		function app_rej_himages() {
			  $this->Pass_model->approve_reject_images();
		}

		function app_rej_rimages() {
				$this->Rooms_model->approve_reject_images();
		}



// Add pass settings data
		function add_pass_settings() {
				$this->Pass_model->add_settings_data();
		}

// update pass settings data
		function update_pass_settings() {
				$this->Pass_model->update_settings_data();
		}

// delete multiple settings
		function delete_multiple_settings() {
				$idlist = $this->input->post('idlist');
				foreach ($idlist as $id) {
						$this->Pass_model->delete_settings($id);
				}
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}

// delete multiple settings
		function delete_single_settings() {
				$id = $this->input->post('id');
				$this->Pass_model->delete_settings($id);
				$this->session->set_flashdata('flashmsgs', "Deleted Successfully");
		}

// disable multiple settings
		function disable_multiple_settings() {
				$idlist = $this->input->post('idlist');
				foreach ($idlist as $id) {
						$this->Pass_model->disable_settings($id);
				}
				$this->session->set_flashdata('flashmsgs', "Disabled Successfully");
		}

// enable multiple settings
		function enable_multiple_settings() {
				$idlist = $this->input->post('idlist');
				foreach ($idlist as $id) {
						$this->Pass_model->enable_settings($id);
				}
				$this->session->set_flashdata('flashmsgs', "Enabled Successfully");
		}
// Delete Pass
        function delPass(){
          $id = $this->input->post('id');
          $this->Pass_model->delete_pass($id);
        }
// Delete Multiple Pass
        function delMultiplePass(){
          $items = $this->input->post('items');
          foreach($items as $item){
          	$this->Pass_model->delete_pass($item);
          }
        
     
        }
// Delete Room
        function delRoom(){
          $id = $this->input->post('id');
          $this->Rooms_model->deleteRoom($id);
        }
// Delete Multiple Rooms
        function delMultipleRooms(){
          $items = $this->input->post('items');
          foreach($items as $item){
          	 $this->Rooms_model->deleteRoom($item);
          }
        
     
        }
// Delete Room Prices
	function deleteRoomPrice(){
		$id = $this->input->post('id');
		$this->Rooms_model->deleteRoomPrice($id);
	}

	function delPassCategory(){
		$id = $this->input->post('id');
		$this->Pass_model->deletePassCategory($id);
	}

     // delete multiple settings
   function delMultiPassCategories(){
    $items = $this->input->post('items');

	foreach($items as $item){
		$this->Pass_model->deleteMultiplePassCategories($item,$type);
	}

   }

	function passExtrasBooking()
	{
		$this->load->library('currconverter');
		$this->load->library('Pass/Pass_lib');
        $passid = $this->input->post('itemid');
        $checkin = $this->input->post('checkin');
        $checkout = $this->input->post('checkout');
        $extras = $this->input->post('extras');
		$extrabeds = $this->input->post('bedscount');
		$adults = $this->input->post('adults');
		$taxAmount = $this->input->post('taxAmount');
		
			$_extrabeds = json_decode($extrabeds, true);
			$response = array();
			
			$_final_response = new stdClass;
			$_final_response->grandTotal = 0;
			$_final_response->taxAmount = 0;
			$_final_response->depositAmount = 0;
			$_final_response->extrashtml = '';
			$_final_response->bookingType = '';
			$_final_response->currCode = '';
			$_final_response->currSymbol = '';
			$_final_response->subitem = array();
			$_final_response->stay = 0;
			$_final_response->extrasInfo = [];
			$_final_response->extraBedCharges = 0;
			foreach ($response as $resp)
			{
				$_final_response->tmp[] = $resp;
				$_final_response->grandTotal += $this->currconverter->removeComma($resp->grandTotal);
				$_final_response->taxAmount += $resp->taxAmount;
				$_final_response->depositAmount += round($resp->depositAmount);
				$_final_response->extrashtml .= $resp->extrashtml;
				$_final_response->bookingType = $resp->bookingType;
				$_final_response->currCode = $resp->currCode;
				$_final_response->currSymbol = $resp->currSymbol;
				$_final_response->subitem[] = $resp->subitem;
				$_final_response->extrasInfo = $resp->extrasInfo;
				$_final_response->stay = $resp->stay;
				$_final_response->extraBedCharges = $resp->extraBedCharges;
			}
			$this->load->library('currconverter');
			$curr = $this->currconverter;
			$extratotal = $this->Pass_lib->extrasFee($extras);
			if (isset($extratotal['extrasTotalFee']) && ! empty($extratotal['extrasTotalFee'])) {
				$_final_response->grandTotal += $extratotal['extrasTotalFee'];
			}
			// Desposit amount
			$this->Pass_lib->setDeposit($_final_response->grandTotal);
			$_final_response->depositAmount = $this->Pass_lib->deposit;
			// Tax amount
			$this->Pass_lib->setTax($_final_response->grandTotal);
			$_final_response->taxAmount = $this->Pass_lib->taxamount;
			$_final_response->grandTotal += $_final_response->taxAmount;

			if(isset($extratotal['extrasInfo']) && ! empty($extratotal['extrasInfo'])) {
				foreach ($extratotal['extrasInfo'] as $einfo) {
					$_final_response->extrashtml .= "<tr class='allextras'><td>" . $einfo['title'] . "</td>
					<td class='text-right'>" . $curr->code . " " . $curr->symbol . $einfo['price'] . "</td></tr>";
				}
			}
			$this->output->set_output(json_encode($_final_response));
       }

}