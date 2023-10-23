<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index(){
		$username = $this->session->userdata(_PREFIX.'username');
		$menurole = $this->session->userdata(_PREFIX.'menurole');

        //if($menurole == '6'){
        //    $branch = $this->session->userdata(_PREFIX.'branch');
        //    $doctorlist = $this->mdoctor->getJoinByHospital($branch)->result_array();
        //}else{
            $doctorlist = $this->mdoctor->getJoinAll()->result_array();
        //}
    
		$this->deleteScheduleTemp('all');


		$data = array(
						'titlebar' 	=> 'Admin | Doctor',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/doctor/index',
						'modal'  	=> 'template/modal',
						'title'		=> 'Doctor',
						'result'	=> $doctorlist,
					 	'role'   	=> $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array(),
					 );
		$data['result_dimension']	= array();
		$data['result_colour']		= array();
		$data['result_schedule']		= array();
		$this->load->view('template/main',$data);
	}

	function add(){
		$name = $this->input->post('name');

		if(!isset($name) || empty($name)){
			$this->deleteScheduleTemp('all');
			$doctorcategory   = $this->mcategory->getAll('statuscategory = \'1\'')->result_array();
			if(count($doctorcategory) == 0){
				$iddoctorcategory = '';
			}else{
				$iddoctorcategory = $doctorcategory[0]['id'];
			}
			$subcategory1  = $this->mdoctor->getCatById($iddoctorcategory,NULL,'subcategory1')->result_array();
			if(count($subcategory1) == 0){
				$idsubcategory1= '';
			}else{
				$idsubcategory1= $subcategory1[0]['cat_id'];
			}
			$data = array(
							'titlebar' 			=> 'Admin | Doctor',
							'menu'				=> $this->mmenu->getParent()->result_array(),
							'content'			=> 'admin/doctor/add',
							'title'				=> 'Add Doctor',
							'modal'  			=> 'template/modal',
							'doctorcategory'	=> $doctorcategory,
							'subcategory1'		=> $subcategory1,//$this->mitemcategory->getAll()->result_array(),
							'itemcategory'		=> $this->mdoctor->getCatById($iddoctorcategory,$idsubcategory1)->result_array(),//$this->mitemcategory->getAll()->result_array(),
							'locationcategory'	=> $this->mlocation->getAll()->result_array(),
							'highlight'			=> $this->mhighlight->getByMenu('admin-doctor','1')->result_array(),
							// 'hospital'			=> $this->mhospital->getAll()->result_array(),
						 	'schedule_temp'		=> $this->db->query("SELECT * FROM "._PREFIX."doctor_schedule_temp a JOIN "._PREFIX."hospital b ON b.idhospital = a.idhospital WHERE a.idschedule = '".$this->marge->get_ip()."' ORDER BY a.idhospital")->result_array(),
						 );

			if($this->session->userdata(_PREFIX.'branch') != '0'){
				$data['hospital'] = $this->mhospital->getById($this->session->userdata(_PREFIX.'branch'))->result_array();
			}else{
				$data['hospital'] = $this->mhospital->getAll()->result_array();
			}

			//$data['result_dimension']	= array();
			//$data['result_colour']		= array();
			$data['result_schedule']		= array();
			$this->load->view('template/main',$data);			
		}else{
			$price 		= $this->input->post('price');
			$status 	= $this->input->post('publish');
			$flag 		= $this->input->post('highlight_flag');
			$slug 		= $this->input->post('slug');
			$split_price = explode('-', $price);
			if(count($split_price)>1){ 
				$nprice = $split_price[0];
			}else{ 
				$nprice = $price;
			} 
			
			if(!isset($status)){
				$status   = '0';
				$updateby = '';
			}else{
				$status   = '1';
				$updateby = $this->session->userdata(_PREFIX.'username');
			}



			if(isset($_POST['subcategory1'])){ $idcatsubcategory1 = $this->input->post('subcategory1'); }else{ $idcatsubcategory1 = 0;}

			if(isset($_POST['itemcategory'])){ $idcatsubcategory2 = $this->input->post('itemcategory'); }else{ $idcatsubcategory2 = 0;}



			$data = array(
							'idcatcategory'		=> $this->input->post('doctorcategory'),
							'idcatlocation'		=> $this->input->post('locationcategory'),
							'idcatsubcategory1'	=> $idcatsubcategory1, //$this->input->post('itemcategory'),
							'idcatsubcategory2'	=> $idcatsubcategory2, //$this->input->post('itemcategory'),
							'iddiscount'		=> '',
							'name'				=> $this->input->post('name'), 
							'description'		=> $this->input->post('description'),
							'status'			=> $status,
							'price'				=> $this->input->post('price'),
							'createddate' 		=> date('Y-m-d H:i:s'),
							'createdby' 		=> $this->session->userdata(_PREFIX.'username'),
							'updateby'	 		=> $updateby,
							'nprice'			=> $nprice,
							'spesification' 	=> $this->input->post('spesification'),
							'care'				=> $this->input->post('care'),
							'slug'				=> $slug,
							// 'schedule' 			=> $this->input->post('schedule-1'),
						 );
			$insert = $this->mdoctor->insert($data);
			$lastid = $this->db->insert_id();
			$lastid = $lastid+0;
			if($insert){
				/* INSERT MULTIPLE IMAGE				
					$schedule 	= $this->input->post('schedule-counter');
					for($i=1;$i<=$schedule;$i++){
						$value = $this->input->post('schedule-'.$i);
						$data_schedule = array(
												'iddoctor' => $lastid,
												'schedule' 	=> $value
											 );
						if(!empty($value)){
							$insert_schedule = $this->mdoctorschedule->insert($data_schedule);
						}
						if($i==1){
							$data_update = array('schedule' => $this->input->post('schedule-'.$i));
							$this->mdoctor->update($lastid,$data_update);
						}
					}
				*/
				/* INSERT SCHEDULE TEMP */
					$get_schedule_temp = $this->db->query("SELECT * FROM "._PREFIX."doctor_schedule_temp a JOIN "._PREFIX."hospital b ON b.idhospital = a.idhospital WHERE a.idschedule = '".$this->marge->get_ip()."' AND a.slug = '".$slug."' ORDER BY a.idhospital")->result_array();
					if(count($get_schedule_temp) > 0){
						foreach($get_schedule_temp as $row){
							$data = array(
											'iddoctor' 	 => $lastid,
											'idhospital' => $row['idhospital'],
											'idday' 	 => $row['idday'],
											'day' 		 => $row['day'],
											'starttime'  => $row['starttime'],
											'endtime' 	 => $row['endtime'],
											'appointment'=> $row['appointment'],
											'slug'		 => $row['slug'],
										 );
							$this->mdoctorschedule->insert($data);
						}
					}
				/* INSERT SCHEDULE TEMP */
				if($flag == '1'){
					$highlight = $this->input->post('highlight');
					for ($i=0; $i < count($highlight); $i++) { 
						$data_highlight = array(
													'doctor_highlight_iddoctor'   => $lastid,
													'doctor_highlight_idhighlight' => $highlight[$i],
													'doctor_highlight_status'		=> '1',
											   );
						$this->mhighlight->insertDetail($data_highlight);
					}
				}
				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Data Saved
              	 </div>
              	');

				$this->deletescheduletemp('all', $slug);

				redirect('admin-doctor');
			}else{
				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Failed Save Data
              	 </div>
              	');

				$this->deletescheduletemp('all', $slug);

				redirect('admin-doctor');
			}
		}
	}

	function delete(){
		$id 		= $this->input->post('id');
		$decrypt_id = $this->marge->decrypt($id);
		$delete = $this->mdoctorschedule->delete($decrypt_id);
		$delete = $this->mhighlight->deleteDetail($decrypt_id);
		$delete = $this->mdoctor->delete($decrypt_id);
		if($delete){
			die('Success');
		}else{
			die('Failed #01');
		}
	}

	function view(){
		$id 	= $this->input->post('id');
		$url 	= $this->input->post('url');
		$type 	= $this->input->post('type');
		$get_account = $this->maccount->getByUsername($id)->row_array();
		if(count($get_account) > 0 ){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}
			$print = '
		            <div class="form-group">
		              <label for="vusername" class="form-control-label">Username</label>
		              <input type="text" class="form-control" id="vusername" name="vusername" value="'.$get_account['username'].'" disabled="disabled">
		              <input type="hidden" id="url" name="url" value="'.$url.'">
		            </div>
		            <div class="form-group">
		              <label for="vname" class="form-control-label">Name</label>
		              <input type="text" class="form-control" id="vname" name="vname" value="'.$get_account['name'].'" '.$disabled.'>
		            </div>
		            <div class="form-group">
		              <label for="vemail" class="form-control-label">Email</label>
		              <input type="email" class="form-control" id="vemail" name="vemail" value="'.$get_account['email'].'" '.$disabled.'>
		            </div>
		            <div class="form-group">
		              <label for="vphoto" class="form-control-label">Photo</label>
              		  <div class="input-group">
			              <input type="text" class="form-control" id="vphoto" data-error=".result" name="vphoto" value="'.$get_account['photo'].'" '.$disabled.'>
		                  <div class="input-group-btn">
		                    <a class="btn btn-info iframe-btn" href="'.base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=vphoto&akey='._AKEY).'" class="iframe-btn" title="File Manager">
		                        Browse
		                    </a>
		                  </div>
		              </div>
		              <div class="result has-error"></div>
		            </div>
		            <div class="form-group">
		              <label for="vrole" class="form-control-label">Role</label>
		              <!--input type="text" class="form-control" id="vrole" name="vrole" -->
		              <select class="form-control" id="vrole" name="vrole" '.$disabled.'>
		            ';
		            if($get_account['role'] == '1'){ $sel1 = 'selected'; $sel2 = ''; }else{ $sel1 = ''; $sel2 = 'selected'; }
		    $print .= '
		                  <option value=""></option>
		                  <option value="1" '.$sel1.'>Admin</option>
		                  <option value="2" '.$sel2.'>User</option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label for="vmenu" class="form-control-label">Group Menu</label>
		              <!--input type="text" class="form-control" id="vmenu" name="vmenu" -->
		              <select class="form-control" id="vmenu" name="vmenu" '.$disabled.'>
		                  	<option value=""></option>
		            ';
		            $res_group = $this->mgroupmenu->getAllGroup()->result_array();
		            foreach($res_group as $row){ 
		            if($get_account['menurole'] == $row['id']){ $selected = "selected";}else{ $selected = '';}
		    $print .= '
		    				<option value="'.$row['id'].'" '.$selected.'>'.$row['groupname'].'</option>
		    		  ';
		            }
		    $print .= '
		              </select>
		            </div>            
					';
			die($print);
		}else{
			die('');
		}
	}

	function edit($id = '0', $role = NULL){
		if($id == '0'){
			$id 		= $this->input->post('iddoctor');
			$price 		= $this->input->post('price');
			$status 	= $this->input->post('publish');
			$flag 		= $this->input->post('highlight_flag');
			$slug 		= $this->input->post('slug');
			$split_price = explode('-', $price);
			if(count($split_price)>1){ 
				$nprice = $split_price[0];
			}else{ 
				$nprice = $price;
			} 

			$updateby = $this->session->userdata(_PREFIX.'username');

			if(isset($_POST['subcategory1'])){ $idcatsubcategory1 = $this->input->post('subcategory1'); }else{ $idcatsubcategory1 = 0;}  //$idsubcategory1 = 0;}

			if(isset($_POST['itemcategory'])){ $idcatsubcategory2 = $this->input->post('itemcategory'); }else{ $idcatsubcategory2 = 0;}  //$idsubcategory2 = 0;}

			$data = array(
							'idcatcategory'		=> $this->input->post('doctorcategory'),
							'idcatlocation'		=> $this->input->post('locationcategory'),
							'idcatsubcategory1'	=> $idcatsubcategory1, //$this->input->post('itemcategory'),
							'idcatsubcategory2'	=> $idcatsubcategory2, //$this->input->post('itemcategory'),
							'iddiscount'		=> '',
							'name'				=> $this->input->post('name'), 
							'description'		=> $this->input->post('description'),
							'price'				=> $this->input->post('price'),
							'latestupdate' 		=> date('Y-m-d H:i:s'),
							'nprice'			=> $nprice,
							'spesification' 	=> $this->input->post('spesification'),
							'care'				=> $this->input->post('care'),
							'updateby'	 		=> $updateby,
							'slug'				=> $slug,
						 );
			if(!isset($status)){
				$data['status'] = '0';
			}else{
				$data['status']   = '1';
				$data['updateby'] = $this->session->userdata(_PREFIX.'username');
			}

			if($this->session->userdata(_PREFIX.'branch') != '0'){
				$update = 1;
			}else{
				$update = $this->mdoctor->update($id,$data);
			}
			

			if($update){
				/* UPDATE MULTIPLE IMAGE
					$schedule 	= $this->input->post('schedule-counter');
					$delete_schedule		= $this->mdoctorschedule->delete($id);
					if($delete_schedule){
						for($i=1;$i<=$schedule;$i++){
							$value = $this->input->post('schedule-'.$i);
							$data_schedule = array(
													'iddoctor' => $id,
													'schedule' 	=> $value
												 );
							if(!empty($value)){
								$insert_schedule = $this->mdoctorschedule->insert($data_schedule);
							}
							if($i==1){
								$data_update = array('schedule' => $this->input->post('schedule-'.$i));
								$this->mdoctor->update($id,$data_update);
							}
						}
					}
				*/

				/* INSERT SCHEDULE TEMP */
					$get_schedule_temp = $this->db->query("SELECT * FROM "._PREFIX."doctor_schedule_temp a JOIN "._PREFIX."hospital b ON b.idhospital = a.idhospital WHERE a.idschedule = '".$this->marge->get_ip()."' AND a.slug = '".$slug."' ORDER BY a.idhospital")->result_array();
					if(count($get_schedule_temp) > 0){
						$this->mdoctorschedule->delete($id);
						foreach($get_schedule_temp as $row){
							$data = array(
											'iddoctor' 	 => $id,
											'idhospital' => $row['idhospital'],
											'idday' 	 => $row['idday'],
											'day' 		 => $row['day'],
											'starttime'  => $row['starttime'],
											'endtime' 	 => $row['endtime'],
											'appointment'=> $row['appointment'],
											'slug'		 => $row['slug'],
										 );
							$this->mdoctorschedule->insert($data);
						}
					}
				/* INSERT SCHEDULE TEMP */

				if($this->session->userdata(_PREFIX.'branch') == '0'){
					if($flag == '1'){
						$highlight 			= $this->input->post('highlight');
						$delete_highlight 	= $this->mhighlight->deleteDetail($id); 
						for ($i=0; $i < count($highlight); $i++) { 
							$data_highlight = array(
														'doctor_highlight_iddoctor'   	=> $id,
														'doctor_highlight_idhighlight' 	=> $highlight[$i],
														'doctor_highlight_status'		=> '1',
												   );
							$this->mhighlight->insertDetail($data_highlight);
						}
					}
				}

				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Data Updated
              	 </div>
              	');
				$this->deletescheduletemp('all', $slug);
				redirect('admin-doctor');
			}else{
				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Failed Update Data
              	 </div>
              	');
				$this->deletescheduletemp('all', $slug);
				redirect('admin-doctor');
			}
		}else{
			$decrypt_id  = $this->marge->decrypt($id);
			$get_doctor = $this->mdoctor->getById($decrypt_id)->row_array();	 
			
			$this->deletescheduletemp('all', $get_doctor['slug']);
			$doctorcategory   	= $this->mcategory->getAll('statuscategory = \'1\'')->result_array();
			$subcategory1  		= $this->mdoctor->getCatById($get_doctor['idcatcategory'],NULL,'subcategory1')->result_array();
			if($role != NULL){
				$role = 'disabled="disabled"';
				$getscheduletemp 	= $this->db->query("SELECT * FROM "._PREFIX."doctor_schedule a JOIN "._PREFIX."hospital b ON b.idhospital = a.idhospital WHERE a.iddoctor = '".$decrypt_id."' OR a.slug = '".$get_doctor['slug']."' ORDER BY a.idhospital")->result_array();
			}else{
				$role = '';
				$getschedule 		= $this->mdoctorschedule->getJoinById($decrypt_id,$get_doctor['slug'])->result_array();
				/* INSERT TO SCHEDULE TEMP */
					if(count($getschedule) > 0){
						$n = 0;
						foreach($getschedule as $row){ $n++;
							$insert = $this->db->query("INSERT INTO "._PREFIX."doctor_schedule_temp VALUES(
														'".$this->marge->get_ip()."',
														'',
														'".$row['idhospital']."',
														'".$row['idday']."',
														'".$row['day']."',
														'".$row['starttime']."',
														'".$row['endtime']."',
														'".$row['appointment']."',
														'".$row['slug']."'
													  )");
						}
						$getscheduletemp 	= $this->db->query("SELECT * FROM "._PREFIX."doctor_schedule_temp a JOIN "._PREFIX."hospital b ON b.idhospital = a.idhospital WHERE a.idschedule = '".$this->marge->get_ip()."' AND a.slug = '".$get_doctor['slug']."' ORDER BY a.idhospital")->result_array();
					}
				/* INSERT TO SCHEDULE TEMP */
			}
			$data = array(
							'titlebar' 			=> 'Admin | Edit Doctor',
							'menu'				=> $this->mmenu->getParent()->result_array(),
							'content'			=> 'admin/doctor/edit',
							'title'				=> 'Edit Doctor',
							'modal'  			=> 'template/modal',
							'doctorcategory'	=> $doctorcategory , //$this->mcategory->getAll()->result_array(),
							'subcategory1'		=> $subcategory1,
							'itemcategory'		=> $this->mdoctor->getCatById($get_doctor['idcatcategory'],$get_doctor['idcatsubcategory1'])->result_array(), //$this->msubcategory2->getAll()->result_array(),
							'locationcategory'	=> $this->mlocation->getAll()->result_array(),
							'result_schedule'	=> $this->mdoctorschedule->getByIddoctor($decrypt_id)->result_array(),
							// 'hospital'			=> $this->mhospital->getAll()->result_array(),
							'result'			=> $get_doctor,
							'encrypt_id'		=> $id,
							'role'				=> $role,
							'highlight'			=> $this->mhighlight->getByMenu('admin-doctor','1')->result_array(),
						 	'schedule_temp'		=> $getscheduletemp,
						 );

			if($this->session->userdata(_PREFIX.'branch') != '0'){
				$data['hospital'] = $this->mhospital->getById($this->session->userdata(_PREFIX.'branch'))->result_array();
			}else{
				$data['hospital'] = $this->mhospital->getAll()->result_array();
			}

			$this->load->view('template/main',$data);
		}
	}

	function load_maincat(){
		$id = $this->input->post('id');
		$get_item = $this->mdoctor->getCatById($id,NULL,'subcategory1')->result_array();
		$print = '';
		foreach ($get_item as $row) {
			$print .= "<option value=\"".$row['cat_id']."\">".$row['cat_name']."</option>";
		}
		die($print);
	}

	function load_subcat(){
		$id1 = $this->input->post('id1');
		$id2 = $this->input->post('id2');
		$get_item = $this->mdoctor->getCatById($id1,$id2)->result_array();
		$print = '';
		foreach ($get_item as $row) {
			$print .= "<option value=\"".$row['item_id']."\">".$row['item_name']."</option>";
		}
		die($print);
	}

	function multiple_action(){
		$role = $this->input->post('role');
		$id   = $this->input->post('id');
		$n = 0;
		for($i=0;$i<count($id);$i++){
			$decrypt_id = $this->marge->decrypt($id[$i]);
	
			if($role == 'publish' || $role == 'unpublish'){
				if($role == 'publish'){
					$data = array( 'status' => '1', 'updateby' => $this->session->userdata(_PREFIX.'username'), 'latestupdate' => date('Y-m-d H:i:s'), );
				}else{
					$data = array( 'status' => '0', 'updateby' => $this->session->userdata(_PREFIX.'username'), 'latestupdate' => date('Y-m-d H:i:s'), );
				}
				$update = $this->mdoctor->update($decrypt_id,$data);
				if($update){
					$n++;
				}
			}elseif($role == 'delete'){
				$update = $this->mdoctorschedule->delete($decrypt_id);
				$update = $this->mhighlight->deleteDetail($decrypt_id);
				$update = $this->mdoctor->delete($decrypt_id);
				if($update){
					$n++;
				}
			}
		}
		if($n == count($id)){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function check_slug(){
		$slug  = $this->input->post('slug'); 
		$where = "a.slug = '".$slug."'";
		$get   = $this->mdoctor->getAdvancedSearch($where);
		//echo $this->db->last_query();
		$get = $get->row_array();
		if(count($get) > 0){
			$additSlug = date('ymdhis');
			die($additSlug);
		}else{
			die('OK');
		}
	}

	function addscheduletemp(){
		$hospitalid 	= $this->input->post('hospitalid');
		$hospitalname 	= $this->input->post('hospitalname');
		$schedule_day 	= $this->input->post('schedule_day');
		$idschedule_day	= $this->input->post('idschedule_day');
		$starttime 		= $this->input->post('starttime');
		$endtime 		= $this->input->post('endtime');
		$byappointment 	= $this->input->post('byappointment');
		$slug 			= $this->input->post('slug');
		$print 			= '';
		$insert = $this->db->query("INSERT INTO "._PREFIX."doctor_schedule_temp VALUES('".$this->marge->get_ip()."','','".$hospitalid."','".$idschedule_day."','".$schedule_day."','".$starttime."','".$endtime."','".$byappointment."','".$slug."')");
		if($insert){
			$get_schedule_temp = $this->db->query("SELECT * FROM "._PREFIX."doctor_schedule_temp a JOIN "._PREFIX."hospital b ON b.idhospital = a.idhospital WHERE a.idschedule = '".$this->marge->get_ip()."' AND a.slug = '".$slug."' ORDER BY a.idhospital")->result_array();
			if(count($get_schedule_temp) > 0){
				foreach($get_schedule_temp as $row){
					if($row['appointment']=='1'){$app='Yes';}else{$app='No';}
					$print .= "<tr>";
                    $print .= "    <td class=\"no-right\" align=\"center\">";
	
					if($row['idhospital'] == $this->session->userdata(_PREFIX.'branch') || $this->session->userdata(_PREFIX.'branch') == 0){
                    $print .= "        <a href=\"javascript:void(0);\" class=\"close\" onclick=\"deleteScheduleTemp('".$row['idindex'].'|'.$row['idschedule']."')\"><i class=\"fa fa-close\"></i></a>";
                   	}

                    $print .= "    </td>";
			        $print .= "    <td>".$row['namehospital']."</td>";
			        $print .= "    <td>".$row['day']."</td>";
			        $print .= "    <td>".date('H:i',strtotime($row['starttime']))."</td>";
					$print .= "    <td>".date('H:i',strtotime($row['endtime']))."</td>";
			        $print .= "    <td>".$app."</td>";
			        $print .= "</tr>";
			    }
			}
	        /*
			$print .= "<tr>";
	        $print .= "    <td>".$hospitalname."</td>";
	        $print .= "    <td>".$schedule_day."</td>";
	        $print .= "    <td>".$starttime."</td>";
			$print .= "    <td>".$endtime."</td>";
	        $print .= "</tr>";
			*/
			echo $print;
		}
	}

	function deletescheduletemp($role = '', $slug = ''){
		if($role == ''){		
			$indexid 	= $this->input->post('indexid');
			$scheduleid = $this->input->post('scheduleid');
			$slug 		= $this->input->post('slug');
			$print = '';
			$delete = $this->db->query("DELETE FROM "._PREFIX."doctor_schedule_temp WHERE idschedule = '".$scheduleid."' AND idindex = '".$indexid."' AND slug = '".$slug."'");
			if($delete){
				$get_schedule_temp = $this->db->query("SELECT * FROM "._PREFIX."doctor_schedule_temp a JOIN "._PREFIX."hospital b ON b.idhospital = a.idhospital WHERE a.idschedule = '".$this->marge->get_ip()."' ORDER BY a.idhospital")->result_array();
				if(count($get_schedule_temp) > 0){
					foreach($get_schedule_temp as $row){
						if($row['appointment']=='1'){$app='Yes';}else{$app='No';}
						$print .= "<tr>";
	                    $print .= "    <td class=\"no-right\" align=\"center\">";

						if($row['idhospital'] == $this->session->userdata(_PREFIX.'branch') || $this->session->userdata(_PREFIX.'branch') == 0){
	                    $print .= "        <a href=\"javascript:void(0);\" class=\"close\" onclick=\"deleteScheduleTemp('".$row['idindex'].'|'.$row['idschedule']."')\"><i class=\"fa fa-close\"></i></a>";
	                    }
	                    
	                    $print .= "    </td>";
				        $print .= "    <td>".$row['namehospital']."</td>";
				        $print .= "    <td>".$row['day']."</td>";
				        $print .= "    <td>".date('H:i',strtotime($row['starttime']))."</td>";
						$print .= "    <td>".date('H:i',strtotime($row['endtime']))."</td>";
			        	$print .= "    <td>".$app."</td>";
				        $print .= "</tr>";
				    }
				}
				echo $print;
			}
		}elseif($role = 'all'){
			$scheduleid = $this->marge->get_ip();
			if($slug == ''){
				$where = '';
			}else{
				$where = "AND slug = '".$slug."'";
			}
			$query = "DELETE FROM "._PREFIX."doctor_schedule_temp WHERE idschedule = '".$scheduleid."' ".$where;
			$delete = $this->db->query($query);
		
			return 'true';
		}
	}
}