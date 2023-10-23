<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Remote extends CI_Controller
{

    //API Base URL
    private $api_base_url = API_URL;


    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function login()
    {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if (! $api_token = $this->cache->get('api_token')) {
            $token = my_token();
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->save('api_token', $token, 120);

            echo json_encode($token);
            exit;
            // return $token['token'];
        }

        echo json_encode($api_token);
        die();
    }

    private function getToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-webservice.teramobile.app/api/v1/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'username=brawijaya&password=braw_cQbDm5dK78',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNzg3ZTMzYWFhOWJiODA3ZmNiNzcxYjFiNTVmMGUwMWQ1NTE4MDViZGM2YWEwZjM2NDgwMmY0ZjE4NmE0MzI5ZjU4M2Y1NzdkYjFiOGFlNzQiLCJpYXQiOjE2MjcwMTM1NTAsIm5iZiI6MTYyNzAxMzU1MCwiZXhwIjoxNjU4NTQ5NTUwLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.xlfvXBuwuhmfav004F-9o73LffEDEyrMzIvstRIvvw05ftjaJt4eBcSRm1nPz-AUiWAw2xrPYjnlDhmNmeV1fA',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $toArray = json_decode($response, true);
        return $toArray['token'];
    }


    private function dataToken()
    {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if (! $api_token = $this->cache->get('api_token')) {
            $token = my_token();
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->save('api_token', $token, 120);

            return $token['token'];
        }
        return $api_token['token'];
    }

    public function match_rm()
    {
        $curl = curl_init();

        $token = $this->dataToken();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/passing',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "requestid": "verifikasi_rm",
            "group": true,
            "rsid": 7,
            "data": {
                "pid": "23-92-93",
                "birth_date": "2000-12-30"
            }
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function grouping()
    {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if (! $grouping = $this->cache->get('grouping')) {
            $curl = curl_init();

            $token = $this->dataToken();

            curl_setopt_array($curl, array(
                CURLOPT_URL => API_URL . '/AllSpecialistByTmGroup',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            $groupingRes = json_decode($response);
            // $response_to_array = json_decode($response,true);
            curl_close($curl);

            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->save('grouping', $groupingRes, 10800);

            // log_message('info', 'response from remote_grouping is:'. json_encode($response));

            echo json_encode($groupingRes);
            die();
        }

        echo json_encode($grouping);
        die();


        // $data = $this->mapidata->getApi()->row();
        // echo $data->grouping;
        // $this->load->library('session');
        $curl = curl_init();

        $token = $this->dataToken();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/AllSpecialistByTmGroup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        // $response_to_array = json_decode($response,true);
        curl_close($curl);

        log_message('info', 'response from remote_grouping is:'. json_encode($response));

        echo $response;
    }

    public function grouping_new()
    {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if (! $grouping = $this->cache->get('grouping')) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => API_URL.'/allSpecialistByTmGroup',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: '.API_AUTH
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $groupingRes = json_decode($response);

            // $response_to_array = json_decode($response,true);
            curl_close($curl);

            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->save('grouping', $groupingRes, 10800);

            // log_message('info', 'response from remote_grouping is:'. json_encode($response));

            echo json_encode($groupingRes);
            die();
        }

        echo json_encode($grouping);
        die();
    }


    public function rs()
    {
        $data = $this->mapidata->getApi()->row();
        echo $data->hospital;
    }

    public function specialistbyrsid($id)
    {
        $curl = curl_init();

        $token = $this->dataToken();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-webservice.teramobile.app/api/v1/specialist',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{
            "group": true,
            "rsid": ' . $id . '
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        $response_to_array = json_decode($response, true);
        curl_close($curl);

        return $response_to_array;
    }

    public function specialist()
    {

        echo 'null';
        die();

        $data = $this->mapidata->getApi()->row();
        $rs = json_decode($data->specialist, true);

        for ($i = 0; $i < count($rs); $i++) {
            $rsid[$i] = $rs[$i]['rsid'];

            // echo "<pre>";
            // print_r($this->specialistbyrsid($rsid[$i]));
            // echo "</pre>";

            // $save[$i] = array("rsid" => $rsid[$i], "specialist" => $this->specialistbyrsid($rsid[$i]));
        }

        echo json_encode($data->specialist);
    }


    public function specialistallrs()
    {
        $data = $this->mapidata->getApi()->row();
        echo $data->specialist_all_rs;
    }


    public function doctors()
    {
        $rsid   = $this->input->get('rsid', true);
        $tmid   = $this->input->get('tmid', true);
        if (isset($tmid)) {
            $get    = $this->curl_get('doctorsbyspecialist/' . $tmid);
            echo json_encode($get);
        } else {
            throw new \Exception('tmid is required.');
        }
    }


    public function doctorsbyrsspecialist()
    {
        $tmid   = $this->input->get('tmid', true);
        if (isset($tmid)) {
            $get    = $this->curl_get('DoctorsByRsSpecialist/?tmid=' . $tmid);
            echo json_encode($get);
        } else {
            throw new \Exception('tmid is required.');
        }
    }

    public function schedule_data($pid, $rsid, $token = null)
    {
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => API_URL.'/schedulebyPid?group=true&rsid=7&pid=6970',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json',
        //         'Authorization: '.API_AUTH
        //     ),
        // ));
        

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
        $token = $this->dataToken();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/schedulebyPid/' . $pid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            // CURLOPT_HEADER  => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode([
                'group' => true,
                'rsid' => $rsid
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        $decode = json_decode($response, true);
        // if ($status != 200) {
        //     return $this->schedule_data($pid, $rsid);
        // }

        curl_close($curl);

        // return $decode;
        echo json_encode($decode);
    }

    public function schedule()
    {
        $manual = 1;
        $pid   = $this->input->get('pid', true);
        $rsid  = $this->input->get('rsid', true);
        $token  = $this->input->get('token', true);
        if (isset($pid)) {
            // if ($manual) {
            //     $data = $this->mscheduler->get_schedule($pid, $rsid)->row();
            //     $jadwal = json_decode($data->jadwal);
            //     $response = [
            //         'dokter' => $data->name,
            //         'pid' => $data->doctor_id,
            //         'cuti' => [],
            //         'jadwal' => $jadwal
            //     ];
            //     echo json_encode($response);
            // }else{
            $get = $this->schedule_data($pid, $rsid, $token);
            // if(isset($get['error'])){
            //     $get = $this->schedule_data($pid, $rsid), $token;
            // }
            echo json_encode($get);
            // }
        } else {
            throw new \Exception('pid is required.');
        }
    }

    public function polibydoctor()
    {
        $pid   = $this->input->get('pid', true);
        if (isset($pid)) {
            $get    = $this->curl_get('polibydoctor/' . $pid);
            echo json_encode($get);
        } else {
            throw new \Exception('pid is required.');
        }
    }

    private function saveAppointmentToDb($data)
    {
        $this->db->insert('bwch_appointments',[
            'name' => $data['name'],
            'email' => $data['email'],
            'birthdate' => $data['birthdate'],
            'birthplace' => $data['birthplace'],
            'alamat' => $data['alamat'],
            'rsname' => $data['rsname'],
            'hp' => $data['hp'],
            'sex' => $data['sex'],
            'appointment_date' => $data['tanggal'],
            'dsid' => $data['dsid'],
            'rsid' => $data['rsid'],
            'pid' => $data['pid'],
            'start_hour' => $data['start_hour'],
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    private function updateAppointment($data, $id)
    {
        if ($id != 0 && $id > 0) {
            $this->db->where('id', $id);
            $this->db->update('bwch_appointments', $data);
        }
    }


    public function submitappointment()
    {
        $id = 0;
        // check otp validation is can_make_appointment
        if ($_SESSION['can_make_appointment'] == false) {
            $response = [
                'message' => "Anda tidak dapat melakukan proses ini! karena alasan keamanan sistem!"
            ];
            echo json_encode($response);
            die();
        } else {
            // FIXME: check patient type old | new

            $array_data = $_REQUEST['data'];

            $id = $this->saveAppointmentToDb($array_data);

            if (!$array_data) {
                echo json_encode([
                    'pesan' => 'data tidak lengkap'
                ]);
                die();
            }

            $email = $array_data['email'];
            $phone = $array_data['hp'];
            $start_hour = $array_data['start_hour'];

            $get = $this->curl_post('appointment', $array_data, $this->dataToken());

            log_message('info', 'response from remote_grouping is:'. json_encode($get));

            $this->updateAppointment([
                'response' => json_encode($get)
            ], $id);

            if (!empty($get['data']['kode_booking'])) {

                //Send email
                $this->updateAppointment([
                    'success' => 1
                ], $id);

                
                if (!empty($email) && !empty($get['data']['kode_booking'])) {
                    $email = $this->submitappointment_email($email, $array_data, $get['data'], $start_hour);
                    $get['email_status'] = $email;
                }

                try {
                    $waAntasari = null;
                    $waDurenTiga = null;
                    $wa = $this->submitappointment_whatsapp($phone, $array_data, $get['data'], $start_hour);
                    if ($array_data['rsid'] == 7) {
                        $waAntasari = $this->submitappointment_whatsapp_antasari('081319597337', $array_data, $get['data'], $start_hour);
                    }
                    if ($array_data['rsid'] == 9) {
                        $waDurenTiga = $this->submitappointment_whatsapp_duren_tiga('087774109225', $array_data, $get['data'], $start_hour);
                    }
                    $get['whatsapp'] = $wa;
                    $get['whatsapp_antasari'] = $waAntasari;
                    $get['whatsapp_duren_tiga'] = $waDurenTiga;
                } catch (\Throwable $th) {
                    $get['errors_whatsapp'] = $th->getMessage();
                }
            }
            unset(
                $_SESSION['otp_created_at']
            );

            echo json_encode($get);
        }
    }

    /**
     * Check tipe pasien sekaligus melakukan form validation dan mengembalikan data berupa array
     *
     * @return array
     */
    private function check_patient_data()
    {
        $patientType = $this->input->post('patient_type', true); //old = 0, new = 1
        if ($patientType == "new") /* new patient */ {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('birthdate', 'Birth Date', 'required');
            $this->form_validation->set_rules('birthplace', 'Birth Place', 'required');
        } else {
            $this->form_validation->set_rules('mrid', 'Mrid', 'required');
        }

        $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules(
            'insurence',
            'Asuransi',
            'required',
            [
                'required' => 'Please select your prefered insurance'
            ]
        );
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_message('valid_email', 'Please insert a valid email');

        if ($this->form_validation->run() == FALSE) {
            $errArray = array_values($this->form_validation->error_array());
            $response = [
                'errors' =>  $errArray[0],
            ];

            header($_SERVER["SERVER_PROTOCOL"] . " 442 validation_error", true, 442);
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }

        //validation rule
        $email = $this->input->post('email', true);
        $phone = $this->input->post('mobile_phone', true);

        if ($patientType == "old") {
            //data for old patient
            $array_data = array(
                'mrid'          => $this->input->post('mrid', true),

                'pid'           => $this->input->post('pid', true),
                'rsid'          => $this->input->post('rsid', true),
                'rsname'        => $this->input->post('rsname', true),
                'dsid'          => $this->input->post('dsid', true),
                'tanggal'       => $this->input->post('date', true),
                'hp'            => $phone,
                'email'         => $email,
                'alamat'        => $this->input->post('address', true),
                'birthdate'     => $this->input->post('birthdate', true),
                'asuransi'      => $this->input->post('insurence', true),
            );

            //? get data from mrid
            $response = $this->check_old_patient($array_data['rsid'], $this->input->post('mrid', true), $array_data['birthdate']);
            if (is_array($response)) {
                if ($response["message"] == 'not found') {
                    $response["message"] = 'patient_not_found';
                    header($_SERVER["SERVER_PROTOCOL"] . " 442 patient_not_found", true, 442);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    die();
                } else {
                    $response["message"] = 'ok';
                    $response['data'] = array_merge($array_data, array(
                        'name'          => $response['data']['name'],
                        'sex'           => $response['data']['gender'],
                        'birthplace'    => $response['data']['tempatlahir'],
                    ));
                }
            }else{
                header($_SERVER["SERVER_PROTOCOL"] . " 442 patient_check_error", true, 442);
                header('Content-Type: application/json');
                echo json_encode([
                    'message' => 'Please try again',
                    'status' => false
                ]);

                die();
            }

        } else {
            //data for new patient
            $array_data = array(
                'pid'           => $this->input->post('pid', true),
                'rsid'          => $this->input->post('rsid', true),
                'rsname'        => $this->input->post('rsname', true),
                'dsid'          => $this->input->post('dsid', true),
                'tanggal'       => $this->input->post('date', true),
                'name'          => $this->input->post('name', true),
                'sex'           => $this->input->post('gender', true),
                'hp'            => $phone,
                'email'         => $email,
                'alamat'        => $this->input->post('address', true),
                'birthplace'    => $this->input->post('birthplace', true),
                'birthdate'     => $this->input->post('birthdate', true),
                'asuransi'      => $this->input->post('insurence', true),
            );

            $response["message"] = 'ok';
            $response['data'] = $array_data;
        }

        return $response;
    }
    /**
     * check if old patient data exist return response data if exist, if not return false.
     *
     * @param string $rsid
     * @param string $mrid
     * @param string $birthdate
     * @return array | false
     */
    private function check_old_patient($rsid, $mrid, $birthdate)
    {
        $get_valid = $this->passing_mrid($rsid, $mrid, $birthdate);

        $response = $get_valid;

        // Dapatkan data pasien dari mrid
        return $response;
    }

    private function passing_mrid($rsid, $mrid, $birth_date)
    {
        $token = $this->dataToken();
        $url = $this->api_base_url . '/passing';
        $curl = curl_init();
        $data = [
            "requestid" => "verifikasi_rm",
            "group" => true,
            "rsid" => $rsid,
            "data" => [
                "pid" => $mrid,
                "birth_date" => $birth_date
            ]
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token . ''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }


    public function dummysubmitappointment()
    {
        $pid = $this->input->post('pid', true);
        $array_data = array(
            'pid'           => 5055,
            'rsid'          => 7,
            'dsid'          => 2644,
            'tanggal'       => '2021-05-05',
            'name'          => 'asd',
            'sex'           => 'M',
            'hp'            => '0812312312',
            'alamat'        => 'Jakarta',
            'birthplace'    => 'Jakarta',
            'birthdate'     => '2021-05-22',
            'asuransi'      => 1,
        );

        // echo http_build_query($array_data);
        // exit;
        $get = $this->curl_post('appointment', $array_data);
        echo json_encode($get);
    }

    private function submitappointment_email($user_email, $array_data, $response, $start_hour)
    {
        // telnet mailsystems.brawijayahospital.com
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com', # Change this
            'smtp_crypto' => 'tls', # Add this
            'smtp_port' => 587,
            'smtp_user' => 'dc3brawijaya@gmail.com',
            'smtp_pass' => 'muqmjewkticesdaj',
            'charset'   => 'utf-8',
            'mailtype'  => 'html',
            'newline'   => "\r\n",
            'crlf'   => "\r\n",
            'wordwrap'  => TRUE
        );

        $schedule_doctor = $array_data['tanggal'] . ' ' . $start_hour;

        $html = '
            <html>
                <body>
                    Halo ' . $array_data['name'] . ',<br><br>
                    Berikut ini data kode booking anda:<br><br>
                    Booking Code: ' . $response['kode_booking'] . '<br>
                    Poli: ' . $response['poli'] . '<br>
                    Nama Dokter: ' . $response['nama_dokter'] . '<br>
                    Jadwal Praktek: ' . $schedule_doctor . '<br>
                    Waktu Estimasi Pelayanan Poli: ' . $response['tgl_janji'] . '<br>
                    Asuransi: ' . $response['asuransi'] . '<br>
                    Antrian: ' . $response['queue'] . '<br><br>
                    Terima Kasih
                </body>
            </html>
        ';

        try {
            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->from('no-reply@brawijayahospital.com', 'Brawijaya Clinic & Hospital');
            $this->email->to($user_email);
            $this->email->subject('[#' . $response['kode_booking'] . '] Appointment: Brawijaya Clinic & Hospital');
            $this->email->message($html);
            if (!$this->email->send()) {
                $this->email->print_debugger(array('headers'));
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }

        return 'sent';

    }


    public function wa1()
    {
        $array_data = array(
            'name'      => 'Dean Abner Julian',
            'rsname'    => 'Brawijaya Hospital Antasari',
        );
        $response = array(
            'nama'          => 'Dean Abner Julian',
            'kode_booking'  => '21Y05VBLT',
            'nama_dokter'   => 'Abdul, dr. SpS',
            'tgl_janji'     => '2021-05-17 07:00:00',
            'queue'       => '2'
        );
        $start_hour = '08:00';
        $wa = $this->submitappointment_whatsapp('08121856261', $array_data, $response, $start_hour);
        $json = json_decode($wa);
        print_r($json);
    }

    private function submitappointment_whatsapp($phone, $array_data, $response, $start_hour)
    {
        $tmplower   = true;
        $rsname     = $tmplower ? strtolower($array_data['rsname']) : $array_data['rsname'];
        $rsname     = ucwords($rsname);
        $schedule_doctor = $array_data['tanggal'] . ' ' . $start_hour;
        $message_raw = "Konfirmasi Booking.\nKode Booking: *" . $response['kode_booking'] . "*.\nNama: " . $array_data['name'] . ",\nUnit: " . $rsname . ",\nDokter: " . $response['nama_dokter'] . ",\nJadwal Praktek: " . $schedule_doctor . ",\nWaktu Estimasi Pelayanan Poli: " . $response['tgl_janji'] . ",\nAntrian: " . $response['queue'] . "\nEstimasi waktu dapat berubah sesuai dengan konfirmasi dokter.\n\nPesan ini adalah Pesan Otomatis, harap tidak membalas pesan ke nomer ini.\n\nKonfirmasi kehadiran ".base_url('patient-confirmation/'.$response['peid']);
        $message = urlencode($message_raw);
        //Send data
        $token = 'hgkGrbkSyWxeB2Vshko3KDncstk40rT5QjmCseheSnE6RqieOYeS1ZpEd0xfnFqs';
        $url = "https://kudus.wablas.com/api/send-message?token=" . $token . "&phone=" . $phone . "&message=" . $message;


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    private function submitappointment_whatsapp_antasari($phone, $array_data, $response, $start_hour)
    {
        $tmplower   = true;
        $rsname     = $tmplower ? strtolower($array_data['rsname']) : $array_data['rsname'];
        $rsname     = ucwords($rsname);
        $schedule_doctor = $array_data['tanggal'] . ' ' . $start_hour;
        $message_raw = "Konfirmasi Appointment Website.\nKode Booking: *" . $response['kode_booking'] . "*.\nNama: " . $array_data['name'] . ",\nUnit: " . $rsname . ",\nDokter: " . $response['nama_dokter'] . ",\nJadwal Praktek: " . $schedule_doctor . ",\nWaktu Estimasi Pelayanan Poli: " . $response['tgl_janji'];
        $message = urlencode($message_raw);
        //Send data
        $token = 'hgkGrbkSyWxeB2Vshko3KDncstk40rT5QjmCseheSnE6RqieOYeS1ZpEd0xfnFqs';
        $url = "https://kudus.wablas.com/api/send-message?token=" . $token . "&phone=" . $phone . "&message=" . $message;


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    private function submitappointment_whatsapp_duren_tiga($phone, $array_data, $response, $start_hour)
    {
        $tmplower   = true;
        $rsname     = $tmplower ? strtolower($array_data['rsname']) : $array_data['rsname'];
        $rsname     = ucwords($rsname);
        $schedule_doctor = $array_data['tanggal'] . ' ' . $start_hour;
        $message_raw = "Konfirmasi Appointment Website.\nKode Booking: *" . $response['kode_booking'] . "*.\nNama: " . $array_data['name'] . ",\nUnit: " . $rsname . ",\nDokter: " . $response['nama_dokter'] . ",\nJadwal Praktek: " . $schedule_doctor . ",\nWaktu Estimasi Pelayanan Poli: " . $response['tgl_janji'];
        $message = urlencode($message_raw);
        //Send data
        $token = 'hgkGrbkSyWxeB2Vshko3KDncstk40rT5QjmCseheSnE6RqieOYeS1ZpEd0xfnFqs';
        $url = "https://kudus.wablas.com/api/send-message?token=" . $token . "&phone=" . $phone . "&message=" . $message;


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }


    public function testwa()
    {

        $message_raw = "Konfirmasi \nBooking.\nKode Booking: *23T01HMQG*.\nNama: Test,\nUnit: Brawijaya Hospital Antasari,\nDokter: Rika Lesmana, dr Sp.B,\nJadwal Praktek: 2023-01-02 13:00,\nWaktu Estimasi Pelayanan Poli: 2023-01-02 13:15:00,\nAntrian:2\nEstimasi waktu dapat berubah sesuai dengan konfirmasi dokter";

        $message = urlencode($message_raw);
        $token = "hgkGrbkSyWxeB2Vshko3KDncstk40rT5QjmCseheSnE6RqieOYeS1ZpEd0xfnFqs";

        // echo $message; die();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://kudus.wablas.com/api/send-message?token=' . $token . '&message=' . $message . '&phone=08121856261',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        die();

        $telepon = '082311354631';
        $curl = curl_init();
        $token = "hgkGrbkSyWxeB2Vshko3KDncstk40rT5QjmCseheSnE6RqieOYeS1ZpEd0xfnFqs";
        $data = [
            'phone' => "$telepon",
            'message' => "test dari qa",
        ];

        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        // $curl = curl_init();

        // $token = "LuiKwBsycmvlpNmH8dWEfCZY0rpclpAXebUGrOESLaifO7sh5uFbUXAR2IU8HpBl";
        // $data = [
        //     'phone' => '08121856261', //'6281387265858', //'6281387265858',
        //     'message' => 'tester',
        // ];

        // curl_setopt(
        //     $curl,
        //     CURLOPT_HTTPHEADER,
        //     array(
        //         "Authorization: $token",
        //     )
        // );
        // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($curl, CURLOPT_URL, "https://kacangan.wablas.com/api/send-message");
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        // $result = curl_exec($curl);
        // curl_close($curl);

        echo $result;
    }

    public function testmail()
    {
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://mailsystems.brawijayahospital.com',
            'smtp_port' => 465,
            'smtp_user' => 'no-reply@mailsystems.brawijayahospital.com',
            'smtp_pass' => 'brawijayahealthcare2',
            'charset'   => 'utf-8',
            'mailtype'  => 'html',
            'newline'   => '\r\n',
        );


        $html = '
            <html>
                <body>
                    Halo Julian,<br><br>
                    Berikut ini data kode booking anda:<br><br>
                    Booking Code: 12123123 <br>
                    Poli: Klinik<br>
                    Terima Kasih
                </body>
            </html>
        ';

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('no-reply@brawijayahospital.com', 'Brawijaya Clinic & Hospital');
        $this->email->to('dabnerjulian@yahoo.com');
        $this->email->subject('Appointment: Brawijaya Clinic & Hospital');
        $this->email->message($html);
        $this->email->send();
        $this->email->print_debugger(array('headers', 'subject', 'body'));
    }



    public function doctorsbyspecialist()
    {
        $tmid = $this->input->get('tmid', true);
        $get = $this->curl_get('doctorsbyspecialist/' . $tmid);
        echo json_encode($get);
    }


    public function doctorsgroup()
    {
        $tmid = $this->input->get('tmid', true);
        $get = $this->curl_get('DoctorsByRsSpecialist?tmid=' . $tmid);
        echo json_encode($get);
    }


    function curl_get($suffix_endpoint = '', $post_fields = null)
    {
        if (empty($suffix_endpoint)) {
            throw new Exception('Please specify endpoint suffix');
        }


        //Set endpoint
        $api_url = $this->api_base_url . '/' . $suffix_endpoint;
        // print_r($api_url);
        // print_r($post_fields);

        /* --- Token Per 04/Maret/2021 14:58 WIB Expired: 2022 ---*/
        // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNWNiMGVjZDNiMDRmODdmNWM2OWExZDNjMjhmNWU3NzAyMTgwN2RlOTAxZTM4OGI3MmZiZDJiZTg1YTA5Zjg2YTg4NTUzODk2ZjQ1ZWMyMmMiLCJpYXQiOjE2MTQ4NDQ1MjIsIm5iZiI6MTYxNDg0NDUyMiwiZXhwIjoxNjQ2MzgwNTIyLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.fBLVPR5DmGcJxB8aPCPSOxOzADrz3cd08WMmcZLyUt3RanKbNvAQaIrsEYkG79d9FdVHCMmS3J30yydM3JWbwg";
        $token = $this->dataToken();


        $ch =  curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            // CURLOPT_HEADER  => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token . ''
            ),
        ));

        $get = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        if ($status != 200) {
            return $this->curl_get($suffix_endpoint, $post_fields);
        }


        curl_close($ch);
        if (!empty($post_fields) && is_array($post_fields)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_fields));
        }

        if (curl_errno($ch)) {
            $decode = "Error: " . curl_error($ch);
        } else {
            $decode = json_decode($get, true);
        }

        return $decode;
    }



    public function curl_post($suffix_endpoint, $post_fields, $token = null)
    {
        //Set endpoint and parameters
        $params = http_build_query($post_fields);
        $api_url = $this->api_base_url . '/' . $suffix_endpoint . '?' . $params;


        /* --- Token Per 04/Maret/2021 14:58 WIB Expired: 2022 ---*/
        // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNWNiMGVjZDNiMDRmODdmNWM2OWExZDNjMjhmNWU3NzAyMTgwN2RlOTAxZTM4OGI3MmZiZDJiZTg1YTA5Zjg2YTg4NTUzODk2ZjQ1ZWMyMmMiLCJpYXQiOjE2MTQ4NDQ1MjIsIm5iZiI6MTYxNDg0NDUyMiwiZXhwIjoxNjQ2MzgwNTIyLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.fBLVPR5DmGcJxB8aPCPSOxOzADrz3cd08WMmcZLyUt3RanKbNvAQaIrsEYkG79d9FdVHCMmS3J30yydM3JWbwg";
        if ($token == null) {
            $token = $this->dataToken();
        }

        $ch =  curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));

        $get = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        if (curl_errno($ch)) {
            $decode = "Error: " . curl_error($ch);
        } else {
            $decode = json_decode($get, true);
        }

        return $decode;
    }



    public function cronjob_get_token()
    {
        $username = 'brawijaya_devel';
        $password = 'Brawc88KKyxzF';
        $api_url  = "https://dev-api-webservice.teramobile.app/api/v1/login?username=" . $username . "&password=" . $password;

        $headers =  array(
            'Content-Type: application/json',
            'Accept: application/json'
        );

        $ch =  curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $get        = curl_exec($ch);
        $decode     = json_decode($get, false);

        echo '<pre>';
        print_r($decode);
    }

    function cronjob_get_hospital_todb()
    {
        $decode = $this->curl_get('rs');

        if (count($decode) > 0) {
            $truncate_hospital = $this->msync->truncate('hospital_tera');

            if ($truncate_hospital) {
                $insert_hospital = $this->msync->insert_batch('hospital_tera', $decode);;

                if ($insert_hospital) {
                    $arrayP = array();
                    $arrayPH = array();
                    $arraySH = array();

                    $exec = 0;
                    foreach ($decode as $row => $value) {
                        $exec++;
                        $rsid = $value['rsid'];

                        $getPoli = $this->cronjob_get_poli($rsid);
                        foreach ($getPoli as $keyP => $valueP) {
                            $xx = 0;
                            $valueP['rsid'] = $rsid;

                            $arrayPH[] = $valueP;

                            /* -- */
                            foreach ($arrayP as $row) {
                                if ($row['did'] == $valueP['did']) {
                                    $xx = 1;
                                    break;
                                }
                            }

                            if ($xx == 0) {
                                $arrayP[] = $valueP;
                            }
                            /* -- */
                        }

                        $getSpecialis = $this->cronjob_get_specialist($rsid);
                        foreach ($getSpecialis as $keyS => $valueS) {
                            $valueS['rsid'] = $rsid;

                            $arraySH[] = $valueS;
                        }

                        // redirect('sync/cronjob_get_poli_todb/0');
                    }

                    if ($exec > 0) {
                        $status = 0;

                        $truncate_poliH = $this->msync->truncate('poli_hospital_tera');

                        if ($truncate_poliH) {
                            $insert_poliH   = $this->msync->insert_batch('poli_hospital_tera', $arrayPH);

                            if ($insert_poliH) {
                                $status++;
                                echo 'Poli Data : Success! <br>';
                                echo '<pre>';
                                print_r($arrayPH);
                            } else {
                                echo 'FAILED! No Data (Poli Hospital) Insert';
                            }
                        }

                        $truncate_spesialis = $this->msync->truncate('spesialis_tera');

                        if ($truncate_spesialis) {
                            $insert_spesialis   = $this->msync->insert_batch('spesialis_tera', $arraySH);

                            echo '<br>========================================<br>';

                            if ($insert_spesialis) {
                                $status++;

                                echo 'Spesialis Data : Success! <br>';
                                echo '<pre>';
                                print_r($arraySH);
                            } else {
                                echo 'FAILED! No Data (Spesialis Hospital) Insert';
                            }
                        }

                        if ($status > 1) {
                            echo '<br>========================================<br>';
                            echo 'FINISHED!';

                            // redirect('sync/cronjob_get_doctor_todb');
                        }
                    }
                } else {
                    echo "FAILED! No Data Insert!";
                }
            }
        } else {
            echo 'FAILED! Count Data Hospital : 0';
        }
    }

    function cronjob_get_doctor_todb($mode, $n = 0, $jmldata = 0)
    {
        $arrayD = array();
        $exec = 0;

        $getHospitalDB = $this->msync->get('hospital_tera')->result_array();

        // foreach ($getHospitalDB as $row) {
        $countHospital = count($getHospitalDB);

        if ($n < count($getHospitalDB)) {
            $rsid = $getHospitalDB[$n]['rsid'];

            $getPoliDB = $this->msync->getByWhere('poli_hospital_tera', array('rsid' => $rsid))->result_array();

            foreach ($getPoliDB as $rowP) {

                $poliid = $rowP['did'];
                $getDoctor = $this->cronjob_get_doctor($rsid, $poliid);

                //echo count($getDoctor);
                //echo '<br>-------'. $rowP['did'] . '-------<br>';

                if (!isset($getDoctor) || count($getDoctor) == 0) {
                    $sn = $n + 1;

                    $text = 'Force Stop! Loop RS: ' . $sn . ' of ' . $countHospital . ' Loop RS | RS: ' . $rsid . '-' . $getHospitalDB[$n]['nama'] . ' | Poli: ' . $rowP['did'] . '-' . $rowP['name_short'];

                    if ($n == $sn) {
                        $text .= ' | GET DATA Last Loop RS <a href="' . base_url('sync/get_doctor_todb/' . $rsid) . '" target="_blank">Click Here</a>';
                    } else {
                        $text .= ' <br> List RS failed execute: <br>';

                        for ($i = $n; $i < $countHospital; $i++) {
                            $text .= $sn . ' - ' . $getHospitalDB[$i]['nama'] . ' -> <a href="' . base_url('sync/get_doctor_todb/' . $getHospitalDB[$i]['rsid']) . '" target="_blank">Click Here to Get Data</a> <br>';
                        }
                    }

                    die($text);
                }

                foreach ($getDoctor as $keyD => $valueD) {
                    $exec++;
                    $valueD['rsid'] = $rsid;
                    $valueD['did']  = $poliid;

                    $arrayD[] = $valueD;
                }
            }

            if ($exec > 0) {
                //echo '<pre>'; print_r($arrayD);

                if ($mode == 'save') {
                    if ($n == 0) {
                        $truncate_doctor = $this->msync->truncate('doctor_tera_temp');
                    }

                    $n++;

                    $jmldata = $jmldata + count($arrayD);
                    $insert_doctor_temp = $this->msync->insert_batch('doctor_tera_temp', $arrayD);

                    if ($insert_doctor_temp) {
                        // echo '<pre>'; print_r($arrayD);
                        redirect('sync/cronjob_get_doctor_todb/' . $mode . '/' . $n . '/' . $jmldata);
                    } else {
                        $xn = $n - 1;
                        echo 'FAILED! No Data (Doctor ' . $xn . ') Insert';
                    }
                } else {
                    if ($n == 0) {
                        $truncate_doctor = $this->msync->truncate('doctor_tera');
                    }

                    $n++;

                    $jmldata = $jmldata + count($arrayD);
                    $insert_doctor = $this->msync->insert_batch('doctor_tera', $arrayD);

                    if ($insert_doctor) {
                        // echo '<pre>'; print_r($arrayD);
                        redirect('sync/cronjob_get_doctor_todb/' . $mode . '/' . $n . '/' . $jmldata);
                    } else {
                        $xn = $n - 1;
                        echo 'FAILED! No Data (Doctor ' . $xn . ') Insert';
                    }
                }
            }
        }
        // }

        else {
            if ($mode == 'save') {
                $truncate_doctor = FALSE;

                $getDoctorTemp = $this->msync->get('doctor_tera_temp')->result_array();

                if ($count == $jmldata) {
                    $truncate_doctor = $this->msync->truncate('doctor_tera');
                }

                if ($truncate_doctor) {
                    $insert_doctor = $this->msync->insert_batch('doctor_tera', $getDoctorTemp);

                    if ($insert_doctor) {
                        echo 'Selesai insert dokter. Total Data :' . $jmldata;
                    } else {
                        echo 'Gagal insert dokter. Total Data :' . $jmldata;
                    }
                } else {
                    echo 'Jumlah Data Aktif dan Temporary Berbeda';
                }
            } else {
                echo 'Selesai insert dokter. Total Data :' . $jmldata;
            }
        }
    }

    function get_doctor_todb($rsid)
    {
        $arrayD = array();
        $exec = 0;

        $getPoliDB = $this->msync->getByWhere('poli_hospital_tera', array('rsid' => $rsid))->result_array();

        if (!isset($getPoliDB) || count($getPoliDB) == 0) {
            die('Force Stop! Failed Get Poli!');
        }

        foreach ($getPoliDB as $rowP) {

            $poliid = $rowP['did'];
            $getDoctor = $this->cronjob_get_doctor($rsid, $poliid);

            if (!isset($getDoctor) || count($getDoctor) == 0) {
                die('Force Stop! Failed Get Doctor!');
            }

            foreach ($getDoctor as $keyD => $valueD) {
                $exec++;
                $valueD['rsid'] = $rsid;
                $valueD['did']  = $poliid;

                $arrayD[] = $valueD;
            }
        }

        if ($exec > 0) {
            //echo '<pre>'; print_r($arrayD);

            $jmldata = count($arrayD);
            $deleteDoctorRS = $this->msync->delete('doctor_tera', array('rsid' => $rsid));

            if ($deleteDoctorRS) {
                $insert_doctor = $this->msync->insert_batch('doctor_tera', $arrayD);

                if ($insert_doctor) {
                    echo '<pre>';
                    print_r($arrayD);
                } else {
                    echo 'FAILED! No Data (Doctor) Insert';
                }
            } else {
                echo 'DELETE FAILED';
            }
        }
    }

    function cronjob_get_poli_todb($n)
    {
        $getHospital = $this->msync->get('hospital_tera')->result_array();

        $rsid = $getHospital[0]['rsid'];

        if ($n < count($getHospital)) {
            $getPoli = $this->cronjob_get_poli($rsid);

            if (count($getPoli) > 0) {
                if ($n == 0) {
                    $truncate_poli = $this->msync->truncate('poli_tera');
                } else {
                    $truncate_poli = TRUE;
                }

                if ($truncate_poli) {
                    $insert_poli = $this->msync->insert_batch('poli_tera', $getPoli);

                    if ($insert_poli) {
                        $n++;

                        redirect('sync/cronjob_get_poli_todb/' . $n);
                    } else {
                        echo "FAILED! No Data Insert!";
                    }
                }
            } else {
                echo 'FAILED! Count Data Poli : 0';
            }
        } else {
            echo 'Lanjut Spesialis';
        }
    }

    function cronjob_get_hospital()
    {
        $decode = $this->curl_get('rs');

        $arrMapurl = array(
            '7' => 'brawijayahospitalantasari',
            '8' => 'brawijayahospitalbojongsari',
            '9' => 'brawijayarsiadurentiga',
            //'10' => 'brawijayaclinickemang',
            '11' => 'brawijayaclinicbuahbatu',
            '19' => 'brawijayahospitalsaharjo',
        );

        $arrDBID = array(
            '7' => '3',
            '8' => '6',
            '9' => '4',
            //'10' = '1',
            '11' => '5',
            '19' => '7',
        );

        echo '<pre>';
        print_r($decode);

        if (count($decode) > 0) {
            $this->msync->insert_batch('hospital_tera', $decode);
            echo 'success';

            $arrData = array();
            $exec    = 0;

            // foreach ($decode as $row => $value) { $exec++;
            //     $rsid = $value['rsid'];

            //     $arrData[] = $value;

            //     // if(isset($arrDBID[$rsid])){
            //     //     $value['rs_dbid'] = $arrDBID[$rsid];
            //     //     $value['rs_dburl'] = $arrMapurl[$rsid];
            //     //     print_r($value);
            //     // }
            // }

            // print_r($decode);

            // if($exec > 0){
            //     return TRUE; //$this->msync->insert_batch('hospital_tera', $arrData);
            // }else{
            //     return FALSE;
            // }
        } else {
            echo 'failed';
        }
    }

    function cronjob_get_doctor($rsid = '', $poliid = '', $print = FALSE)
    {
        if (!empty($poliid) && $poliid != '') {
            $endpoint = 'doctorsbypoli/' . $poliid;
        } else {
            $endpoint = 'doctors';
        }

        if (!empty($rsid) && $rsid != '') {
            $parameter_rsid = 'rsid=' . $rsid;
        } else {
            $parameter_rsid = '';
        }

        if (isset($_GET['page'])) {
            $page = 'page=' . $_GET['page'] . '&';
        } else {
            $page = '';
        }

        $decode = $this->curl_get($endpoint . '?' . $page . 'group=true&' . $parameter_rsid);

        if ($print == 'true') {
            echo '<pre>';
            print_r($decode);
        } else {
            return $decode;
        }
    }

    function cronjob_get_poli($rsid = '', $print = FALSE)
    {
        if (!empty($rsid) && $rsid != '') {
            $parameter_rsid = 'rsid=' . $rsid;
        } else {
            $parameter_rsid = '';
        }

        $decode = $this->curl_get('poli?group=true&' . $parameter_rsid);

        if ($print == 'true') {
            echo '<pre>';
            print_r($decode);
        } else {
            return $decode;
        }
    }

    function cronjob_get_specialist($rsid = '', $print = FALSE)
    {
        if (!empty($rsid) && $rsid != '') {
            $parameter_rsid = 'rsid=' . $rsid;
        } else {
            $parameter_rsid = '';
        }

        $decode = $this->curl_get('specialist?group=true&' . $parameter_rsid);

        if ($print == 'true') {
            echo '<pre>';
            print_r($decode);
        } else {
            return $decode;
        }
    }

    function cronjob_test_schedule($rsid = '')
    {
        if (!empty($rsid) && $rsid != '') {
            $parameter_rsid = 'rsid=' . $rsid;
        } else {
            $parameter_rsid = '';
        }

        $dataDoctor = $this->curl_get('schedulebyDP/8/2942?group=true&' . $parameter_rsid);

        echo '<pre>';
        print_r($dataDoctor);
    }

    function cronjob_get_schedule($rsid = '')
    {
        $data = array();

        if (!empty($rsid) && $rsid != '') {
            $parameter_rsid = 'rsid=' . $rsid;
        } else {
            $parameter_rsid = '';
        }

        $dataPoli = $this->curl_get('poli?group=true&' . $parameter_rsid);

        echo '<pre>';
        $i = 0;
        foreach ($dataPoli as $row => $value) {
            $data[$i] = $value;

            $dataDoctor = $this->curl_get('doctorsbypoli/' . $value['did'] . '?group=true&' . $parameter_rsid);

            if (count($dataDoctor) > 0) {
                $ic = 0;
                foreach ($dataDoctor as $crow => $cvalue) {
                    $data[$i]['doctor'][$ic] = $cvalue;

                    $dataSchedule = $this->curl_get('schedulebyDP/' . $value['did'] . '/' . $cvalue['pid'] . '?group=true&' . $parameter_rsid);

                    if (count($dataSchedule) > 0) {
                        foreach ($dataSchedule as $srow => $svalue) {
                            $data[$i]['doctor'][$ic]['schedule'] = $svalue;
                        }
                    }

                    $ic++;
                }
            }

            $i++;
        }

        print_r($data);
    }

    function cronjob_sync_schedule()
    {
        $decode = $this->curl_get('rs');

        $arrSPID    = $this->data_specialist();
        $arrSPName  = $this->data_specialist('name');

        $arrMapurl = array(
            '7' => 'brawijayahospitalantasari',
            '8' => 'brawijayahospitalbojongsari',
            '9' => 'brawijayarsiadurentiga',
            // '10' => 'brawijayaclinickemang',
            '11' => 'brawijayaclinicbuahbatu',
            '19' => 'brawijayahospitalsaharjo',
        );

        $arrDBID = array(
            '7' => '3',
            '8' => '6',
            '9' => '4',
            // '10' => '1',
            '11' => '5',
            '19' => '7',
        );

        echo '<pre>';
        // print_r($decode);

        foreach ($decode as $row => $value) {
            $rsid   = $value['rsid'];
            $rsname = $value['nama'];

            /**** Jika data hospital ada & sudah disamakan by ID ****/
            if (isset($arrDBID[$rsid])) {
                $value['rs_dbid'] = $arrDBID[$rsid];
                $value['rs_dburl'] = $arrMapurl[$rsid];
                // print_r($value);

                echo '<br>------------------------------------------------------------------<br>';
                echo $rsname;
                echo '<br>------------------------------------------------------------------<br>';

                $get_specialist = $this->cronjob_get_specialist($rsid);

                foreach ($get_specialist as $key => $value_sp) {
                    $spid   = $value_sp['tmid'];
                    $spname = $value_sp['spesialis'];

                    if (isset($arrSPID[$spid])) {
                        $value_sp['sp_dbid'] = $arrSPID[$spid];
                        $value_sp['sp_dbname'] = $arrSPName[$spid];

                        print_r($value_sp);
                    }
                }
            }
        }
    }

    function curl_get_bk($endpoint = '')
    {
        $api_url = "https://dev-api-webservice.teramobile.app/api/v1";

        /* --- Token Per 04/Maret/2021 14:58 WIB Expired: 2022 ---*/
        // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNWNiMGVjZDNiMDRmODdmNWM2OWExZDNjMjhmNWU3NzAyMTgwN2RlOTAxZTM4OGI3MmZiZDJiZTg1YTA5Zjg2YTg4NTUzODk2ZjQ1ZWMyMmMiLCJpYXQiOjE2MTQ4NDQ1MjIsIm5iZiI6MTYxNDg0NDUyMiwiZXhwIjoxNjQ2MzgwNTIyLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.fBLVPR5DmGcJxB8aPCPSOxOzADrz3cd08WMmcZLyUt3RanKbNvAQaIrsEYkG79d9FdVHCMmS3J30yydM3JWbwg";
        $token = $this->dataToken();


        $ch =  curl_init($api_url . '/' . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));

        $get = curl_exec($ch);

        if (curl_errno($ch)) {
            $decode = "Error: " . curl_error($ch);
        } else {
            $decode = json_decode($get, true);
        }

        return $decode;
    }

    private function data_specialist($par = '')
    {
        $arrSP = array(
            '1' => ($par == '') ? '10' : 'pediatric', // ANAK
            '2' => ($par == '') ? '9' : 'obstetric & gynaecology', //KEBIDANAN & PENY KANDUNGAN
            '3' => ($par == '') ? '12' : 'internal medicine', // PENY. DALAM
            '4' => ($par == '') ? '22' : 'surgery', // BEDAH UMUM
            '5' => ($par == '') ? '17' : 'radiology', // RADIOLOGI
            '6' => '',
            '7' => ($par == '') ? '34' : 'anaesthesia', // ANESTESI & ICU
            '8' => ($par == '') ? '28' : 'heart center', // JANTUNG
            '9' => '',
            '10' => ($par == '') ? '21' : 'ear nose and throats', // T H T
            '11' => ($par == '') ? '13' : 'psycholog', // JIWA
            '12' => ($par == '') ? '20' : 'general practitioners', // UMUM
            '13' => ($par == '') ? '15' : 'dental', // GIGI DAN MULUT DEWASA
            '14' => ($par == '') ? '15' : 'dental', // GIGI DAN MULUT DEWASA
            '15' => '', //
            '16' => '', //
            '17' => '', //
            '18' => '', //
            '19' => '', //
            '20' => '', //
            '21' => ($par == '') ? '31' : 'orthopedic', // BEDAH TULANG
            '22' => '',
            '23' => ($par == '') ? '26' : 'medical rehabilitation', // REHABILITASI MEDIS
            '24' => '', //
            '25' => '', //
            '26' => '', // PATOLOGI KLINIK
            '27' => ($par == '') ? '25' : 'neurology', // SARAF
            '28' => '',
            '29' => ($par == '') ? '27' : 'urology', // BEDAH UROLOGI
            '30' => ($par == '') ? '11' : 'dermatology', // KULIT DAN KELAMIN
            '31' => ($par == '') ? '22' : 'surgery', // BEDAH MULUT
            '32' => '',
            '33' => ($par == '') ? '36' : 'pulmonology', // PARU
            '34' => ($par == '') ? '35' : 'plastic surgery', // Spesialis Bedah Plastik
            '35' => ($par == '') ? '37' : 'neurosurgery', // BEDAH SYARAF
            '36' => ($par == '') ? '15' : 'dental', // Periodonti
            '37' => ($par == '') ? '15' : 'dental', // Konservasi Gigi
            '38' => ($par == '') ? '15' : 'dental', // Prostodonti
            '39' => ($par == '') ? '15' : 'dental', // Konservasi Gigi Anak
            '40' => ($par == '') ? '15' : 'dental', // Dokter Gigi Spesialis Ortho
            '41' => ($par == '') ? '11' : 'dermatology', // Spesialis Kulit dan Kelamin
            '42' => '', // Patologi Anatomi
            '43' => '', //
            '44' => '', //
            '45' => '', //
            '46' => '', //
            '47' => '', //
            '48' => '', //
            '49' => '', //
            '50' => '', //
            '51' => '', //
            '52' => ($par == '') ? '15' : 'dental', // Dokter Gigi
            '53' => '', //
            '54' => '', //
            '55' => '', // untuk yang tanpa gelar)
            '56' => '', //
            '57' => '', //
            '58' => '', //
            '59' => '', //
            '60' => '', //
            '61' => '', //
            '62' => '', //
            '63' => '', //
            '64' => '', //
            '65' => '', //
            '66' => '', //
            '67' => '', //
            '68' => '', //
            '69' => '', //
            '70' => '', //
            '71' => ($par == '') ? '10' : 'pediatric', // Spesialis Anak
            '72' => ($par == '') ? '34' : 'anaesthesia', // Spesialis Anestesiologi dan Reanimasi
            '73' => '', // Spesialis Andrologi
            '74' => '',
            '75' => ($par == '') ? '22' : 'surgery', // Spesialis Bedah
            '76' => ($par == '') ? '22' : 'surgery', // Spesialis Bedah Anak
            '77' => '',
            '78' => ($par == '') ? '35' : 'plastic surgery', // Spesialis Bedah Plastik
            '79' => '', //
            '80' => '', //
            '81' => '', //
            '82' => '', //
            '83' => '', //
            '84' => ($par == '') ? '16' : 'Physician Nutrition', // Spesialis Gizi Klinik
            '85' => ($par == '') ? '28' : 'heart center', // Spesialis Jantung dan Pembuluh Darah
            '86' => ($par == '') ? '26' : 'medical rehabilitation', // Spesialis Kedokteran Fisik dan Rehabilitasi
            '87' => ($par == '') ? '15' : 'dental', // Spesialis Konservasi Gigi (Dokter Gigi)
            '88' => ($par == '') ? '15' : 'dental', // Spesialis Kedokteran Gigi Anak (Dokter Gigi)
            '89' => '',
            '90' => '',
            '91' => ($par == '') ? '11' : 'dermatology', // Spesialis Penyakit Kulit dan Kelamin
            '92' => '',
            '93' => '',
            '94' => '',
            '95' => ($par == '') ? '29' : 'opthalmologist', // Spesialis Mata
            '96' => '',
            '97' => ($par == '') ? '9' : 'obstetric & gynaecology', // Spesialis Obstetri & Ginekologi (Kebidanan dan Kandungan)
            '98' => '',
            '99' => '',
            '100' => ($par == '') ? '15' : 'dental', // Spesialis Ortodonsia (Perawatan Maloklusi) (Dokter Gigi)
            '101' => ($par == '') ? '31' : 'orthopedic', // Spesialis Bedah Orthopaedi dan Traumatologi
            '102' => ($par == '') ? '36' : 'pulmonology', // Spesialis Paru (Pulmonologi)
            '103' => '',
            '104' => '',
            '105' => '',
            '106' => ($par == '') ? '12' : 'internal medicine', // Spesialis Penyakit Dalam
            '107' => '', // Spesialis Patologi Klinik
            '108' => '',
            '109' => '',
            '110' => ($par == '') ? '17' : 'radiology', // Spesialis Radiologi
            '111' => '',
            '112' => ($par == '') ? '25' : 'neurology', // Spesialis Saraf
            '113' => ($par == '') ? '21' : 'ear nose and throats', // Spesialis Telinga Hidung Tenggorok-Bedah Kepala Leher
            '114' => ($par == '') ? '27' : 'urology', // Spesialis Urologi
            '115' => '',
            '116' => ($par == '') ? '20' : 'general practitioners', // Dokter Umum
        );

        return $arrSP;
    }


    public function specialistGroup()
    {

        $curl = curl_init();
        $token = $this->dataToken();


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-webservice.teramobile.app/api/v1/SpecialistByGroup?tmgroupid=4&rsid=7',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function allSpec()
    {
        $curl = curl_init();
        $token = $this->dataToken();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-webservice.teramobile.app/api/v1/AllSpecialistByTmGroup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response_array = json_decode($response, true);
        return $response_array;
    }

    public function rsByTmId()
    {

        $gid = $this->input->get('gid', true);

        $tmGroup = $this->allSpec();

        for ($i = 0; $i < count($tmGroup); $i++) {
            if ($tmGroup[$i]['tmgroupid'] == $gid) {
                $rs = $tmGroup[$i]['rs'];
            }
        }

        echo json_encode($rs);
    }

    public function spByTmId()
    {
        $gid = $this->input->get('gid', true);
        $rsid =  $this->input->get('rsid', true);

        $tmGroup = $this->allSpec();

        for ($i = 0; $i < count($tmGroup); $i++) {
            if ($tmGroup[$i]['tmgroupid'] == $gid) {
                $rs = $tmGroup[$i]['rs'];
            }
        }

        for ($i = 0; $i < count($rs); $i++) {
            if ($rs[$i]['rsid'] == $rsid) {
                $sp = $rs[$i]['specialist'];
            }
        }

        echo json_encode($sp);
    }

    public function api_doctor()
    {
        $id = $this->input->get('pid');
        echo json_encode($this->apidoctors->findByPID($id)->row_array());
    }

    // NOTE: OTP function here

    public function match_otp()
    {
        $this->form_validation->set_rules('otp_input', 'OTP', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'failed', 'causer' => 'validation_error']);
            return;
        }

        $code = $_SESSION['user_otp'];
        $otp_input = $this->input->post('otp_input');

        if ($code) {
            if ($code == $otp_input) {
                $_SESSION['can_make_appointment'] = true;
                echo json_encode(['status' => 'success']);
                return;
            } else {
                echo json_encode(['status' => 'failed', 'causer' => 'code_not_match']);
                return;
            }
        }
        echo json_encode(['status' => 'failed', 'causer' => 'code_not_found']);
        return;
    }

    public function dump_otp()
    {
        echo $_SESSION['user_otp'];
    }

    public function send_otp()
    {
        $code = rand(1111, 9999);

        $data = $this->check_patient_data();
        $data['data']['start_hour'] = $_REQUEST['start_hour'];

        if (!isset($data['data'])) {
            echo json_encode([
                'status' => 'error',
            ]);
            die();
            return;
        } else {
            $data = $data['data'];
        }

        // NOTE: the code stops here to prevent whatsapp send
        if (isset($_SESSION['otp_created_at'])) {
            $time_diff = time() - $_SESSION['otp_created_at'];

            if ($time_diff < 120) {
                echo json_encode([
                    'status' => 'limited',
                    'time_diff' => 120 - $time_diff
                ]);
                return;
            }
        }

        // $phone = $this->input->post('mobile_phone');

        $this->load->library('session');

        $this->session->set_userdata('user_otp', $code);
        $this->session->set_userdata('can_make_appointment', false);
        $this->session->set_userdata('otp_created_at', time());

        $message = 'Konfirmasi Kode OTP. Kode OTP: ' . $code;

        //Send data
        $token = 'hgkGrbkSyWxeB2Vshko3KDncstk40rT5QjmCseheSnE6RqieOYeS1ZpEd0xfnFqs';
        $url = "https://kudus.wablas.com/api/send-message?token=" . $token . "&phone=" . $data['hp'] . "&message=" . $message;


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $response_data = curl_exec($ch);
        curl_close($ch);

        echo json_encode([
            'status' => 'success',
            'response_data' => $response_data,
            'patient_data' => $data
        ]);
    }
}
