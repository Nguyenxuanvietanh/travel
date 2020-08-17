<?php

use DateTime;

class Pass_model extends CI_Model {

        public $langdef;

        public $isSuperAdmin = null;

		function __construct()

        {

            // Call the Model constructor

            parent :: __construct();

            $this->langdef = $this->session->userdata('set_lang');

            $this->langdef = (!empty($this->langdef))?$this->langdef:DEFLANG;

            $this->isSuperAdmin = $this->session->userdata('pt_logged_super_admin');

		}



        public function getSearchResult($args)

        {

            list($checkin,$checkout,$adults,$childs) = $args;

            $this->db->query('SET SESSION group_concat_max_len=102400');

            $localeCondition = $this->db->where('trans_lang',$this->langdef)->get('pt_pass_translation')->num_rows();



            if($localeCondition > 0) {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

                    (

                        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                            "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                            "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                            "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                            "trans_name":"\', `pt_pass_categories_translation`.`trans_name`, \'"

                         }\')), "]")

                        FROM pt_pass_categories 

                        LEFT JOIN pt_pass_categories_translation ON pt_pass_categories.sett_id = pt_pass_categories_translation.sett_id 

                        WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

                        AND pt_pass_categories_translation.trans_lang = "'.$this->langdef.'"

                    ) AS h_amenities, (SELECT ';

            } else {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

                    (

                        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                            "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                            "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                            "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                            "trans_name":"\', ,\'"

                         }\')), "]")

                        FROM pt_pass_categories 

                        WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

                    ) AS h_amenities, (SELECT ';

            }



            if($localeCondition) {

                $query .= ' IFNULL(pt_locations_translation.loc_name, pt_locations.location) AS loc_name ';

            } else {

                $query .= ' pt_locations.location AS loc_name ';

            }

            $query .= ' 

                        FROM pt_locations

                        LEFT JOIN pt_locations_translation ON pt_locations_translation.loc_id = pt_locations.id

                        WHERE pt_locations.id = pt_pass.pass_city ';

            if($localeCondition) {

                $query .= ' AND pt_locations_translation.trans_lang = "'.$this->langdef.'" ';

            } else {

                $query .= ' LIMIT 1 ';

            }

            $query .= ' ) AS location_trans';

            $this->db->select($query);

            if($localeCondition > 0) {

                $this->db->select('pt_pass_translation.trans_title,pt_pass_translation.trans_desc');

            }

            $this->db->select('COUNT(pt_reviews.review_itemid) AS reviews_count');

            $this->db->select_avg('pt_reviews.review_overall', 'avg_review');

            $this->db->select('(

                SELECT GROUP_CONCAT(CONCAT(

                    Concat("checkin:",pt_rooms_prices.date_from), 

                    ",",

                    Concat("checkout:",pt_rooms_prices.date_to),

                    ",",

                    Concat("adults:",pt_rooms_prices.adults),

                    ",",

                    Concat("children:",pt_rooms_prices.children)

                ))

                FROM pt_rooms_prices

		        WHERE pt_rooms_prices.room_id = pt_rooms.room_id

		    ) AS room_checkinout');



            if($localeCondition > 0) {

                $this->db->join('pt_pass_translation', 'pt_pass.pass_id = pt_pass_translation.item_id', 'left');

            }

            $this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

            $this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

            $this->db->where('pt_pass.pass_status', 'Yes');

            if($localeCondition > 0) {

                $this->db->where('pt_pass_translation.trans_lang', $this->langdef);

            }

            // Start: Filter

            $this->db->group_by('pt_pass.pass_id');

            $this->db->having('FIND_IN_SET("checkin:'.date('Y-m-d', strtotime($checkin)).'", room_checkinout)');

            $this->db->having('FIND_IN_SET(" checkout:'.date('Y-m-d', strtotime($checkout)).'", room_checkinout)');

            $this->db->having('FIND_IN_SET(" adults:'.$adults.'", room_checkinout)');

            $this->db->having('FIND_IN_SET(" children:'.$childs.'", room_checkinout)');

            // End: Filter

            $result = $this->db->get('pt_pass')->result();

            return $result;

        }



		public function getAllPass($limit = 0, $offset = 0)

        {

            $this->db->query('SET SESSION group_concat_max_len=102400');

            $localeCondition = $this->db->where('trans_lang',$this->langdef)->get('pt_pass_translation')->num_rows();



            if($localeCondition > 0) {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', `pt_pass_categories_translation`.`trans_name`, \'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    LEFT JOIN pt_pass_categories_translation ON pt_pass_categories.sett_id = pt_pass_categories_translation.sett_id 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

                    AND pt_pass_categories_translation.trans_lang = "'.$this->langdef.'"

			    ) AS h_amenities, (SELECT ';

            } else {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', ,\'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

			    ) AS h_amenities, (SELECT ';

            }



            if($localeCondition) {

                $query .= ' IFNULL(pt_locations_translation.loc_name, pt_locations.location) AS loc_name ';

            } else {

                $query .= ' pt_locations.location AS loc_name ';

            }

			$query .= ' 

			        FROM pt_locations

			        LEFT JOIN pt_locations_translation ON pt_locations_translation.loc_id = pt_locations.id

			        WHERE pt_locations.id = pt_pass.pass_city ';

			if($localeCondition) {

                $query .= ' AND pt_locations_translation.trans_lang = "'.$this->langdef.'" ';

            } else {

                $query .= ' LIMIT 1 ';

            }

            $query .= ' ) AS location_trans';

            $this->db->select($query);

            if($localeCondition > 0) {

                $this->db->select('pt_pass_translation.trans_title,pt_pass_translation.trans_desc');

            }

            $this->db->select('COUNT(pt_reviews.review_itemid) AS reviews_count');

            $this->db->select_avg('pt_reviews.review_overall', 'avg_review');

            if($localeCondition > 0) {

                $this->db->join('pt_pass_translation', 'pt_pass.pass_id = pt_pass_translation.item_id', 'left');

            }

            $this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

            $this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

            $this->db->where('pt_pass.pass_status', 'Yes');

            if($localeCondition > 0) {

                $this->db->where('pt_pass_translation.trans_lang', $this->langdef);

            }

			$this->db->group_by('pt_pass.pass_id');

			$this->db->order_by('pt_pass.pass_id', 'DESC');

            if( ! empty($limit) ) {

                $result = $this->db->get('pt_pass', $limit, $offset)->result();

            } else {

                $result = $this->db->get('pt_pass')->result();

            }

            return $result;

		}

		

		public function getAllPassByFilter($args)

