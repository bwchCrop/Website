<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhospital extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'hospital';
		$this->tableDetail = _PREFIX.'hospital_detail';
		$this->load->database();
	}
	
	public function getAll(){
		$this->db->order_by('status DESC');
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getActived($order = 'status DESC'){
		$this->db->where('status','1');
		//$this->db->order_by($order);
		$this->db->order_by(_PREFIX."hospital.namehospital", "ASC");
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

//	navigationQuery
    public function getMenu($order = 'status DESC'){
        $this->db->where('status','1');
        $this->db->where_not_in('idhospital', array('7', '8'));
        $this->db->order_by(_PREFIX."hospital.namehospital", "ASC");
        $sql = $this->db->get($this->table);

        return $sql;
    }

	public function getById($id){
		$this->db->where('idhospital',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByWhere($where){
		$this->db->where($where);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinAll(){
		$this->db->join(_PREFIX."cat_location",_PREFIX."cat_location.id = "._PREFIX."hospital.location");
		$this->db->order_by('status DESC');
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinByWhere($where = 'status = 1'){
		$this->db->join(_PREFIX."cat_location",_PREFIX."cat_location.id = "._PREFIX."hospital.location");
		$this->db->where($where);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinDetailByWhere($where = 'status = 1', $order = ''){
		$this->db->select("*");
		$this->db->select(_PREFIX.'post.title as post_title,'._PREFIX.'post.id as post_id');
		$this->db->join(_PREFIX."cat_location",_PREFIX."cat_location.id = "._PREFIX."hospital.location");
		$this->db->join(_PREFIX."hospital_detail",_PREFIX."hospital_detail.hospital_detail_idhospital = "._PREFIX."hospital.idhospital");
		$this->db->join(_PREFIX."post",_PREFIX."post.id = "._PREFIX."hospital_detail.hospital_detail_idpost");
		$this->db->where($where);

		if($order != ''){
			$this->db->order_by($order);
		}

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function delete($id){
		$sql = $this->db->delete($this->table,array('idhospital' => $id));

		return $sql;
	}
	
	public function update($id,$data){
		$this->db->where('idhospital',$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}