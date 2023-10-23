<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

		$data = array(
						'titlebar' 	=> 'Admin | Manage User',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/user/index',
						'modal'  	=> 'template/modal',
						'title'		=> 'User',
						'result'	=> $this->muser->getAll()->result_array(),
						'js'		=> ''
					 );

		$this->load->view('template/main',$data);
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
			die('Success');
		}else{
			die('Failed');
		}
	}

	function view(){
		$id 	= $this->input->post('id');
		$url 	= $this->input->post('url');
		$type 	= $this->input->post('type');
		$role	= $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array();

		$get_data = $this->mpatient->getJoinByWhere("patient_userid = '$id'")->result_array();
		$get_user = $this->muser->getById($id)->row_array();

		if(count($get_data) > 0 ){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

			$print = '';

			$print .= '
						<div class="col-xs-12" style="float:none;">
							<style>h4{margin-top: 0px; margin-bottom: 20px;}</style>
							<table width="100%">
								<tr>
									<td>
										<label class="form-control-label">EMAIL USER</label>
										<h4>'.$get_user['emailaddress'].'</h4>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-xs-12" style="float:none;">
							<table class="table table-striped table-bordered" width="100%">
								<tr>
									<td>PATIENT</td>
									<td>BIRTHDAY</td>
									<td>AGE</td>
									<td>LAST DOCTOR VISIT</td>
									<td>ACTION</td>
								</tr>';

			if(count($get_data) > 0){
			foreach($get_data as $row){

			$getPatient = $this->mpatient->getTransByPatient($row['patient_id'],'transdate',1)->row_array();

			if(count($getPatient)>0){
				$lastvisit  = $getPatient['name'].'<br>'.date('d-m-Y',strtotime($getPatient['transdate']));
			}else{
				$lastvisit	= '-';
			}

			$print .= '
								<tr>
									<td>'.$row['patient_name'].'</td>
									<td>'.date('d-m-Y',strtotime($row['patient_birthday'])).'</td>
									<td>'.$this->marge->age($row['patient_birthday']).' Years</td>
									<td>'.$lastvisit.'</td>
									<td align="center">
				                        <a href="javascript:void(0);" onclick="view_list(\''.$row['patient_id'].'\',\''.base_url('view-patient').'\')" class="btn bg-green btn-xs edit" data-id="patient">
				                            <i class="fa fa-laptop"></i> View
				                        </a>
				                        &nbsp;';

										if($role['menudelete'] == '1'){
			$print .= '					<a href="javascript:void(0);" onclick="delete_list(\''.$row['patient_id'].'\',\''.base_url('delete-patient').'\')" class="btn bg-maroon btn-xs delete" data-id="patient">
											<i class="fa fa-trash-o"></i> Delete
										</a>';
										}

			$print .= '				</td>
								</tr>
					  ';

			}
			}else{
			$print .= '<tr><td colspan="3" align="center">Patient data not found</td></tr>';
			}

			$print .='		</table>
						</div>
			 		 ';

			die($print);
		}else{
			die('No Data Available.');
		}
	}

	function view_old(){
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
						'photo'		=> $this->input->post('photo')
					 );

		$check_id = $this->maccount->getByUsername($username)->row_array();

		if(count($check_id) == 0){
			die('Failed');
		}else{
			$update = $this->maccount->update($username,$data); 
			
			if($update){
				die('Success');
			}else{
				die('Failed');
			}
		}
	}

	function export(){

		$query 	  = "SELECT * FROM "._PREFIX."user ";
		$query   .= "WHERE 1=1 ";

		$getQuery = $this->db->query($query);
		$resQuery = $getQuery->result_array();

		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename='export_user.xls'");

		/*********** EXCEL TABLE HTML ***********/
		    $print = '';

		    $print .= '
		                <table border="1">
		                    <tr>
		                        <th>No.</th>
		                        <th>Name</th>
		                        <th>Email</th>
		                        <th>Phone</th>
		                        <th>Last Login</th>
		                        <th>Total Login</th>
		                    </tr>
		              ';

		    $n = 0;
		    foreach($resQuery as $row){ $n++;
			    $print .= '
			                    <tr>
			                        <td>'.$n.'</td>
			                        <td>'.$row['firstname'].'</td>
			                        <td>'.$row['emailaddress'].'</td>
			                        <td>'.$row['phone'].'</td>
			                        <td>'.$row['lastlogin'].'</td>
			                        <td>'.number_format($row['countlogin']).'</td>
			                    </tr>
			              ';
		    }

		    $print .= '     
		                </table>
		              ';

		    echo $print;
		/*********** EXCEL TABLE HTML ***********/

		// echo $query;
		// echo '<pre>';
		// print_r($resQuery);

		//redirect('admin-transaction');
	}
}