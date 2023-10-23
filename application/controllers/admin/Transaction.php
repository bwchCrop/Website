<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}
	
	public function index(){
		$username = $this->session->userdata(_PREFIX.'username');

		$data = array(
						'titlebar' 	=> 'Admin | Transaction',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/transaction/index',
						'modal'  	=> 'admin/transaction/modal',
						'title'		=> 'Transaction',
						'result'	=> $this->mtransaction->getJoinAll('DESC')->result_array(),
						'js'		=> ''
					 );

		$this->load->view('template/main',$data);
	}

	function add(){
		$data = array(
						'title' 	=> $this->input->post('name')
					 );

		$insert = $this->mcategory->insert($data);

		if($insert){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function delete(){
		$id = $this->input->post('id');

		$delete = $this->mcategory->delete($id);

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
		$print  = '';

		$get_data = $this->mtransaction->getJoinByTrans($id)->row_array();

		$getTransPatient = $this->mtransaction->getJoinByTransPatientId(_PREFIX.'transaction.idtrans',$id)->result_array();

		$query = $this->db->last_query();
		if(count($get_data) > 0 ){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

			$print .= '
					  <div class="row product-2">
					    <h4>Trans. ID    '.$get_data['idtrans'].'</h4>
					    <h4>Visit. Date  '.$get_data['transdate'].'</h4>
					    <h4>Trans. User  '.$get_data['emailaddress'].'</h4>
					    <h3>'.$get_data['name'].'</h3>
					    <h4>Specialist  '.$this->marge->capital($get_data['highlight_title']).' - '.$get_data['namehospital'].' ( '.date('H:i',strtotime($get_data['starttime'])).' - '.date('H:i',strtotime($get_data['endtime'])).' )</h4><br><br>
					    <table class="table table-bordered table-striped" width="100%">
					    	<thead>
					    		<tr>
					    			<td>Patient Name</td>
					    			<td>Birthday</td>
					    			<td>Age</td>
					    			<td>Sex</td>
					    		</tr>
					    	</thead>
					    	<tbody>
					  ';

			foreach($getTransPatient as $row){

		    $print .= '<tr>
		    			<td>'.$row['patient_name'].'</td>
		    			<td>'.$this->marge->date_ID('d F Y',$row['patient_birthday']).'</td>
		    			<td>'.$this->marge->age($row['patient_birthday']).' Years Old</td>
		    			<td>'.$this->marge->sex($row['patient_sex']).'</td>
		    		  </tr>';

		  	}

			$print .= '   	</tbody>
					    </table>
					  </div>
					 ';
			die($print);
		}else{
			die('');
		}
	}

	function edit(){
		$id = $this->input->post('id');

		$data = array(
						'title' => $this->input->post('name')
					 );

		$check_id = $this->mcategory->getByid($id)->row_array();

		if(count($check_id) == 0){
			die('Failed');
		}else{
			$update = $this->mcategory->update($id,$data); 
			
			if($update){
				die('Success');
			}else{
				die('Failed');
			}
		}
	}

	function export(){
		$valDoctor 		= $this->input->post('doctor');
		$valSpeciality 	= $this->input->post('valSpeciality');
		$valLocation 	= $this->input->post('valLocation');
		$valBranch 		= $this->input->post('valBranch');
		$valDay 		= $this->input->post('valDay');
		$valTime 		= $this->input->post('valTime');

		$query 	  = "SELECT * FROM "._PREFIX."transaction ";
		$query   .= "JOIN "._PREFIX."doctor_schedule ON "._PREFIX."doctor_schedule.idschedule = "._PREFIX."transaction.transschedule ";
		$query   .= "JOIN "._PREFIX."hospital ON "._PREFIX."hospital.idhospital = "._PREFIX."doctor_schedule.idhospital ";
		$query   .= "JOIN "._PREFIX."doctor ON "._PREFIX."doctor.iddoctor = "._PREFIX."doctor_schedule.iddoctor ";
		$query   .= "JOIN "._PREFIX."doctor_highlight ON "._PREFIX."doctor_highlight.doctor_highlight_iddoctor = "._PREFIX."doctor.iddoctor ";
		$query   .= "JOIN "._PREFIX."highlight ON "._PREFIX."highlight.highlight_id = "._PREFIX."doctor_highlight.doctor_highlight_idhighlight ";
		$query   .= "WHERE 1=1 ";

		/* ===== DOCTOR ===== */
			if(isset($valDoctor) && $valDoctor != ''){
				$query .= "AND "._PREFIX."doctor.name LIKE '%".$valDoctor."%' ";
			}
		/* ===== DOCTOR ===== */


		/* ===== SPECIALITY ===== */
			if(isset($valSpeciality) && $valSpeciality != ''){
				$valSpeciality = explode(',', $valSpeciality);

				if(count($valSpeciality) > 1){
					$query .= "AND (";

					for($i=0; $i<count($valSpeciality); $i++){
						if($i == 0){
							$query .= _PREFIX."highlight.highlight_id = '$valSpeciality[$i]' ";
						}else{
							$query .= " OR "._PREFIX."highlight.highlight_id = '$valSpeciality[$i]' ";
						}
					}

					$query .= ") ";
				}else{
					$query .= "AND "._PREFIX."highlight.highlight_id = '$valSpeciality[0]' ";	
				}
			}
		/* ===== SPECIALITY ===== */


		/* ===== BRANCH/LOCATION ===== */
			if(isset($valBranch) && $valBranch != ''){
				$valBranch = explode(',', $valBranch);

				if(count($valBranch) > 1){
					$query .= "AND (";

					for($i=0; $i<count($valBranch); $i++){
						if($i == 0){
							$query .= _PREFIX."hospital.idhospital = '$valBranch[$i]' ";
						}else{
							$query .= " OR "._PREFIX."hospital.idhospital = '$valBranch[$i]' ";
						}
					}

					$query .= ") ";
				}else{
					$query .= "AND "._PREFIX."hospital.idhospital = '$valBranch[0]' ";	
				}
			}else{

				//LOCATION

				if(isset($valLocation) && $valLocation != ''){
					$valLocation = explode(',', $valLocation);

					if(count($valLocation) > 1){
						$query .= "AND (";

						for($i=0; $i<count($valLocation); $i++){
							if($i == 0){
								$query .= _PREFIX."hospital.location = '$valLocation[$i]' ";
							}else{
								$query .= " OR "._PREFIX."hospital.location = '$valLocation[$i]' ";
							}
						}

						$query .= ") ";
					}else{
						$query .= "AND "._PREFIX."hospital.location = '$valLocation[0]' ";	
					}
				}
			}
		/* ===== BRANCH/LOCATION ===== */


		/* ===== DAY ===== */
			if(isset($valDay) && $valDay != ''){
				$valDay = explode(',', $valDay);

				if(count($valDay) > 1){
					$query .= "AND (";

					for($i=0; $i<count($valDay); $i++){
						if($i == 0){
							$query .= _PREFIX."doctor_schedule.idday = '$valDay[$i]' ";
						}else{
							$query .= " OR "._PREFIX."doctor_schedule.idday = '$valDay[$i]' ";
						}
					}

					$query .= ") ";
				}else{
					$query .= "AND "._PREFIX."doctor_schedule.idday = '$valDay[0]' ";	
				}
			}
		/* ===== DAY ===== */


		/* ===== TIME ===== */
			if(isset($valTime) && $valTime != ''){
				$valTime = explode(',', $valTime);

				if(count($valTime) > 1){
					$query .= "AND ( ";

					for($i=0; $i<count($valTime); $i++){

						switch ($valTime[$i]) {
							case '1':
								$Time = 'starttime <= \'11:59:00\'';			
								break;
							case '2':
								$Time = 'starttime <= \'16:59:00\' AND endtime >= \'12:00:00\'';			
								break;	
							default:
								$Time = 'starttime <= \'21:00:00\' AND endtime >= \'17:00:00\'';			
								break;
						}

						if($i == 0){
							$query .= "(".$Time.") ";
						}else{
							$query .= "OR "."(".$Time.") ";
						}
					}

					$query .= ") ";
				}else{
					switch ($valTime[0]) {
						case '1':
							$Time = 'starttime <= \'11:59:00\'';			
							break;
						case '2':
							$Time = 'starttime <= \'16:59:00\' AND endtime >= \'12:00:00\'';			
							break;	
						default:
							$Time = 'starttime <= \'21:00:00\' AND endtime >= \'17:00:00\'';			
							break;
					}

					$query .= "AND (".$Time.") ";	
				}
			}
		/* ===== TIME ===== */

		$getQuery = $this->db->query($query);
		$resQuery = $getQuery->result_array();

		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename='export_transaction.xls'");

		/*********** EXCEL TABLE HTML ***********/
		    $print = '';

		    $print .= '
		                <table border="1">
		                    <tr>
		                        <th>ID.</th>
		                        <th>Trans. Date</th>
		                        <th>User</th>
		                        <th>Doctor</th>
		                        <th>Clinic</th>
		                        <th>Specialist</th>
		                        <th>Time</th>  
		                        <th>Day</th>
		                    </tr>
		              ';

		    foreach($resQuery as $row){

		    $print .= '
		                    <tr>
		                        <td>'.$row['idtrans'].'</td>
		                        <td>'.$this->marge->date_ID($row['transdate'],'d F Y').'</td>
		                        <td>'.$row['email'].'</td>
		                        <td>'.$row['name'].'</td>
		                        <td>'.$row['namehospital'].'</td>
		                        <td>'.$row['highlight_title'].'</td>
		                        <td>'.$row['starttime'].' - '.$row['endtime'].'</td>                        
		                        <td>'.$row['day'].'</td>
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
