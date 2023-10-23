<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api_doctor_scheduler extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}
	}

	public function index(){
		$data = array(
						'content'  	=> 'admin/api_doctor_scheduler/index',
						'modal'		=> 'template/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | Doctor Profile',
						'title'	   	=> 'Doctor Profile',
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
			$data['result']   	= $this->mapi_doctor_scheduler->getAll()->result_array();
		}

		$this->load->view('template/main', $data);
	}

	public function edit($id = null)
	{
		if (!$id) {
			$id	= $this->input->post('id');

			$data = [
				'description' => $this->input->post('description'),
				'image'	=> $this->input->post('image'),
			];

			$update = $this->mapi_doctor_scheduler->update($id, $data);

			if ($update) {
				$this->session->set_flashdata(
					'message_',
					'<div id="message" class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Data Updated
					</div>'
				);
				redirect('admin-api_doctor_scheduler');
			}else {
				$this->session->set_flashdata(
					'message_',
					'<div id="message" class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Failed Update Data
					</div>
              		');
				redirect('admin-api_doctor_scheduler');

			}
		}else {
			$id1 		= str_replace(array('_'), array('/'), $id);
			$decrypt_id = $this->encryption->decrypt($id1);

			$api_doctor_schedule = $this->mapi_doctor_scheduler->getById($decrypt_id)->row_array();
			
			$data = [
				'titlebar' => 'Admin | Edit Doctor Profile',
				'menu' => $this->mmenu->getParent()->result_array(),
				'content' => 'admin/api_doctor_scheduler/edit',
				'title' => 'Edit Doctor Profile',
				'modal' => 'admin/api_doctor_scheduler/modal',
				'result' => $api_doctor_schedule,
				'encrypt_id' => $id,
				'decrypt_id' => $decrypt_id, 
			];

			$this->load->view('template/main', $data);
		}

	}
}/*END OF FILE*/
