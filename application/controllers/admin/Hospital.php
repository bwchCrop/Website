<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index(){
		$username = $this->session->userdata(_PREFIX.'username');

		if($this->session->userdata(_PREFIX.'branch') != '0'){
			$id = $this->marge->encrypt($this->session->userdata(_PREFIX.'branch'));

			redirect("edit-hospital-".$id);
		}else{

			$data = array(
							'titlebar' 	=> 'Admin | Hospital',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/hospital/index',
							'modal'  	=> 'template/modal',
							'title'		=> 'Hospital',
							'result'	=> $this->mhospital->getAll()->result_array(),
						 	'role'   	=> $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array(),
						 );

			$this->load->view('template/main',$data);
		}
	}

	function add(){
		$namehospital = $this->input->post('namehospital');

		if(!isset($namehospital) || empty($namehospital)){
			$data = array(
							'titlebar' 	=> 'Admin | Add Hospital',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/hospital/add',
							'title'		=> 'Add Hospital',
							'modal'  	=> 'admin/hospital/modal',
							'result_location'	=> $this->mlocation->getAll()->result_array(),
						 );

			$this->load->view('template/main',$data);			
		}else{
			$data = array(
							'namehospital' 	=> $this->input->post('namehospital'), 
							'location' 		=> $this->input->post('location'),
							'addresshospital'	=> $this->input->post('addresshospital'),
							'longitude'		=> $this->input->post('longitude'),
							'latitude' 		=> $this->input->post('latitude'),
							//'mapurl'		=> $this->input->post('mapurl'),
							'image'  		=> $this->input->post('image'),
							'picture'  		=> $this->input->post('picture'),
							'status'		=> $this->input->post('publish'),
							'phone'			=> $this->input->post('phone'),
							'ugd'			=> $this->input->post('ugd') ? $this->input->post('ugd', false) : NULL,
							'city'			=> $this->input->post('city'),
							'email'			=> $this->input->post('email'),
						 );

			$insert = $this->mhospital->insert($data);

			if($insert){
				die('Success');
			}else{
				die('Failed');
			}
		}
	}

	function delete(){
		$id 		= $this->input->post('id');
		$id1 		= str_replace(array('_'), array('/'), $id);
		$decrypt_id = $this->encryption->encrypt($id1);

		$delete = $this->mhospital->delete($decrypt_id);

		if($delete){
			die('Success');
		}else{
			die('Failed');
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

	function edit($id = '0'){
		if($id == '0'){
			$id 		= $this->input->post('idhospital');
			$id1 		= str_replace(array('_'), array('/'), $id);
			$decrypt_id = $this->encryption->decrypt($id1);

			$services 	= $this->input->post('services');
			$facilities	= $this->input->post('facilities');

			$data = array(
						'namehospital' 	=> $this->input->post('namehospital'), 
						'location' 		=> $this->input->post('location'),
						'description' 	=> $this->input->post('description'),
						'addresshospital'=> $this->input->post('addresshospital'),
						'longitude'		=> $this->input->post('longitude'),
						'latitude' 		=> $this->input->post('latitude'),
						//'mapurl'		=> $this->input->post('mapurl'),
						'image'  		=> $this->input->post('image'),
						'picture'  		=> $this->input->post('picture'),
						'status'		=> $this->input->post('publish'),
						'phone'			=> $this->input->post('phone'),
						'ugd'			=> $this->input->post('ugd') ? $this->input->post('ugd', false) : NULL,
						'city'			=> $this->input->post('city'),
						'email'			=> $this->input->post('email'),
					);

			$check_id = $this->mhospital->getById($decrypt_id)->row_array();

			if(count($check_id) == 0){
				die('Failed');
			}else{
				$update = $this->mhospital->update($decrypt_id,$data); 
				
				if($update){
					$delete = $this->db->query("DELETE FROM "._PREFIX."hospital_detail WHERE hospital_detail_idhospital = '".$decrypt_id."'");

					if($delete){
						for($i=0; $i < count($services); $i++) { 
							$this->db->query("INSERT INTO "._PREFIX."hospital_detail VALUES ('','".$decrypt_id."','".$services[$i]."')");
						}

						for($i=0; $i < count($facilities); $i++) { 
							$this->db->query("INSERT INTO "._PREFIX."hospital_detail VALUES ('','".$decrypt_id."','".$facilities[$i]."')");
						}
					}

					die('Success');
				}else{
					die('Failed');
				}
			}
		}else{
			$id1 		= str_replace(array('_'), array('/'), $id);
			$decrypt_id = $this->encryption->decrypt($id1);

			$get_hospital	= $this->mhospital->getById($decrypt_id)->row_array();	 


			$get_detail 	= $this->db->query("
												SELECT *,tblpost.id post_id, tblpost.title post_title FROM "._PREFIX."hospital_detail tbldetail
												JOIN "._PREFIX."post tblpost ON tblpost.id = tbldetail.hospital_detail_idpost
												WHERE tbldetail.hospital_detail_idhospital = '".$decrypt_id."' 
											   ")->result_array();

			$data = array(
						'titlebar' 	=> 'Admin | Edit Hospital',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'location'	=> $this->mlocation->getAll()->result_array(),
						'content'	=> 'admin/hospital/edit',
						'title'		=> 'Edit Hospital',
						'modal'  	=> 'admin/hospital/modal',
						'category'	=> $this->mcategory->getAll()->result_array(),
						'result'	=> $get_hospital,
						'resultServ'=> $this->mpost->getJoinByWhere('post.idcategory = 3')->result_array(),
						'resultFac' => $this->mpost->getJoinByWhere('post.idcategory = 4')->result_array(),
						'resdetail' => $get_detail,
						'encrypt_id'=> $id,
						'decrypt_id'=> $decrypt_id,
					);

			$this->load->view('template/main',$data);
		}
	}

	function multiple_action(){
		$role = $this->input->post('role');
		$id   = $this->input->post('id');

		$n = 0;
		for($i=0;$i<count($id);$i++){
			$decrypt_id = $this->marge->decrypt($id[$i]);
	
			if($role == 'publish' || $role == 'unpublish'){
				if($role == 'publish'){
					$data = array( 'status' => '1',);
				}else{
					$data = array( 'status' => '0',);
				}

				$update = $this->mhospital->update($decrypt_id,$data);
				if($update){
					$n++;
				}
			}elseif($role == 'delete'){
				$update = $this->mhospital->delete($decrypt_id);
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

}
