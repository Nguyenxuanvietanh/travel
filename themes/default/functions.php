<?php
    //Wish list global function for all modules
    if (!function_exists('wishListInfo')) {
      function wishListInfo($module, $id) {
        $inwishlist = pt_isInWishList($module, $id);
        if ($inwishlist) {
          $html = '<div title="' . trans('028') . '" data-toggle="tooltip" data-placement="left" id="' . $id . '" data-module="' . $module . '" class="wishlist wishlistcheck ' . $module . 'wishtext' . $id . ' fav"><a  class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="' . $module . 'wishsign' . $id . ' fav">-</span></a></div>';
        }
        else {
          $html = '<div  title="' . trans('029') . '" data-toggle="tooltip" data-placement="left" id="' . $id . '" data-module="' . $module . '" class="wishlist wishlistcheck ' . $module . 'wishtext' . $id . '"><a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="' . $module . 'wishsign' . $id . '">+</span></a></div>';
        }
        return $html;
      }
    }

    //Tours locations part on home page    iconspane-lg -41
    if (!function_exists('toursWithLocations')) {
      function toursWithLocations() {
        $appObj = appObj();
        $toursLib = $appObj->load->library('Tours/Tours_lib');
        $totalLocations = 7;
        $locationData = $toursLib->toursByLocations($totalLocations);
        return $locationData;
      }
    }

    //Show Lazy Loading icon
    if (!function_exists('lazy')) {
      function lazy() {
        $appObj = appObj();
        $themeData = (object) $appObj->theme->_data;
        return "src='" . $themeData->theme_url . LOADING_ICON;
      }
    }

    //Tours locations part on home page
    if (!function_exists('searchForm'))
    {
        function searchForm($module = "hotels", $data = NULL)
        {      
            $appObj = appObj();
            $themeData = (object) $appObj->theme->_data;
            //$themeData->checkin = date($themeData->app_settings[0]->date_f,strtotime('+'.CHECKIN_SPAN.' day', time()));
            $themeData->checkinMonth = strtoupper(date("F", convert_to_unix($themeData->checkin)));
            $themeData->checkinDay = date("d", convert_to_unix($themeData->checkin));
            //$themeData->checkout = date($themeData->app_settings[0]->date_f, strtotime('+'.CHECKOUT_SPAN.' day', time()));
            $themeData->checkoutMonth = strtoupper(date("F", convert_to_unix($themeData->checkout)));
            $themeData->checkoutDay = date("d", convert_to_unix($themeData->checkout));
            $themeData->eancheckin = date("m/d/Y", convert_to_unix($themeData->eancheckin, "m/d/Y"));
            $themeData->eancheckout = date("m/d/Y", convert_to_unix($themeData->eancheckout, "m/d/Y"));
            $themeData->eancheckinMonth = strtoupper(date("F", convert_to_unix($themeData->eancheckin, "m/d/Y")));
            $themeData->eancheckinDay = date("d", convert_to_unix($themeData->eancheckin, "m/d/Y"));
            $themeData->eancheckoutMonth = strtoupper(date("F", convert_to_unix($themeData->eancheckout, "m/d/Y")));
            $themeData->eancheckoutDay = date("d", convert_to_unix($themeData->eancheckout, "m/d/Y"));
            $themeData->ctcheckin = date("m/d/Y", strtotime("+1 days"));
            $themeData->ctcheckout = date("m/d/Y", strtotime("+2 days"));
            $tourType = @ $_GET['type'];

            $lazy = "src='" . $theme_url . "assets/img/loader.gif'";

            if (isModuleActive($module))
            {
                if ($module == "hotels")
                {
                    require $themeurl.'views/modules/hotels/main_search.php';
                }
                if ($module == "pass")
                {
                    require $themeurl.'views/modules/pass/main_search.php';
                }
                if ($module == "flights")
                {
                    require $themeurl.'views/modules/flights/main_search.php';
                }
                if ($module == "tours")
                {
                    require $themeurl.'views/modules/tours/main_search.php';
                }
                if ($module == "cars")
                {
                    require $themeurl.'views/modules/cars/main_search.php';
                }
                if ($module == "ean")
                {
                    require $themeurl.'views/modules/expedia/main_search.php';
                }
                if ($module == "travelport_flight")
                {
                    $travelportSearchFormData = $data;
                    include 'views/modules/travelport/flight/search_form.php';
                }
                if ($module == "iati_flight")
                {
                    $iatiSearchFormData = $data;
                    include 'views/modules/iati_flight/search_form.php';
                }
                if ($module == "Travelport_hotels")
                {
                    include 'views/modules/travelport/hotel/search_form.php';
                }
                if ($module == "hotelbeds")
                {
                    include 'views/modules/hotelbeds/main_search.php';
                }
                if ($module == "cartrawler")
                {
                    include 'views/modules/cartrawler/main_search.php';
                }
                if ($module == "Amadeus")
                {
                    $amadeus_data = $data;
                    include 'views/modules/amadeus/main_search.php';
                }
                if ($module == "Juniper")
                {
                    $juniper_data = $data;
                    include 'views/modules/juniper/main_search.php';
                }
                if ($module == "Sabre")
                {
                    $searchForm = $data;
                    include 'views/modules/sabre/main_search.php';
                }
            }
        }
    }
?>