<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maccount extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'account';
		$this->load->database();
	}
	
	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}
	
	public function getByUsername($id){
		$this->db->where('username',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByEmail($id){
		$this->db->where('email',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByPass($type,$id,$pass){
		$this->db->where($type,$id);
		$this->db->where('password',$pass);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getNonUserLogin($id, $join = FALSE){
		$this->db->where("username != '".$id."'");
		$this->db->where('role != 0');
		
		if($join == TRUE){
			$this->db->join(_PREFIX."group a", "a.id = ".$this->table.".menurole");
		}

		$sql = $this->db->get($this->table);
		
		return $sql;
	}
	
	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('username' => $id));

		return $sql;
	}
	
	public function update($id,$data){
		$this->db->where('username',$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}