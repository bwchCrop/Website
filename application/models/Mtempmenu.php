<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mtempmenu extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'menutemp';
		$this->load->database();
	}

	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getById($id){
		$this->db->where('menutemp_id', $id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByWhere($where = NULL, $order = NULL){
		if($where != NULL){
			$this->db->where($where);
		}

		if($order != NULL){
			$this->db->order_by($order);
		}

		$sql = $this->db->get($this->table);

		return $sql;
	}
	
	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id,$additional = NULL){
		if($id == NULL){
			$sql = $this->db->delete($this->table,$additional);
		}else{
			$sql = $this->db->delete($this->table,array('menutemp_id' => $id));
		}

		return $sql;
	}
	
	public function update($id,$data,$additional = NULL){
		if($id == NULL){
			$this->db->where($additional);
		}else{
			$this->db->where('menutemp_id',$id);
		}

		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}