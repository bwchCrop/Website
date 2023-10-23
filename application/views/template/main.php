<?php 

	$this->load->view('template/header');

	$this->load->view('template/menu');	

	$this->load->view($content);

	$this->load->view('template/footer');

	$this->load->view('template/foot_load');

	if(isset($modal)){
		$this->load->view($modal);
	}

	// $this->load->view('template/js');	
 ?>