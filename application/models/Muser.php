<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muser extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'user';
		$this->load->database();
	}
	
	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}
	
	public function getByEmail($id){
		$this->db->where('emailaddress',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByEmailProvider($id1,$id2){
		$this->db->where('emailaddress',$id1);
		$this->db->where('oauth_provider',$id2);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getById($id){
		$this->db->where('id',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByPass($type,$id,$pass){
		$this->db->where($type,$id);
		$this->db->where('password',$pass);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByOauth($provider,$id){
		$this->db->where('oauth_provider',$provider);
		$this->db->where('oauth_uid',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('emailaddress' => $id));

		return $sql;
	}
	
	public function update($id,$data){
		$this->db->where('emailaddress',$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}

	public function updateBy($param,$id,$data){
		$this->db->where(_PREFIX.$param,$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}