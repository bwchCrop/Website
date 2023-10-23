<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

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
						'titlebar' 	=> 'Admin | Newsletter',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/newsletter/index',
						'modal'  	=> 'admin/newsletter/modal',
						'title'		=> 'Newsletter',
						'result'	=> $this->mnewsletter->getAllGroup()->result_array(),
						'js'		=> ''
					 );

		$this->load->view('template/main',$data);
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

	function export(){
		$data 		= $this->mnewsletter->getPublished()->result_array();
		$separator 	= ';';
		$fileName	= "NewsList_".date('dmY').'_'.date('His');
		$path		= 'export/'.$fileName.'.txt';
		$text		= '';
		if(count($data) > 0):
			foreach($data as $r):
				$text	.= $r['newsletter'].$separator.PHP_EOL;
			endforeach;
			
			$buka= fopen($path, "w");
			$kb= fwrite($buka, $text);
			$this->session->set_flashdata('message_', 
			'<div id="message" class="alert alert-success alert-dismissible">
	        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        	Success Export Newsletter !
	      	 </div>
	      	');
			die($fileName);
		else:
			die('Failed');
		endif;
	}

	function download($filename){
		$Pathfile = 'export/';
		$data = file_get_contents($Pathfile.$filename.'.txt');

		force_download($filename.'.txt',$data);

		redirect('admin-newsletter');
	}
}
