<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhighlight extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'highlight';
		$this->table2 = _PREFIX.'doctor_highlight';
		$this->load->database();
	}

	public function getAll(){
	    $this->db->order_by("highlight_title", "asc");
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getById($id){
		$this->db->where('highlight_id',$id);
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getByWhere($where){
		$this->db->where($where);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByMenu($menu,$status = NULL){
		if($status != NULL){
			$this->db->where('highlight_status',$status);
		}

		$this->db->where('highlight_menu',$menu);
		$this->db->order_by("highlight_title", "asc");
		$sql = $this->db->get($this->table);
		

		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('highlight_id' => $id));

		return $sql;
	}

	public function update($id,$data){
		$this->db->where('highlight_id',$id);
		$sql = $this->db->update($this->table,$data);

		return $sql; 
	}

	/* --- Detail --- */

	public function getAllDetail(){
		$sql = $this->db->get($this->table2);

		return $sql;
	}

	public function getByIdDetail($id){
		$this->db->where('doctor_highlight_iddoctor',$id);
		$sql = $this->db->get($this->table2);

		return $sql;
	}

	public function getJoinByIdDetail($id){
		$this->db->join($this->table , $this->table.'.highlight_id = '.$this->table2.'.doctor_highlight_idhighlight');
		$this->db->where('doctor_highlight_iddoctor',$id);
		$sql = $this->db->get($this->table2);

		return $sql;
	}

	public function getByDetail($id1,$id2){
		$this->db->where('doctor_highlight_iddoctor',$id1);
		$this->db->where('doctor_highlight_idhighlight',$id2);
		$sql = $this->db->get($this->table2);

		return $sql;
	}

	public function insertDetail($data){
		return $this->db->insert($this->table2,$data);
	}

	public function deleteDetail($id){
		$sql = $this->db->delete($this->table2,array('doctor_highlight_iddoctor' => $id));

		return $sql;
	}

	public function updateDetail($id,$data){
		$this->db->where('doctor_highlight_iddoctor',$id);
		$sql = $this->db->update($this->table2,$data);

		return $sql; 
	}
}
