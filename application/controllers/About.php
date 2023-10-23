<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct() {
        parent::__construct();
		// session_destroy();

        // if(!$this->session->userdata('doctormenu')){
        // 	$get =$this->allSpec();

        // 	$this->session->set_userdata('doctormenu',$get);
        // }  
    }

    //get token
    private function testData($token){
        $curl = curl_init();

        curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api-webservice.teramobile.app/api/v1/rs',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Accept: application/json',
				'Authorization: Bearer '.$token
			),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $toArray = json_decode($response, true);
        return $toArray['message'];
    }

    private function getToken(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-webservice.teramobile.app/api/v1/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'username=brawijaya&password=braw_cQbDm5dK78',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNzg3ZTMzYWFhOWJiODA3ZmNiNzcxYjFiNTVmMGUwMWQ1NTE4MDViZGM2YWEwZjM2NDgwMmY0ZjE4NmE0MzI5ZjU4M2Y1NzdkYjFiOGFlNzQiLCJpYXQiOjE2MjcwMTM1NTAsIm5iZiI6MTYyNzAxMzU1MCwiZXhwIjoxNjU4NTQ5NTUwLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.xlfvXBuwuhmfav004F-9o73LffEDEyrMzIvstRIvvw05ftjaJt4eBcSRm1nPz-AUiWAw2xrPYjnlDhmNmeV1fA',
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $toArray = json_decode($response, true);
        return $toArray['token'];

    }


    private function dataToken(){
        $this->load->helper('url');
        $lokasi = base_url()."token.txt";

        $data = read_file(FCPATH."token.txt");
        //print_r($this->testData($data));

        if($this->testData($data) == 'Unauthenticated.'){
            $newToken = $this->getToken();
            write_file(FCPATH.'/token.txt', $newToken);

            return $data;
        } else {
            return $data;
        }
    }

    private function allSpec(){
        $curl = curl_init();
        $token = $this->dataToken();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-webservice.teramobile.app/api/v1/AllSpecialistByTmGroup',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer '.$token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response,true);
    }

	public function index(){
		// $apiData = $this->mapidata->getApi()->row();
		// $allSpecialist = json_decode($apiData->specialist_all_rs, true); //$this->session->userdata('doctormenu');
		// for($i = 0; $i<count($allSpecialist); $i++){
		// 	$allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
        //     $allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
        // }

		$data = array(
					'content' 	=> 'front/about',
					'title'	  	=> 'Brawijaya Hospital',
					// 'allS'		=> $allS,
					'result' 	=> '',			
					'tab'		=> '0',
					'banner'	=> $this->mpost->getJoinBy('post.idcategory','8')->result_array(),
				);

		$this->load->view('front/template/main',$data);
	}

	public function coe()
	{
		$data = array(
			'content' 	=> 'front/coe',
			'title'	  	=> 'Brawijaya Hospital',
			'result' 	=> '',			
			'tab'		=> '1',
			'services'	=> $this->mpost->scopeCoe()->result_array(),
		);

		$this->load->view('front/template/main',$data);
	}

	public function sub($menu = 'about', $tab = '0', $id = NULL, $slug = NULL){
		$investor = 0;
		$open = 0;
		if($menu == 'performanceboard' || $menu == 'about'){
			$banner = 'about_vision_mission';

			if($menu == 'about'){
				switch ($tab) {
					case 'vision-mission':
						$tab = '1';
						break;
					case 'patient-family-rights':
						$tab = '2';
						break;
					case 'patient-family-obligation':
						$tab = '3';
						break;
					case 'kepuasan-pasien-dan-keluarga':
						$tab = '0';
						break;
					case 'capaian-inm';
						$tab = '4';
						break;
					case 'sevice-quality':
						$tab = '0';
						break;
					default:
						$tab = '0';
						break;
				}
			}
		}elseif ($menu == 'facilities') {
			$banner = 'services';
			$tab = 2;
		}elseif ($menu == 'services') {
			$banner = 'services';
			$tab = 1;
			$menu = 'serv';
		}else{
			$banner = $menu;

			if($menu == 'special_offer' && $tab != '1'){
				$open = 1;
			}elseif($menu == 'investor'){
				$investor = 1;
			}
		}

		$data = array(
				'content' 	=> 'front/'.$menu,
				'title'	  	=> 'Brawijaya Hospital',
				'result' 	=> '',
				'tab'		=> $tab,
				'banner'	=> $this->mpost->getJoinBy('post.slug',$banner)->result_array(),
				'newsevent' => $this->mpost->getJoinPublishedBy('1','idcategory',3,0,'DESC')->result_array(),
				'offer' 	=> $this->mpost->getJoinPublishedBy('2','idcategory',0,0,'DESC')->result_array(),
				'service' 	=> $this->mpost->getJoinPublishedBy('3','idcategory',0,0,'ASC')->result_array(),
				'services'	=> $this->mpost->scopeCoe()->result_array(),
				'ugds'		=> $this->mhospital->getByWhere([
					'status' => 1,
					'ugd !=' => NULL,
				])->result_array(),
				'facilities'=> $this->mpost->getJoinPublishedBy('4','idcategory',0,0,'ASC')->result_array(),
			);

		if($open == 1){
			$getThumbnail = $this->db->query("SELECT * FROM "._PREFIX."post a WHERE a.slug = '".$tab."'")->row_array();

			$data['thumbnail'] = $getThumbnail['thumbnail'];
		}


		if($id != NULL){
			if($id == 'slug'){
				$getId  = $this->db->query("SELECT * FROM "._PREFIX."post a WHERE a.slug = '".$slug."'")->row_array();
				$id 	= $getId['id'];
			}

			$data['resultData'] = $this->mpost->getJoinPublishedBy($id,_PREFIX.'post.id')->row_array();
			$data['resultImage']= $this->mpost->getPicture($id)->result_array();
			$data['type']		= 'detail';
		}else{
			$data['resultData'] = '';
			$data['resultImage']= '';
			$data['type']		= 'main';
		}

		if($investor == 1){
			$data = array(
				'content' 	=> 'front/investor',
				'title'	  	=> 'Brawijaya Hospital',
				'result' 	=> '',	
			);

			$this->load->view('front/template/main',$data);
		}else{
			$this->load->view('front/template/main',$data);
		}
	}

	public function load_sub($param = "main", $id = NULL){
		$view = 'detail_services';
		
		if ($param == 'detail_facilities') {
			$view = $param;
		}
		if ($param == 'detail_services') {
			$view = 'detail_serv';
		}
		// $apiData = $this->mapidata->getApi()->row();
		// $allSpecialist = json_decode($apiData->specialist_all_rs, true); //$this->session->userdata('doctormenu');

		// for($i = 0; $i<count($allSpecialist); $i++){
        //     $allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
        //     $allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
        // }

		$data = array(
						'load' 		=> $param,
						// 'allS'		=> $allS,
						'service' 	=> $this->mpost->getJoinPublishedBy('3','idcategory',0,0,'ASC')->result_array(),
						'facilities'=> $this->mpost->getJoinPublishedBy('4','idcategory',0,0,'ASC')->result_array(),
					);

		if($id != NULL){
			$data['resultImage']= $this->mpost->getPicture($id)->result_array();
			$data['resultData'] = $this->mpost->getJoinPublishedBy($id,_PREFIX.'post.id')->row_array();
		}else{
			$data['resultData'] = '';
			$data['resultImage']= '';
		}

		$this->load->view('front/'.$view, $data);
	}

	public function load_more(){
		$limit = $this->input->post('limit');
		$allnewsevent = $this->mpost->getJoinPublishedBy('1','idcategory')->result_array();
		$newsevent 	  = $this->mpost->getJoinPublishedBy('1','idcategory',$limit,0,'DESC')->result_array();
		$print = '';

		foreach($newsevent as $row){
			$print .= "<div class=\"col-xs-12 newsevent-list\" align=\"left\">";
			$print .= "	<div class=\"col-sm-4 col-md-3\" style=\"padding: 15px;\">";
			$print .= "		<div class=\"col-sm-8 col-sm-offset-2 thumbnail-image\" style=\"background: url('".$row['thumbnail']."'); background-position: center; background-size: cover;\"></div>";
			$print .= "	</div>";
			$print .= "	<div class=\"thumbnail-content col-sm-8 col-md-9\" align=\"left\">";
			$print .= "		<b class=\"darkpurple\">".strtoupper($row['post_title'])."</b>";
			$print .= "		<p class=\"no-marg\">";
			$print .= "			".substr($row['thumbnailtext'], 0,180);
			$print .= "		</p>";
			$print .= "		<p class=\"darkgrey\"><b class=\"small\"><i>UPLOADED BY ".strtoupper(($row['user'].', '.date('F d, Y',strtotime($row['date']))))."</i></b></p>";
			$print .= "		<a class=\"btn-gradient italic\" href=\"".base_url('newsevent/').$row['slug']."\"><i>Read More</i></a>";
			$print .= "	</div>";
			$print .= "</div>";
		}

		if(count($allnewsevent) == count($newsevent)){
			$status = 'true';
		}else{
			$status = 'false';
		}

		$print .= '+_+'.$status;

		echo $print;	
	}
}