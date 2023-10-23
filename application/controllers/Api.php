<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct() {
        parent::__construct();   

    }

	public function index($token = NULL,$action = NULL){
		$api_result = array(
							 'request'  => NULL,
							 'ok' 		=> false,
							 'result' 	=> array(),
						   );
		$list_token = array(
								'e10adc3949ba59abbe56e057f20f883e' => TRUE, // MD5 hash 123456
						   );

		$find_token = isset ($list_token[$token]) ? $list_token[$token]:'';

		if($find_token == TRUE){
			$api_result['request'] = 'getBanner';
			$api_result['ok'] 		= true;

			if($action == 'getBanner'){
				$api_result['result'] 	= $this->mpost->getApiBanner('post.idcategory = \'7\' AND ( date IS NULL OR date >= \''.date('Y-m-d').'\' ) ')->result_array(); //die($this->db->last_query());
			}elseif($action == 'getOffer'){
				$api_result['result'] 	= $this->mpost->getApiPost('post.idcategory = \'2\' AND '._PREFIX.'post.status = \'1\' ')->result_array();
			}elseif($action == 'getNews'){
				$api_result['result'] 	= $this->mpost->getApiPost('post.idcategory = \'1\' AND '._PREFIX.'post.status = \'1\' ')->result_array();
			}else{
				$api_result['ok'] 		= false;
			}
		}

		// if($action == 'getBanner'){
		// 	$api_result['request'] = $action;

		// 	$find_token = isset ($list_token[$token]) ? $list_token[$token]:'';

		// 	if($find_token == TRUE){
		// 		$api_result['ok'] 		= true;
		// 		$api_result['result'] 	= $this->mpost->getApiBanner('post.idcategory','7')->result_array();
		// 	}
		// }

		header('Content-type:application/json;charset=utf-8');
		echo json_encode($api_result, TRUE);	
	}

	public function testApi(){
		$api_url = "https://brawijayahospital.com/api/e10adc3949ba59abbe56e057f20f883e/getNews"; //"http://api.plos.org/search?q=title:DNA";

		$my_json_result = file_get_contents($api_url); 
		$my_php_arr = json_decode($my_json_result, true); 

		echo "hasil: <br><pre>";

		foreach($my_php_arr['result'] as $row){
			print_r($row);
		}
	}

	public function testApi2(){
		$api_url = "https://brawijayahospital.com/api/e10adc3949ba59abbe56e057f20f883e/getNews";

        $ch =  curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

        $get        = curl_exec($ch);
        $decode     = json_decode($get, false);

        print_r($decode);
	}
}
		