<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}
	
	/* ----------- POST CATEGORY ----------- */

		public function index(){
			$username = $this->session->userdata(_PREFIX.'username');

			$data = array(
							'titlebar' 	=> 'Admin | Post Category',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/postcategory/index',
							'modal'  	=> 'admin/postcategory/modal',
							'title'		=> 'Post Category',
							'result'	=> $this->mpostcategory->getAll()->result_array(),
							//'res_group' => $this->mgroupmenu->getAllGroup()->result_array(),
							'js'		=> ''
						 );

			$this->load->view('template/main',$data);
		}

		function add(){
			$data = array(
							'title' 	=> $this->input->post('name'),
						 );

			$insert = $this->mpostcategory->insert($data);

			if($insert){
				$this->marge->record_activity('Add Post Category '.$data['title']);
				die('Success');
			}else{
				die('Failed');
			}
		}

		function delete(){
			$id = $this->input->post('id');

			$delete = $this->mpostcategory->delete($id);

			if($delete){
				$this->marge->record_activity('Delete Post Category ID:'.$id);
				die('Success');
			}else{
				die('Failed');
			}
		}

		function view(){
			$id 	= $this->input->post('id');
			$url 	= $this->input->post('url');
			$type 	= $this->input->post('type');

			$get_data = $this->mpostcategory->getByid($id)->row_array();

			if(count($get_data) > 0 ){
			    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

				$print = '
			            <div class="form-group">
			              <label for="vusername" class="form-control-label">Title</label>
			              <input type="text" class="form-control" id="vname" name="vname" value="'.$get_data['title'].'">
			              <input type="hidden" id="url" name="url" value="'.$url.'">
			              <input type="hidden" id="id" name="id" value="'.$id.'">
			            </div>       
						';

				die($print);
			}else{
				die('');
			}
		}

		function edit(){
			$id = $this->input->post('id');

			$data = array(
							'title' => $this->input->post('name')
						 );

			$check_id = $this->mpostcategory->getByid($id)->row_array();

			if(count($check_id) == 0){
				die('Failed');
			}else{
				$update = $this->mpostcategory->update($id,$data); 
				
				if($update){
					$this->marge->record_activity('Update Post Category '.$data['title']);
					die('Success');
				}else{
					die('Failed');
				}
			}
		}

		function multiple_action(){
			$role = $this->input->post('role');
			$id   = $this->input->post('id');

			$n = 0;
			for($i=0;$i<count($id);$i++){
				if($role == 'publish' || $role == 'unpublish'){
					if($role == 'publish'){
						$data = array( 'catstatus' => '1', );
					}else{
						$data = array( 'catstatus' => '0', );
					}

					$update = $this->mpostcategory->update($id[$i],$data);
					if($update){
						$n++;
					}
				}elseif($role == 'delete'){
					alert('delete');
				}
			}

			if($n == count($id)){
				die('Success');
			}else{
				die('Failed');
			}
		}

	/* ----------- DOCTOR CATEGORY ----------- */

		public function doctorcategory(){
			$username = $this->session->userdata(_PREFIX.'username');

			$data = array(
							'titlebar' 	=> 'Admin | Doctor Category',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/category/index',
							'modal'  	=> 'admin/category/modal',
							'title'		=> 'Doctor Category',
							'result'	=> $this->mcategory->getAll()->result_array(),
							'js'		=> ''
						 );

			$this->load->view('template/main',$data);
		}

		function doctorcategory_add(){
			$data = array(
							'namecategory' 		=> $this->input->post('namecategory'),
							'picturecategory'	=> $this->input->post('picturecategory')
						 );

			$insert = $this->mcategory->insert($data);

			if($insert){
				$this->marge->record_activity('Add doctor.Category '.$data['namecategory']);
				die('Success');
			}else{
				die('Failed');
			}
		}

		function doctorcategory_delete(){
			$id = $this->input->post('id');

			$delete = $this->mcategory->delete($id);

			if($delete){
				$this->marge->record_activity('Delete doctor.Category ID:'.$id);
				die('Success');
			}else{
				die('Failed');
			}
		}

		function doctorcategory_view(){
			$id 	= $this->input->post('id');
			$url 	= $this->input->post('url');
			$type 	= $this->input->post('type');

			$get_data = $this->mcategory->getByid($id)->row_array();

			if(count($get_data) > 0 ){
			    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

				$print = '
			            <div class="form-group">
			              <label for="vnamecategory" class="form-control-label">Doctor Category</label>
			              <input type="text" class="form-control" id="vnamecategory" name="vnamecategory" value="'.$get_data['namecategory'].'">
			              <input type="hidden" id="url" name="url" value="'.$url.'">
			              <input type="hidden" id="id" name="id" value="'.$id.'">
			            </div>
			            <div class="form-group">
			                <label for="vpicturecategory" class="form-control-label">Picture</label>
			                <div class="input-group">
			                    <input type="text" class="form-control" data-error=".result" id="vpicturecategory" name="vpicturecategory" value="'.$get_data['picturecategory'].'">
			                    <div class="input-group-btn">
			                        <a class="btn btn-info iframe-btn" href="'.base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=vpicturecategory&akey='._AKEY).'" class="iframe-btn" title="File Manager">
			                        Browse
			                        </a>
			                    </div>
			                </div>
			                <div class="result has-error"></div>
			            </div>       
						';

				die($print);
			}else{
				die('');
			}
		}

		function doctorcategory_edit(){
			$id = $this->input->post('id');

			$data = array(
							'namecategory' 		=> $this->input->post('namecategory'),
							'picturecategory' 	=> $this->input->post('picturecategory')
						 );

			$check_id = $this->mcategory->getByid($id)->row_array();

			if(count($check_id) == 0){
				die('Failed');
			}else{
				$update = $this->mcategory->update($id,$data); 
				
				if($update){
					die('Success');
				}else{
					die('Failed');
				}
			}
		}

	/* ----------- SUB CATEGORY 2 ----------- */

		public function itemcategory(){
			$username = $this->session->userdata(_PREFIX.'username');

			$data = array(
							'titlebar' 	=> 'Admin | Item Category',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/subcategory2/index',
							'modal'  	=> 'admin/subcategory2/modal',
							'title'		=> 'Item Category',
							'result'	=> $this->msubcategory2->getJoinAll()->result_array(),
							'res_group' => $this->msubcategory1->getAll()->result_array(),
							'js'		=> ''
						 );

			$this->load->view('template/main',$data);
		}

		function itemcategory_add(){
			$data = array(
							'subcategory2' 		=> $this->input->post('subcategory2'),
							'idcatsubcategory1' => $this->input->post('subcategory1')
						 );

			$insert = $this->msubcategory2->insert($data);

			if($insert){
				die('Success');
			}else{
				die('Failed');
			}
		}

		function itemcategory_delete(){
			$id = $this->input->post('id');

			$delete = $this->msubcategory2->delete($id);

			if($delete){
				die('Success');
			}else{
				die('Failed');
			}
		}

		function itemcategory_view(){
			$id 	= $this->input->post('id');
			$url 	= $this->input->post('url');
			$type 	= $this->input->post('type');

			$get_data = $this->msubcategory2->getByid($id)->row_array();

			if(count($get_data) > 0 ){
			    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

			    $get_group = $this->msubcategory1->getAll()->result_array();

				$print = '
			            <div class="form-group">
			              <label for="vsubcategory2" class="form-control-label">Item Category</label>
			              <input type="text" class="form-control" id="vsubcategory2" name="vsubcategory2" value="'.$get_data['subcategory2'].'">
			              <input type="hidden" id="url" name="url" value="'.$url.'">
			              <input type="hidden" id="id" name="id" value="'.$id.'">
			            </div>       
			            <div class="form-group">
			              <label for="vsubcategory1" class="form-control-label">Item Category</label>
			              <select name="vsubcategory1" id="vsubcategory1" class="form-control">
						';
				foreach($get_group as $row){
				if($row['id'] == $get_data['idcatsubcategory1']){ $sel = 'selected'; }else{ $sel = ''; }
				$print .= '
							<option value="'.$row['id'].'" '.$sel.'>'.$row['subcategory1'].'</option>
						  ';
				}

				$print .= '
						  </select>
						  ';


				die($print);
			}else{
				die('');
			}
		}

		function itemcategory_edit(){
			$id = $this->input->post('id');

			$data = array(
							'subcategory2' 		=> $this->input->post('subcategory2'),
							'idcatsubcategory1' => $this->input->post('subcategory1')
						 );

			$check_id = $this->msubcategory2->getByid($id)->row_array();

			if(count($check_id) == 0){
				die('Failed');
			}else{
				$update = $this->msubcategory2->update($id,$data); 
				
				if($update){
					die('Success');
				}else{
					die('Failed');
				}
			}
		}

	/* ----------- SUB CATEGORY 1 ----------- */

		public function groupitemcategory(){
			$username = $this->session->userdata(_PREFIX.'username');

			$data = array(
							'titlebar' 	=> 'Admin | Group Item ',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/subcategory1/index',
							'modal'  	=> 'admin/subcategory1/modal',
							'title'		=> 'Group Item ',
							'result'	=> $this->msubcategory1->getAll()->result_array(),
							'result_group'=> $this->mcategory->getAll()->result_array(),
							'js'		=> ''
						 );

			$this->load->view('template/main',$data);
		}

		function groupitemcategory_add(){
			$data = array(
							'subcategory1' 	=> $this->input->post('subcategory1'),
							'idcatcategory' => $this->input->post('category'),
						 );

			$insert = $this->msubcategory1->insert($data);

			if($insert){
				die('Success');
			}else{
				die('Failed');
			}
		}

		function groupitemcategory_delete(){
			$id = $this->input->post('id');

			$delete = $this->msubcategory1->delete($id);

			if($delete){
				die('Success');
			}else{
				die('Failed');
			}
		}

		function groupitemcategory_view(){
			$id 	= $this->input->post('id');
			$url 	= $this->input->post('url');
			$type 	= $this->input->post('type');

			$get_catcategory = $this->mcategory->getAll()->result_array();
			$get_data = $this->msubcategory1->getByid($id)->row_array();

			if(count($get_data) > 0 ){
			    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

				$print = '
			            <div class="form-group">
			              <label for="vsubcategory1" class="form-control-label">Group Item Category</label>
			              <input type="text" class="form-control" id="vsubcategory1" name="vsubcategory1" value="'.$get_data['subcategory1'].'">
			              <input type="hidden" id="url" name="url" value="'.$url.'">
			              <input type="hidden" id="id" name="id" value="'.$id.'">
			            </div>  
			            <div class="form-group">
			              <label for="vcategory" class="form-control-label">Category</label>
			              <select class="form-control" name="vcategory" id="vcategory">
			              ';

			              foreach ($get_catcategory as $row){
			    		  if($row['id'] == $get_data['idcatcategory']){ $selected = 'selected'; }else{ $selected = '';}
			    $print .= '<option value="'.$row['id'].'" '.$selected.'>'.$row['namecategory'].'</option>';

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

		function groupitemcategory_edit(){
			$id = $this->input->post('id');

			$data = array(
							'subcategory1' => $this->input->post('subcategory1'),
							'idcatcategory'=> $this->input->post('category'),
						 );

			$check_id = $this->msubcategory1->getByid($id)->row_array();

			if(count($check_id) == 0){
				die('Failed');
			}else{
				$update = $this->msubcategory1->update($id,$data); 
				
				if($update){
					die('Success');
				}else{
					die('Failed');
				}
			}
		}

	/* ----------- location CATEGORY ----------- */

		public function locationcategory(){
			$username = $this->session->userdata(_PREFIX.'username');

			$data = array(
							'titlebar' 	=> 'Admin | Location Category',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'content'	=> 'admin/location/index',
							'modal'  	=> 'admin/location/modal',
							'title'		=> 'Location Category',
							'result'	=> $this->mlocation->getAll()->result_array(),
							'js'		=> ''
						 );

			$this->load->view('template/main',$data);
		}

		function locationcategory_add(){
			$publish = $this->input->post('status');

			/*if($status == '1'){
				$publish = '1';
			}else{
				$publish = '0';
			}*/

			$data = array(
							'namelocation' 	=> $this->input->post('namelocation'),
							'picturelocation' 	=> $this->input->post('picturelocation'),
							'statuslocation'	=> $this->input->post('status'),
						 );

			$insert = $this->mlocation->insert($data);

			if($insert){
				die('Success');
			}else{
				die('Failed');
			}
		}

		function locationcategory_delete(){
			$id = $this->input->post('id');

			$delete = $this->mlocation->delete($id);

			if($delete){
				die('Success');
			}else{
				die('Failed');
			}
		}

		function locationcategory_view(){
			$id 	= $this->input->post('id');
			$url 	= $this->input->post('url');
			$type 	= $this->input->post('type');

			$get_data = $this->mlocation->getByid($id)->row_array();

			if(count($get_data) > 0 ){
			    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}
			    if($get_data['statuslocation'] == '1'){ $checked = 'value="1" checked'; }else{ $checked = ''; }

				$print = '
			            <div class="form-group">
			              <label for="vnamelocation" class="form-control-label">location</label>
			              <input type="text" class="form-control" id="vnamelocation" name="vnamelocation" value="'.$get_data['namelocation'].'">
			              <input type="hidden" id="url" name="url" value="'.$url.'">
			              <input type="hidden" id="id" name="id" value="'.$id.'">
			            </div>
			            <div class="form-group">
			              <label for="vpicturelocation" class="form-control-label">Picture</label>
			              <div class="input-group">
				              <input type="text" class="form-control" id="vpicturelocation" name="vpicturelocation" value="'.$get_data['picturelocation'].'">
				              <div class="input-group-btn">
				                  <a class="btn btn-info iframe-btn" href="'.base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=vpicturelocation&akey='._AKEY).'" class="iframe-btn" title="File Manager">
				                  Browse
				                  </a>
				              </div>
				          </div>
			            </div>  
			            <div class="form-group">
			                <label>
			                    <input type="checkbox" id="vpublish" name="vpublish" class="minimal" '.$checked.'/>&nbsp;
			                    Publish
			                </label>
			            </div>            
						';

				die($print);
			}else{
				die('');
			}
		}

		function locationcategory_edit(){
			$id = $this->input->post('id');
			$publish = $this->input->post('status');

			/*if($status == '1'){
				$publish = '1';
			}else{
				$publish = '0';
			}*/

			$data = array(
							'namelocation' 	=> $this->input->post('namelocation'),
							'picturelocation' 	=> $this->input->post('picturelocation'),	
							'statuslocation'	=> $this->input->post('status'),					
						 );

			$check_id = $this->mlocation->getByid($id)->row_array();

			if(count($check_id) == 0){
				die('Failed');
			}else{
				$update = $this->mlocation->update($id,$data); 
				
				if($update){
					die('Success');
				}else{
					die('Failed');
				}
			}
		}

}
