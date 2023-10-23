<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mtimepicker extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'timepicker';
		$this->load->database();
	}

	public function getAll(){
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getById($id){
		$this->db->where('timepicker_id',$id);
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('timepicker_id' => $id));

		return $sql;
	}

	public function update($id,$data){
		$this->db->where('timepicker_id',$id);
		$sql = $this->db->update($this->table,$data);

		return $sql; 
	}
}