        {

			list($stars,$priceRange,$propertyTypes,$amenities) = $args;

			list($minPrice, $maxPrice) = explode('-', $priceRange);

            $this->db->query('SET SESSION group_concat_max_len=102400');

            $localeCondition = $this->db->where('trans_lang',$this->langdef)->get('pt_pass_translation')->num_rows();



            if($localeCondition > 0) {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', `pt_pass_categories_translation`.`trans_name`, \'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    LEFT JOIN pt_pass_categories_translation ON pt_pass_categories.sett_id = pt_pass_categories_translation.sett_id 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

                    AND pt_pass_categories_translation.trans_lang = "'.$this->langdef.'"

			    ) AS h_amenities, (SELECT ';

            } else {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', ,\'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

			    ) AS h_amenities, (SELECT ';

            }



            if($localeCondition) {

                $query .= ' IFNULL(pt_locations_translation.loc_name, pt_locations.location) AS loc_name ';

            } else {

                $query .= ' pt_locations.location AS loc_name ';

            }

			$query .= ' 

			        FROM pt_locations

			        LEFT JOIN pt_locations_translation ON pt_locations_translation.loc_id = pt_locations.id

			        WHERE pt_locations.id = pt_pass.pass_city ';

			if($localeCondition) {

                $query .= ' AND pt_locations_translation.trans_lang = "'.$this->langdef.'" ';

            } else {

                $query .= ' LIMIT 1 ';

            }

            $query .= ' ) AS location_trans';

            $this->db->select($query);

            if($localeCondition > 0) {

                $this->db->select('pt_pass_translation.trans_title,pt_pass_translation.trans_desc');

            }

            $this->db->select('COUNT(pt_reviews.review_itemid) AS reviews_count');

            $this->db->select_avg('pt_reviews.review_overall', 'avg_review');

            if($localeCondition > 0) {

                $this->db->join('pt_pass_translation', 'pt_pass.pass_id = pt_pass_translation.item_id', 'left');

            }

            $this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

            $this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

            $this->db->where('pt_pass.pass_status', 'Yes');

            if($localeCondition > 0) {

                $this->db->where('pt_pass_translation.trans_lang', $this->langdef);

			}

			// Start: filters

            if( ! empty($amenities) ) {

                $where_string = '';

                $amenities = explode('-', $amenities);

                foreach($amenities as $index => $amenity) {

                    $where_string .= 'FIND_IN_SET('.$amenity.', pt_pass.pass_amenities) ';

                    if(isset($amenities[$index+1])) {

                        $where_string .= 'AND ';

                    }

                }

                $this->db->where($where_string, NULL, FALSE);

            }

            if( ! empty($propertyTypes) ) {

                $propertyTypes = "'". implode("','", explode('-',$propertyTypes)) . "'";

                $this->db->where('pt_pass.pass_type IN ('.$propertyTypes.')', NULL, FALSE);

            }

            if( ! empty($stars) ) {

                $this->db->where('pt_pass.pass_stars >=', $stars);

            }

            if(! empty($minPrice) ) {

				$this->db->where('pt_rooms.room_basic_price >=', $minPrice);

                $this->db->where('pt_rooms.room_basic_price <=', $maxPrice);

            }

            // End: filters;

            $this->db->group_by('pt_pass.pass_id');

            if( ! empty($limit) ) {

                $result = $this->db->get('pt_pass', $limit, $offset)->result();

            } else {

                $result = $this->db->get('pt_pass')->result();

            }

            return $result;

        }



		public function searchByFilters($args = array(), $limit = 0, $offset = 0)

