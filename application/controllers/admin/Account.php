<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index(){
		$username = $this->session->userdata(_PREFIX.'username');
		$role     = $this->session->userdata(_PREFIX.'role');

		if($role != '0'){ $where = "id != '0'"; }else{ $where = 'id IS NOT NULL'; }

		$data = array(
				'titlebar' 	=> 'Admin | Manage User',
				'menu'		=> $this->mmenu->getParent()->result_array(),
				'content'	=> 'admin/account/index',
				'modal'  	=> 'admin/account/modal',
				'title'		=> 'Account',
				'result'	=> $this->maccount->getNonUserLogin($username, TRUE)->result_array(),
				'res_group' => $this->mgroupmenu->getAllGroup($where)->result_array(),
				'res_branch'=> $this->mhospital->getAll()->result_array(),
				'js'		=> ''
			);

		$this->load->view('template/main',$data);
	}

	function add(){
		$data = array(
						'username' 	=> $this->input->post('username'), 
						'name' 		=> $this->input->post('name'),
						'password'  => '',
						'email'		=> $this->input->post('email'),
						'role' 		=> $this->input->post('role'),
						'menurole'  => $this->input->post('menu'),
						'branch'  	=> $this->input->post('branch'),
						'photo'		=> $this->input->post('photo')
					 );

		$insert = $this->maccount->insert($data);

		if($insert){
			$username 		= $data['username'];
			$createpass 	= $data['username'].date('dmyhis');
			$newpass		= substr(md5($createpass),1,8);

			$data_update 	= array('password' => md5($newpass));

			$update_pass 	= $this->maccount->update($data['username'],$data_update);
			
			$message 		= 'Dear '.$data['name'].', '.
							  "<br>".
							  "<br>";
			$message 	   .= 'Akun baru anda berhasil dibuat berikut informasi account anda :'.
							  "<br> Username : <b>".$data['username']."</b>
							   <br> Password : <b>".$newpass."</b>".
							  "<br>".
							  "<br>";
			$message 	   .= 'Enjoy your stay here at '._PT."<br>";
			$message 	   .= 'Tim '._PT;

			$data =	array(
		 					'subject'	=> 'New Account - Akun '._PT,
		 					'from'		=> 'no-reply@'._DOMAIN.','._PT,
		 					'to'		=> $data['email'],
		 					'cc'		=> array(),
		 					'bcc'		=> array(),
		 					'message'	=> $message,
		 					'attach'	=> array(),
		  				 );

			$send = $this->marge->send_mail($data);
			//$this->send_email($data,'Create');

			if($send == 'true'){//if($this->email->send()){
				$this->marge->record_activity('Add Admin Account ID:'.$username);
				die('Success');
			}else{
				die('Failed Send Email, Check Your Check Connection..');
			}
		}else{
			die('Failed');
		}
	}

	function myaccount(){
		$username = $this->session->userdata(_PREFIX.'username');

		$data = array(
						'titlebar' 	=> 'Admin | My Account',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/myaccount',
						'title'		=> 'My Account',
						'result'	=> $this->maccount->getByUsername($username)->row_array(),
						'js'		=> $this->js_myaccount_password()
					 );

		$this->load->view('template/main',$data);
	}

	function change_password(){		
		$username = $this->session->userdata(_PREFIX.'username');
		$password = $this->input->post('retypepassword');

		$data = array('password' => md5($password) );

		$update = $this->maccount->update($username,$data);

		if($update){
			$this->marge->record_activity('Change Password');

			$message = "Password Changed..";

			$this->session->set_flashdata('message_', 
			'<div id="message" class="alert alert-success alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	'.$message.'
          	 </div>
          	');
		}else{
			$message = "Change Password Failed..";

			$this->session->set_flashdata('message_', 
			'<div id="message" class="alert alert-danger alert-dismissible">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	'.$message.'
          	 </div>
          	');
		}

		redirect('admin-account');
	}

	function check_password(){
		$username 	= $this->session->userdata(_PREFIX.'username');
		$data 		= $this->maccount->getByUsername($username)->row_array();
		$oldpassword= $data['password']; 
		$typepass   = $this->input->post('Pass');

		if($data['password'] == $typepass){
			die($data['password']);
		}else{
			die('');
		}
	}

	function update(){
		$username 	= $this->session->userdata(_PREFIX.'username');
		$name 		= $this->input->post('name');
		$email 		= $this->input->post('email');
		$photo 		= $this->input->post('photo');			

		$data = array(
						'name'		=> $name,
						'email'		=> $email,
						'photo'		=> $photo
					 );

		$update = $this->maccount->update($username,$data);

		if($update){
				$this->marge->record_activity('Update Account Info');

				$message = "Account Updated..";

				$this->session->set_flashdata('message', 
				'<div id="message" class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	'.$message.'
              	 </div>
              	');
		}else{
				$message = "Update Account Failed..";

				$this->session->set_flashdata('message', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	'.$message.'
              	 </div>
              	');
		}

		redirect('admin-account');
	}

	function delete(){
		$id = $this->input->post('id');

		$delete = $this->maccount->delete($id);

		if($delete){
			$this->marge->record_activity('Delete Account ID:'.$id);

			die('Success');
		}else{
			die('Failed');
		}
	}

	function view(){
		$id 	= $this->input->post('id');
		$url 	= $this->input->post('url');
		$type 	= $this->input->post('type');

		$get_account = $this->maccount->getByUsername($id)->row_array();

		if(count($get_account) > 0 ){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

			$print = '
		            <div class="form-group">
		              <label for="vusername" class="form-control-label">Username</label>
		              <input type="text" class="form-control" id="vusername" name="vusername" value="'.$get_account['username'].'" disabled="disabled">
		              <input type="hidden" id="url" name="url" value="'.$url.'">
		            </div>
		            <div class="form-group">
		              <label for="vname" class="form-control-label">Name</label>
		              <input type="text" class="form-control" id="vname" name="vname" value="'.$get_account['name'].'" '.$disabled.'>
		            </div>
		            <div class="form-group">
		              <label for="vemail" class="form-control-label">Email</label>
		              <input type="email" class="form-control" id="vemail" name="vemail" value="'.$get_account['email'].'" '.$disabled.'>
		            </div>
		            <div class="form-group">
		              <label for="vphoto" class="form-control-label">Photo</label>
              		  <div class="input-group">
			              <input type="text" class="form-control" id="vphoto" data-error=".result" name="vphoto" value="'.$get_account['photo'].'" '.$disabled.'>
		                  <div class="input-group-btn">
		                    <a class="btn btn-info iframe-btn" href="'.base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=vphoto&akey='._AKEY).'" class="iframe-btn" title="File Manager">
		                        Browse
		                    </a>
		                  </div>
		              </div>
		              <div class="result has-error"></div>
		            </div>
		            <div class="form-group">
		              <label for="vrole" class="form-control-label">Role</label>
		              <!--input type="text" class="form-control" id="vrole" name="vrole" -->
		              <select class="form-control" id="vrole" name="vrole" '.$disabled.'>
		            ';
		            if($get_account['role'] == '1'){ $sel1 = 'selected'; $sel2 = ''; }else{ $sel1 = ''; $sel2 = 'selected'; }

		    $print .= '
		                  <option value=""></option>
		                  <option value="1" '.$sel1.'>Admin</option>
		                  <option value="2" '.$sel2.'>User</option>
		              </select>
		            </div>
		            <div class="form-group">
		              <label for="vmenu" class="form-control-label">Group Menu</label>
		              <!--input type="text" class="form-control" id="vmenu" name="vmenu" -->
		              <select class="form-control" id="vmenu" name="vmenu" '.$disabled.'>
		                  	<option value=""></option>
		            ';
		            $res_group = $this->mgroupmenu->getAllGroup()->result_array();

		            foreach($res_group as $row){ 
		            if($get_account['menurole'] == $row['id']){ $selected = "selected";}else{ $selected = '';}
		    $print .= '
		    				<option value="'.$row['id'].'" '.$selected.'>'.$row['groupname'].'</option>
		    		  ';
		            }

		    $print .= '
		              </select>
		            </div>            
					';

			die($print);
		}else{
			die('');
		}
	}

	function edit(){
		$username = $this->input->post('username');

		$data = array(
						'name' 		=> $this->input->post('name'),
						'email'		=> $this->input->post('email'),
						'role' 		=> $this->input->post('role'),
						'menurole'  => $this->input->post('menu'),
						'branch'  	=> $this->input->post('branch'),
						'photo'		=> $this->input->post('photo')
					 );

		$check_id = $this->maccount->getByUsername($username)->row_array();

		if(count($check_id) == 0){
			die('Failed');
		}else{
			$update = $this->maccount->update($username,$data); 
			
			if($update){
				$this->marge->record_activity('Edit Account ID:'.$username);

				die('Success');
			}else{
				die('Failed');
			}
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

		$createpass 	= $data['username'].date('dmyhis');
		$newpass		= substr(md5($createpass),1,8);

		$data_update 	= array('password' => md5($newpass));

		$update_pass 	= $this->maccount->update($data['username'],$data_update);
		$message 		= 'Dear '.$data['name'].', '.
						  "<br>".
						  "<br>";
		$message 	   .= 'Akun baru anda berhasil dibuat berikut informasi account anda :'.
						  "<br> Username : <b>".$data['username']."</b>
						   <br> Password : <b>".$newpass."</b>".
						  "<br>".
						  "<br>";
		$message 	   .= 'Enjoy your stay here at '._PT."<br>";
		$message 	   .= 'Tim '._PT;      

        $ci->email->subject('New Account - Akun '._PT);

        $list = array($data['email']);
        $ci->email->to($list);
        $ci->email->message($message);
	}

	function js_myaccount_password(){
		$js = 
				"<script>
					$(function() {
				        var x_timer;    
		                $(\"input[name=newpassword]\").attr('disabled',true);
		                $(\"input[name=retypepassword]\").attr('disabled',true);
		                $(\"#btn-change\").attr('disabled',true);
						$('.overlay').hide();

				        $(\"input[name=oldpassword]\").keyup(function (e){
				            clearTimeout(x_timer);
				            var Pass_old = $(this).val();
				            var Pass = $.md5(Pass_old);
				            x_timer = setTimeout(function(){
				                check_Pass_ajax(Pass);
				            }, 500);    	
				        }); 

				        function check_Pass_ajax(Pass){
							$('.overlay').show();

				            $.post('".base_url('check-password')."',{
				            	'Pass':Pass}, 
				            	function(data) {
									$('.overlay').hide();
					            	if(data==''){
										$(\"input[name=oldpassword]\").parents(\".has-success\").removeClass(\"has-success\"); 
										$(\"input[name=oldpassword]\").parents(\"div.form-group\").addClass(\"has-error\"); 
		
						                $(\"#btn-change\").attr('disabled',true);
						                $(\"input[name=newpassword]\").attr('disabled',true);
						                $(\"input[name=retypepassword]\").attr('disabled',true);
					            	}else{
										$(\"input[name=oldpassword]\").parents(\".has-error\").removeClass(\"has-error\"); 
										$(\"input[name=oldpassword]\").parents(\"div.form-group\").addClass(\"has-success\"); 

						                $(\"#btn-change\").removeAttr('disabled');
						                $(\"input[name=newpassword]\").removeAttr('disabled');
						                $(\"input[name=retypepassword]\").removeAttr('disabled');
										$('input[name=newpassword]').focus();
						            }
				            });
				        }

						$(\"form[name='myaccount-password']\").validate({
							debug: true,
							errorClass:'help-block',
							validClass:'help-block',
							errorElement:'span',
							highlight: function (element, errorClass, validClass) { 
								$(element).parents(\".has-success\").removeClass(\"has-success\"); 
								$(element).parents(\"div.form-group.val\").addClass(\"has-error\"); 

							}, 
							unhighlight: function (element, errorClass, validClass) { 
								$(element).parents(\".has-error\").removeClass(\"has-error\"); 
								$(element).parents(\"div.form-group.val\").addClass(\"has-success\"); 
							},
							rules: {
								newpassword: {
									required: true,
									minlength: 5
								},
								retypepassword: {
									required: true,
									equalTo: newpassword
								}
							},
							messages: {
								newpassword: {
									required: \"Please provide a password\",
									minlength: \"Your password must be at least 5 characters long\"
								},
								retypepassword: {
									required: \"Please provide a password\",
									minlength: \"Your password must be at least 5 characters long\"
								}
							},
							submitHandler: function(form) {
								form.submit();
							}
						});


						$(\"form[name='myaccount-info']\").validate({
							debug: true,
							errorClass:'help-block',
							validClass:'help-block',
							errorElement:'span',
							highlight: function (element, errorClass, validClass) { 
								$(element).parents(\"div.form-group\").addClass(\"has-error\"); 

							}, 
							unhighlight: function (element, errorClass, validClass) { 
								$(element).parents(\".has-error\").removeClass(\"has-error\"); 
							},
							rules: {
								name: {
									required: true,
								},
								email: {
									required: true,
									email: true
								}
							},
							messages: {
								name: {
									required: \"Please provide a name\",
								},
								email: {
									required: \"Please provide an email\",
									email: \"Wrong Email Address\"
								}
							},
							submitHandler: function(form) {
								form.submit();
							}
						});

					});
				</script>";

		return $js;
	}
}
