<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller
{

    public function show(string $slug)
    {

        $doctor_row = $this->apidoctors->findBySlug($slug)->row_array();

        $grouping = $this->mapidata->getApi()->row();

        $groupingArray = json_decode($grouping->grouping);

        $hospitalsData = [];

        foreach ($groupingArray as $key => $group) {
            $hospitals = $group->rs;
            foreach ($hospitals as $key => $hospital) {
                $specialists = $hospital->specialist;
                foreach ($specialists as $key => $specialist) {
                    $doctors = $specialist->doctors;
                    foreach ($doctors as $key => $doctor) {
                        if ($doctor->pid == $doctor_row['doctor_id']) {
                            $doctor->hospital = $hospital->hospital;
                            $doctor->rsid = $hospital->rsid;
                            $doctor->tmgroupname = $group->tmgroupname;
                            array_push($hospitalsData, $doctor);
                        }
                    }
                }
            }
        }

        foreach ($hospitalsData as $key => $hospital) {
            $schedule = $this->mscheduler->getByDoctorIdRsid($hospital->pid, $hospital->rsid)->row();
            $hospitalsData[$key]->schedule = $schedule;
        }

        $data = [
            'doctor' => $doctor_row,
            'hospital_data' => $hospitalsData,
			'title'           =>  'Brawijaya Hospital',
			'content'         =>  'front/doctor',
        ];

		$this->load->view('front/template/main',$data);
    }
    
}



?>