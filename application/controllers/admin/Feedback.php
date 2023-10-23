<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

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
						'titlebar' 	=> 'Admin | Feedback',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/feedback/index',
						'modal'  	=> 'admin/feedback/modal',
						'title'		=> 'Feedback',
						'result'	=> $this->mfeedback->getAll()->result_array(),
						'js'		=> ''
					 );

		$this->load->view('template/main',$data);
	}

	function add(){
		$data = array(
						'title' 	=> $this->input->post('name')
					 );

		$insert = $this->mcategory->insert($data);

		if($insert){
			die('Success');
		}else{
			die('Failed');
		}
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
		              <input type="text" class="form-control" id="vsubject" name="vsubject" value="'.$get_data['subject'].'" disabled="disabled">
		              <input type="hidden" id="url" name="url" value="'.$url.'">
		              <input type="hidden" id="id" name="id" value="'.$id.'">
		            </div> 
		            <div class="form-group">
		              <label for="vmessage" class="form-control-label">Message</label>
		              <textarea class="form-control" id="vmessage" name="vmessage" disabled="disabled">'.$get_data['message'].'</textarea>
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
