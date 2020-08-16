<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');
        if (!function_exists('getBackPassTranslation')) {

		function getBackPassTranslation($lang, $id) {
		  if(!empty($id)){
          $CI = get_instance();
          $CI->load->model('Pass/Pass_model');
          $res = $CI->Pass_model->getBackTranslation($lang,$id);
          return $res;
		  }else{
            return '';
		  }

		}

} 
if (!function_exists('getCategoriesTranslation')) {

		function getCategoriesTranslation($lang, $id) {
		  if(!empty($id)){
          $CI = get_instance();
          $CI->load->model('Pass/Pass_model');
          $res = $CI->Pass_model->getCategoriesTranslation($lang,$id);
          return $res;
		  }else{
            return '';
		  }

		}

}