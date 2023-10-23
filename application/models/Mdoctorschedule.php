<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdoctorschedule extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'doctor_schedule';
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

	public function getJoinByIdDoc($id){
		$this->db->join(_PREFIX."doctor", _PREFIX."doctor.iddoctor = "._PREFIX."doctor_schedule.iddoctor");
		$this->db->where(_PREFIX.'doctor_schedule.iddoctor',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}	

	public function getJoinById($id1,$id2){
		$this->db->join(_PREFIX."doctor", _PREFIX."doctor.iddoctor = "._PREFIX."doctor_schedule.iddoctor");
		$this->db->where(_PREFIX.'doctor_schedule.iddoctor',$id1);
		$this->db->where(_PREFIX.'doctor_schedule.slug',$id2);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}	

	public function getByIddoctor($id){
		$this->db->where('iddoctor',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}		

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('iddoctor' => $id));

		return $sql;
	}
	
	public function update($id,$data){
		$this->db->where('id',$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}