<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apidoctors extends CI_Model{

    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = _PREFIX . 'api_doctors';
        $this->load->database();
    }

    public function all()
    {
        return $this->db->get($this->table);
    }

    public function findByPID($pid)
    {
        $this->db->where('doctor_id', $pid);
        $sql = $this->db->get($this->table);

        return $sql;
    }

    public function findBySlug($slug)
    {
        $this->db->where('slug', $slug);
        $sql = $this->db->get($this->table);

        return $sql;
    }

    public function insertDefault($data)
    {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function updateByPID($pid, $name, $hospital, $specialist, $slug)
    {
        $this->db->where('doctor_id', $pid);
        $sql = $this->db->update($this->table, [
            'name' => $name,
            'slug' => $slug,
            'hospital' => $hospital,
            'specialist' => $specialist,
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        return $sql; 
    }
}