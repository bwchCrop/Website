<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index(){
		$username = $this->session->userdata(_PREFIX.'username');

		$data = array(
						'titlebar' 	=> 'Admin | Brand',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/brand/index',
						'modal'  	=> 'admin/brand/modal',
						'title'		=> 'Post',
						'result'	=> $this->mbrand->getAll()->result_array()
					 );

		$this->load->view('template/main',$data);
	}

	function add(){
		$brandname = $this->input->post('brandname');

		if(!isset($brandname) || empty($brandname)){
			$data = array(
							'titlebar' 	=> 'Admin | Add Brand',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/brand/add',
							'title'		=> 'Add Brand',
							'modal'  	=> 'admin/brand/modal',
							'category'	=> $this->mbrand->getAllBrand()->result_array()
						 );

			$data['result_gallery']	= array();
			$data['result_slide']	= array();
			$data['result_address']	= array();

			$this->load->view('template/main',$data);			
		}else{
			$data = array(
							'brandname'		=> $this->input->post('brandname'), 
							'branddesc'		=> $this->input->post('branddesc'),
							'brandstatus'	=> $this->input->post('brandstatus'),
							'brandlogo'		=> $this->input->post('brandlogo'),
							'brandback'		=> $this->input->post('brandback'),
							'branddate' 	=> date('Y-m-d'),
							'branduser' 	=> $this->session->userdata(_PREFIX.'username')
						 );

			$insert = $this->mbrand->insert($data);
			$lastid = $this->db->insert_id();
			$lastid = $lastid+0;

			if($insert){
				$gallery = $this->input->post('gallery-counter');

				for($i=1;$i<=$gallery;$i++){
					$data_gallery = array(
											'idbrand' => $lastid,
											'gallery' => $this->input->post('gallery-'.$i)
										 );

					$insert_gallery = $this->mbrand->insert_gallery($data_gallery);
				}

				if($insert_gallery){
					$slide = $this->input->post('slide-counter');

					for($i=1;$i<=$slide;$i++){
						$data_slide = array(
												'idbrand' 	=> $lastid,
												'slide' 	=> $this->input->post('slide-'.$i)
											 );

						$insert_slide = $this->mbrand->insert_slide($data_slide);
					}

					if($insert_slide){
						$address = $this->input->post('address-counter');

						for($i=1;$i<=$address;$i++){
							$data_address = array(
													'idbrand' 		=> $lastid,
													'addresstitle' 	=> $this->input->post('addresstitle-'.$i),
													'addressdesc'  	=> $this->input->post('addressdesc-'.$i),
													'addresslongitude' 	=> $this->input->post('addresslongitude-'.$i),
													'addressLatitude'  	=> $this->input->post('addressLatitude-'.$i)
												 );

							$insert_address = $this->mbrand->insert_address($data_address);
						}
					}
				}

				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Data Saved
              	 </div>
              	');
				redirect('admin-brand');
			}else{
				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Failed Save Data
              	 </div>
              	');
				redirect('admin-brand');
			}
		}
	}

	function delete(){
		$id 		= $this->input->post('id');
		$id1 		= str_replace(array('_'), array('/'), $id);
		$decrypt_id = $this->encryption->encrypt($id1);

		$delete = $this->mpost->delete($decrypt_id);

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
			$id = $this->input->post('idbrand');

			$data = array(
							'brandname'		=> $this->input->post('brandname'), 
							'branddesc'		=> $this->input->post('branddesc'),
							'brandstatus'	=> $this->input->post('brandstatus'),
							'brandlogo'		=> $this->input->post('brandlogo'),
							'brandback'		=> $this->input->post('brandback'),
							'branddate' 	=> date('Y-m-d'),
							'branduser' 	=> $this->session->userdata(_PREFIX.'username')
						 );

			$insert = $this->mbrand->update($id,$data);

			if($insert){
				$delete_gallery = $this->mbrand->delete_gallery($id);
				$gallery = $this->input->post('gallery-counter');

				for($i=1;$i<=$gallery;$i++){
					$data_gallery = array(
											'idbrand' => $id,
											'gallery' => $this->input->post('gallery-'.$i)
										 );

					$insert_gallery = $this->mbrand->insert_gallery($data_gallery);
				}

				if($insert_gallery){
					$delete_slide = $this->mbrand->delete_slide($id);
					$slide = $this->input->post('slide-counter');

					for($i=1;$i<=$slide;$i++){
						$data_slide = array(
												'idbrand' 	=> $id,
												'slide' 	=> $this->input->post('slide-'.$i)
											 );

						$insert_slide = $this->mbrand->insert_slide($data_slide);
					}

					if($insert_slide){
						$delete_address = $this->mbrand->delete_address($id);
						$address = $this->input->post('address-counter');

						for($i=1;$i<=$address;$i++){
							$data_address = array(
													'idbrand' 			=> $id,
													'addresstitle' 		=> $this->input->post('addresstitle-'.$i),
													'addressdesc'  		=> $this->input->post('addressdesc-'.$i),
													'addresslongitude' 	=> $this->input->post('addresslongitude-'.$i),
													'addresslatitude'  	=> $this->input->post('addresslatitude-'.$i)
												 );

							$insert_address = $this->mbrand->insert_address($data_address);
						}
					}
				}

				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Data Updated
              	 </div>
              	');
				redirect('admin-brand');
			}else{
				$this->session->set_flashdata('message_', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Failed Update Data
              	 </div>
              	');
				redirect('admin-brand');
			}
		}else{
			$id1 		= str_replace(array('_'), array('/'), $id);
			$decrypt_id = $this->encryption->decrypt($id1);

			$get_brand	= $this->mbrand->getById($decrypt_id)->row_array();	 
			
			$data = array(
							'titlebar' 		=> 'Admin | Edit Brand',
							'menu'			=> $this->mmenu->getParent()->result_array(),
							'content'		=> 'admin/brand/edit',
							'title'			=> 'Edit Brand',
							'modal'  		=> 'admin/brand/modal',
							'result'		=> $get_brand,
							'result_gallery'=> $this->mbrand->getGalleryById_($decrypt_id)->result_array(),
							'result_slide'	=> $this->mbrand->getSlideById_($decrypt_id)->result_array(),
							'result_address'=> $this->mbrand->getAddressById_($decrypt_id)->result_array(),
							'encrypt_id'	=> $id
						 );

			$this->load->view('template/main',$data);
		}
	}

}
