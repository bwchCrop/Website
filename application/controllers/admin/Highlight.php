<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Highlight extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}
	}

	public function index(){
		$where = '(link IS NOT NULL AND link != \'\') AND (url IS NOT NULL AND url != \'\')';
		
		$data = array(
						'content'  	=> 'admin/highlight/index',
						'modal'		=> 'template/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | Highlight',
						'title'	   	=> 'Highlight',
						'result'   	=> $this->mhighlight->getAll()->result_array(),
						'res_menu'	=> $this->mmenu->getByWhere($where,'no')->result_array(),
						'js'		=> '',
						'role'		=> $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array(),
					);

		$this->load->view('template/main', $data);
	}

	function add(){
		$data = array(
						'highlight_menu'  => $this->input->post('highlight_menu'),
						'highlight_title' => $this->input->post('highlight_title'),
						'highlight_status'=> $this->input->post('highlight_status'),
					 );

		$insert = $this->mhighlight->insert($data);

		if($insert){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function view(){
		$id 	= $this->input->post('id');
		$url 	= $this->input->post('url');
		$type 	= $this->input->post('type');

		$get_data = $this->mhighlight->getByid($id)->row_array();

		if(count($get_data) > 0 ){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

		    $where = '(link IS NOT NULL AND link != \'\') AND (url IS NOT NULL AND url != \'\')';

		    $get_menu = $this->mmenu->getByWhere($where,'no')->result_array();

			$print = '
		            <div class="form-group">
		              <label for="vhighlight_title" class="form-control-label">Highlight Title</label>
		              <input type="text" class="form-control" id="vhighlight_title" name="vhighlight_title" value="'.$get_data['highlight_title'].'" '.$disabled.'>
		              <input type="hidden" id="url" name="url" value="'.$url.'">
		              <input type="hidden" id="vhighlight_id" name="vhighlight_id" value="'.$id.'">
		            </div>       
		            <div class="form-group">
		              <label for="vhighlight_menu" class="form-control-label">Highlight Menu</label>
		              <select name="vhighlight_menu" id="vhighlight_menu" class="form-control" '.$disabled.'>
					';
			foreach($get_menu as $row){
			if($row['link'] == $get_data['highlight_menu']){ $sel = 'selected'; }else{ $sel = ''; }
			$print .= '
						<option value="'.$row['link'].'" '.$sel.'>'.$row['menu'].'</option>
					  ';
			}

			$print .= '
					  </select>
					  ';


			die($print);
		}else{
			die('');
		}
	}

	function edit(){
		$id = $this->input->post('highlight_id');

		$data = array(
						'highlight_title'	=> $this->input->post('highlight_title'),
						'highlight_menu' 	=> $this->input->post('highlight_menu'),
						'highlight_status'	=> '1',//$this->input->post('highlight_status'),
					 );

		$check_id = $this->mhighlight->getByid($id)->row_array();

		if(count($check_id) == 0){
			die('Failed #01');
		}else{
			$update = $this->mhighlight->update($id,$data); 
			
			if($update){
				die('Success');
			}else{
				die('Failed #02');
			}
		}
	}

	function delete(){
		$id = $this->input->post('id');

		$delete = $this->mhighlight->delete($id);

		if($delete){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function multiple_action(){
		$role = $this->input->post('role');
		$id   = $this->input->post('id');

		$n = 0;
		for($i=0;$i<count($id);$i++){
			if($role == 'publish' || $role == 'unpublish'){
				if($role == 'publish'){
					$data = array( 'highlight_status' => '1', );
				}else{
					$data = array( 'highlight_status' => '0', );
				}

				$update = $this->mhighlight->update($id[$i],$data);
				if($update){
					$n++;
				}
			}elseif($role == 'delete'){
							
				if($this->mhighlight->delete($id[$i])){
					$n++;
				}else{
					$n = FALSE;
				}
			}else{
				$n = FALSE;
			}
		}

		if($n == count($id)){
			die('Success');
		}else{
			die('Failed');
		}
	}
}
