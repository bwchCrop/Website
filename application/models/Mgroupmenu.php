<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mgroupmenu extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table1 = _PREFIX.'group';
		$this->table2 = _PREFIX.'groupmenu';
		$this->load->database();
	}
	
	public function autonumberGroup(){
		$check_count = "select count(smytemp_group.id) as id from (select max(id) as id from "._PREFIX."group) as smytemp_group";
		$sql_check   = $this->db->query($check_count);

		$this->db->select("MAX(id)+1 as autoid");
		$sql = $this->db->get($this->table1);

		$row = $sql->row();
		$x   = $row->autoid;
		return array(
			'row'			=> $x,
			'count'			=> $sql_check->row()
		);
	}

	public function getAllGroup($where = 'id IS NOT NULL'){
		$this->db->where($where);
		$sql = $this->db->get($this->table1);
		
		return $sql;
	}

	public function getIdGroup($id){
		$this->db->where('id',$id);
		$sql = $this->db->get($this->table1);
		
		return $sql;
	}
	
	public function insert($data){
		return $this->db->insert($this->table1,$data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$sql = $this->db->delete($this->table1);

		return $sql;
	}
	
	public function update($id,$data){
		$this->db->where('id',$id);
		$sql = $this->db->update($this->table1,$data);
		
		return $sql; 
	}

	public function getAllGroupMenu(){
		$sql = $this->db->get($this->table2);
		
		return $sql;
	}

	public function getAllGroupMenuJoin(){
		$this->db->join(_PREFIX.'menu',_PREFIX.'menu.id = '.$this->table2.'.idmenu');
		$sql = $this->db->get($this->table2);
		
		return $sql;
	}	

	public function getIdGroupMenu($id){
		$this->db->join(_PREFIX.'menu',_PREFIX.'menu.id = '.$this->table2.'.idmenu');
		$this->db->where('idgroup', $id);
		$this->db->order_by(_PREFIX.'menu.no');
		$sql = $this->db->get($this->table2);
		
		return $sql;
	}

	public function getGroupMenuId($id1,$id2){
		$this->db->where('idgroup', $id1);
		$this->db->where('idmenu', $id2);
		$sql = $this->db->get($this->table2);
		
		return $sql;
	}

	public function getByUser($username,$routesMenu){
		$this->db->join(_PREFIX.'account',_PREFIX.'account.menurole = '.$this->table2.'.idgroup');
		$this->db->join(_PREFIX.'menu',_PREFIX.'menu.id = '.$this->table2.'.idmenu');
		$this->db->where(_PREFIX.'account.username', $username);
		$this->db->where(_PREFIX.'menu.link', $routesMenu);
		$sql = $this->db->get($this->table2);
		
		return $sql;		
	}

	public function insert_groupmenu($data){
		return $this->db->insert($this->table2,$data);
	}

	public function delete_groupmenu($id){
		$this->db->where('idgroup',$id);
		$sql = $this->db->delete($this->table2);

		return $sql;
	}
	
	public function update_groupmenu($id,$data,$id2 = NULL){
		$this->db->where('idgroup',$id);
		if($id2 != NULL){
			$this->db->where('idmenu',$id2);
		}
		$sql = $this->db->update($this->table2,$data);
		
		return $sql; 
	}

	public function deleteWhere($value = ''){
		$this->db->where($value);
		$sql = $this->db->delete($this->table2);

		return $sql;
	}
}