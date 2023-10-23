<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		if($this->session->userdata(_PREFIX.'login') != TRUE){
			$username = $this->session->userdata(_PREFIX.'username');
			if(isset($username)){
				$data = array(
								'titlebar' => 'Admin | Lockscreen'
							 );

				$this->load->view('admin/lock',$data);
			}else{
				$data = array(
								'titlebar' => 'Admin | Login'
							 );

				$this->load->view('admin/login',$data);
			}
		}else{
			redirect('admin');
		}
	}

	function do_login(){
		$id 		= $this->input->post('username');		
		$password 	= md5($this->input->post('password'));

		$check_user  = $this->maccount->getByUsername($id)->row_array();
		$check_email = $this->maccount->getByEmail($id)->row_array();

		
		if(count($check_user)>0 || count($check_email)>0){

			if(count($check_user)>0){
				$type = 'username'; 
			}

			if(count($check_email)>0){
				$type = 'email';
			}

			$check_pass = $this->maccount->getByPass($type,$id,$password)->row_array();
			if(count($check_pass)>0){

				//$this->session->destroy();
				$this->session->set_userdata(_PREFIX.'login',TRUE);
				$this->session->set_userdata(_PREFIX.'username',$check_pass['username']);
				$this->session->set_userdata(_PREFIX.'name',$check_pass['name']);
				$this->session->set_userdata(_PREFIX.'email',$check_pass['email']);
				$this->session->set_userdata(_PREFIX.'photo',$check_pass['photo']);
				$this->session->set_userdata(_PREFIX.'role',$check_pass['role']);
				$this->session->set_userdata(_PREFIX.'menurole',$check_pass['menurole']);
				$this->session->set_userdata(_PREFIX.'branch',$check_pass['branch']);
				$this->session->set_userdata('akey',_AKEY);

				if($check_pass['role'] == '2'){
					$message = "Login hanya untuk Admin..";
					$this->session->set_flashdata('message', 
					'<div id="message" class="alert alert-danger alert-dismissible">
	                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                	'.$message.'
	              	 </div>
	              	');

					$this->do_logout();
				}else{
					$this->marge->record_activity('Login');
				}

				$lasturl = $this->session->userdata(_PREFIX.'lasturl');

				if(isset($lasturl) && $lasturl != ''){
					redirect($lasturl);
				}else{
					redirect('admin');
				}
			}else{
				$message = "Password Salah, Silahkan Cek Password..";

				$this->session->set_flashdata('message', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	'.$message.'
              	 </div>
              	');

				redirect('admin-log-in');
			}

		}else{
			$message = "Username Salah/Belum tedaftar, Silahkan Cek Username..";

			$this->session->set_flashdata('message', 
			'<div id="message" class="alert alert-danger alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	'.$message.'
          	 </div>
          	');

			redirect('admin-log-in');
		}
	}

	function do_logout(){
		$this->marge->record_activity('Logout');

		$this->session->unset_userdata(_PREFIX.'login');
		$this->session->unset_userdata(_PREFIX.'username');
		$this->session->unset_userdata(_PREFIX.'name');
		$this->session->unset_userdata(_PREFIX.'email');
		$this->session->unset_userdata(_PREFIX.'photo');
		$this->session->unset_userdata(_PREFIX.'role');
		$this->session->unset_userdata(_PREFIX.'menurole');
		$this->session->unset_userdata(_PREFIX.'branch');
		$this->session->unset_userdata(_PREFIX.'lasturl');
		$this->session->unset_userdata('akey');
		$this->session->sess_destroy();

		redirect('admin-log-in');
		/*
		echo '<pre>';
		print_r($this->session->all_userdata());
		*/
	}

	function do_logoff($activity = 'logoff'){
		$this->marge->record_activity($activity);

		$this->session->unset_userdata(_PREFIX.'login');
		$this->session->unset_userdata(_PREFIX.'email');
		$this->session->unset_userdata(_PREFIX.'role');
		$this->session->unset_userdata(_PREFIX.'menurole');
		$this->session->unset_userdata(_PREFIX.'branch');
		$this->session->unset_userdata('akey');

		redirect('admin-log-in');
	}

	function forgot_password(){
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$data = array(
							'titlebar' => 'Admin | Forgot Password'
						 );

			$this->load->view('admin/forgot',$data);
		}else{
			redirect('admin');
		}
	}

	function do_forgot(){
		$id 		= $this->input->post('username');		

		$check_user  = $this->maccount->getByUsername($id)->row_array();
		$check_email = $this->maccount->getByEmail($id)->row_array();

		if(count($check_user)>0 || count($check_email)>0){

			if(count($check_user)>0){
				$data = $check_user;
				$type = 'username'; 
			}

			if(count($check_email)>0){
				$data = $check_email;
				$type = 'email';
			}

			$this->send_email($data,'confirmation');

			if($this->email->send()){
				$this->marge->record_activity('Forgot Password',$data['username']);

				$message = "Success Sending Email, Check Your Email..";

				$this->session->set_flashdata('message', 
				'<div id="message" class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	'.$message.'
              	 </div>
              	');

				redirect('admin-forgot-password');
			}else{
				$message = "Failed Sending Email, Check Connection..";

				$this->session->set_flashdata('message', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	'.$message.'
              	 </div>
              	');

				redirect('admin-forgot-password');
			}

		}else{
			$message = "Username Salah/Belum tedaftar, Silahkan Cek Username..";

			$this->session->set_flashdata('message', 
			'<div id="message" class="alert alert-danger alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	'.$message.'
          	 </div>
          	');

			redirect('admin-forgot-password');
		}
	}

	function send_password($id){
		$data = $this->maccount->getByUsername($id)->row_array();

		$this->send_email($data,'send-password');

		if($this->email->send()){
			$this->marge->record_activity('Reset Password',$data['username']);

			$message = "Success Sending Email, Check Your Email..";

			$this->session->set_flashdata('message', 
			'<div id="message" class="alert alert-success alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	'.$message.'
          	 </div>
          	');

			redirect('admin-log-in');
		}else{
			$message = "Failed Sending Email, Check Connection..";

			$this->session->set_flashdata('message', 
			'<div id="message" class="alert alert-danger alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	'.$message.'
          	 </div>
          	');

			redirect('admin-log-in');
		}
	}

	function send_email($data,$type){
        $ci = get_instance();
        $ci->load->library('email');
        //$config['protocol'] = "smtp";
        //$config['smtp_host'] = "ssl://smtp.gmail.com";
        //$config['smtp_port'] = "465";
        //$config['smtp_user'] = _USEREMAIL;
        //$config['smtp_pass'] = _EMAILPASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);
        $ci->email->from('no-reply@'._DOMAIN , _PT);

		if($type == 'confirmation'){
	        $link = base_url().'admin-send-password/'.$data['username']; # Diganti link sekali pake
			$message = 'Dear '.$data['name'].', '."<br>"."<br>";
			$message .= 'Untuk konfirmasi reset password, silahkan klik link berikut.'."<br>"."<br>";
			$message .= anchor($link, 'Klik Disini Untuk Reset Password', '')."<br>"."<br>";
			$message .= 'Enjoy your stay here at '._PT."<br>";
			$message .= 'Tim '._PT;        
	        $ci->email->subject('Reset Password Akun '._PT);
		}else{
			$createpass = $data['username'].date('dmyhis');
			$newpass	= substr(md5($createpass),1,8);

			$data_update = array('password' => md5($newpass));

			$update_pass = $this->maccount->update($data['username'],$data_update);
	        //$link = base_url().'admin-send-password';
			$message = 'Dear '.$data['name'].', '."<br>"."<br>";
			$message .= 'Anda telah melakukan reset password, berikut adalah password baru anda '."<b>".$newpass."</b>".' .'."<br>"."<br>";
			$message .= 'Enjoy your stay here at '._PT."<br>";
			$message .= 'Tim '._PT;        
	        $ci->email->subject('New Password Akun '._PT);
		}

        $list = array($data['email']);
        $ci->email->to($list);
        $ci->email->message($message);
	}
}
