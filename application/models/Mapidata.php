<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapidata extends CI_Model{

    public function __construct(){
		parent::__construct();
		$this->table = _PREFIX.'api_doctor_schedule';
        $this->load->helper('date');
		$this->load->database();
	}

    public function getApi(string $column = "*")
    {
        $this->db->select("$column")->limit(1)->order_by('id', "DESC");
        $sql = $this->db->get($this->table);
        return $sql;
    }

    public function insert($data){
		return $this->db->insert($this->table, $data);
	}

}