<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$link = base_url();

		$email_content = '
							<p>Silahkan melakukan aktivasi User Account '._PT.' dengan klik tautan berikut</p>

							<p>	
								<br/>
								<a class="button" href="'.$link.'"> Klik Disini </a>
								<br/>
							</p>	
						 ';

        $data_html = array( 
        					'title'=> 'TEST',
        					'name' => 'Deny',
        					'email_content' => $email_content,
        				  );

		$this->load->view('front/template/responsive_email',$data_html);
	}
}
