<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index(){
		$data = array(
						'content'  	=> 'admin/general',
						//'modal'		=> 'admin/menu/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | General Setting',
						'title'	   	=> 'General Setting'
						//'result'   	=> $this->mmenu->getAll()->result_array(),
						//'max_parent'=> $this->mmenu->getMaxParent(),
						//'js'		=> ''
					 );
		$this->load->view('template/main', $data);
	}

	function add(){

	}

	function view(){

	}

	function edit(){

	}

	function delete(){

	}

}
