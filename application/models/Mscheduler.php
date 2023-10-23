<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mscheduler extends CI_Model
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = _PREFIX . 'api_doctor_schedulers';
        $this->load->database();
    }

    public function get_schedule($pid, $rsid)
    {
        $this->db->where(['doctor_id' =>  $pid, 'rsid' => $rsid]);
        $sql = $this->db->get($this->table);
        return $sql;
    }

    public function insertBulk($data)
    {
        $this->db->truncate($this->table);
        $this->db->insert_batch($this->table, $data);
    }

    public function getByDoctorIdRsid(int $doctor_id, int $rsid)
	{
        $this->db->where('doctor_id', $doctor_id);
		$this->db->where('rsid', $rsid);

		$sql = $this->db->get($this->table);
		return $sql;
	}
}
