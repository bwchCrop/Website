<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mconfiguration extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'configuration';
		$this->load->database();
	}

	public function getAll(){
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getById($id){
		$this->db->where('id',$id);
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('id' => $id));

		return $sql;
	}

	public function update($id,$data){
		$this->db->where('id',$id);
		$sql = $this->db->update($this->table,$data);

		return $sql; 
	}
}
