<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mnewsletter extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'newsletter';
		$this->load->database();
	}
	
	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getAllGroup(){
		$this->db->group_by('newsletter');
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getPublished(){
		$this->db->where('status','1');
		$this->db->group_by('newsletter');
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getById($id){
		$this->db->where('idnewsletter',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByNewsletter($id){
		$this->db->where('newsletter',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('idnewsletter' => $id));

		return $sql;
	}
	
	public function update($id,$data){
		$this->db->where('idnewsletter',$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}