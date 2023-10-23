<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}
	}

	public function index(){
		$constant = getcwd().'/application/config/constants.php';

		$data = array(
						'content'  	=> 'admin/configuration/index',
						'modal'		=> 'admin/configuration/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | Configuration',
						'title'	   	=> 'Configuration',
						'result'   	=> '',//$this->mconfiguration->getAll()->result_array(),
						'js'		=> '',
						'lines'		=> file($constant),
					);

		$this->load->view('template/main', $data);
	}

	function edit(){
		$x = $this->marge->update_constants();

		if($x == 'true'){
			$this->session->set_flashdata('message', 
			'<div id="message" class="alert alert-success alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	Configuration Updated..
          	 </div>
          	');
			redirect('admin-configuration');
		}else{
			$this->session->set_flashdata('message', 
			'<div id="message" class="alert alert-danger alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	Update Configuration Failed..
          	 </div>
          	');
			redirect('admin-configuration');
		}
	}
}
