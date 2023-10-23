<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($index = NULL){

		$data = [
			'content'         =>  'front/home',
			'title'           =>  'Brawijaya Hospital',
			'result'          =>  '',
			'banner'          =>  $this->mpost->getJoinBy('post.idcategory','7')->result_array(),
			'patientstories'  =>  $this->mpost->getJoinBy('post.idcategory','17')->result_array(),
			'location'        =>  $this->mlocation->getAllActive()->result_array(),
			'hospital'        =>  $this->mhospital->getActived()->result_array(),
			'newsevent'       =>  $this->mpost->getJoinPublishedBy('1','idcategory',6,0,'DESC')->result_array(),
			'offer'           =>  $this->mpost->getJoinPublishedBy('2','idcategory',2,0,'DESC')->result_array(),
			'ig_feeds'        =>  $this->mpost->getJoinPublishedBy('15','idcategory',9,0,'DESC')->result_array(),
			'coes'            =>  $this->mpost->scopeCoe()->result_array(),
			// 'services'        =>  $services,
			'testimonial'     =>  $this->mfeedback->getPublished()->result_array(),
			'day'             =>  [
				'1'  =>  array('id' => '1', 'day' => 'Monday'),
				'2'  =>  array('id' => '2', 'day' => 'Tuesday'),
				'3'  =>  array('id' => '3', 'day' => 'Wednesday'),
				'4'  =>  array('id' => '4', 'day' => 'Thursday'),
				'5'  =>  array('id' => '5', 'day' => 'Friday'),
				'6'  =>  array('id' => '6', 'day' => 'Saturday'),
				'7'  =>  array('id' => '7', 'day' => 'Sunday'),
			],
			'time' 		=> [
				'1'  =>  array('id' => '1', 'time' => 'Morning'),
				'2'  =>  array('id' => '2', 'time' => 'Noon'),
				'3'  =>  array('id' => '3', 'time' => 'Night'),
			],
		];

		$exindex = explode('-', $index);

		if(count($exindex) > 1){
			$datafont = [
				'roboto' 	  => 'Roboto',
				'newscycle'   => 'News Cycle',
				'meerainimai' => 'Meera Inimai',
				'museo'		  => 'Museo Sans 500',
			];
			$fonttype = $exindex[1];
			$data['font'] = $datafont[$fonttype];
		}

		$this->load->view('front/template/main',$data);
	}

	public function get_schedule (){
		$spec = $this->input->post('homeSpeciality');
		echo "test";
	}

	public function find_doctor(){
		$data = [
			'content' 	=> 'front/find_doctor',
			'title'	  	=> 'Find Doctor',
			'result' 	=> '',
		];

		$this->load->view('front/template/main',$data);
	}

	function scheduleRs(){
		$apiData = $this->mapidata->getApi()->row();
		$allSpecialist = json_decode($apiData->specialist_all_rs, true);//$this->session->userdata('doctormenu'); 

		for($i = 0; $i<count($allSpecialist); $i++){
            $allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
            $allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
        }

        $idTm = $this->uri->segment(2);
        $idRS = $this->uri->segment(3);
		$data = [
			'content'			=> 'front/doctor_schedule',
			'idTm'				=> $idTm,
			'idRS'				=> $idRS,
			'allS'				=> $allS,
			'banner'			=> $this->mpost->getJoinBy('post.idcategory','11')->result_array(),
			'speciality'		=> $this->mhighlight->getByMenu('admin-doctor','1')->result_array(),
		];

			$this->load->view('front/template/main',$data);

	}


	function advanced_search($speciality = NULL, $slug = NULL){
		$doctorname = $this->input->post('doctorname');
		$city 		= $this->input->post('city');
		$area 		= $this->input->post('area');
		$period 	= $this->input->post('period');
		$tmid 		= $this->input->post('tmid');
		$where 		= '';
		
		if($speciality == NULL){
			$speciality = $this->input->post('speciality');
		}else{
			if($speciality != 'slug'){

				$getSlug = $this->db->query("SELECT * FROM "._PREFIX."highlight a WHERE a.highlight_id = '".$speciality."'")->row_array();
				$slug    = $getSlug['highlight_slug'];

				redirect('doctor-schedule/'.$slug);
			}
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

		if($speciality == 'slug'){
			/* --- ADDITIONAL 'WHERE' QUERY --- */
				if(isset($doctorname) AND $doctorname != ''){
					$where .= 'a.name LIKE \'%'.$doctorname.'%\' AND ';
				}

				if(isset($speciality) AND $speciality != ''){
					if($speciality == 'slug'){
						$where .= 'c.highlight_slug = \''.$slug.'\' AND ';	
						
						// $getIdSpeciality = $this->db->query("SELECT * FROM "._PREFIX."highlight a WHERE a.highlight_slug = '".$slug."'")->row_array();
						// $speciality = $getIdSpeciality['highlight_id'];				
					}else{
						$where .= 'c.highlight_id = \''.$speciality.'\' AND ';
					}
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
			$apiData = $this->mapidata->getApi()->row();
			$allSpecialist = json_decode($apiData->specialist_all_rs, true); //$this->session->userdata('doctormenu'); 

			for($i = 0; $i<count($allSpecialist); $i++){
				$allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
				$allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
			}

			$idTm = $this->uri->segment(2);
			$idRS = $this->uri->segment(3);
			$data = [
				'content'			=> 'front/doctor_schedule',
				'where' 			=> $where, 
				'idTm'				=> $idTm,
				'idRS'				=> $idRS,
				'result' 			=> $getSchedule, 
				'allS'				=> $allS,
				'banner'			=> $this->mpost->getJoinBy('post.idcategory','11')->result_array(),
				'hospital_list' 	=> $hospital,
				'day_list'			=> $day_list,
				'period'			=> $period,
				// 'speciality'		=> $this->mhighlight->getByMenu('admin-doctor','1')->result_array(),
				'speciality_list'	=> $speciality_list,
			];

			$this->load->view('front/template/main',$data);
		}else{
			$custom = 'result/search';
			redirect($custom);
		}
	}

	function create_url_search($param = NULL){
		$where 		= '';
		$period 	= '';

		if(isset($param) && $param != NULL){
			$explodeparam = explode('::', $param);

			if(count($explodeparam) > 1){

				for($i=0; $i < count($explodeparam); $i++){ 

					if(stristr($explodeparam[$i], 'doctor')){
						$explodesubparam = explode('=', $explodeparam[$i]);
						$doctorname 	 = urldecode($explodesubparam[1]);

						$where .= 'a.name LIKE \'%'.$doctorname.'%\' AND ';

					}elseif(stristr($explodeparam[$i], 'speciality')){
						$explodesubparam = explode('=', $explodeparam[$i]);
						$speciality 	 = $explodesubparam[1];

						$arrspeciality = $this->mhighlight->getByWhere("highlight_slug = '".$speciality."'")->row_array();
						$speciality    = $arrspeciality['highlight_id'];

						$where .= 'c.highlight_id = \''.$speciality.'\' AND ';

					}elseif(stristr($explodeparam[$i], 'location')){
						$explodesubparam = explode('=', $explodeparam[$i]);
						$city 			 = $explodesubparam[1];
						$city 			 = str_replace('-', ' ', $city);
						$city 			 = $this->marge->capital($city);

						$arrlocation = $this->mlocation->getByWhere("namelocation = '".$city."'")->row_array();

						$where .= 'e.location = \''.$arrlocation['id'].'\' AND ';

					}elseif(stristr($explodeparam[$i], 'branch')){
						$explodesubparam = explode('=', $explodeparam[$i]);
						$area 			 = $explodesubparam[1];
						$area 			 = str_replace('-', ' ', $area);
						$area 			 = $this->marge->capital($area);

						$arrhospital = $this->mhospital->getByWhere(_PREFIX."hospital.city = '".$area."'")->row_array();

						$where .= 'e.idhospital = \''.$arrhospital['idhospital'].'\' AND ';

					}elseif(stristr($explodeparam[$i], 'day')){
						$arrday = array('monday'=>'1','tuesday'=>'2','wednesday'=>'3','thursday'=>'4','friday'=>'5','saturday'=>'6','sunday'=>'7');

						$explodesubparam = explode('=', $explodeparam[$i]);
						$day			 = $explodesubparam[1];
						$idday 			 = $arrday[$day];

						$where .= 'd.day = \''.$day.'\' AND ';

					}elseif(stristr($explodeparam[$i], 'period')){
						$arrperiod = array('morning'=>'1','noon'=>'2','night'=>'3');

						$explodesubparam = explode('=', $explodeparam[$i]);
						$period 		 = $explodesubparam[1];
						$period 		 = $arrperiod[$period];

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

						if(isset($period) AND $period != ''){
							$where .= $param.' AND ';
							$period = 'AND '.$param;
						}else{
							if(!isset($doctorname) OR $doctorname == ''){
								$where .= 'starttime <= \'21:00:00\' AND endtime >= \'08:00:00\' AND ';
								$period = 'AND starttime <= \'21:00:00\' AND endtime >= \'08:00:00\'';		
							}	
						}	

					}
				}
			}
		}

		$where 		.= '1=1';

		$getSchedule = $this->mdoctor->getAdvancedSearch($where)->result_array(); 

		/* --- RESULT CONDITION --- */
			if(!isset($speciality) || $speciality == ''){

				$speciality_list 	= 'all';
			}else{

				$speciality_list 	= $speciality;
			}

			// $hospital = $this->mdoctor->getAdvancedSearch($where,'e.idhospital')->result_array();
			$hospital = [];

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
		$apiData = $this->mapidata->getApi()->row();
		$allSpecialist = json_decode($apiData->specialist_all_rs, true);//$this->session->userdata('doctormenu');

		for($i = 0; $i<count($allSpecialist); $i++){
            $allS[$i]['tmgroupid'] = $allSpecialist[$i]['tmgroupid'];
            $allS[$i]['tmgroupname'] = $allSpecialist[$i]['tmgroupname'];
        }

		$data = array( 
					'content'			=> 'front/doctor_schedule',
					'where' 			=> $where, 
					'allS'				=> $allS,
					'result' 			=> $getSchedule, 
					'banner'			=> $this->mpost->getJoinBy('post.idcategory','11')->result_array(),
					'hospital_list' 	=> $hospital,
					'day_list'			=> $day_list,
					'period'			=> $period,
					'speciality'		=> $this->mhighlight->getByMenu('admin-doctor','1')->result_array(),
					'speciality_list'	=> $speciality_list,
					);

		$this->load->view('front/template/main',$data);
	}

	function load_city(){
		$idlocation = $this->input->post('idlocation');
 		$get_city 	= $this->mlocation->getAllActive()->result_array();
		$print 	  	= '<option value="00" disabled selected> - Select Area - </option>';

		foreach($get_city as $row) {
			if($idlocation == $row['id']){$sel = 'selected';}else{$sel='';}

			$print .= '<option value="'.$row['id'].'" '.$sel.'>'.$row['namelocation'].'</option>';
		}

		echo $print;
	}

	function load_area(){
		$idlocation = $this->input->post('idlocation');
 		$get_area 	= $this->mhospital->getByWhere('location = \''.$idlocation.'\'')->result_array();
		$print 	  	= '<option value="00" disabled selected> - Select Area - </option>';

		foreach($get_area as $row) {
			$print .= '<option value="'.$row['idhospital'].'" idlocation="'.$row['location'].'">'.$row['namehospital'].'</option>';
		}

		echo $print;
	}

	function load_modalSet(){
		$idschedule  = $this->input->post('idschedule');
		$idhighlight = $this->input->post('idspeciality');
		$print 		 = '';

		$query = "
					SELECT * FROM "._PREFIX."doctor_schedule a
					JOIN "._PREFIX."doctor b ON b.iddoctor = a.iddoctor 
					JOIN "._PREFIX."doctor_highlight c ON c.doctor_highlight_iddoctor = a.iddoctor 
					JOIN "._PREFIX."hospital d ON d.idhospital = a.idhospital 
					JOIN "._PREFIX."highlight e ON e.highlight_id = c.doctor_highlight_idhighlight
					WHERE a.idschedule = '".$idschedule."'
				";

		$getSchedule   = $this->db->query($query)->row_array();

		if($idhighlight != 'all'){
			$getSpeciality = $this->mhighlight->getById($idhighlight)->row_array();
			$speciality    = $getSpeciality['highlight_title'];
			$idhighlight   = $idhighlight;
		}else{
			$speciality    = $getSchedule['highlight_title'];
			$idhighlight   = $getSchedule['highlight_id'];
		}

		$print .='
		          <input type="hidden" class="form-control" id="mdl-txtidschedule" value="'.$getSchedule['idschedule'].'">
		          <div class="form-group">
		          	<label class="form-control-label">Speciality</label>		          
		            <input type="hidden" id="mdl-txtidspeciality" value="'.$idhighlight.'">
		            <input type="text" class="form-control" id="mdl-txtspeciality" value="'.$speciality.'" disabled/>
		          </div>
		          <div class="form-group">
		          	<label class="form-control-label">Doctor</label>		          
		            <input type="text" class="form-control" id="mdl-txtdoctor" value="'.$getSchedule['name'].'" disabled/>
		          </div>
		          <div class="form-group">
		          	<label class="form-control-label">Location</label>		          
		            <input type="text" class="form-control" id="mdl-txthospital" value="'.$getSchedule['namehospital'].'" disabled/>
		          </div>
		          <div class="form-group">
		          	<label class="form-control-label">Date</label>&nbsp;		          
					<input type="text" id="mdl-txtdate" class="form-control date-picker" placeholder="Click and Choose Date">
		          </div>
		          <div class="form-group">
		          	<label class="form-control-label">Time</label>		          
		            <input type="text" class="form-control" id="mdl-txthour" value="'.date('H.i',strtotime($getSchedule['starttime'])).' - '.date('H.i',strtotime($getSchedule['endtime'])).'" disabled/>
		          </div>
          		 ';

        echo $print;
	}

	function load_modalAccLogin($log = FALSE){
		if($log == 'logout'){
			/* --- UPDATE LASTLOGIN --- */
			$email 		= $this->session->userdata(_PREFIX.'frontemail');
			$logintime 	= date('Y-m-d H:i:s');

			$this->db->query("UPDATE "._PREFIX."user SET lastlogin = '$logintime' WHERE emailaddress = '$email'");
			/* --- UPDATE LASTLOGIN --- */

			$this->session->unset_userdata(_PREFIX.'front_dateApp','');
			$this->session->unset_userdata(_PREFIX.'frontlogin','');
			$this->session->unset_userdata(_PREFIX.'frontuserid','');
			$this->session->sess_destroy();

			redirect('');
		}elseif($log == 'login'){
			$email 		= $this->input->post('email');
			$password 	= $this->input->post('password');
			$print 		= '';

			/* --- CHECK LOGIN --- */
			if($this->session->userdata(_PREFIX.'frontlogin') != TRUE){
				$getLogin = $this->muser->getByPass('emailaddress',$email,md5($password))->row_array();

				if(count($getLogin) > 0){
					$login = TRUE;
					$logintime = date('Y-m-d H:i:s');
					$this->session->set_userdata(_PREFIX.'frontlogin',TRUE);
					$this->session->set_userdata(_PREFIX.'frontuserid',$getLogin['id']);
					$this->session->set_userdata(_PREFIX.'frontemail',$getLogin['emailaddress']);

					/* --- UPDATE LASTLOGIN --- */
					$this->db->query("UPDATE "._PREFIX."user SET lastlogin = '$logintime', countlogin = countlogin+1 WHERE emailaddress = '$email'");
					/* --- UPDATE LASTLOGIN --- */
				
		        	echo 'Logged On';
				}else{
					$login = FALSE;
					echo 'Failed';
				}
			}else{
				$login = TRUE;
				$getLogin['id'] = $this->session->userdata(_PREFIX.'frontuserid');
			}
			/* --- CHECK LOGIN --- */
		}else{
			$idschedule 	= $this->input->post('idschedule');
			$idspeciality 	= $this->input->post('idspeciality');
			$email 			= $this->input->post('email');
			$password 		= $this->input->post('password');
			$print 			= '';

			/* --- CHECK LOGIN --- */
			if($this->session->userdata(_PREFIX.'frontlogin') != TRUE){
				$getLogin = $this->muser->getByPass('emailaddress',$email,md5($password))->row_array();

				if(count($getLogin) > 0){
					$login = TRUE;
					$this->session->set_userdata(_PREFIX.'frontlogin',TRUE);
					$this->session->set_userdata(_PREFIX.'frontuserid',$getLogin['id']);
					$this->session->set_userdata(_PREFIX.'frontemail',$getLogin['emailaddress']);
				}else{
					$login = FALSE;
				}
			}else{
				$login = TRUE;
				$getLogin['id'] = $this->session->userdata(_PREFIX.'frontuserid');
			}
			/* --- CHECK LOGIN --- */

			if($login == TRUE){
				$query = "
							SELECT * FROM "._PREFIX."doctor_schedule a
							JOIN "._PREFIX."doctor b ON b.iddoctor = a.iddoctor 
							JOIN "._PREFIX."doctor_highlight c ON c.doctor_highlight_iddoctor = a.iddoctor 
							JOIN "._PREFIX."hospital d ON d.idhospital = a.idhospital 
							JOIN "._PREFIX."highlight e ON e.highlight_id = c.doctor_highlight_idhighlight
							WHERE a.idschedule = '".$idschedule."'
						 ";

				$getSchedule = $this->db->query($query)->row_array();

				$getSpeciality = $this->mhighlight->getById($idspeciality)->row_array();

				$print .='
				          <input type="hidden" class="form-control" id="mdl-txtidschedule" value="'.$getSchedule['idschedule'].'">
				          <input type="hidden" class="form-control" id="mdl-txtemail" value="'.$email.'">
				          <div class="form-group">
				            <input type="hidden" id="mdl-txtidspeciality" value="'.$getSpeciality['highlight_id'].'" disabled/>
				            <input type="text" class="form-control" id="mdl-txtspeciality" value="'.$getSpeciality['highlight_title'].'" disabled/>
				          </div>
				          <div class="form-group">
				            <input type="text" class="form-control" id="mdl-txtdoctor" value="'.$getSchedule['name'].'" disabled/>
				          </div>
				          <div class="form-group">
				            <input type="text" class="form-control" id="mdl-txthospital" value="'.$getSchedule['namehospital'].'" disabled/>
				          </div>
				          <div class="form-group">
							<input type="text" id="mdl-txtdate" class="form-control date-picker" placeholder="date" value="'.$this->session->userdata(_PREFIX.'front_dateApp').'" disabled>
				          </div>
				          <div class="form-group">
				            <input type="text" class="form-control" id="mdl-txthour" value="'.date('H.i',strtotime($getSchedule['starttime'])).' - '.date('H.i',strtotime($getSchedule['endtime'])).'" disabled/>
				          </div>
		          		 ';

		        $where 		= "patient_userid = '".$getLogin['id']."'";
		        $getPatient = $this->mpatient->getByWhere($where)->result_array();

		        $print .='--delimiter--';
		        $print .='<li><a href="javascript:void(0);" onclick="setPatient(\'\',\'\',\'\',\'\',\'0000-00-00\',\'\')"> -- Cancel -- </a></li>';

		        foreach($getPatient as $row){
		        $print .='<li><a href="javascript:void(0);" onclick="setPatient(\''.$row['patient_id'].'\',\''.$row['patient_name'].'\',\''.$row['patient_email'].'\',\''.$row['patient_phone'].'\',\''.$row['patient_birthday'].'\',\''.$row['patient_sex'].'\')">'.$row['patient_name'].'</a></li>';
		    	}

		        echo $print;
			}else{
				echo "Failed";
			}
		}
	}

	function addPatientField($field = NULL){
		if($field == NULL){
			$counterpatientn= $this->input->post('counterpatient');
			$counterpatient = '-'.$counterpatientn;
			$print 			= '';

			$print 		   .= '
							    <div class="row field'.$counterpatient.'">
		        					<button type="button" onclick="delPatient('.$counterpatientn.')" class="close btn-delpatient field'.$counterpatient.'"><span aria-hidden="true">&times;</span></button>
							        <div class="col-md-12" style="padding: 15px 0px 0px;">
							          <div class="col-md-12">
								          <div class="form-group inputPatientName">
								            <input type="text" class="form-control" id="mdllogin-txtpatientname'.$counterpatient.'" name="mdllogin-txtpatientname[]" placeholder=" Nama Pasien ">
								          </div>
								      </div>
							          <div class="col-md-12">
								          <div class="form-group">
								            <input type="radio" class="sex" id="mdllogin-txtpatientsex'.$counterpatient.'" name="mdllogin-txtpatientsex'.$counterpatient.'[]" value="1"/>&nbsp;Male&nbsp;&nbsp;&nbsp;
								            <input type="radio" class="sex" id="mdllogin-txtpatientsex'.$counterpatient.'" name="mdllogin-txtpatientsex'.$counterpatient.'[]" value="0"/>&nbsp;Female
								          </div>
								      	</div>
								      	<div class="col-md-12">
								      		<div class="form-group">
								      			<input type="date" name="tgl_pasien'.$counterpatient.'" class="form-control">
								      		</div>
								      	</div>
							        </div>
							  ';


			// $print 		   .= '
			// 				    <div class="row field'.$counterpatient.'">
		 //        					<button type="button" onclick="delPatient('.$counterpatientn.')" class="close btn-delpatient field'.$counterpatient.'"><span aria-hidden="true">&times;</span></button>
			// 				        <div class="col-md-12" style="padding: 15px 0px 0px;">
			// 				          <div class="col-md-12">
			// 					          <div class="form-group inputPatientName">
			// 					            <input type="text" class="form-control" id="mdllogin-txtpatientname'.$counterpatient.'" name="mdllogin-txtpatientname[]" placeholder=" Nama Pasien ">
			// 					          </div>
			// 					      </div>
			// 				          <div class="col-md-12">
			// 					          <div class="form-group">
			// 					            <input type="radio" class="sex" id="mdllogin-txtpatientsex'.$counterpatient.'" name="mdllogin-txtpatientsex'.$counterpatient.'[]" value="1"/>&nbsp;Male&nbsp;&nbsp;&nbsp;
			// 					            <input type="radio" class="sex" id="mdllogin-txtpatientsex'.$counterpatient.'" name="mdllogin-txtpatientsex'.$counterpatient.'[]" value="0"/>&nbsp;Female
			// 					          </div>
			// 					      </div>
			// 				        </div>
			// 				        <div class="col-md-12" style="padding: 0px;">
			// 				          <div class="col-md-4">
			// 				          	<div class="form-group">
			// 					            <label class="form-control-label">Tanggal Lahir</label>
			// 				        		<select class="form-control col-md-4" id="mdllogin-txtbirthday'.$counterpatient.'" name="mdllogin-txtbirthday[]" >
			// 				        			<option value="0" valmonth="" disabled selected> - Day - </option>
			// 				  ';

			// for ($i=1; $i < 32; $i++) { 
			// $print 		   .= '<option value="'.$i.'">'.$i.'</option>';
			// }

			// $print 		   .= '
			// 				        		</select>          		
			// 				          	</div>
			// 				          </div>
			// 				          <div class="col-md-4">
			// 				          	<div class="form-group">
			// 					            <label class="form-control-label">&nbsp;</label>
			// 				        		<select class="form-control col-md-4" id="mdllogin-txtbirthmonth'.$counterpatient.'" name="mdllogin-txtbirthmonth[]" >
			// 				        			<option value="00" valmonth="" disabled selected> - Month - </option>
			// 				        			<option value="01" valmonth="January">January</option>
			// 				        			<option value="02" valmonth="February">February</option>
			// 				        			<option value="03" valmonth="March">March</option>
			// 				        			<option value="04" valmonth="April">April</option>
			// 				        			<option value="05" valmonth="May">May</option>
			// 				        			<option value="06" valmonth="June">June</option>
			// 				        			<option value="07" valmonth="July">July</option>
			// 				        			<option value="08" valmonth="August">August</option>
			// 				        			<option value="09" valmonth="September">September</option>
			// 				        			<option value="10" valmonth="October">October</option>
			// 				        			<option value="11" valmonth="November">November</option>
			// 				        			<option value="12" valmonth="December">December</option>
			// 				        		</select>
			// 							</div>
			// 				          </div>
			// 				          <div class="col-md-4">
			// 				          	<div class="form-group">
			// 					            <label class="form-control-label">&nbsp;</label>
			// 				        		<select class="form-control col-md-4" id="mdllogin-txtbirthyear'.$counterpatient.'" name="mdllogin-txtbirthyear[]" >
			// 				        			<option value="0" valmonth="" disabled selected> - Year - </option>
			// 				  ';

			// for ($i=1970; $i <= date('Y'); $i++) { 
			// $print 		   .= '<option value="'.$i.'">'.$i.'</option>';
			// }

			// $print 		   .= '
			// 				        		</select>             		
			// 				          	</div>
			// 				          </div>
			// 				        </div>  
			// 					</div>
			// 				  ';

			echo $print;
		}else{
			$counterpatientn= $this->input->post('counterpatient');
			$counterpatient = '-'.$counterpatientn;

		    $where 		= "patient_userid = '".$this->session->userdata(_PREFIX.'frontuserid')."'";
	        $getPatient = $this->mpatient->getByWhere($where)->result_array();

			$print 			= '';

			$print 		   .= '
							    <div class="row field'.$counterpatient.'">
		        					  <button type="button" onclick="delPatient('.$counterpatientn.')" class="close btn-delpatient field'.$counterpatient.'"><span aria-hidden="true">&times;</span></button>
							          <div class="col-md-12" style="padding-top: 15px;">
								          <div class="form-group inputPatientName">
												<div class="input-group">
												  	<input type="hidden" id="mdllogin-txtpatientid'.$counterpatient.'" name="mdllogin-txtpatientid[]" value="">
												  	<input type="text" class="form-control" id="mdllogin-txtpatientname'.$counterpatient.'" name="mdllogin-txtpatientname[]" placeholder=" Nama Pasien " aria-describedby="basic-addon2">
													<span class="input-group-btn btn-group" id="basic-addon2">
													  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
													  <ul class="dropdown-menu" id="dropdown-patient">
							  ';
		    $print 		   .= '							<li><a href="javascript:void(0);" onclick="setPatient(\'\',\'\',\'\',\'\',\'0000-00-00\',\'\',\''.$counterpatientn.'\')"> -- Cancel -- </a></li>';

	        foreach($getPatient as $row){
	        $print 		   .= '							<li><a href="javascript:void(0);" onclick="setPatient(\''.$row['patient_id'].'\',\''.$row['patient_name'].'\',\''.$row['patient_email'].'\',\''.$row['patient_phone'].'\',\''.$row['patient_birthday'].'\',\''.$row['patient_sex'].'\',\''.$counterpatientn.'\')">'.$row['patient_name'].'</a></li>';
	    	}

		    $print 		   .= '
													  </ul>
													</span>
												</div>
								          </div>
								      </div>
							          <div class="col-md-12">
								          <div class="form-group">
								            <input type="text" class="form-control" id="mdllogin-txtpatientphone'.$counterpatient.'" name="mdllogin-txtpatientphone[]" placeholder=" Telpon ">
								          </div>
								      </div>
							          <div class="col-md-12">
								          <div class="form-group">
								            <input type="text" class="form-control" id="mdllogin-txtpatientemail'.$counterpatient.'" name="mdllogin-txtpatientemail[]" placeholder=" Email ">
								          </div>
								      </div>
								      <div class="col-md-12">
									        <div class="form-group">
									            <input type="radio" class="sex" id="mdllogin-txtpatientsex'.$counterpatient.'" name="mdllogin-txtpatientsex'.$counterpatient.'" value="1"/>&nbsp;Male&nbsp;&nbsp;&nbsp;
									            <input type="radio" class="sex" id="mdllogin-txtpatientsex'.$counterpatient.'" name="mdllogin-txtpatientsex'.$counterpatient.'" value="0"/>&nbsp;Female
									        </div>
									  </div>
								      <div class="col-md-12"> 
								          <div class="col-md-12" style="padding: 0px;">
									        <label class="form-control-label">Tanggal Lahir</label>
								          </div>
								          <div class="col-md-3" style="padding: 0px;">
								          	<div class="form-group">
								        		<select class="form-control col-md-4" id="mdllogin-txtbirthday'.$counterpatient.'" name="mdllogin-txtbirthday[]">
								        			<option value="00" valmonth="" disabled selected> - Day - </option>
							  ';
								        			for ($i=1; $i < 32; $i++) { 
			$print 		   .= '						<option value="'.$i.'">'.$i.'</option>';
								        			}
			$print 		   .= '
								        		</select>          		
								          	</div>
								          </div>
								          <div class="col-md-5">
								          	<div class="form-group">
								        		<select class="form-control col-md-4" id="mdllogin-txtbirthmonth'.$counterpatient.'" name="mdllogin-txtbirthmonth[]">
								        			<option value="00" valmonth="" disabled selected> - Month - </option>
								        			<option value="01" valmonth="January">January</option>
								        			<option value="02" valmonth="February">February</option>
								        			<option value="03" valmonth="March">March</option>
								        			<option value="04" valmonth="April">April</option>
								        			<option value="05" valmonth="May">May</option>
								        			<option value="06" valmonth="June">June</option>
								        			<option value="07" valmonth="July">July</option>
								        			<option value="08" valmonth="August">August</option>
								        			<option value="09" valmonth="September">September</option>
								        			<option value="10" valmonth="October">October</option>
								        			<option value="11" valmonth="November">November</option>
								        			<option value="12" valmonth="December">December</option>
								        		</select>
											</div>
								          </div>
								          <div class="col-md-4" style="padding: 0px;">
								          	<div class="form-group">
								        		<select class="form-control col-md-4" id="mdllogin-txtbirthyear'.$counterpatient.'" name="mdllogin-txtbirthyear[]">
								        			<option value="0000" valmonth="" disabled selected> - Year - </option>
							  ';
								        			for ($i=1970; $i <= date('Y'); $i++) { 
			$print 		   .= '						<option value="'.$i.'">'.$i.'</option>';
								        			}
			$print 		   .= '
								        		</select>             		
								          	</div>
								          </div>
								      </div> 
								</div>
							  ';

			echo $print;
		}
	}

	function accountRegistration($field = NULL){
		$accschedule	= $this->input->post('accschedule');
		$accspeciality	= $this->input->post('accspeciality');
		$accbookdate	= $this->input->post('accbookdate');
		$accemail		= $this->input->post('accemail');
		$accname		= $this->input->post('accname');
		$accpass		= $this->input->post('accpass');
		$accphone		= $this->input->post('accphone');

		$patientcounter = $this->input->post('patientcounter');
		$patientname	= $this->input->post('patientname');
		$patientsex		= $this->input->post('patientsex');
		$patientbday	= $this->input->post('patientbday');
		$patientbmonth	= $this->input->post('patientbmonth');
		$patientbyear	= $this->input->post('patientbyear');

		$idtrans 		= $this->mtransaction->autonumber();

		if($field == NULL){
			$data = array(
							'emailaddress' 	=> $accemail,
							'firstname' 	=> $accname,
							'phone'			=> $accphone,
							'password'		=> md5($accpass),
							'countlogin'    => 0,
						 );

			if($this->muser->insert($data)){
				$lastid = $this->db->insert_id();
				$lastid = $lastid+0;

				for($i=0; $i < $patientcounter; $i++) { 
					$dataPatient = array(
											'patient_name'		=> $patientname[$i],
											'patient_phone'		=> $accphone,
											'patient_email' 	=> $accemail,
											'patient_birthday' 	=> $patientbyear[$i].'-'.$patientbmonth[$i].'-'.$patientbday[$i],
											'patient_sex' 		=> $patientsex[$i],
											'patient_userid'	=> $lastid, 
										);

					$insertPasien = $this->mpatient->insert($dataPatient);
					$patientid 	  = $this->db->insert_id();

					if(!empty($accschedule) && $accschedule != ''){ // Kondisi ketika regis bersamaan dengan booking
						$dataTransPatient = array(
													'idtrans' 	=> $idtrans,
													'idpatient'	=> $patientid,
													'iduser'    => $lastid,
												 );

						$insertTransPasien = $this->mtransaction->insert_trans_patient($dataTransPatient);
					}
				}

				if(!empty($accschedule) && $accschedule != ''){ // Kondisi ketika regis bersamaan dengan booking
					if($insertPasien){
						$query = "
									SELECT * FROM "._PREFIX."doctor_schedule a
									JOIN "._PREFIX."doctor b ON b.iddoctor = a.iddoctor 
									JOIN "._PREFIX."doctor_highlight c ON c.doctor_highlight_iddoctor = a.iddoctor 
									JOIN "._PREFIX."hospital d ON d.idhospital = a.idhospital 
									JOIN "._PREFIX."highlight e ON e.highlight_id = c.doctor_highlight_idhighlight
									WHERE a.idschedule = '".$accschedule."'
								 ";

						$getScheduleData = $this->db->query($query)->row_array();

						$dataTrans = array(
											'idtrans' 		=> $idtrans,
											'iddoctor' 		=> $getScheduleData['iddoctor'],
											'transdate' 	=> $accbookdate,
											'transuserid' 	=> $lastid,
											'transstatus' 	=> '0',
											'transschedule' => $accschedule,
											'transpoli'		=> $accspeciality,
									 );

						if($this->mtransaction->insert($dataTrans)){
							if($this->mail($accemail,'booking','user',$idtrans,$getScheduleData['namehospital'])){

								if($this->mail($getScheduleData['email'],'booking','admin',$idtrans,$getScheduleData['namehospital'])){
									echo 'Success-'.$getScheduleData['idhospital'];
								}else{
									echo '0#5';
								}
							}else{
								echo '0#4';
							}
						}else{
							echo '#03';
						}
					}else{
						echo '#02';
					}
				}else{
					if($insertPasien){
						if($this->mail($accemail,'registration','user')){
							echo 'RegSuccess';
						}else{
							echo '#01-21';
						}
					}else{
						echo '#01-2';
					}
				}
			}else{
				echo '#01';
			}
		}else{
			$lastid    = $this->session->userdata(_PREFIX.'frontuserid');
			$getpatientid = $this->input->post('patientid');
			$patientemail = $this->input->post('patientemail');
			$patientphone = $this->input->post('patientphone');

			for($i=0; $i < $patientcounter; $i++) { 
				$getPatient = $this->mpatient->getById($getpatientid[$i])->row_array();

				if(count($getPatient) < 1){
					$dataPatient = array(
											'patient_name'		=> $patientname[$i],
											'patient_phone'		=> $patientphone[$i],
											'patient_email' 	=> $patientemail[$i],
											'patient_birthday' 	=> $patientbyear[$i].'-'.$patientbmonth[$i].'-'.$patientbday[$i],
											'patient_sex' 		=> $patientsex[$i],
											'patient_userid'	=> $lastid, 
										);

					$insertPasien = $this->mpatient->insert($dataPatient);
					$patientid 	  = $this->db->insert_id();
				}else{
					$patientid 	  = $getpatientid[$i];
				}

				$dataTransPatient = array(
											'idtrans' 	=> $idtrans,
											'idpatient'	=> $patientid,
											'iduser'    => $lastid,
										 );

				$insertTransPasien = $this->mtransaction->insert_trans_patient($dataTransPatient);
			}

			if($insertTransPasien){
				$query = "
							SELECT * FROM "._PREFIX."doctor_schedule a
							JOIN "._PREFIX."doctor b ON b.iddoctor = a.iddoctor 
							JOIN "._PREFIX."doctor_highlight c ON c.doctor_highlight_iddoctor = a.iddoctor 
							JOIN "._PREFIX."hospital d ON d.idhospital = a.idhospital 
							JOIN "._PREFIX."highlight e ON e.highlight_id = c.doctor_highlight_idhighlight
							WHERE a.idschedule = '".$accschedule."'
						 ";

				$getScheduleData = $this->db->query($query)->row_array();

				$dataTrans = array(
									'idtrans' 		=> $idtrans,
									'iddoctor' 		=> $getScheduleData['iddoctor'],
									'transdate' 	=> $accbookdate,
									'transuserid' 	=> $lastid,
									'transstatus' 	=> '0',
									'transschedule' => $accschedule,
									'transpoli'		=> $accspeciality,
							 );

				if($this->mtransaction->insert($dataTrans)){

					if($this->mail($this->session->userdata(_PREFIX.'frontemail'),'booking','user',$idtrans,$getScheduleData['namehospital'])){

						if($this->mail($getScheduleData['email'],'booking','admin',$idtrans,$getScheduleData['namehospital'])){
							echo 'Success-'.$getScheduleData['idhospital'];
						}else{
							echo '0#5B';
						}
					}else{
						echo '0#4B';
					}
				}else{
					echo '#03B';
				}
			}else{
				echo '#02B';
			}
		}
	}

	function accountLoggedOn(){
	}

	function addOffer(){
		$offerId 		= $this->input->post('offerid',TRUE);
		$offerTitle		= $this->input->post('offertitle',TRUE);
		$offerName 		= $this->input->post('offername',TRUE);
		$offerEmail 	= $this->input->post('offeremail',TRUE);
		$offerPhone 	= $this->input->post('offerphone',TRUE);
		$offerUnit 		= $this->input->post('offerunit',TRUE);
		$offerMessage 	= $this->input->post('offermessage',TRUE);

		$dataInsert = array(
								'category' 	=> $offerId,
								'name' 		=> $offerName,
								'email' 	=> $offerEmail,
								'date' 		=> date('Y-m-d H:i:s'),
								'phone' 	=> $offerPhone,
								'subject' 	=> $offerTitle,
								'unit' 		=> $offerUnit,
								'message' 	=> $offerMessage,
						   );

		$insert = $this->mcontactus->insert($dataInsert);
		$iddata = $this->db->insert_id();

		$getHospital = $this->mhospital->getById($offerUnit)->row_array();

		if($insert){
			if($this->mail($offerEmail,'offer','user',$iddata,$getHospital['namehospital'])){
				if($this->mail('noreply.cuber@gmail.com','offer','admin',$iddata,$getHospital['namehospital'])){				
					die('success');
				}else{
					die('0#3B');
				}
			}else{
				die('0#2B');
			}
		}else{
			die('failed');
		}
	}

	function redirect($param = FALSE, $detail = ''){
		if($param == 'success'){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Successfully...</div>');
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Failed '.$detail.'... </div>');
		}

		redirect('');
	}

	function setAppointment(){
		$dateApp 		 = $this->input->post('date');

		$this->session->set_userdata(_PREFIX.'front_dateApp',$dateApp);

		if($this->session->userdata(_PREFIX.'frontlogin') == TRUE){
			echo 'logon';
		}else{
			echo 'logoff';
		}
	}

	function mail($mailto = '', $type = 'booking', $to = 'admin', $id = NULL,$hospital = 'Brawijaya Clinic & Hospital'){
		if($type == 'booking'){

			$subject = 'Brawijaya Clinic & Hospital : Konfirmasi Booking Online';
			
			if($id != NULL){
				$getHighlight = $this->mtransaction->getByTrans($id)->row_array();

				$attr = array(_PREFIX.'trans_patient.idtrans',_PREFIX.'highlight.highlight_id');
				$value= array($id,$getHighlight['transpoli']);

				$data = $this->mtransaction->getJoinByTransPatientId($attr,$value)->result_array();
				$echoquery = $this->db->last_query();
			}else{
				$data = array();
				$echoquery = '';
				//$data = $this->mtransaction->getJoinByTransPatientId(_PREFIX.'trans_patient.idtrans','TRN-171108051414003')->result_array();
			}
		
			if($to == 'user'){
			    $ccmail = array('');

				$email_content   = '  <p class="signature" style="font-size: 14px;">Terimakasih,<br/><br/></p>';
				$email_content  .= '  <p>Anda telah melakukan pendaftaran online di <b>'.$hospital.'</b>, Selanjutnya admission kami akan menghubungi Anda untuk verifikasi pendaftaran online Anda.<br/><br/>Berikut di bawah ini merupakan data yang anda daftarkan :</p>';
			}else{
			    if($hospital == 'Brawijaya Hospital Saharjo'){
			        $ccmail = array('davi.bwch@yahoo.com','noreply.cuber@gmail.com','admrsbs@rsbrawijayasaharjo.com','admrsbs@gmail.com');
			    }else{
		     	    $ccmail = array('davi.bwch@yahoo.com','noreply.cuber@gmail.com');//'darmawan@designcub3.com');
			    }
			    
				$email_content  = '  <p>Anda mendapatkan form pendaftaran online di <b>'.$hospital.'</b>, di bawah ini merupakan data yang didaftarkan :</p>';
			}

			if(count($data) > 0){
				$n = 0;
				foreach($data as $row){ $n++;
					if(count($data) > 1 ){
					$email_content .= '  <p><br/><u>Data '.$n.'</u><br/></p>';
					}

					$email_content .= '<table style="font-family: Gotham Book; font-size: 14px;">';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Kode App. 		</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$row['idtrans'].' 											</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Nama 			</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$row['patient_name'].' 									</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Tanggal Lahir	</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$this->marge->date_ID($row['patient_birthday'],'d F Y').' 	</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Jenis Kelamin	</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$this->marge->sex($row['patient_sex']).' 					</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Phone 			</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$row['patient_phone'].' 									</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Email 			</font></td><td>:</td><td><font style="font-family: Gotham;"> <a href="mailto:'.$row['patient_email'].'">'.$row['patient_email'].'</a></font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Dokter 		</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$row['name'].' 											</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Poliklinik 	</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$row['highlight_title'].' 									</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Tanggal 		</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$this->marge->date_ID($row['transdate'],'d F Y').' 		</font></td></tr>';
					$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Periode 		</font></td><td>:</td><td><font style="font-family: Gotham;"> '.date('H:i',strtotime($row['starttime'])).' - '.date('H:i',strtotime($row['endtime'])).'</font></td></tr>';					
					$email_content .= '</table>';
				}
			}else{

				$email_content .= '  <p><br/>No Data Available.<br/></p>';
			}	
		}elseif($type == 'offer'){
			$ccmail = array('');

			$subject = $hospital.' : Konfirmasi Special Offer Form';
			
			if($id != NULL){
				$data = $this->mcontactus->getById($id)->row_array();
				$echoquery = $this->db->last_query();
			}else{
				$data = array();
				$echoquery = '';
			}
		
			if($to == 'user'){
				$email_content   = '  <p class="signature" style="font-size: 14px;">Terimakasih,<br/><br/></p>';
				$email_content  .= '  <p>Anda telah melakukan pendaftaran "special offer" online di <b>'.$hospital.'</b>, di bawah ini merupakan data yang anda daftarkan :</p>';
			}else{
		     	// $ccmail = array('davi.bwch@yahoo.com','noreply.cuber@gmail.com');

				$email_content  = '  <p>Anda mendapatkan form pendaftaran "special offer" online di <b>'.$hospital.'</b>, di bawah ini merupakan data yang didaftarkan :</p>';
			}

			$email_content .= '<table style="font-family: Gotham Book; font-size: 14px;">';
			$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Special Offer 	</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$data['subject'].' 									</font></td></tr>';
			$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Name 			</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$data['name'].' 									</font></td></tr>';
			$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Phone 			</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$data['phone'].' 									</font></td></tr>';
			$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Email 			</font></td><td>:</td><td><font style="font-family: Gotham;"> <a href="mailto:'.$data['email'].'">'.$data['email'].'</a></font></td></tr>';
			$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Unit 			</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$hospital.'									</a></font></td></tr>';
			$email_content .= '  <tr><td><font style="font-family: Gotham Book;">Message 		</font></td><td>:</td><td><font style="font-family: Gotham;"> '.$data['message'].' 									</font></td></tr>';					
			$email_content .= '</table>';	
		}elseif($type == 'registration'){
			$ccmail = array('');


			$subject = 'Brawijaya Clinic & Hospital : Registration User';

			if($to == 'user'){
				$email_content  = '  <p>Terimakasih,</p>';
				$email_content  = '  <p>Anda telah melakukan pendaftaran akun web brawijaya hospital & clinic, anda dapat menggunakan akun ini untuk melakukan booking online.</p>';
			}else{
				$email_content  = '';
			}
		}else{
			$ccmail = array('');

			$subject = 'Brawijaya Clinic & Hospital : '.$this->marge->capital($type);

			if($to == 'user'){
				$email_content  = '';
			}else{
				$email_content  = '  <p>Anda mendapatkan pesan, di bawah ini merupakan isi rincian data :</p>';
			}
		}

		/* =========== SEND EMAIL DATA =========== */

		$message = $this->load->view('front/template/responsive_email',array('title'=> $subject,'name' => '','email_content' => $email_content,),TRUE);

		$data 	 = array(
						'subject'	=> $subject,
						'from'		=> 'no-reply@brawijayahospital.com,Brawijaya Clinic & Hospital',//'it@brawijayahealthcare.com',
						'to'		=> array($mailto),
						'cc'		=> $ccmail,
						'bcc'		=> array(''),
						'message'	=> $message,
						'attach'	=> array(''),
					   );

        $config = array(
        				'protocol'	=> 'smtp',
        				'smtp_host'	=> 'mail.brawijayahospital.com',
        				'smtp_port'	=> '587',
        				'smtp_user'	=> 'no-reply@brawijayahospital.com',
        				'smtp_pass'	=> 'cubecube123',
        				'charset'	=> 'utf-8',
        				'mailtype'	=> 'html',
        				'newline'	=> '\r\n',
				   );

		return $this->marge->send_mail($data,$config);
	}
}
		