<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index(){
		if(isset($_POST['type'])){
		// if(isset($_GET['type'])){
			// $type = $_GET['type'];
			$type = $this->input->post('type');

			if($type == 'new')
			{	
				$data = array(
								'title' 		=> $this->input->post('title'),
								'startdate' 	=> $this->input->post('startdate'),
								'enddate'	 	=> $this->input->post('startdate'),
								'allDay' 		=> $this->input->post('all_day'),
								'backcolor' 	=> $this->input->post('backcolor'),
								'bordercolor' 	=> $this->input->post('bordercolor')
							 );

				$insert = $this->mcalendar->insert($data);

				$lastid = $this->db->insert_id();

				$this->marge->record_activity('Add Calendar Event');
				echo json_encode(array('status'=>'success','eventid'=>$lastid));
			}

			if($type == 'changetitle')
			{
				$eventid 	= $this->input->post('eventid');
				$data = array(
								'title' => $this->input->post('title')
							 );

				$update = $this->mcalendar->update($eventid,$data);

				if($update){
					$this->marge->record_activity('Edit Calendar Event');
					echo json_encode(array('status'=>'success'));
				}else{
					echo json_encode(array('status'=>'failed'));
				}
			}

			if($type == 'resetdate')
			{
				$eventid 	= $this->input->post('eventid');

				$start = date('H:i:s',strtotime($this->input->post('start')));
				$end   = date('H:i:s',strtotime($this->input->post('end')));

				if($start == '00:00:00' && $end == '00:00:00'){
					$allday = 'true';
				}else{
					$allday = 'false';
				}

				$data = array(
								'title' 	=> $this->input->post('title'),
								'startdate' => $this->input->post('start'),
								'enddate' 	=> $this->input->post('end'),
								'allDay'	=> $allday,
							 );

				$update = $this->mcalendar->update($eventid,$data);
				
				if($update){
					$this->marge->record_activity('Reset Date Calendar Event');
					echo json_encode(array('status'=>'success'));
				}else{
					echo json_encode(array('status'=>'failed'));
				}
			}

			if($type == 'remove')
			{
				$eventid = $this->input->post('eventid');

				$delete  = $this->mcalendar->delete($eventid);

				if($delete){
					$this->marge->record_activity('Remove Calendar Event');
					echo json_encode(array('status'=>'success'));
				}else{
					echo json_encode(array('status'=>'failed'));
				}
			}

			if($type == 'fetch')
			{
				$events = array();

				$query = $this->mcalendar->getAll()->result_array();

				foreach($query as $fetch)
				{
					$e = array();
				    $e['id'] 				= $fetch['id'];
				    $e['title'] 			= $fetch['title'];
				    $e['start'] 			= $fetch['startdate'];
				    $e['end'] 				= $fetch['enddate'];
					$e['backgroundColor'] 	= $fetch['backcolor'];
					$e['borderColor'] 		= $fetch['bordercolor'];

				    $allday = ($fetch['allDay'] == "true") ? true : false;
				    $e['allDay'] = $allday;

				    array_push($events, $e);
				}

				$query_trans = "
								SELECT transdate,waktu,COUNT(transdate) AS count FROM bwch_transaction a
								JOIN 
								(
								SELECT 
								idschedule,starttime,endtime,
								CASE 
									WHEN starttime > '07:59:59' AND endtime < '11:59:59' THEN 'PAGI'
									WHEN starttime > '11:59:59' AND endtime < '16:59:59' THEN 'SIANG'
									WHEN starttime > '16:59:59' AND endtime < '21:00:01' THEN 'SORE'
									ELSE 'TENTATIVE'
								END AS waktu
								FROM bwch_doctor_schedule
								) AS TEMP ON TEMP.idschedule = a.transschedule
								GROUP BY transdate,waktu
								";

				$get_trans  = $this->db->query($query_trans)->result_array();

				$i = 0;
				foreach($get_trans as $row){ $i++;
				    $e['id'] 				= 'a-'.$i;

				    switch ($row['waktu']) {
				    	case 'PAGI':
				    		$title 	   = ': '.$row['count'].' Book';
				    		$starttime = $row['transdate'].'T08:00:00';
				    		$endtime   = $row['transdate'].'T12:00:00';
				    		$backcolor = '#39cccc';
				    		break;
				    	case 'SIANG':
				    		$title 	   = ': '.$row['count'].' Book';
				    		$starttime = $row['transdate'].'T12:00:00';
				    		$endtime   = $row['transdate'].'T17:00:00';
				    		$backcolor = '#f39c12';
				    		break;
				    	case 'SORE':
				    		$title 	   = ': '.$row['count'].' Book';
				    		$starttime = $row['transdate'].'T17:00:00';
				    		$endtime   = $row['transdate'].'T21:00:00';
				    		$backcolor = '#605ca8';
				    		break;
				    	default:
				    		$title 	   = 'Tent: '.$row['count'].' Book';
				    		$starttime = $row['transdate'].'T00:00:00';
				    		$endtime   = $row['transdate'].'T00:00:00';
				    		$backcolor = '#a2a2a2';
				    		break;
				    }

				    $e['title'] 			= $title;
				    $e['start'] 			= $starttime;
				    $e['end'] 				= $endtime;

					$e['backgroundColor'] 	= $backcolor;
					$e['borderColor'] 		= '#ffffff';

					$ex = explode('T', $starttime);
					$allday = ($ex[1] == "00:00:00") ? true : false;
				    $e['allDay'] = $allday;

				    array_push($events, $e);
				}

				echo json_encode($events);
				//echo '<pre>';print_r($events);
			}			
		}else{
			$type = '';
			$data = array(
							'content'  	=> 'admin/calendar/index',
							'modal'		=> 'admin/calendar/modal',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'titlebar' 	=> 'Admin | Calendar',
							'title'	   	=> 'Calendar',
							//'result'   	=> $this->mmenu->getAll()->result_array(),
							//'max_parent'=> $this->mmenu->getMaxParent(),
							'js'		=> $this->js()
						 );
			$this->load->view('template/main', $data);
		}
	}

	function js(){
		$js = '';

	}
}
