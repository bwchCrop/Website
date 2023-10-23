<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdoctor extends CI_Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'doctor';
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

	public function getJoinPublished($perpage = 999, $offset = 0, $sort = 0, $category = 0, $doctorcategory = 0, $doctoritem = 0, $brand = 0, $menutype = 0){
		$this->db->join(_PREFIX.'doctoritem' , _PREFIX.'doctoritem.id = '.$this->table.'.iddoctoritem');
		$this->db->join(_PREFIX.'doctoritemcategory' , _PREFIX.'doctoritemcategory.id = '._PREFIX.'doctoritem'.'.iddoctoritemcategory');
		$this->db->join(_PREFIX.'doctorcategory', _PREFIX.'doctorcategory.id = '.$this->table.'.iddoctorcategory');
		$this->db->join(_PREFIX.'doctorbrand', _PREFIX.'doctorbrand.id = '.$this->table.'.iddoctorbrand');
		$this->db->where('status','1');
		
		if($menutype != '0'){
			$this->db->where('menutype',$menutype);
		}

		if($category != '0'){
			$this->db->where(_PREFIX.'doctoritemcategory.id', $category);
		}

		if($doctorcategory != '0'){
			$this->db->where($this->table.'.iddoctorcategory', $doctorcategory);
		}

		if($doctoritem != '0'){
			$this->db->where($this->table.'.iddoctoritem', $doctoritem);
		}

		if($brand != '0'){
			$this->db->where($this->table.'.iddoctorbrand', $brand);
		}		

		if($sort != '0'){
			$result = explode('-', $sort);
			$this->db->order_by($result[0], $result[1]);
		}else{
			$this->db->order_by($this->table.'.iddoctoritem');
		}

		$sql = $this->db->get($this->table,$perpage,$offset);
		
		return $sql;
	}

	public function getJoinAll(){
        $this->db->select('*,'.$this->table.'.iddoctor as doctor_id' );

		// $this->db->join(_PREFIX.'cat_subcategory2' , _PREFIX.'cat_subcategory2.id = '.$this->table.'.idcatsubcategory2');
		// $this->db->join(_PREFIX.'cat_subcategory1' , _PREFIX.'cat_subcategory1.id = '._PREFIX.'cat_subcategory2'.'.idcatsubcategory1');
		// $this->db->join(_PREFIX.'cat_category', _PREFIX.'cat_category.id = '.$this->table.'.idcatcategory');
		// $this->db->join(_PREFIX.'cat_location', _PREFIX.'cat_location.id = '.$this->table.'.idcatlocation');

		$sql = $this->db->get($this->table);
		
		return $sql;
	}
	
	public function getJoinByHospital($id){
	    $this->db->select('*,'._PREFIX.'doctor_schedule.iddoctor as doctor_id' );
		$this->db->join(_PREFIX.'doctor_schedule' , _PREFIX.'doctor_schedule.iddoctor = '.$this->table.'.iddoctor');
		$this->db->where('idhospital',$id);
		$this->db->group_by('doctor_id');

		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getById($id){
		$this->db->where('iddoctor',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getJoinById($id){
		$this->db->join(_PREFIX.'doctoritem' , _PREFIX.'doctoritem.id = '.$this->table.'.iddoctoritem');
		$this->db->join(_PREFIX.'doctoritemcategory' , _PREFIX.'doctoritemcategory.id = '._PREFIX.'doctoritem'.'.iddoctoritemcategory');
		$this->db->join(_PREFIX.'doctorcategory', _PREFIX.'doctorcategory.id = '.$this->table.'.iddoctorcategory');
		$this->db->join(_PREFIX.'doctorbrand', _PREFIX.'doctorbrand.id = '.$this->table.'.iddoctorbrand');
		$this->db->where('iddoctor',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}

	public function getAdvancedSearch($where = '1=1', $groupby = ''){
		$this->db->select('a.iddoctor,a.name namedoctor,a.status statusdoctor,a.idcatlocation,
						   c.highlight_id specialistid,c.highlight_title specialist,c.highlight_status specialiststatus,
						   d.idschedule,d.day dayschedule,d.starttime,d.endtime,
						   e.idhospital idhospital,e.namehospital,
						   f.namelocation');
		$this->db->from(_PREFIX.'doctor a');
		$this->db->join(_PREFIX.'doctor_highlight b', 'b.doctor_highlight_iddoctor = a.iddoctor');
		$this->db->join(_PREFIX.'highlight c', 'c.highlight_id = b.doctor_highlight_idhighlight');
		$this->db->join(_PREFIX.'doctor_schedule d', 'd.iddoctor = a.iddoctor');
		$this->db->join(_PREFIX.'hospital e', 'e.idhospital = d.idhospital');
		$this->db->join(_PREFIX.'cat_location f', 'f.id = e.location');
		$this->db->where($where);

		if($groupby != ''){
			$this->db->group_by($groupby);
		}

		$sql = $this->db->get();

		return $sql;
	}

	public function getPictureById($id){
		$this->db->join(_PREFIX.'doctorpicture' , _PREFIX.'doctorpicture.iddoctor = '.$this->table.'.iddoctor');
		$this->db->where($this->table.'.iddoctor',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}	

	public function getDimensionById($id){
		$this->db->join(_PREFIX.'doctordimension' , _PREFIX.'doctordimension.iddoctor = '.$this->table.'.iddoctor');
		$this->db->where($this->table.'.iddoctor',$id);
		$sql = $this->db->get($this->table);
		
		return $sql;
	}	

	public function getMappingCategory($id_cat = 0, $id_group = 0){
		//$sql = $this->db->query("SELECT * FROM map_doctorcategory WHERE id_cat = '".$id."'");

		// $this->db->select("a.iddoctorcategory id_cat, c.iddoctoritemcategory id_group, a.iddoctoritem id_item, b.namecategory category_, d.itemcategory group_ , c.doctoritemname item_ ");
		// $this->db->join(_PREFIX.'doctorcategory b' , 'b.id = a.iddoctorcategory');
		// $this->db->join(_PREFIX.'doctoritem c' ,'c.id = a.iddoctoritem');
		// $this->db->join(_PREFIX.'doctoritemcategory d', 'd.id = c.iddoctoritemcategory');
		// $this->db->where('a.status' , '1');
		// $this->db->where('a.iddoctorcategory' , $id);
		// $this->db->group_by('a.iddoctoritem'); 
		// $this->db->order_by('a.iddoctorcategory,a.iddoctoritem', 'ASC');
		// $sql = $this->db->get($this->table.' a');
		$where = "";

		if($id_group != '0'){
			$where .= "WHERE temp.id_group = '$id_group'";
		}else{
			if($id_cat != '0'){
				$where = "WHERE temp.id_cat = '$id_cat'";
			}			
		}

		$sql = $this->db->query("SELECT * FROM (
												SELECT  a.iddoctorcategory id_cat, 
													c.iddoctoritemcategory id_group, 
													a.iddoctoritem id_item, 
													b.namecategory category_, 
													d.itemcategory group_ , 
													c.doctoritemname item_ 
												FROM "._PREFIX."doctor a
												JOIN "._PREFIX."doctorcategory b ON b.id = a.iddoctorcategory
												JOIN "._PREFIX."doctoritem c ON c.id = a.iddoctoritem
												JOIN "._PREFIX."doctoritemcategory d ON d.id = c.iddoctoritemcategory
												WHERE a.status = '1'
												GROUP BY a.iddoctoritem 
												ORDER BY a.iddoctorcategory,a.iddoctoritem  ASC
												) temp $where");

		return $sql;
	}

	public function getCatById($id1,$id2 = NULL,$group = NULL){ // $id1 : IDParentCat - $id2 : IDMainCat
		if($id2 == NULL){
			$where = "c.id = \"$id1\"";
		}elseif($id1 == NULL){
			$where = "b.id = \"$id2\"";
		}else{
			$where = "c.id = \"$id1\" AND b.id = \"$id2\"";
		}

		if($group != NULL){
			$groupby = "GROUP BY ".$group." ORDER BY ".$group;
		}else{
			$groupby = "";
		}

		$sql = $this->db->query("SELECT a.id item_id,
											 a.subcategory2 item_name, 
											 b.id cat_id, 
											 b.subcategory1 cat_name, 
											 c.id dept_id, 
											 c.namecategory dept_name 
										FROM "._PREFIX."cat_subcategory2 a
										JOIN "._PREFIX."cat_subcategory1 b ON b.id = a.idcatsubcategory1
										JOIN "._PREFIX."cat_category c ON c.id = b.idcatcategory
										WHERE ".$where." ".$groupby);
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
		$this->db->where('iddoctor',$id);
		$sql = $this->db->update($this->table,$data);
		
		return $sql; 
	}
}