<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load extends CI_Controller {

    private $api_base_url = API_URL;

    function __construct()
    {
        parent::__construct();
        // session_destroy();
    }

    protected function getToken(){
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if (! $api_token = $this->cache->get('api_token')) {
            $token = my_token();
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->save('api_token', $token, 120);

            // echo json_encode($token);
            // exit;
            return $token['token'];
        }

        return $api_token['token'];
    }

    public function run($key) {
        // disable temporary
        // echo '<h1>Disable temporary</h1>';
        // die();

        if ($key == 'Y1OSFjTKcJ') {
            $token = $this->getToken();
            // $specialist = $this->specialist($token);
            // $rs = $this->getRs($token);
            $grouping = $this->getGrouping($token);
            // $specialist_all_rs = $grouping;
            $data = [
                'grouping' => $grouping,
                // 'hospital' => $rs,
                // 'specialist_all_rs' => $specialist_all_rs,
                // 'specialist' => $specialist,
                // 'created_at' => date('Y-m-d H:i:s')
            ];

            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->save('grouping', json_decode($data['grouping']), 3600);
            print_r($data['grouping']);

            // foreach ($data as $key => $item) {
            //     echo 'Saving '. $key .' to the cache!<br />';
            //     // Save into the cache for 5 minutes
            //     echo '<br>';
            // }

            log_message('debug', 'Fetch data success with response '. json_encode($data));
    
            // $insert = $this->mapidata->insert($data);
            // var_dump($this->mapidata->getApi()->row());
            // die();
        }else{
            log_message('debug', 'Someone access /data/loadapi, with unmatched key');
            show_404();
        }
    }

    public function run_2($key)
    {
        // disable temporary
        // echo '<h1>Disable temporary</h1>';
        // die();
        
        if ($key == 'Y1OSFjTKcJ') {
        
            $token = $this->getToken();
            $rs = json_decode($this->getRs($token));
    
            $newSchedules = [];
            $counter1 = 0;
            foreach ($rs as $hospital) {
                $get = $this->getSpecDoctorByPoli($token, ['group' => true, 'rsid' => $hospital->rsid]);
                $data = json_decode($get);
                foreach ($data as  $value) {
                    $doctors = $value->doctors ?? null;
                    if ($doctors) {
                        # code...
                        foreach ($doctors as  $doctor) {
                            $doctor_id = $doctor->pid;
                            $doctor_name = $doctor->dokter;
                            foreach ($doctor->schedules as  $schedules) {
                                $poli = $schedules->poliklinik;
                                $tmpJadwal = [];
                                foreach ($schedules->schedule as $jadwal) {
                                    $tmp = $jadwal;
                                    $tmp->poli = $poli;
                                    $tmpJadwal[] = $tmp;
                                }
                                $tmpschedule = [
                                    'rsid' => $hospital->rsid,
                                    'doctor_id' => $doctor_id,
                                    'name' => $doctor_name,
                                    'jadwal' => json_encode($tmpJadwal)
                                ];
        
                                //dokter uda ada
                                if(!empty($newSchedules[$hospital->rsid][$doctor_id]['jadwal'])){
                                    $currentJadwal = json_decode($newSchedules[$hospital->rsid][$doctor_id]['jadwal']);
                                    $mergeJadwal = array_merge($currentJadwal, $tmpJadwal);
                                    $newSchedules[$hospital->rsid][$doctor_id]['jadwal'] = json_encode($mergeJadwal);
                                    
                                //Dokter belum ada
                                }else{
                                    $newSchedules[$hospital->rsid][$doctor_id] = $tmpschedule;
                                    $counter1++;
        
                                }
                            }
                        }
                    }
                }
            }
    
            $tmpinsert = [];
            $counter2 = 0;
            foreach ($newSchedules as $rs) {
                // $tmpdoctor;
                foreach ($rs as $doctor) {
                    // $tmpdoctor = $doctor;
                    $tmpinsert[] = $doctor;
                    $counter2++;
                }
                
            }
    
            echo "<p>Counter1= $counter1 & Counter 2 = $counter2</p>";
            echo '<pre>';
            // print_r($tmpinsert);
            print_r($newSchedules);
            echo '</pre>';
            $this->mscheduler->insertBulk($tmpinsert);
        }else{
            log_message('info', 'Someone access /data/loadapi2, with unmatched key');
            show_404();
        }
    }
    
    private function specialist($token){
        $get = $this->curl_get('rs', $token);
        return $get;
    }

    private function getRs($token){
        $get = $this->curl_get('rs', $token);
        return $get;
    }

    private function allSpecialistByTmGroup($token){
        $get = $this->curl_get('AllSpecialistByTmGroup', $token);
        return $get;
    }

    private function getGrouping($token){
        $get = $this->curl_get('AllSpecialistByTmGroup', $token);
        return $get;
    }

    private function getSpecDoctorByPoli($token, $param){
        $get = $this->curl_get_param('SpecialistDoctorsSchedulePoli', $token, $param);
        return $get;
    }

    function curl_get($suffix_endpoint = '', $token){
        if(empty($suffix_endpoint)){
            throw new Exception('Please specify endpoint suffix');
        }

        //Set endpoint
        $api_url = $this->api_base_url.'/'.$suffix_endpoint;


        $ch =  curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer '.$token.''
            ),
        ));

        $get = curl_exec($ch);
        curl_close($ch);
        return $get;
    }

    function curl_get_param($suffix_endpoint = '', $token, $param){
        if(empty($suffix_endpoint)){
            throw new Exception('Please specify endpoint suffix');
        }

        //Set endpoint
        $api_url = $this->api_base_url.'/'.$suffix_endpoint;
        // var_dump($api_url);

        $ch =  curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer '.$token.''
            ),
            CURLOPT_POSTFIELDS => json_encode($param),
        ));

        $get = curl_exec($ch);
        curl_close($ch);
        return $get;
    }

    public function dumpConfig()
    {
        echo "<h1> HELL YEAH </h1>";
        // $config = $this;
        // var_dump($config);
        // die();
    }
}