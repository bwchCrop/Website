<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller {

	function __construct() {
        parent::__construct();
		session_destroy();
    }

	public function index(){

		// $this->load->model('mprivacy');
		// $field = $this->mprivacy->getData('mom')->result_array();

		$data = array(
						'content' 	=> 'front/privacy/moms-diary',
						'title'	  	=> 'Brawijaya Hospital',
						'result' 	=> '',			
						'tab'		=> '',
			 		 );

		$this->load->view('front/template/main',$data);	
	}
}