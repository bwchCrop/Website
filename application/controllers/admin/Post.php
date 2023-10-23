<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

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
						'titlebar' 	=> 'Admin | Post',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/post/index',
						'modal'  	=> 'template/modal',
						'title'		=> 'Post',
						'result'	=> $this->mpost->getPostContent()->result_array(),//$this->mpost->getPostJoin()->result_array()
					 	'role'   	=> $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array(),
					 );

		$this->load->view('template/main',$data);
	}

	function add(){
		$title = $this->input->post('title');

		if(!isset($title) || empty($title)){
			$data = array(
							'titlebar' 	=> 'Admin | Add Post',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/post/add',
							'title'		=> 'Add Post',
							'modal'  	=> 'template/modal',
							'category'	=> $this->mpostcategory->getPostCategory()->result_array(),
						 );

			$data['result_picture']		= array();

			$this->load->view('template/main',$data);			
		}else{
			$store = $this->input->post('store');
			if(isset($_POST['store'])){
				$store = $store;
			}else{
				$store = NULL;
			}

			$data = array(
							'title' 	=> $this->input->post('title'), 
							'content' 	=> $this->input->post('content'),
							'slug' 		=> $this->input->post('slug'),
							'idcategory'=> $this->input->post('category'),
							'date'		=> date('Y-m-d H:i:s'),
							'image' 	=> $this->input->post('image'),
							'thumbnail' => $this->input->post('thumbnail'),
							'status'  	=> $this->input->post('publish'),
							'user'		=> $this->session->userdata(_PREFIX.'username'),
							'idpoststore'   => $store,
							'thumbnailtext' => $this->input->post('thumbnailtext'),
						 );

			//$insert = $this->mpost->insert($data);

			if($this->mpost->insert($data)){
				$lastid = $this->db->insert_id();
				$lastid = $lastid+0;

				$picture = $this->input->post('pictureCounter');
				$value 	 = $this->input->post('arrPicture');

				for($i=0;$i<$picture;$i++){
					$data_picture = array(
											'idpost' 			=> $lastid,
											'postpicture' 		=> $value[$i],
										 );
					if(!empty($value)){
						$insert_picture = $this->mpost->insert_postpicture($data_picture);
					}
				}

				die('Success');
			}else{
				die('Failed');
			}
		}
	}

	function delete(){
		$id 		= $this->input->post('id');
		$decrypt_id = $this->marge->decrypt($id);

		$delete = $this->mpost->delete($decrypt_id);

		if($delete){
			$delete = $this->mpost->delete_postpicture($decrypt_id);

			if($delete){
				die('Success');
			}else{
				die('Failed #02');
			}
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

	function edit($id = '0', $role = NULL){
		if($id == '0'){
			$id 		= $this->input->post('id');
			$decrypt_id = $this->marge->decrypt($id);

			$store = $this->input->post('store');
			if(isset($_POST['store'])){
				$store = $store;
			}else{
				$store = NULL;
			}

			$data = array(
							'title' 		=> $this->input->post('title'),
							'content'		=> $this->input->post('content'),
							'slug'			=> $this->input->post('slug'),
							'idcategory' 	=> $this->input->post('category'),
							'image'  		=> $this->input->post('image'),
							'thumbnail'  	=> $this->input->post('thumbnail'),
							'status'		=> $this->input->post('publish'),
							'idpoststore'	=> $store,
							'thumbnailtext' => $this->input->post('thumbnailtext'),
						 );

			$check_id = $this->mpost->getById($decrypt_id)->row_array();

			if(count($check_id) == 0){
				die('Failed');
			}else{
				$update = $this->mpost->update($decrypt_id,$data); 
				
				if($update){
					if($this->mpost->delete_postpicture($decrypt_id)){
						$picture = $this->input->post('pictureCounter');
						$value 	 = $this->input->post('arrPicture');

						for($i=0;$i<$picture;$i++){
							$data_picture = array(
													'idpost' 			=> $decrypt_id,
													'postpicture' 		=> $value[$i],
												 );
							if(!empty($value)){
								$insert_picture = $this->mpost->insert_postpicture($data_picture);
							}
						}
						die('Success');
					}else{
						die('Failed #02');
					}
				}else{
					die('Failed #01');
				}
			}
		}else{
			$decrypt_id = $this->marge->decrypt($id);

			$get_post	= $this->mpost->getById($decrypt_id)->row_array();	 
			
			if($role != NULL){
				$role = 'disabled="disabled"';
			}else{
				$role = '';
			}

			$data = array(
							'titlebar' 	=> 'Admin | Edit Post',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/post/edit',
							'title'		=> 'Edit Post',
							'modal'  	=> 'template/modal',
							'category'	=> $this->mpostcategory->getPostCategory()->result_array(),
							'result'	=> $get_post,
							'encrypt_id'=> $id,
							'role' 		=> $role,
						 );

			$data['result_picture'] = $this->mpost->getPicture($decrypt_id)->result_array();

			$this->load->view('template/main',$data);
		}
	}

	function load_store(){
		$id = $this->input->post('id');

		$get_store = $this->mstore->getAll()->result_array();
		$print = "<option value=\"0\">All</option>";

		foreach ($get_store as $row) {
			$print .= "<option value=\"".$row['idstore']."\">".$row['location']."</option>";
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
					$data = array( 'status' => '1', );
				}else{
					$data = array( 'status' => '0', );
				}

				$update = $this->mpost->update($decrypt_id,$data);
				if($update){
					$n++;
				}
			}elseif($role == 'delete'){
				$update = $this->mpost->delete($decrypt_id);
				if($update){
					$delete = $this->mpost->delete_postpicture($decrypt_id);

					if($delete){
						$n++;
					}
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
		$where = "post.slug = '".$slug."'";
		$get   = $this->mpost->getJoinByWhere($where)->row_array();
		$last = $this->db->last_query();

		if($get > 0){
			$additSlug = date('ymdhis');
			die($additSlug);
		}else{
			die('OK');
		}
	}

	function get_append(){
		$counter = $this->input->post('counter');

		$print  = '';

		$print .=  '
                    <div class="col-sm-12">
						<div class="input-group" style="margin-bottom: 5px;">
							<input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="picture-'.$counter.'" name="picture-'.$counter.'" placeholder="Picture '.$counter.'">
							<div class="input-group-btn">
								<a class="btn btn-info iframe-btn" href="'.base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=picture-').$counter.'&akey='._AKEY.'" class="iframe-btn" title="File Manager">
									Browse
								</a>
							</div>
						</div>
					</div>';

		echo $print;
	}	
}
