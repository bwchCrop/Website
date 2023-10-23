<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}
	}

	public function index(){
		$data = array(
						'content'  	=> 'admin/patient/index',
						'modal'		=> 'template/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | Patient',
						'title'	   	=> 'Patient',
						'js'		=> '',
						'role'		=> $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array()
					);

		$where 		= _PREFIX.'menu.link = \''.$this->uri->segment(1).'\'';
		$checkMenu 	= $this->mmenu->getByWhere($where)->row_array();

		if($checkMenu['status'] == '2'){
			$data['result']   	= '';
			$data['content'] 	= 'admin/tempmenu';
			$data['idmenu']		= $checkMenu['id'];
			$data['tempstep'] 	= $checkMenu['tempstep'];
		}else{
			$data['result']   	= $this->mpatient->getJoinAll()->result_array();
		}

		$this->load->view('template/main', $data);
	}

	function view(){
		$id 	= $this->input->post('id');
		$url 	= $this->input->post('url');
		$type 	= $this->input->post('type');

		$get_data = $this->mpatient->getByid($id)->row_array();

		if(count($get_data) > 0 ){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

		    $getData = $this->mpatient->getJoinById($id)->row_array();

		    $totalvisit = $this->db->query("
		    								SELECT COUNT(idpatient) AS count_ FROM "._PREFIX."trans_patient 
											JOIN "._PREFIX."transaction ON "._PREFIX."transaction.idtrans = "._PREFIX."trans_patient.idtrans
											WHERE idpatient = '$id' AND YEAR(transdate) = '".date('Y')."'
										   ")->row_array();

			$print = '';

			$print .= '
						<div class="col-xs-12" style="float:none;">
							<style>h4{margin-top: 0px; margin-bottom: 20px;}</style>
							<table width="100%">
								<tr>
									<td width="50%">
										<label class="form-control-label">PATIENT</label>
										<h4>'.$getData['patient_name'].'</h4>
									</td>
									<td width="50%">
										<label class="form-control-label">REGISTERED BY USER</label>
										<h4>'.$getData['emailaddress'].'</h4>
									</td>
								</tr>
								<tr>
									<td>
										<label class="form-control-label">SEX</label>
										<h4>'.strtoupper($this->marge->sex($getData['patient_sex'])).'</h4>
									</td>
									<td>
										<label class="form-control-label">EMAIL</label>
										<h4>'.$getData['patient_email'].'</h4>
									</td>
								</tr>
								<tr>
									<td>
										<label class="form-control-label">BIRTHDAY</label>
										<h4>'.date('d-m-Y',strtotime($getData['patient_birthday'])).'</h4>
									</td>
									<td>
										<label class="form-control-label">AGE</label>
										<h4>'.$this->marge->age($getData['patient_birthday']).' years old</h4>
									</td>
								</tr>
								<tr>
									<td>
										<label class="form-control-label">MOST VISIT TO DOCTOR</label>
										<h4>-</h4>
									</td>
									<td>
										<label class="form-control-label">TOTAL VISIT</label>
										<h4>'.$totalvisit['count_'].' times in '.date('Y').'</h4>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-xs-12" style="float:none;">
							<table class="table table-striped table-bordered" width="100%">
								<tr>
									<td width="50%">DOCTOR VISIT</td>
									<td width="30%">SPECIALIZE</td>
									<td width="20%">DATE VISIT</td>
								</tr>';

		    $getHistory = $this->db->query("
		    								SELECT * FROM "._PREFIX."trans_patient 
											JOIN "._PREFIX."transaction ON "._PREFIX."transaction.idtrans = "._PREFIX."trans_patient.idtrans
											JOIN "._PREFIX."doctor ON "._PREFIX."doctor.iddoctor = "._PREFIX."transaction.iddoctor
											JOIN "._PREFIX."highlight ON "._PREFIX."highlight.highlight_id = "._PREFIX."transaction.transpoli
											WHERE idpatient = '$id'
										   ")->result_array();

			if(count($getHistory) > 0){
			foreach($getHistory as $row){
			$print .= '
								<tr>
									<td>'.$row['name'].'</td>
									<td>'.$row['highlight_title'].'</td>
									<td>'.date('d-m-Y',strtotime($row['transdate'])).'</td>
								</tr>
					 ';

			}
			}else{
			$print .= '<tr><td colspan="3" align="center">History not found</td></tr>';
			}

			$print .='		</table>
						</div>
			 		 ';

			die($print);
		}else{
			die('No Data Available.');
		}
	}

	function delete(){
		$id	= $this->input->post('id');

		$delete = $this->mpatient->delete($id);

		if($delete){
			$this->marge->record_activity('Delete Data Patient');
			die('Success');
		}else{
			die('Failed #01');
		}
	}

	function multiple_action(){
		$role = $this->input->post('role');
		$id   = $this->input->post('id');

		$n = 0;
		for($i=0;$i<count($id);$i++){
			$get_id = $id[$i];

			if($role == 'publish' || $role == 'unpublish'){
				if($role == 'publish'){
					$data = array( 'patient_status' => '1', 'patient_updateby' => $this->session->userdata(_PREFIX.'username'), 'patient_updatedate' => date('Y-m-d H:i:s'), );
				}else{
					$data = array( 'patient_status' => '0', 'patient_updateby' => $this->session->userdata(_PREFIX.'username'), 'patient_updatedate' => date('Y-m-d H:i:s'), );
				}

				$update = $this->mpatient->update($get_id,$data);
				if($update){
					$n++;
				}
			}elseif($role == 'delete'){
				$update = $this->mpatient->delete($get_id);
				if($update){
					$n++;
				}
			}
		}

		if($n == count($id)){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function load_filterExport(){
		$print = '';

		$print.= 
		'

        <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label class="form-control-label">Patient (Similar)</label>
                <input class="form-control" type="text" name="patient" id="patient" placeholder="Enter Patient Name">
              </div>
            </div>        	

            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label class="form-control-label">User (Similar)</label>
                <input class="form-control" type="text" name="user" id="user" placeholder="Enter User / Email">
              </div>
            </div>

            <div class="col-xs-12 col-sm-6">
	            <div class="form-group">
	                <label class="form-control-label">Sex</label>
	                <select class="form-control multiple-dropx" multiple="multiple" name="sex" id="sex">
	                  <option idclass="sex" value="1">Male</option>
	                  <option idclass="sex" value="0">Female</option>
	                </select>
	                <input type="hidden" name="valsex" id="valsex">
	            </div>
            </div>
        </div>		

		';

		echo $print;
	}

	function export(){
		$valPatient	= $this->input->post('patient');
		$valUser 	= $this->input->post('user');
		$valSex 	= $this->input->post('sex');

		$query 	  = "SELECT * FROM "._PREFIX."patient ";
		$query   .= "JOIN "._PREFIX."user ON "._PREFIX."user.id = "._PREFIX."patient.patient_userid ";
		$query   .= "WHERE 1=1 ";

		/* ===== USER ===== */
			if(isset($valUser) && $valUser != ''){
				$query .= "AND ("._PREFIX."user.firstname LIKE '%".$valUser."%' OR "._PREFIX."user.emailaddress LIKE '%".$valUser."%') ";
			}
		/* ===== USER ===== */

		/* ===== PATIENT ===== */
			if(isset($valPatient) && $valPatient != ''){
				$query .= "AND "._PREFIX."patient.patient_name LIKE '%".$valPatient."%' ";
			}
		/* ===== PATIENT ===== */

		/* ===== SEX ===== */
			if(isset($valSex) && $valSex != ''){
				$valSex = explode(',', $valSex);

				if(count($valSex) > 1){
					$query .= "AND (";

					for($i=0; $i<count($valSex); $i++){
						if($i == 0){
							$query .= _PREFIX."patient.patient_sex = '$valSex[$i]' ";
						}else{
							$query .= " OR "._PREFIX."patient.patient_sex = '$valSex[$i]' ";
						}
					}

					$query .= ") ";
				}else{
					$query .= "AND "._PREFIX."patient.patient_sex = '$valSex[0]' ";	
				}
			}
		/* ===== SEX ===== */


		$getQuery = $this->db->query($query);
		$resQuery = $getQuery->result_array();

		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename='export_patient.xls'");

		/*********** EXCEL TABLE HTML ***********/
		    $print = '';

		    $print .= '
		                <table border="1">
		                    <tr>
		                        <th>No.</th>
		                        <th>Patient</th>
		                        <th>Birthday</th>
		                        <th>Age</th>
		                        <th>Sex</th>
		                        <th>User</th>
		                        <th>Last Doctor Visit</th>
		                        <th>Total Visit</th>  
		                    </tr>
		              ';

		    $n = 0;
		    foreach($resQuery as $row){ $n++;

			    $sex = array('0' => 'Female', '1' => 'Male');
                $getPatient = $this->mpatient->getTransByPatient($row['patient_id'])->row_array();

                if(count($getPatient)){
                    $lastvisit  = $this->marge->date_ID($getPatient['transdate'],'d F Y');
                    $visit = $getPatient['name'].' - '.$lastvisit;                        
                }else{
                    $visit = '-';
                }

			    $totalvisit = $this->db->query("
			    								SELECT COUNT(idpatient) AS count_ FROM "._PREFIX."trans_patient 
												JOIN "._PREFIX."transaction ON "._PREFIX."transaction.idtrans = "._PREFIX."trans_patient.idtrans
												WHERE idpatient = '".$row['patient_id']."' AND YEAR(transdate) = '".date('Y')."'
											   ")->row_array();

			    $print .= '
			                    <tr>
			                        <td>'.$n.'</td>
			                        <td>'.$row['patient_name'].'</td>
			                        <td>'.$this->marge->date_ID($row['patient_birthday'],'d F Y').'</td>
			                        <td>'.$this->marge->age($row['patient_birthday']).' Years Old'.'</td>
			                        <td>'.$sex[$row['patient_sex']].'</td>
			                        <td>'.$row['emailaddress'].'</td>
			                        <td>'.$visit.'</td>                        
			                        <td>'.$totalvisit['count_'].'</td>
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

}/*END OF FILE*/
