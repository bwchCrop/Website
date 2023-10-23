<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpostcategory extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'post_category';
		$this->load->database();
	}
	
	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getWhere($where){
		$this->db->where($where);

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getPostCategory(){
		$this->db->where_in(_PREFIX.'post_category.id', [1,2,3,4,5,16,17]);
		$this->db->order_by(_PREFIX.'post_category.title', 'asc');

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