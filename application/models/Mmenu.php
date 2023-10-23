<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmenu extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->table = _PREFIX.'menu';
		$this->tablex= _PREFIX.'groupmenu';
		$this->mrole = $this->session->userdata(_PREFIX.'menurole'); 
		$this->load->database();
	}
	
	public function getMaxParent(){
		$check_count = "select max("._PREFIX."menu.parent)+1 as parent FROM "._PREFIX."menu WHERE "._PREFIX."menu.parent != '20'";
		$sql_check   = $this->db->query($check_count);

		return $sql_check->row_array();
	}

	public function getMaxPosition($id){
		$check_count = "select max("._PREFIX."menu.position)+1 as position FROM "._PREFIX."menu WHERE "._PREFIX."menu.parent = $id";
		$sql_check   = $this->db->query($check_count);

		return $sql_check->row_array();
	}

	public function getMaxSort($id1,$id2){
		$check_count = "select max("._PREFIX."menu.sort)+1 as sort FROM "._PREFIX."menu WHERE "._PREFIX."menu.parent = $id1 AND "._PREFIX."menu.position = $id2";
		$sql_check   = $this->db->query($check_count);

		return $sql_check->row_array();
	}	

	public function getAll(){
		$this->db->order_by('no');
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getById($id){
		$this->db->where('id', $id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getMenuToGroup($where = 'id IS NOT NULL'){
		$this->db->where('status > 0');
		$this->db->where('position !=','0');
		$this->db->where($where);
		$this->db->order_by('no');		
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getParentById($id){
	}
	
	public function getAllParent(){
		//$this->db->where('parent IN (SELECT parent FROM '.$this->tablex.' a JOIN '.$this->table.' b ON b.id = a.idmenu WHERE idgroup = '.$this->mrole.')');
		$this->db->where('position','0');
		$this->db->where('sort','0');
		$this->db->where('status > 0');
		$this->db->order_by('parent');

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getByWhere($where = NULL, $order = NULL){
		if($where != NULL){
			$this->db->where($where);
		}

		if($order != NULL){
			$this->db->order_by($order);
		}

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getParent(){
		$this->db->where('parent IN (SELECT parent FROM '.$this->tablex.' a JOIN '.$this->table.' b ON b.id = a.idmenu WHERE idgroup = '.$this->mrole.')');
		$this->db->where('position','0');
		$this->db->where('sort','0');
		$this->db->where('status > 0');
		$this->db->order_by('parent');

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getAllPosition($id){
		//$this->db->where('position IN (SELECT position FROM '.$this->tablex.' a JOIN '.$this->table.' b ON b.id = a.idmenu WHERE idgroup = '.$this->mrole.' AND parent = '.$id.')');
		$this->db->where('position != 0');
		$this->db->where('parent',$id);
		$this->db->where('sort','0');
		$this->db->where('status > 0');
		$this->db->order_by('position');

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getPosition($id){
		$this->db->where('position IN (SELECT position FROM '.$this->tablex.' a JOIN '.$this->table.' b ON b.id = a.idmenu WHERE idgroup = '.$this->mrole.' AND parent = '.$id.')');
		$this->db->where('position != 0');
		$this->db->where('parent',$id);
		$this->db->where('sort','0');
		$this->db->where('status > 0');
		$this->db->order_by('position');

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getAllSort($id1,$id2){
		//$this->db->where('sort IN (SELECT sort FROM '.$this->tablex.' a JOIN '.$this->table.' b ON b.id = a.idmenu WHERE idgroup = '.$this->mrole.' AND parent = '.$id1.' AND position = '.$id2.')');
		$this->db->where('sort != 0');
		$this->db->where('parent',$id1);
		$this->db->where('position',$id2);
		$this->db->where('status > 0');
		$this->db->order_by('sort');

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getSort($id1,$id2){
		$this->db->where('sort IN (SELECT sort FROM '.$this->tablex.' a JOIN '.$this->table.' b ON b.id = a.idmenu WHERE idgroup = '.$this->mrole.' AND parent = '.$id1.' AND position = '.$id2.')');
		$this->db->where('sort != 0');
		$this->db->where('parent',$id1);
		$this->db->where('position',$id2);
		$this->db->where('status > 0');
		$this->db->order_by('sort');

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