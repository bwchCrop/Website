<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apidoctor extends CI_Controller {

    public function index()
    {
        $doctorlist = $this->apidoctors->all()->result_array();
        $grouping = json_decode($this->grouping());

        $idDoctorArray = [];

        foreach ($grouping as $group) {
            foreach($group->rs as $hospital){
                foreach ($hospital->specialist as $specialist) {
                    foreach ($specialist->doctors as $key => $doctor) {
                        $idDoctorArray[] = $doctor->pid;
                        array_push($idDoctorArray, $doctor->pid);
                        // print_r($specialist->specialist);
                        // var_dump($this->apidoctors->findByPID($doctor->pid)->row_array());
                        $slug = $this->slugify($doctor->dokter);
                        $data = [
                            'doctor_id' => $doctor->pid,
                            'name' => $doctor->dokter,
                            'slug' => $slug,
                            'hospital' => $hospital->hospital,
                            'specialist' => $specialist->specialist,
                            'created_at' => date("Y-m-d H:i:s")
                        ];
                        // echo "<pre>";
                        // print_r($doctor->pid);
                        $this->apidoctors->insertDefault($data);
                        // if ($this->apidoctors->findByPID($doctor->pid)->row_array() == null){
                        // }else{
                        //     $this->apidoctors->updateByPID($doctor->pid, $doctor->dokter, $hospital->hospital, $specialist->specialist, $slug);
                        // }
                    }
                }
            }
        }

        
        // sort array
        asort($idDoctorArray);
        $idDoctorArray = array_unique($idDoctorArray, SORT_REGULAR);
        try {
            $this->db->select()->from('bwch_api_doctors')->where_not_in('doctor_id', $idDoctorArray)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        echo "Success";

    }


    private function grouping(){
        $data = $this->mapidata->getApi()->row();
        return $data->grouping;
    }

    private function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
