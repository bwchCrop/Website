<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if($this->session->userdata(_PREFIX.'login') == TRUE){
			$data = array(
						'content'  	=> 'admin/home',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | Dashboard',
						'title'	   	=> '',
						'result'   	=> '',
						'js'		=> ''
					);
			$this->load->view('template/main', $data);
		}else{
			redirect('admin-log-in');
		}
	}
}
