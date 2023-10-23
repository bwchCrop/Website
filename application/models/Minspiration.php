<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Minspiration extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'inspiration';
		$this->load->database();
	}
	
	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getAllLimit($limit,$offset){
		$sql = $this->db->get($this->table,$limit,$offset);
		
		return $sql;
	}

	public function getById($id){
		$this->db->where('idinspiration',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('idinspiration' => $id));

		return $sql;
	}
	
	public function update($id,$data){
		$this->db->where('idinspiration',$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}