<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mtransaction extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table 	 = _PREFIX.'transaction';
		$this->table_sec = _PREFIX.'trans_patient';
		$this->load->database();
	}

	function autonumber(){
		$strQ = $this->db->query("SELECT MAX(idtrans) AS idtrans FROM ".$this->table);
        $x1 = $strQ->row();
		
		if (!empty($x1->idtrans)){
            $next=substr($x1->idtrans,16,3)+1;
            if($next<=9 && $next>0){
                $next="TRN-".date('ymdhis').'00'.$next;
            }
            elseif($next<=99 && $next>9){
                $next="TRN-".date('ymdhis').'0'.$next;
            }
            else{
                $next="TRN-".date('ymdhis').$next;
            }

            return $next;
		}else{
			return "TRN-".date('ymdhis')."001";
		}
		
		return $x1;	
	}

	public function getAll(){
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinAll($order = ''){
		$this->db->select($this->table.'.*');
		$this->db->select(_PREFIX.'doctor.*');
		$this->db->select(_PREFIX.'hospital.*');
		$this->db->select(_PREFIX.'user.firstname firstname, '._PREFIX.'user.lastname lastname');
		$this->db->join(_PREFIX.'doctor',_PREFIX.'doctor.iddoctor = '.$this->table.'.iddoctor');
		$this->db->join(_PREFIX.'user',_PREFIX.'user.id = '.$this->table.'.transuserid');
		$this->db->join(_PREFIX.'doctor_schedule',_PREFIX.'doctor_schedule.idschedule = '.$this->table.'.transschedule');
		$this->db->join(_PREFIX.'hospital',_PREFIX.'hospital.idhospital = '._PREFIX.'doctor_schedule.idhospital');

		if($order != ''){
			$this->db->order_by('transdate',$order);
		}

		$sql = $this->db->get($this->table);
			
		return $sql;
	}

	public function getJoinById($id){
		$this->db->select($this->table.'.*');
		$this->db->select(_PREFIX.'doctor.*');
		$this->db->select(_PREFIX.'user.firstname firstname, '._PREFIX.'user.lastname lastname');
		$this->db->join(_PREFIX.'doctor',_PREFIX.'doctor.iddoctor = '.$this->table.'.iddoctor');
		$this->db->join(_PREFIX.'user',_PREFIX.'user.id = '.$this->table.'.transuserid');
		$this->db->where($this->table.'.id',$id);
		$sql = $this->db->get($this->table);
			
		return $sql;
	}

	public function getPublished(){
		$this->db->where('status','1');
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getById($id){
		$this->db->where('id',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByTrans($id){
		$this->db->where('idtrans',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinByTrans($id){
		$this->db->select($this->table.'.*');
		$this->db->select(_PREFIX.'doctor.*');
		$this->db->select(_PREFIX.'user.*');
		$this->db->select(_PREFIX.'hospital.*');
		$this->db->select(_PREFIX.'highlight.*');
		$this->db->select(_PREFIX.'doctor_schedule.*');
		$this->db->select(_PREFIX.'user.firstname firstname, '._PREFIX.'user.lastname lastname');
		$this->db->join(_PREFIX.'doctor',_PREFIX.'doctor.iddoctor = '.$this->table.'.iddoctor');
		$this->db->join(_PREFIX.'user',_PREFIX.'user.id = '.$this->table.'.transuserid');
		$this->db->join(_PREFIX.'highlight',_PREFIX.'highlight.highlight_id = '.$this->table.'.transpoli');
		$this->db->join(_PREFIX.'doctor_schedule',_PREFIX.'doctor_schedule.idschedule = '.$this->table.'.transschedule');
		$this->db->join(_PREFIX.'hospital',_PREFIX.'hospital.idhospital = '._PREFIX.'doctor_schedule.idhospital');

		$this->db->where('idtrans',$id);
		$sql = $this->db->get($this->table);
			
		return $sql;
	}

	public function getByTransPatientId($attr,$value){
		$this->db->where($attr,$value);
		$sql = $this->db->get($this->table_sec);
		
		return $sql;
	}

	public function getJoinByTransPatientId($attr,$value){
		$this->db->join($this->table, $this->table.'.idtrans = '.$this->table_sec.'.idtrans');
		$this->db->join(_PREFIX.'doctor_schedule', _PREFIX.'doctor_schedule.idschedule = '.$this->table.'.transschedule');
		$this->db->join(_PREFIX.'doctor',_PREFIX.'doctor.iddoctor = '._PREFIX.'doctor_schedule.iddoctor');
		$this->db->join(_PREFIX.'highlight',_PREFIX.'highlight.highlight_id = '._PREFIX.'transaction.transpoli');

		$this->db->join(_PREFIX.'patient', _PREFIX.'patient.patient_id = '.$this->table_sec.'.idpatient');
		$this->db->join(_PREFIX.'user',    _PREFIX.'user.id = '.$this->table_sec.'.iduser');

		if(count($attr) > 1){
			for ($i=0; $i < count($attr); $i++) { 
				$this->db->where($attr[$i],$value[$i]);
			}
		}else{
			$this->db->where($attr,$value);
		}

		$sql = $this->db->get($this->table_sec);
		
		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function insert_trans_patient($data){
		return $this->db->insert($this->table_sec,$data);
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