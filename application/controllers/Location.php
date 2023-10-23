<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	function __construct() {
        parent::__construct();
		// session_destroy();
		// session_write_close();
        // if(!$this->session->userdata('doctormenu')){
		// 	$get = $this->allSpec();
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

	public function index($id = NULL){
		if($id != NULL){
			$result = $this->mhospital->getJoinByWhere("idhospital = '".$id."'")->row_array();
		}else{
			$result = $this->mhospital->getJoinByWhere("status = '1' AND description IS NOT NULL")->result_array();
		}
		$apiData = $this->mapidata->getApi()->row();	
		$allSpecialist = json_decode($apiData->specialist_all_rs, true);//$this->session->userdata('doctormenu');

		for($i = 0; $i<count($allSpecialist); $i++){
            $allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
            $allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
        }

		$data = array(
				'content' 	=> 'front/location',
				'title'	  	=> 'Brawijaya Hospital',
				'allS'		=> $allS,
				'result' 	=> $result,			
				'banner'	=> $this->mpost->getJoinBy('post.idcategory','9')->result_array(),
			);

		$this->load->view('front/template/main',$data);
	}

	public function sub($menu = 'detail_location', $id = '1', $speciality = NULL){

		$getHospital = $this->mhospital->getJoinByWhere("idhospital = '".$id."'")->row_array();

		if(strpos(strtolower($getHospital['namehospital']), 'hospital')){
			$type = 'x';
		}else{
			$type = $id;
		}
		$apiData = $this->mapidata->getApi()->row();
		$allSpecialist = json_decode($apiData->specialist_all_rs, true); //$this->session->userdata('doctormenu');

		for($i = 0; $i<count($allSpecialist); $i++){
            $allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
            $allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
        }

		$data = array(
						'content' 		=> 'front/'.$menu,
						'title'	  		=> 'Brawijaya Hospital',
						'result' 		=> '',			
						'allS'			=> $allS,
						'banner'		=> $this->mpost->getJoinBy('post.slug','location')->result_array(),
			 		 	'type'			=> $type,
			 		 	'id'			=> $id,
			 		 	'resulthospital'=> $getHospital,
						'coes'			=>  $this->mpost->scopeCoe()->result_array(),

			 		 );

		$getDetailHospital_Service  = $this->mhospital->getJoinDetailByWhere(_PREFIX."post.idcategory = '3' AND idhospital = '$id'", 'hospital_detail_id ASC')->result_array();
		if(count($getDetailHospital_Service) > 0){
			$data['service'] = $getDetailHospital_Service;
		}else{
			$data['service'] = $this->mpost->getJoinPublishedBy('3','idcategory',0,0,'ASC')->result_array();
		}

		$getDetailHospital_Facility = $this->mhospital->getJoinDetailByWhere(_PREFIX."post.idcategory = '4' AND idhospital = '$id'", 'hospital_detail_id ASC')->result_array();
		if(count($getDetailHospital_Facility) > 0){
			$data['facilities'] = $getDetailHospital_Facility;
		}else{
			$data['facilities'] = $this->mpost->getJoinPublishedBy('4','idcategory',0,0,'ASC')->result_array();
		}

		if($type == 'x'){
			// $data['result_schedule'] = $this->advanced_search($speciality,$getHospital['location'],$getHospital['idhospital']);
		}

		$fas_sers = array_merge($data['service'], $data['facilities']);
		$data['fas_sers'] = array_chunk($fas_sers, 3);


		$this->load->view('front/template/main',$data);
	}
	
	public function sub_static($id){
		$apiData = $this->mapidata->getApi()->row();
		$allSpecialist = json_decode($apiData->specialist_all_rs, true);//$this->session->userdata('doctormenu');

		for($i = 0; $i < count($allSpecialist); $i++){
			$allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
			$allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
		}

        if ($id == '1'){
			$getHospital = $this->mhospital->getJoinByWhere("idhospital = 7")->row_array();
			$data = array(
				'content' 	=> 'front/location_static',
				'allS'		=> $allS,
                'title'	  	=> 'Brawijaya Hospital',
				'static_name' => 'front/static_item/saharjo_static',
				'resulthospital' => $getHospital
            );
        } elseif ($id == '2'){
			$getHospital = $this->mhospital->getJoinByWhere("idhospital = 8")->row_array();
            $data = array(
				'content' 	=> 'front/location_static',
				'allS'		=> $allS,
                'title'	  	=> 'Brawijaya Hospital Tangerang',
				'static_name' => 'front/static_item/permata_ibu_static',
				'resulthospital' => $getHospital,
            );
        }
		$this->load->view('front/template/main',$data);
    }

	public function load_post(){
		$id = $this->input->post('id');

		$getPost = $this->mpost->getJoinAllBy($id,_PREFIX.'post.id')->row_array();

		$print = '';
		$print .= '<h2 class="purple italic">'.$getPost['post_title'].'</h2>';

		$content 		= $getPost['content'];
		$splitContent 	= explode('<hr />', $content); 

		if(count($splitContent) > 1){
			$print .= $splitContent[0];

			$print .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
			for($i=1;$i<count($splitContent);$i++){

				$exSplitContent = explode('<h1>', $splitContent[$i]);
				$exSplitImage   = explode('src="', $splitContent[$i]);

				if(count($exSplitContent) > 1){
					$endSplitContent= explode('</h1>', $exSplitContent[1]);
					$collpaseTitle  = $endSplitContent[0];

					if(count($exSplitImage)>1){
						$endSplitImage  = explode('"', $exSplitImage[1]);
						$link 			= $endSplitImage[0];
					}else{
						$endSplitImage  = '';
						$link 			= '';
					}

					if($i == 1){
						$collpased = '';
						$in 	   = 'in';
					}else{
						$collpased = 'class="collpased"';
						$in 	   = '';
					}

				  	$print .= '<div class="panel panel-default">';
					$print .= '    <div class="panel-heading" role="tab" id="heading'.$i.'">';
					$print .= '	      <h4 class="panel-title">';
					$print .= '	        <a '.$collpased.' role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'" aria-expanded="true" aria-controls="collapse'.$i.'">';
					$print .= '	         	'.$collpaseTitle;
					$print .= '	        </a>';
					$print .= '	      </h4>';
					$print .= '    </div>';
					$print .= '    <div id="collapse'.$i.'" class="panel-collapse collapse '.$in.'" role="tabpanel" aria-labelledby="heading'.$i.'">';
					$print .= '	      <div class="panel-body">';
					$print .= '			  <div class="col-xs-12 no-pad"><img class="mobile" src="'.$link.'" width="100%"></div>';
					$print .= '	          '.$splitContent[$i]; 
					$print .= '	      </div>';
					$print .= '    </div>';
				  	$print .= '</div>';
				}
			}
			$print .= '</div>';
		}else{
			$print .= $content;
		}

		echo $print;
	}

	public function loaddeschospital($lat,$lng){
		$result = $this->mhospital->getJoinByWhere("latitude = '".$lat."' AND longitude = '".$lng."'")->row_array();

		echo $result['namehospital'].', '.$result['namelocation'];
	}

	function advanced_search($speciality = NULL, $city = '1', $area = '2'){
		$doctorname = '';
		//$city 		= '1';
		//$area 		= '2';
		$period 	= '';
		$where 		= '';
		
		if($speciality == NULL){
			$speciality = $this->input->post('speciality');
		}

		if(isset($_POST['day'])){
			$getday		= $this->input->post('day');
			$exday 		= explode('-', $getday);
			$idday 		= $exday[0];
			$day 		= $exday[1];
		}else{

			$day 		= '';
		}

		switch ($period) {
			case '1':
				$param = 'starttime <= \'11:59:00\'';			
				break;
			case '2':
				$param = 'starttime <= \'16:59:00\' AND endtime >= \'12:00:00\'';			
				break;	
			default:
				$param = 'starttime <= \'21:00:00\' AND endtime >= \'17:00:00\'';			
				break;
		}

		/* --- ADDITIONAL 'WHERE' QUERY --- */
			if(isset($doctorname) AND $doctorname != ''){
				$where .= 'a.name LIKE \'%'.$doctorname.'%\' AND ';
			}

			if(isset($speciality) AND $speciality != ''){
				$where .= 'c.highlight_id = \''.$speciality.'\' AND ';
			}

			if(isset($city) AND $city != ''){
				$where .= 'e.location = \''.$city.'\' AND ';
			}

			if(isset($area) AND $area != ''){
				$where .= 'e.idhospital = \''.$area.'\' AND ';
			}

			if(isset($day) AND $day != ''){
				$where .= 'd.day = \''.$day.'\' AND ';
			}	

			if(isset($period) AND $period != ''){
				$where .= $param.' AND ';
				$period = 'AND '.$param;
			}else{
				if(!isset($doctorname) OR $doctorname == ''){
					$where .= 'starttime <= \'21:00:00\' AND endtime >= \'08:00:00\' AND ';
					$period = 'AND starttime <= \'21:00:00\' AND endtime >= \'08:00:00\'';		
				}	
			}	

			$where 		.= '1=1';
		/* --- ADDITIONAL 'WHERE' QUERY --- */

		$getSchedule = $this->mdoctor->getAdvancedSearch($where)->result_array(); 

		/* --- RESULT CONDITION --- */
			if(!isset($speciality) || $speciality == ''){

				$speciality_list 	= 'all';
			}else{

				$speciality_list 	= $speciality;
			}

			$hospital = $this->mdoctor->getAdvancedSearch($where,'e.idhospital')->result_array();

			if(!isset($day) || $day == ''){
				$day_list = array(	
									'0' => array('id' => '1', 'day' => 'Monday'),
	                                '1' => array('id' => '2', 'day' => 'Tuesday'),
	                                '2' => array('id' => '3', 'day' => 'Wednesday'),
	                                '3' => array('id' => '4', 'day' => 'Thursday'),
	                                '4' => array('id' => '5', 'day' => 'Friday'),
	                                '5' => array('id' => '6', 'day' => 'Saturday'),
	                                '6' => array('id' => '7', 'day' => 'Sunday'),
		                         );
			}else{

				$day_list = array('0' => array('id' => $idday, 'day' => $day),);
			}
		/* --- RESULT CONDITION --- */

		$data = array( 
						'content'			=> 'front/doctor_schedule',
						'where' 			=> $where, 
						'result' 			=> $getSchedule, 
						'banner'			=> $this->mpost->getJoinBy('post.idcategory','11')->result_array(),
						'hospital_list' 	=> $hospital,
						'day_list'			=> $day_list,
						'period'			=> $period,
						'speciality'		=> $this->mhighlight->getByMenu('admin-doctor','1')->result_array(),
						'speciality_list'	=> $speciality_list,
					 );

		return $data;
	}
}