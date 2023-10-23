<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personalise extends CI_Controller {

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
						'titlebar' 			=> 'Admin | Personalise',
						'menu'				=> $this->mmenu->getParent()->result_array(),
						'content'			=> 'admin/personalise/index',
						'modal'  			=> 'admin/personalise/modal',
						'title'				=> 'Personalise',
						'result_home'		=> $this->mpost->getJoinBy('post.idcategory','7')->result_array(),
						'result_about'		=> $this->mpost->getJoinBy('post.idcategory','8')->result_array(),
						'result_location'	=> $this->mpost->getJoinBy('post.idcategory','9')->result_array(),
						'result_service'	=> $this->mpost->getJoinBy('post.idcategory','10')->result_array(),
						'result_schedule'	=> $this->mpost->getJoinBy('post.idcategory','11')->result_array(),
						'result_special'	=> $this->mpost->getJoinBy('post.idcategory','12')->result_array(),
						'result_membership'	=> $this->mpost->getJoinBy('post.idcategory','13')->result_array(),
						'result_newsevent'	=> $this->mpost->getJoinBy('post.idcategory','14')->result_array(),
						'result_ig_feed'	=> $this->mpost->getJoinBy('post.idcategory','15')->result_array(),
						'js'				=> ''
					 );

		$this->load->view('template/main',$data);
	}

	function save(){
		for($x=7;$x<=15;$x++){
            switch ($x) {
                case '7' : $slug = 'home';          		break;
                case '8' : $slug = 'about_vision_mission';  break;
                case '9' : $slug = 'location';   	  		break;
                case '10': $slug = 'services';    	  		break;
                case '11': $slug = 'doctor_schedule'; 		break;
                case '12': $slug = 'special_offer';   		break;
                case '13': $slug = 'membership'; 	  		break;
                case '14': $slug = 'newsevent';  	  		break;
                case '15': $slug = 'ig_feed';  	  		break;
                default  : $slug = ''; break;
            }

			$counter 		= $this->input->post('slide-'.$x.'-counter');

			$this->mpost->deleteBy('post.idcategory',$x);
			for($i=1; $i<=$counter; $i++){
				$field 		= $this->input->post('slide-'.$x.'-'.$i);
				$fieldurl 	= $this->input->post('slideurl-'.$x.'-'.$i);
				$fielddate 	= $this->input->post('slidedate-'.$x.'-'.$i);
				$fieldsort 	= $this->input->post('slideorder-'.$x.'-'.$i);
				$data = array(
								'idcategory' 	=> $x,
								'title'			=> $title.' '.$x.'-'.$i,
								'slug'			=> $slug,
								'image'			=> $field,
								'attach'		=> (trim($fieldurl) == '')?NULL:$fieldurl,
								'status'		=> '1',
								'user'			=> $this->session->userdata(_PREFIX.'username'),
							 	'date'			=> $fielddate,
								'sort'			=> $fieldsort ? $fieldsort : 0
							 );
				if(isset($field) OR !empty($field)){
					$insert = $this->mpost->insert($data);
				}
			}
		}

		$this->session->set_flashdata('message_', 
		'<div class="row" style="padding: auto 15px;">
			 <div id="message" class="alert alert-success alert-dismissible">
	        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        	Personalise Saved..
	      	 </div>
      	 </div>
      	');

		redirect('admin-personalise');
	}

	function delete(){
		$id = $this->input->post('id');

		$delete = $this->mcategory->delete($id);

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

		$get_data = $this->mfeedback->getByid($id)->row_array();

		if(count($get_data) > 0 ){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

			$print = '
		            <div class="form-group">
		              <label for="vsubject" class="form-control-label">Subject</label>
		              <input type="text" class="form-control" id="vsubject" name="vsubject" value="'.$get_data['subject'].'">
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

}
