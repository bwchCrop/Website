<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpatient extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'patient';
		$this->load->database();
	}

	public function getAll(){
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getJoinAll(){
		$this->db->join(_PREFIX.'user',_PREFIX.'user.id = '.$this->table.'.patient_userid');

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getById($id){
		$this->db->where('patient_id',$id);
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getByWhere($where){
		$this->db->where($where);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinById($id){
		$this->db->join(_PREFIX.'user',_PREFIX.'user.id = '.$this->table.'.patient_userid');
		$this->db->where('patient_id',$id);

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getJoinByWhere($where){
		$this->db->join(_PREFIX.'user',_PREFIX.'user.id = '.$this->table.'.patient_userid');
		$this->db->where($where);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getTransByPatient($id,$order = NULL, $limit = '0'){
		$this->db->join(_PREFIX.'trans_patient',_PREFIX.'trans_patient.idpatient = '._PREFIX.'patient.patient_id');
		$this->db->join(_PREFIX.'transaction',_PREFIX.'transaction.idtrans = '._PREFIX.'trans_patient.idtrans');
		$this->db->join(_PREFIX.'doctor',_PREFIX.'doctor.iddoctor = '._PREFIX.'transaction.iddoctor');
		$this->db->where('patient_id',$id);

		if($order != NULL){
			$this->db->order_by($order,'DESC');
		}

		$sql = $this->db->get($this->table,$limit);

		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('patient_id' => $id));

		return $sql;
	}

	public function update($id,$data){
		$this->db->where('patient_id',$id);
		$sql = $this->db->update($this->table,$data);

		return $sql; 
	}
}