		{

		    list($country,$city,$checkin,$checkout,$adults,$childs,$stars,$priceRange,$propertyTypes,$amenities) = $args;

		    list($minPrice, $maxPrice) = explode('-', $priceRange);
			$city = str_replace('-',' ', $city);
            $this->db->query('SET SESSION group_concat_max_len=102400');

            $localeCondition = $this->db->where('trans_lang',$this->langdef)->get('pt_pass_translation')->num_rows();

            $pt_location = $this->db->select('pt_locations.id, pt_locations_translation.loc_name')

                ->join('pt_locations_translation', 'pt_locations_translation.id = pt_locations.id', 'left')

                ->where('LOWER(pt_locations.location)',strtolower($city))

                ->get('pt_locations')

                ->row();

            $loc_name = (!empty($pt_location->loc_name))?$pt_location->loc_name:'NULL';

            if($localeCondition > 0) {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', `pt_pass_categories_translation`.`trans_name`, \'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    LEFT JOIN pt_pass_categories_translation ON pt_pass_categories.sett_id = pt_pass_categories_translation.sett_id 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

                    AND pt_pass_categories_translation.trans_lang = "'.$this->langdef.'"

			    ) AS h_amenities, (SELECT "'.$loc_name.'") AS location_trans';

            } else {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', ,\'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

			    ) AS h_amenities, (SELECT "'.$loc_name.'") AS location_trans';

            }

            $this->db->select($query);

            if($localeCondition > 0) {

                $this->db->select('pt_pass_translation.trans_title,pt_pass_translation.trans_desc');

            }

            $this->db->select('COUNT(pt_reviews.review_itemid) AS reviews_count');

            $this->db->select_avg('pt_reviews.review_overall', 'avg_review');

            if($localeCondition > 0) {

                $this->db->join('pt_pass_translation', 'pt_pass.pass_id = pt_pass_translation.item_id', 'left');

            }

            $this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

            $this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

            $this->db->where('pt_pass.pass_city', $pt_location->id);

            $this->db->where('pt_pass.pass_status', 'Yes');

            if($localeCondition > 0) {

                $this->db->where('pt_pass_translation.trans_lang', $this->langdef);

            }

            // Start: filters

            if( ! empty($amenities) ) {

                $where_string = '';

                $amenities = explode('-', $amenities);

                foreach($amenities as $index => $amenity) {

                    $where_string .= 'FIND_IN_SET('.$amenity.', pt_pass.pass_amenities) ';

                    if(isset($amenities[$index+1])) {

                        $where_string .= 'AND ';

                    }

                }

                $this->db->where($where_string, NULL, FALSE);

            }

            if( ! empty($propertyTypes) ) {

                $propertyTypes = "'". implode("','", explode('-',$propertyTypes)) . "'";

                $this->db->where('pt_pass.pass_type IN ('.$propertyTypes.')', NULL, FALSE);

            }

            if( ! empty($stars) ) {

                $this->db->where('pt_pass.pass_stars =', $stars);

            }

            if(! empty($minPrice) ) {

                $this->db->where('pt_rooms.room_basic_price >=', $minPrice);

                $this->db->where('pt_rooms.room_basic_price <=', $maxPrice);

            }

            // End: filters;

            $this->db->group_by('pt_pass.pass_id');

            if( ! empty($limit) ) {

                $result = $this->db->get('pt_pass', $limit, $offset)->result();

            } else {

                $result = $this->db->get('pt_pass')->result();

            }

            return $result;

		}



        public function searchByLocation($city, $limit = 0, $offset = 0)

		{
		    $settings = $this->db->where('front_for', 'pass')->get('pt_front_settings')->row();
			$city = str_replace('-',' ', $city);
		    $this->db->query('SET SESSION group_concat_max_len=102400');

		    $localeCondition = $this->db->where('trans_lang',$this->langdef)->get('pt_pass_translation')->num_rows();

		    $pt_location = $this->db->select('pt_locations.id, pt_locations_translation.loc_name')

                ->join('pt_locations_translation', 'pt_locations_translation.id = pt_locations.id', 'left')

                ->where('LOWER(pt_locations.location)',strtolower($city))

                ->get('pt_locations')

                ->row();

            $loc_name = (!empty($pt_location->loc_name))?$pt_location->loc_name:'NULL';

            if($localeCondition > 0) {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', `pt_pass_categories_translation`.`trans_name`, \'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    LEFT JOIN pt_pass_categories_translation ON pt_pass_categories.sett_id = pt_pass_categories_translation.sett_id 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

                    AND pt_pass_categories_translation.trans_lang = "'.$this->langdef.'"

			    ) AS h_amenities, (SELECT "'.$loc_name.'") AS location_trans';

            } else {

                $query = 'pt_pass.*,min(pt_rooms.room_basic_price) as price, 

			    (

			        SELECT CONCAT("[", GROUP_CONCAT(CONCAT(\'{ 

                        "sett_id":\', `pt_pass_categories`.`sett_id`, \', 

                        "sett_name":"\', `pt_pass_categories`.`sett_name`, \'", 

                        "sett_img":"\', `pt_pass_categories`.`sett_img`, \'", 

                        "trans_name":"\', ,\'"

                     }\')), "]")

                    FROM pt_pass_categories 

                    WHERE FIND_IN_SET(pt_pass_categories.sett_id, pt_pass.pass_amenities) 

			    ) AS h_amenities, (SELECT "'.$loc_name.'") AS location_trans';

            }

            $this->db->select($query);

            if($localeCondition > 0) {

                $this->db->select('pt_pass_translation.trans_title,pt_pass_translation.trans_desc');

            }

            $this->db->select('COUNT(pt_reviews.review_itemid) AS reviews_count');

			$this->db->select_avg('pt_reviews.review_overall', 'avg_review');

			if($localeCondition > 0) {

                $this->db->join('pt_pass_translation', 'pt_pass.pass_id = pt_pass_translation.item_id', 'left');

            }

			$this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

			$this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

			$this->db->where('pt_pass.pass_city', $pt_location->id);

			$this->db->where('pt_pass.pass_status', 'Yes');

            if($localeCondition > 0) {

                $this->db->where('pt_pass_translation.trans_lang', $this->langdef);

            }

            if (!empty($settings->front_listings)) {
                $this->db->limit($settings->front_listings);
            }

            if (!empty($settings->front_listings_order)) {
                if ($settings->front_listings_order == 'oldf') {
                    $this->db->order_by("pt_pass.pass_id", "asc");
                } else if ($settings->front_listings_order == 'newf') {
                    $this->db->order_by("pt_pass.pass_id", "desc");
                } else if ($settings->front_listings_order == 'az') {
                    $this->db->order_by("pt_pass.pass_title", "desc");
                } else if ($settings->front_listings_order == 'za') {
                    $this->db->order_by("pt_pass.pass_title", "asc");
                }
            }

			$this->db->group_by('pt_pass.pass_id');

            if( ! empty($limit) ) {

				$result = $this->db->get('pt_pass', $limit, $offset)->result();

			} else {

				$result = $this->db->get('pt_pass')->result();

            }

			return $result;

		}



// Get all enabled pass short info

		function shortInfo($id = null) {

				$result = array();

				$this->db->select('pass_id,pass_title,pass_slug');

				if (!empty ($id)) {

						$this->db->where('pass_owned_by', $id);

				}

				$this->db->where('pass_status', 'Yes');

				$this->db->order_by('pass_id', 'desc');

				$pass = $this->db->get('pt_pass')->result();

				foreach($pass as $pass){

					$result[] = (object)array('id' => $pass->pass_id, 'title' => $pass->pass_title, 'slug' => $pass->pass_slug);

				}



				return $result;

		}





// Get all pass id and names only

		function all_pass_names($id = null) {

				$this->db->select('pass_id,pass_title,pass_slug');

				if (!empty ($id)) {

						$this->db->where('pass_owned_by', $id);

				}

				$this->db->order_by('pass_id', 'desc');

				return $this->db->get('pt_pass')->result();

		}



// Get all pass for extras

		function all_pass($id = null) {

				$this->db->select('pass_id as id,pass_title as title');

				if (!empty ($id)) {

						$this->db->where('pass_owned_by', $id);

				}

				$this->db->order_by('pass_id', 'desc');

				return $this->db->get('pt_pass')->result();

		}



// get all data of single pass by slug

		function get_pass_data($id) {
				$this->db->select('pt_pass.*');
				$this->db->where('pt_pass.id', $id);

				return $this->db->get('pt_pass')->result();

		}



// get data of single pass by id for maps

		function pass_data_for_map($id) {

				$this->db->select('pt_pass.pass_id,pt_pass.pass_title,pt_pass.pass_slug');

				$this->db->where('pt_pass.pass_id', $id);

/*  $this->db->where('pt_pass_images.himg_type','default');



$this->db->where('pt_pass_images.himg_approved','1');



$this->db->join('pt_pass_images','pt_pass.pass_id = pt_pass_images.himg_pass_id','left');*/

				return $this->db->get('pt_pass')->result();

		}



// add pass data

		function add_pass($user = null) {
			$sales_date = '';
			if(empty($user)){
				$user = 1;
			}

			$data = array(
				'name' => $this->input->post('name'),
				'status' => $this->input->post('status'),
				'type' => $this->input->post('type'),
				'category_id' => $this->input->post('category_id'),
				'sales_date' => convert_to_unix($this->input->post('sales_date')),
				'ammount' => $this->input->post('ammount'),
				'note' => $this->input->post('note'),
				'html_note' => $this->input->post('html_note'),
			);

			$this->db->insert('pt_pass', $data);

			$passid = $this->db->insert_id();

			return $passid;
		}



// update pass data

		function update_pass($id) {

			$data = array(
				'name' 			=> $this->input->post('name'),
				'ammount' 		=> $this->input->post('ammount'),
				'sales_date'	=> convert_to_unix($this->input->post('sales_date')),
				'status' 		=> $this->input->post('status'),
				'type' 			=> $this->input->post('type'),
				'category_id'	=> $this->input->post('category_id'),
				'note' 			=> $this->input->post('note'),
				'html_note' 	=> $this->input->post('html_note'),
			);

			$this->db->where('id', $id);
			$this->db->update('pt_pass', $data);
		}



// add pass images by type

		function add_pass_image($type, $filename, $passid) {

				$imgorder = 0;



             			$this->db->where('himg_type', 'slider');

						$this->db->where('himg_pass_id', $passid);

						$imgorder = $this->db->get('pt_pass_images')->num_rows();

						$imgorder = $imgorder + 1;

			 $approval = pt_admin_gallery_approve();

				$this->db->where('himg_type', 'default');

				$this->db->where('himg_pass_id', $passid);

				$hasdefault = $this->db->get('pt_pass_images')->num_rows();

				if ($hasdefault < 1) {

						$type = 'default';

				}

				$data = array('himg_pass_id' => $passid, 'himg_type' => $type, 'himg_image' => $filename, 'himg_order' => $imgorder, 'himg_approved' => $approval);

				$this->db->insert('pt_pass_images', $data);

		}



// update pass image by type

		function update_pass_image($type, $filename, $passid) {

				$data = array('himg_image' => $filename);

				$this->db->where("himg_type", $type);

				$this->db->where("himg_pass_id", $passid);

				$this->db->update('pt_pass_images', $data);

		}



// update pass order

		function update_pass_order($id, $order) {

				$data = array('pass_order' => $order);

				$this->db->where('pass_id', $id);

				$this->db->update('pt_pass', $data);

		}

// Disable Hotel



		public function disable_pass($id) {

				$data = array('pass_status' => '0');

				$this->db->where('pass_id', $id);

				$this->db->update('pt_pass', $data);

		}

// Enable Hotel



		public function enable_pass($id) {

				$data = array('pass_status' => '1');

				$this->db->where('pass_id', $id);

				$this->db->update('pt_pass', $data);

		}



// update featured status

		function update_featured() {

			   //	$forever = $this->input->post('foreverfeatured');

				$isfeatured = $this->input->post('isfeatured');

                $id = $this->input->post('id');



                if($isfeatured == "no"){

					$isforever = '';

				}else{



				$isforever = "forever";



				}



			   /*	if ($isfeatured == '1') {

						if ($forever == "forever") {

								$ffrom = date('Y-m-d');

								$fto = date('Y-m-d', strtotime('+1 years'));

								$isforever = 'forever';

						}

						else {

								$ffrom = $this->input->post('ffrom');

								$fto = $this->input->post('fto');

								$isforever = '';

						}

				}

				else {

						$ffrom = '';

						$fto = '';

						$isforever = 'forever';

				}*/



				//$data = array('pass_is_featured' => $isfeatured, 'pass_featured_from' => convert_to_unix($ffrom), 'pass_featured_to' => convert_to_unix($fto), 'pass_featured_forever' => $isforever);

			    $data = array('pass_is_featured' => $isfeatured, 'pass_featured_forever' => $isforever);

				$this->db->where('pass_id', $id);

				$this->db->update('pt_pass', $data);



		}











// Get Hotel Images

		function pass_images($id) {

				/*$this->db->where('himg_pass_id', $id);

				$this->db->where('himg_type', 'default');

				$this->db->order_by('himg_id', 'desc');

				$q = $this->db->get('pt_pass_images');

				$data['def_image'] = $q->result();*/

				$this->db->where('himg_type', 'slider');

				$this->db->order_by('himg_id', 'desc');

				$this->db->having('himg_pass_id', $id);

				$q = $this->db->get('pt_pass_images');

				$data['all_slider'] = $q->result();

				$data['slider_counts'] = $q->num_rows();

				/*$this->db->where('himg_pass_id', $id);

				$this->db->where('himg_type', 'interior');

				$this->db->order_by('himg_id', 'desc');

				$q2 = $this->db->get('pt_pass_images');

				$data['all_interior'] = $q2->result();

				$data['interior_counts'] = $q2->num_rows();

				$this->db->where('himg_pass_id', $id);

				$this->db->where('himg_type', 'exterior');

				$this->db->order_by('himg_id', 'desc');

				$q3 = $this->db->get('pt_pass_images');

				$data['all_exterior'] = $q3->result();

				$data['exterior_counts'] = $q3->num_rows();*/

				return $data;

		}



// Delete Hotel Images

		function delete_image($imgname, $imgid, $passid) {

				$this->db->where('himg_id', $imgid);

				$this->db->delete('pt_pass_images');

                $this->updateHotelThumb($passid,$imgname,"delete");

                @ unlink(PT_HOTELS_SLIDER_THUMBS_UPLOAD . $imgname);

				@ unlink(PT_HOTELS_SLIDER_UPLOAD . $imgname);



		}

//update pass thumbnail

		function updateHotelThumb($passid,$imgname,$action) {

		  if($action == "delete"){

            $this->db->select('thumbnail_image');

            $this->db->where('thumbnail_image',$imgname);

            $this->db->where('pass_id',$passid);

            $rs = $this->db->get('pt_pass')->num_rows();

            if($rs > 0){

              $data = array(

              'thumbnail_image' => PT_BLANK_IMG

              );

              $this->db->where('pass_id',$passid);

              $this->db->update('pt_pass',$data);

            }

            }else{

              $data = array(

              'thumbnail_image' => $imgname

              );

              $this->db->where('pass_id',$passid);

              $this->db->update('pt_pass',$data);

            }



		}



//update pass thumbnail

		function update_thumb($oldthumb, $newthumb, $passid) {

				$data = array('himg_type' => 'slider');

				$this->db->where('himg_id', $oldthumb);

				$this->db->where('himg_pass_id', $passid);

				$this->db->update('pt_pass_images', $data);

				$data2 = array('himg_type' => 'default');

				$this->db->where('himg_id', $newthumb);

				$this->db->where('himg_pass_id', $passid);

				$this->db->update('pt_pass_images', $data2);

		}



// update image order

		function update_image_order($imgid, $order) {

				$data = array('himg_order' => $order);

				$this->db->where('himg_id', $imgid);

				$this->db->update('pt_pass_images', $data);

		}





// get number of rooms of pass

		function rooms_count($passid) {

				$this->db->where('room_pass', $passid);

				$this->db->select_sum('room_quantity');

				$res = $this->db->get('pt_rooms')->result();

				return $res[0]->room_quantity;

		}



// get number of reviews of pass

		function reviews_count($passid) {

				$this->db->where('review_itemid', $passid);

				$this->db->where('review_module', 'pass');

				return $this->db->get('pt_reviews')->num_rows();

		}



// get number of photos of pass

		function photos_count($passid) {

				$this->db->where('himg_pass_id', $passid);

				return $this->db->get('pt_pass_images')->num_rows();

		}





// get default image of pass

		function default_pass_img($id) {

				$this->db->select('thumbnail_image');

				$this->db->where('pass_id', $id);

				$res = $this->db->get('pt_pass')->result();

				return $res[0]->thumbnail_image;

		}



// Approve or reject Hotel Images

		function approve_reject_images() {

				$data = array('himg_approved' => $this->input->post('apprej'));

				$this->db->where('himg_id', $this->input->post('imgid'));



                return $this->db->update('pt_pass_images', $data);

		}





// Delete Hotel

		function delete_pass($passid) {
				$this->db->where('id', $passid);
				$this->db->delete('pt_pass');

		}





// Disable pass settings

		function disable_settings($id) {

				$data = array('sett_status' => 'No');

				$this->db->where('sett_id', $id);

				$this->db->update('pt_pass_categories', $data);

		}



// Enable pass settings

		function enable_settings($id) {

				$data = array('sett_status' => 'Yes');

				$this->db->where('sett_id', $id);

				$this->db->update('pt_pass_categories', $data);

		}







// Check by slug

		function pass_exists($slug) {

				$this->db->select('id');

				$this->db->where('name', $slug);

				$nums = $this->db->get('pt_pass')->num_rows();

				if ($nums > 0) {
					return true;
				}

				else {
					return false;
				}
		}



// List all pass on front listings page

		function list_pass_front($perpage = null, $offset = null, $orderby = null) {

				$data = array();

               // $passlist = $lists['pass'];

				if ($offset != null) {

						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;

				}

				$this->db->select('pt_pass.pass_id,pt_pass.pass_stars,pt_pass.pass_title,pt_pass.pass_order,pt_pass.pass_order,pt_rooms.room_basic_price as price');

				if ($orderby == "za") {

						$this->db->order_by('pt_pass.pass_title', 'desc');

				}

				elseif ($orderby == "az") {

						$this->db->order_by('pt_pass.pass_title', 'asc');

				}

				elseif ($orderby == "oldf") {

						$this->db->order_by('pt_pass.pass_id', 'asc');

				}

				elseif ($orderby == "newf") {

						$this->db->order_by('pt_pass.pass_id', 'desc');

				}

				elseif ($orderby == "ol") {

						$this->db->order_by('pt_pass.pass_order', 'asc');

				}

				elseif ($orderby == "p_lh") {

						$this->db->order_by('pt_rooms.room_basic_price', 'asc');

				}

				elseif ($orderby == "p_hl") {

						$this->db->order_by('pt_rooms.room_basic_price', 'desc');

				}

				elseif ($orderby == "s_lh") {

						$this->db->order_by('pt_pass.pass_stars', 'asc');

				}

				elseif ($orderby == "s_hl") {

						$this->db->order_by('pt_pass.pass_stars', 'desc');

				}

               // $this->db->where_in('pt_pass.pass_id', $passlist);

				//$this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->group_by('pt_pass.pass_id');

                $this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

			    //$this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

				$this->db->where('pt_pass.pass_status', 'Yes');

				$query = $this->db->get('pt_pass', $perpage, $offset);

				$data['all'] = $query->result();

				$data['rows'] = $query->num_rows();

				return $data;

		}





// List all pass on front listings page based on location

		function listPassByLocation($locs, $perpage = null, $offset = null, $orderby = null) {

				$data = array();

               // $passlist = $lists['pass'];

				if ($offset != null) {

						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;

				}

				$this->db->select('pt_pass.pass_id,pt_pass.pass_stars,pt_pass.pass_title,pt_pass.pass_order,pt_pass.pass_order,pt_rooms.room_basic_price as price');

				if ($orderby == "za") {

						$this->db->order_by('pt_pass.pass_title', 'desc');

				}

				elseif ($orderby == "az") {

						$this->db->order_by('pt_pass.pass_title', 'asc');

				}

				elseif ($orderby == "oldf") {

						$this->db->order_by('pt_pass.pass_id', 'asc');

				}

				elseif ($orderby == "newf") {

						$this->db->order_by('pt_pass.pass_id', 'desc');

				}

				elseif ($orderby == "ol") {

						$this->db->order_by('pt_pass.pass_order', 'asc');

				}

				elseif ($orderby == "p_lh") {

						$this->db->order_by('pt_rooms.room_basic_price', 'asc');

				}

				elseif ($orderby == "p_hl") {

						$this->db->order_by('pt_rooms.room_basic_price', 'desc');

				}

				elseif ($orderby == "s_lh") {

						$this->db->order_by('pt_pass.pass_stars', 'asc');

				}

				elseif ($orderby == "s_hl") {

						$this->db->order_by('pt_pass.pass_stars', 'desc');

				}

               // $this->db->where_in('pt_pass.pass_id', $passlist);

				//$this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->group_by('pt_pass.pass_id');

                $this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

                if(is_array($locs)){

                $this->db->where_in('pt_pass.pass_city',$locs);

                }else{

                $this->db->where('pt_pass.pass_city',$locs);

                }



				$this->db->where('pt_pass.pass_status', 'Yes');

				$query = $this->db->get('pt_pass', $perpage, $offset);

				$data['all'] = $query->result();

				$data['rows'] = $query->num_rows();

				return $data;

		}

// Search pass from home page

		function search_pass_front($perpage = null, $offset = null, $orderby = null, $cities = null,$lists = null) {

				$data = array();

				$searchtxt = $this->input->get('txtSearch');

				$checkin = $this->input->get('checkin');

				$checkout = $this->input->get('checkout');

				$adult = $this->input->get('adults');

				$child = $this->input->get('child');

				$types = $this->input->get('type');

				$amenities = $this->input->get('amenities');

				$groups = $this->input->get('group');

				$categories = $this->input->get('category');

				$stars = $this->input->get('stars');

				$sprice = $this->input->get('price');

				$days = pt_count_days($checkin, $checkout);

                $checkindate = convert_to_unix($checkin);

                $checkoutdate = convert_to_unix($checkout);

                //$passlist = $lists['pass'];

                //$roomslist = $lists['rooms'];

				if ($offset != null) {

						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;

				}



            	$this->db->select("pt_pass.*,pt_rooms.room_basic_price as price");

				if ($orderby == "za") {

						$this->db->order_by('pt_pass.pass_title', 'desc');

				}

				elseif ($orderby == "az") {

						$this->db->order_by('pt_pass.pass_title', 'asc');

				}

				elseif ($orderby == "oldf") {

						$this->db->order_by('pt_pass.pass_id', 'asc');

				}

				elseif ($orderby == "newf") {

						$this->db->order_by('pt_pass.pass_id', 'desc');

				}

				elseif ($orderby == "ol") {

						$this->db->order_by('pt_pass.pass_order', 'asc');

				}

				elseif ($orderby == "p_lh") {

				    	$this->db->order_by('pt_rooms.room_basic_price', 'asc');



				}

				elseif ($orderby == "p_hl") {

				   	$this->db->order_by('pt_rooms.room_basic_price', 'desc');



				}

				elseif ($orderby == "s_lh") {

						$this->db->order_by('pt_pass.pass_stars', 'asc');

				}

				elseif ($orderby == "s_hl") {

						$this->db->order_by('pt_pass.pass_stars', 'desc');

				}

			   /*	if (!empty ($adult)) {

						$this->db->where('pt_pass.pass_adults <=', $adult);

				}

				if (!empty ($child)) {

						$this->db->where('pt_pass.pass_children <=', $child);

				}*/

				if (!empty ($types)) {

						$this->db->where_in('pt_pass.pass_type', $types);

				}



				if (!empty ($amenities)) {

					foreach($amenities as $am){



						$this->db->or_like('pt_pass.pass_amenities', $am);

					}

				}



				if (!empty ($stars)) {

						$this->db->where('pt_pass.pass_stars', $stars);

				}

				if (!empty ($sprice)) {

						/*$sprice = str_replace(";", ",", $sprice);

						$sprice = explode(",", $sprice);

						$minp = $sprice[0];

						$maxp = $sprice[1];

						$this->db->where('pt_rooms.room_basic_price >=', $minp);

						$this->db->where('pt_rooms.room_basic_price <=', $maxp);*/



				}

               // $this->db->where_in('pt_pass.pass_id', $passlist);

                //$this->db->select_avg('pt_reviews.review_overall', 'overall');



/*$this->db->where('MATCH (pt_pass.pass_title) AGAINST ("'. $searchtxt .'")', NULL, false);

$this->db->or_where('MATCH (pt_pass_translation.trans_title) AGAINST ("'. $searchtxt .'")', NULL, false);*/



				if(!empty($searchtxt)){

				$this->db->like('pt_pass.pass_title',$searchtxt);

				$this->db->or_like('pt_pass_translation.trans_title',$searchtxt);

				}







            	$this->db->group_by('pt_pass.pass_id');

				$this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

			    $this->db->join('pt_pass_translation', 'pt_pass.pass_id = pt_pass_translation.item_id', 'left');

				$this->db->having('pt_pass.pass_status', 'Yes');

				if(!empty($perpage)){

				$query = $this->db->get('pt_pass', $perpage, $offset);

			}else{

				$query = $this->db->get('pt_pass');

			}

			/*echo $this->db->_error_message();

			exit;*/

				$data['all'] = $query->result();

				$data['rows'] = $query->num_rows();



				return $data;

		}

//search pass by text

		function search_pass_by_text($cityid, $perpage = null, $offset = null, $orderby = null, $cities = null,$lists = null,$checkin = null,$checkout = null) {

				$data = array();



                $searchtxt = $cityid;// $this->input->get('searching');

                if(empty($checkin)){

                	$checkin = $this->input->get('checkin');

                }



                if(empty($checkout)){

                	$checkout = $this->input->get('checkout');

                }



				$adult = $this->input->get('adults');

				$child = $this->input->get('child');

				$stars = $this->input->get('stars');

				$sprice = $this->input->get('price');

				$types = $this->input->get('type');



                //$passlist = $lists['pass'];

				if ($offset != null) {

						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;

				}

				$this->db->select('pt_pass.*,pt_rooms.room_basic_price as price,pt_pass_translation.trans_title');

				$this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->where('pt_pass.pass_city', $searchtxt);



/*$this->db->where('MATCH (pt_pass.pass_title) AGAINST ("'. $searchtxt .'")', NULL, false);

$this->db->or_where('MATCH (pt_pass_translation.trans_title) AGAINST ("'. $searchtxt .'")', NULL, false);

$this->db->or_where('MATCH (pt_pass.pass_city) AGAINST ("'. $searchtxt .'")', NULL, false);

*/



                	/*$this->db->like('pt_pass.pass_title', $searchtxt);

				    $this->db->or_like('pt_pass_translation.trans_title', $searchtxt);

				    $this->db->or_like('pt_pass.pass_city', $searchtxt);*/



			 if (!empty ($stars)) {

						$this->db->having('pt_pass.pass_stars', $stars);

				}

				if ($orderby == "za") {

						$this->db->order_by('pt_pass.pass_title', 'desc');

				}

				elseif ($orderby == "az") {

						$this->db->order_by('pt_pass.pass_title', 'asc');

				}

				elseif ($orderby == "oldf") {

						$this->db->order_by('pt_pass.pass_id', 'asc');

				}

				elseif ($orderby == "newf") {

						$this->db->order_by('pt_pass.pass_id', 'desc');

				}

				elseif ($orderby == "ol") {

						$this->db->order_by('pt_pass.pass_order', 'asc');

				}

				elseif ($orderby == "p_lh") {

						$this->db->order_by('pt_pass.pass_basic_price', 'asc');

				}

				elseif ($orderby == "p_hl") {

						$this->db->order_by('pt_pass.pass_basic_price', 'desc');

				}

				elseif ($orderby == "s_lh") {

						$this->db->order_by('pt_pass.pass_stars', 'asc');

				}

				elseif ($orderby == "s_hl") {

						$this->db->order_by('pt_pass.pass_stars', 'desc');

				}

				if (!empty ($types)) {

						$this->db->where_in('pt_pass.pass_type', $types);

				}

				if (!empty ($sprice)) {

						$sprice = str_replace(";", ",", $sprice);

						$sprice = explode(",", $sprice);

						$minp = $sprice[0];

						$maxp = $sprice[1];

						$this->db->where('pt_rooms.room_basic_price >=', $minp);

						$this->db->where('pt_rooms.room_basic_price <=', $maxp);

				}

				$this->db->join('pt_pass_translation', 'pt_pass.pass_id = pt_pass_translation.item_id', 'left');

				$this->db->group_by('pt_pass.pass_id');

                $this->db->join('pt_rooms', 'pt_pass.pass_id = pt_rooms.room_pass', 'left');

			    $this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

				$this->db->having('pt_pass.pass_status', 'Yes');



				if(!empty($perpage)){



				$query = $this->db->get('pt_pass', $perpage, $offset);



				}else{



				$query = $this->db->get('pt_pass');



				}

				

				$data['all'] = $query->result();

				$data['rows'] = $query->num_rows();

				return $data;

		}











// for auto suggestions search

		function textsearch() {

				$q = $this->input->get('q');

				$r = $this->input->get('type');

				$term = mysql_real_escape_string($q);

				$query = $this->db->query("SELECT pass_title as name FROM pt_pass WHERE pass_title LIKE '%$term%' ")->result();

				foreach ($query as $qry) {

						echo $qry->name . "\n";

				}

		}



// get all pass for related selection for backend

		function select_related_pass($id = null) {

				$this->db->select('id ,name');

				return $this->db->get('pt_pass')->result();

		}



// get related pass for front-end

		function get_related_pass($pass) {

				$id = explode(",", $pass);

				$this->db->select('pt_pass.pass_title,pt_pass.pass_slug,pt_pass.pass_id,pt_pass.pass_basic_price,pt_pass.pass_basic_discount,pt_pass.pass_stars');

				$this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->where_in('pt_pass.pass_id', $id);

// $this->db->where('pt_pass_images.himg_type','default');

				$this->db->group_by('pt_pass.pass_id');

// $this->db->join('pt_pass_images','pt_pass.pass_id = pt_pass_images.himg_pass_id','left');

				$this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

				return $this->db->get('pt_pass')->result();

		}



// get featured pass

		function featured_pass_front() {

				$settings = $this->Settings_model->get_front_settings('pass');

				$limit = $settings[0]->front_homepage;

				$orderby = $settings[0]->front_homepage_order;

				$this->db->select('pt_pass.pass_status,pt_pass.pass_slug,pt_pass.pass_id,pt_pass.pass_desc,pt_pass.pass_stars,



   pt_pass.pass_title,pt_pass.pass_city,pt_pass.pass_basic_price,pt_pass.pass_basic_discount,pt_pass.pass_latitude,pt_pass.pass_longitude');

				$this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->where('pt_pass.pass_is_featured', 'yes');

				$this->db->where('pt_pass.pass_featured_from <', time());

				$this->db->where('pt_pass.pass_featured_to >', time());

				$this->db->group_by('pt_pass.pass_id');

				$this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

				$this->db->having('pass_status', '1');

				$this->db->limit($limit);

				if ($orderby == "za") {

						$this->db->order_by('pt_pass.pass_title', 'desc');

				}

				elseif ($orderby == "az") {

						$this->db->order_by('pt_pass.pass_title', 'asc');

				}

				elseif ($orderby == "oldf") {

						$this->db->order_by('pt_pass.pass_id', 'asc');

				}

				elseif ($orderby == "newf") {

						$this->db->order_by('pt_pass.pass_id', 'desc');

				}

				elseif ($orderby == "ol") {

						$this->db->order_by('pt_pass.pass_order', 'asc');

				}

				return $this->db->get('pt_pass')->result();

		}



// get popular pass

		function popular_pass_front() {

				$settings = $this->Settings_model->get_front_settings('pass');

				$limit = $settings[0]->front_popular;

				$orderby = $settings[0]->front_popular_order;



                $this->db->select('pt_pass.pass_id,pt_pass.pass_status,pt_reviews.review_overall,pt_reviews.review_itemid');



                $this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->order_by('overall', 'desc');

				$this->db->group_by('pt_pass.pass_id');

				$this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid');

				$this->db->where('pass_status', 'yes');

				$this->db->limit($limit);

			   	return $this->db->get('pt_pass')->result();

		}



// get latest pass

		function latest_pass_front() {

				$settings = $this->Settings_model->get_front_settings('pass');

				$limit = $settings[0]->front_latest;

				$this->db->select('pt_pass.pass_status,pt_pass.pass_slug,pt_pass.pass_id,pt_pass.pass_desc,pt_pass.pass_stars,



   pt_pass.pass_title,pt_pass.pass_city,pt_pass.pass_basic_price,pt_pass.pass_basic_discount,pt_pass.pass_latitude,pt_pass.pass_longitude');

				$this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->order_by('pt_pass.pass_id', 'desc');

				$this->db->group_by('pt_pass.pass_id');

				$this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

				$this->db->where('pass_status', '1');

				$this->db->limit($limit);

				return $this->db->get('pt_pass')->result();

		}



		function offers_data($id) {

				$this->db->where('offer_module', 'pass');

				$this->db->where('offer_item', $id);

				return $this->db->get('pt_special_offers')->result();

		}



// update translated data os some fields in english

		function update_english($id) {

				$hslug = create_url_slug($this->input->post('title'));

				$this->db->where('pass_slug', $hslug);

				$this->db->where('pass_id !=', $id);

				$nums = $this->db->get('pt_pass')->num_rows();

				if ($nums > 0) {

						$hslug = $hslug . "-" . $id;

				}

				else {

						$hslug = $hslug;

				}

				$data = array('pass_title' => $this->input->post('title'), 'pass_slug' => $hslug, 'pass_desc' => $this->input->post('desc'), 'pass_additional_facilities' => $this->input->post('additional'), 'pass_policy' => $this->input->post('policy'));

				$this->db->where('pass_id', $id);

				$this->db->update('pt_pass', $data);

				return $hslug;

		}











		function convert_price($amount) {



		}



// get special offer pass

		function specialoffer_pass() {

				$this->db->select('pt_pass.pass_status,pt_pass.pass_slug,pt_pass.pass_id,pt_pass.pass_desc,pt_pass.pass_stars,



   pt_pass.pass_title,pt_pass.pass_city,pt_pass.pass_basic_price,pt_pass.pass_basic_discount,pt_pass.pass_latitude,pt_pass.pass_longitude,pt_special_offers.offer_item');

				$this->db->select_avg('pt_reviews.review_overall', 'overall');

				$this->db->where('pt_special_offers.offer_from <=', time());

				$this->db->where('pt_special_offers.offer_to >=', time());

				$this->db->where('pt_special_offers.offer_status', '1');

				$this->db->order_by('pt_special_offers.offer_id', 'desc');

				$this->db->group_by('pt_pass.pass_id');

				$this->db->join('pt_reviews', 'pt_pass.pass_id = pt_reviews.review_itemid', 'left');

				$this->db->join('pt_special_offers', 'pt_pass.pass_id = pt_special_offers.offer_item', 'left');

				$this->db->having('pt_pass.pass_status', '1');

				return $this->db->get('pt_pass')->result();

		}









        // Adds translation of some fields data

		function add_translation($postdata,$id) {

		  foreach($postdata as $lang => $val){

		     if(array_filter($val)){

		        $title = $val['title'];

                $desc = $val['desc'];

                $metatitle = $val['metatitle'];

				$metadesc = $val['metadesc'];

				$keywords = $val['keywords'];

				$policy = $val['policy'];

                $data = array(

                'trans_title' => $title,

                'trans_desc' => $desc,

                'trans_policy' => $policy,

                'metatitle' => $metatitle,

                'metadesc' => $metadesc,

                'metakeywords' => $keywords,

                'item_id' => $id,

                'trans_lang' => $lang

                );

				$this->db->insert('pt_pass_translation', $data);

                }



                }





		}



        // Update translation of some fields data

		function update_translation($postdata,$id) {



       foreach($postdata as $lang => $val){

		     if(array_filter($val)){

		        $title = $val['title'];

                $desc = $val['desc'];

                $metatitle = $val['metatitle'];

				$metadesc = $val['metadesc'];

				$kewords = $val['keywords'];

				$policy = $val['policy'];

                $transAvailable = $this->getBackTranslation($lang,$id);



                if(empty($transAvailable)){

                   $data = array(

                'trans_title' => $title,

                'trans_desc' => $desc,

                'trans_policy' => $policy,

                'metatitle' => $metatitle,

                'metadesc' => $metadesc,

                'metakeywords' => $kewords,

                'item_id' => $id,

                'trans_lang' => $lang

                );

				$this->db->insert('pt_pass_translation', $data);



                }else{

                 $data = array(

                'trans_title' => $title,

                'trans_desc' => $desc,

                'trans_policy' => $policy,

                'metatitle' => $metatitle,

                'metadesc' => $metadesc,

                'metakeywords' => $kewords,

                );

				$this->db->where('item_id', $id);

				$this->db->where('trans_lang', $lang);

			    $this->db->update('pt_pass_translation', $data);

                }





              }



                }

		}



        function getBackTranslation($lang,$id){



            $this->db->where('trans_lang',$lang);

            $this->db->where('item_id',$id);

            return $this->db->get('pt_pass_translation')->result();



        }



        function passGallery($slug){

          $this->db->select('pt_pass.thumbnail_image as thumbnail,pt_pass_images.himg_id as id,pt_pass_images.himg_pass_id as itemid,pt_pass_images.himg_type as type,pt_pass_images.himg_image as image,pt_pass_images.himg_order as imgorder,pt_pass_images.himg_image as image,pt_pass_images.himg_approved as approved');

          $this->db->where('pt_pass.pass_slug',$slug);

          $this->db->join('pt_pass_images', 'pt_pass.pass_id = pt_pass_images.himg_pass_id', 'left');

          $this->db->order_by('pt_pass_images.himg_id','desc');

          return $this->db->get('pt_pass')->result();

        }



        function addPhotos($id,$filename){

         $this->db->select('thumbnail_image');

         $this->db->where('pass_id',$id);

         $rs = $this->db->get('pt_pass')->result();

         if($rs[0]->thumbnail_image == PT_BLANK_IMG){

               $data = array('thumbnail_image' => $filename);

               $this->db->where('pass_id',$id);

               $this->db->update('pt_pass',$data);

         }



        //add photos to pass images table

        $imgorder = 0;

        $this->db->where('himg_type', 'slider');

        $this->db->where('himg_pass_id', $id);

        $imgorder = $this->db->get('pt_pass_images')->num_rows();

        $imgorder = $imgorder + 1;



				$approval = pt_admin_gallery_approve();

		    	$insdata = array(

                'himg_pass_id' => $id,

                'himg_type' => 'slider',

                'himg_image' => $filename,

                'himg_order' => $imgorder,

                'himg_approved' => $approval

                );

				$this->db->insert('pt_pass_images', $insdata);





        }



        function assignPass($pass,$userid){

          if(!empty($pass)){

          $userpass = $this->userOwnedPass($userid);

                foreach($userpass as $ht){

                   if(!in_array($ht,$pass)){

                    $ddata = array(

                   'pass_owned_by' => '1'

                   );

                   $this->db->where('pass_id',$ht);

                   $this->db->update('pt_pass',$ddata);

                   }

                }



                foreach($pass as $h){

                   $data = array(

                   'pass_owned_by' => $userid

                   );

                   $this->db->where('pass_id',$h);

                   $this->db->update('pt_pass',$data);



                 }



                 }

        }



        function userOwnedPass($id){

          $result = array();

          if(!empty($id)){

          $this->db->where('pass_owned_by',$id);

          }



          $rs = $this->db->get('pt_pass')->result();

          if(!empty($rs)){

            foreach($rs as $r){

              $result[] = $r->pass_id;

            }

          }

          return $result;

        }



        /*************Hotel Settings Functions**************/



        // Add pass settings data

		function addCategoriesData() {
			$filename = "";
			
			$data = array(
				'name' => $this->input->post('name'),
				'status' => $this->input->post('statusopt'),
			);

			$this->db->insert('pt_pass_categories', $data);

			return $this->db->insert_id();

			$this->session->set_flashdata('flashmsgs', "Added Successfully");
		}



// update pass settings data

		function updateCategoriesData() {
			$id 	= $this->input->post('id');
			$name 	= $this->input->post('name');

			if(empty($status)){
				$status = 'No';
			}
			$status = $this->input->post('status');

			$data = array(
				'name' 		=> $this->input->post('name'),
				'status' 	=> $status
			);

			$this->db->where('id', $id);

			$this->db->update('pt_pass_categories', $data);

			$this->session->set_flashdata('flashmsgs', "Updated Successfully");

		}



// Get pass categories data

		function get_pass_categories_data() {
			$this->db->order_by('id', 'asc');

			return $this->db->get('pt_pass_categories')->result();

		}



		function get_pass_settings_value($type, $id) {

				$this->db->where('sett_type', $type);

				$this->db->where('sett_id', $id);

				$this->db->where('sett_status', 'Yes');

				$rslt = $this->db->get('pt_pass_categories')->result();

				if (empty ($rslt)) {

						return '';

				}

				else {

						return $rslt[0]->sett_name . "!";

				}

		}



// Get pass settings data for adding pass or room

		function get_hsettings_data($type) {

				$this->db->where('sett_type', $type);

				$this->db->where('sett_status', 'Yes');

				return $this->db->get('pt_pass_categories')->result();

		}



// Get pass settings data for adding pass or room

		function get_hsettings_data_front($type, $items) {

				$this->db->where('sett_type', $type);

				$this->db->where_in('sett_id', $items);

				$this->db->where('sett_status', 'Yes');

				return $this->db->get('pt_pass_categories')->result();

		}

     		function updateHotelSettings() {

				$ufor = $this->input->post('updatefor');

				$heropass = $this->input->post('heropass');

				if (!empty ($heropass)) {

						$heropasstxt = implode(",", $heropass);

				}

				else {

						$heropasstxt = "";

				}

				$miniheropass = $this->input->post('miniheropass');

				if (!empty ($miniheropass)) {

						$miniheropasstxt = implode(",", $miniheropass);

				}

				else {

						$miniheropasstxt = "";

				}

				$topcities = $this->input->post('topcities');

				if (!empty ($topcities)) {

						$topcitiestxt = implode(",", $topcities);

				}

				else {

						$topcitiestxt = "";

				}

				$data = array('front_icon' => $this->input->post('page_icon'),

                'front_homepage' => $this->input->post('home'),

                'front_homepage_order' => $this->input->post('homeorder'),

                'front_related' => $this->input->post('related'),

              //  'front_popular' => $this->input->post('popular'),

              //  'front_popular_order' => $this->input->post('popularorder'),

                'front_latest' => $this->input->post('latest'),

                'front_homepage_hero' => $heropasstxt,

                'front_listings' => $this->input->post('listings'),

                'front_listings_order' => $this->input->post('listingsorder'),

                'front_homepage_small_hero' => $miniheropasstxt,

                'front_top_cities' => $topcitiestxt,

                'front_search' => $this->input->post('searchresult'),

                'front_search_order' => $this->input->post('searchorder'),

                'front_search_min_price' => $this->input->post('minprice'),

                'front_search_max_price' => $this->input->post('maxprice'),

                'front_checkin_time' => $this->input->post('checkin'),

                'front_checkout_time' => $this->input->post('checkout'),

                'front_txtsearch' => '1',

				'front_tax_percentage' => $this->input->post('taxpercentage'), 'front_tax_fixed' => $this->input->post('taxfixed'), 'front_search_state' => $this->input->post('state'), 'front_sharing' => $this->input->post('sharing'), 'linktarget' => $this->input->post('target'),

				'header_title' => $this->input->post('headertitle'),

				'meta_keywords' => $this->input->post('keywords'),

				'meta_description' => $this->input->post('description')

				);

				$this->db->where('front_for', $ufor);

				$this->db->update('pt_front_settings', $data);

				$this->session->set_flashdata('flashmsgs', "Updated Successfully");

		}



	 function updatePassCategoriesTranslation($postdata, $id) {
       foreach($postdata as $lang => $val){
		     if(array_filter($val)){
		        $name 			= $val['name'];
				$transAvailable = $this->getBackSettingsTranslation($lang,$id);

                if(empty($transAvailable)){
                 $data = array(
					'trans_name' => $name,
					'category_id' => $id,
					'trans_lang' => $lang
				);

				$this->db->insert('pt_pass_categories_translation', $data);
                }else{
					$data = array(
						'trans_name' => $name
					);

					$this->db->where('category_id', $id);
					$this->db->where('trans_lang', $lang);
					$this->db->update('pt_pass_categories_translation', $data);
				}
              }
                }
		}





         function getBackSettingsTranslation($lang, $id){
			//  echo $lang . '<br />';
            $this->db->where('trans_lang',$lang);
            $this->db->where('id',$id);
			// die;
            return $this->db->get('pt_pass_categories_translation')->result();

        }



        // Delete pass settings

		function deletePassCategory($id) {
			$this->db->where('id', $id);
			$this->db->delete('pt_pass_categories');

			$this->db->where('category_id', $id);
			$this->db->delete('pt_pass');
		}



		// Delete multiple pass settings

		function deleteMultiplePassCategories($id, $type) {
			$this->db->where('id', $id);
			$this->db->delete('pt_pass_categories');
			$rowsDeleted = $this->db->affected_rows();

			if($rowsDeleted > 0){

			$this->db->where('category_id', $id);

			$this->db->delete('pt_pass_categories_translation');

		}





		}



         function getCategoriesTranslation($lang,$id){
            $this->db->where('trans_lang',$lang);
			$this->db->where('category_id',$id);

            return $this->db->get('pt_pass_categories_translation')->result();
        }



        function uploadSettingIcon($oldfile = null){



				if (!empty ($_FILES)) {

				  if(!empty($oldfile)){

				    @unlink(PT_HOTELS_ICONS_UPLOAD.$oldfile);

				  }

						$tempFile = $_FILES['amticon']['tmp_name'];

						$fileName = $_FILES['amticon']['name'];

						$fileName = str_replace(" ", "-", $_FILES['amticon']['name']);

						$fig = rand(1, 999999);

						$saveFile = $fig . '_' . $fileName;



						$targetPath = PT_HOTELS_ICONS_UPLOAD;



						$targetFile = $targetPath . $saveFile;

						move_uploaded_file($tempFile, $targetFile);

                        return $saveFile;

                       }

        }



        /*************End Hotel Settings Functions**************/





}

