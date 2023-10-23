<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msubcategory2 extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'cat_subcategory2';
		$this->load->database();
	}
	
	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getPublished(){
		$this->db->where('status','1');
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinAll(){
		$this->db->select($this->table.'.*');
		$this->db->select(_PREFIX.'cat_subcategory1.subcategory1 as subcategory1');
		$this->db->join(_PREFIX.'cat_subcategory1',_PREFIX.'cat_subcategory1.id = '.$this->table.'.idcatsubcategory1');
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