<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class timepicker extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}
	}

	public function index(){
		$data = array(
						'content'  	=> 'admin/timepicker/index',
						'modal'		=> 'template/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | timepicker',
						'title'	   	=> 'timepicker',
						'js'		=> '',
						'role'		=> $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array()
					);

		$where 		= _PREFIX.'menu.link = \''.$this->uri->segment(1).'\'';
		$checkMenu 	= $this->mmenu->getByWhere($where)->row_array();

		if($checkMenu['status'] == '2'){
			$data['result']   	= '';
			$data['content'] 	= 'admin/tempmenu';
			$data['idmenu']	= $checkMenu['id'];
			$data['tempstep'] 	= $checkMenu['tempstep'];
		}else{
			$data['result']   	= $this->mtimepicker->getAll()->result_array();
		}

		$this->load->view('template/main', $data);
	}

	function multiple_action(){
		$role = $this->input->post('role');
		$id   = $this->input->post('id');

		$n = 0;
		for($i=0;$i<count($id);$i++){
			$get_id = $id[$i];

			if($role == 'publish' || $role == 'unpublish'){
				if($role == 'publish'){
					$data = array( 'timepicker_status' => '1', 'timepicker_updateby' => $this->session->userdata(_PREFIX.'username'), 'timepicker_updatedate' => date('Y-m-d H:i:s'), );
				}else{
					$data = array( 'timepicker_status' => '0', 'timepicker_updateby' => $this->session->userdata(_PREFIX.'username'), 'timepicker_updatedate' => date('Y-m-d H:i:s'), );
				}

				$update = $this->mtimepicker->update($get_id,$data);
				if($update){
					$n++;
				}
			}elseif($role == 'delete'){
				$update = $this->mtimepicker->delete($get_id);
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

}/*END OF FILE*/
