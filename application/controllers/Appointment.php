<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment extends CI_Controller
{

    protected $middlewareUrl;
    public function __construct()
    {
        parent::__construct();
        $this->middlewareUrl = API_MIDDLEWARE;
    }

    public function index(int $peid = 0)
    {
        $data['peid'] = $peid;
        $data['title'] = 'Konfirmasi Kehadiran';
        $data['content'] = 'front/appointments/home';

        $this->load->view('front/template/appointments/app', $data);
    }

    public function attendance()
    {
        $this->load->library("session");
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $token = $this->input->post('token');
            $peid = $this->input->post('peid');
            $ip_address = $this->input->ip_address();
            $confirmation = $this->input->post('confirmation');

            $response = $this->validate_token($token, $ip_address);

            if ($response['success'] == false) {
                $this->session->set_flashdata('warning', 'Validasi Captcha error!, Harap coba lagi!');
                redirect('patient-confirmation/' . $peid);
            }

            $curl = curl_init();

            $postField = [
                "peid" => $peid,                
                "confirmAttendance" => $confirmation
            ];

            $url = $this->middlewareUrl . '/appointment/confirmAttendance';
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => json_encode($postField),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic YnJhd2lqYXlhOnBhdGllbnRqb3VybmV5'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $data = json_decode($response, true);

            if (array_key_exists("responseMessage", $data) && is_array($data)) {
                if ($data['responseMessage'] == "SUCCESS") {
                    $this->session->set_flashdata('success', 'Konfirmasi kehadiran berhasil!');
                    redirect('patient-confirmation/detail/' . $peid);
                } elseif ($data['responseMessage']=='Not found') {
                    $this->session->set_flashdata('warning', 'Perjanjian tidak di temukan.');
                    redirect('patient-confirmation/' . $peid);
                } else {
                    $this->session->set_flashdata('warning', $data['responseMessage']);
                    redirect('patient-confirmation/' . $peid);
                }
            } else{
                $this->session->set_flashdata('warning', "Terjadi kesalahan, pesan : " . $response);
                redirect('patient-confirmation/' . $peid);
            }
            $this->session->set_flashdata('warning', "Terjadi kesalahan, harap coba lagi nanti");
            redirect('patient-confirmation/' . $peid);

        } else {
            show_404();
        }
    }

    public function show(int $peid = 0)
    {

        $data['appointmentStatus'] = null;
        $data['peidExist'] = false;

        try {
            $data['peidExist'] = true;
            $response = $this->matchPeid($peid);

            if ($response['responseCode'] != 200) {
                show_404();
            }

            $data['appointmentStatus'] = $response['data'][0];
        } catch (\Throwable $th) {
            //throw $th;
            $data['peidExist'] = false;
        }

        $data['title'] = 'Status Kehadiran';
        $data['content'] = 'front/appointments/show';


        $this->load->view('front/template/appointments/app', $data);
    }

    private function matchPeid($peid)
    {
        if ($peid) {
            $curl = curl_init();

            $url = $this->middlewareUrl . '/appointment/detail?peid=' . $peid;

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic YnJhd2lqYXlhOnBhdGllbnRqb3VybmV5'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            return json_decode($response, true);
        }

        return null;
    }

    private function validate_token($token, $ip_address)
    {
        $postdata = http_build_query(["secret" => "6LdInZAlAAAAADE7quAunlELxBhZQINv-nhms7g2", "response" => $token]);
        $opts = [
            'http' =>
            [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            ]
        ];
        $context  = stream_context_create($opts);
        $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        return json_decode($result, true);
    }

    private function getAppointments()
    {
        $result = $this->getApiAppointments();
        return $result['data'] ?? [];
    }

    private function getAppointmentBranch($branch)
    {
        $result = $this->getApiAppointments($branch);
        return $result['data'] ?? [];
    }

    public function test() {
        $data = $this->getAppointmentBranch('DUREN TIGA');
        echo json_encode($data);
    }

    public function display_all()
    {
        // Check the session is available or not
        if (!$this->session->has_userdata('username')) {
            $this->session->set_flashdata('warning', 'Silahkan login terlebih dahulu!');
            redirect('middleware-appointment/login');
        }

        $userdata = $this->session->userdata();

        $branch = $userdata['branch_name'];

        if ($branch != '*') {
            $data['appointments'] = $this->getAppointmentBranch($branch);
        }else{
            $data['appointments'] = $this->getAppointments();
        }


        $data['title'] = 'Daftar Kehadiran';
        $data['content'] = 'front/appointments/display-all';

        $this->load->view('front/template/appointments/app-front-user', $data);
    }

    public function show_login()
    {
        $data['title'] = 'Login Unit';
        $data['content'] = 'front/appointments/login';

        $this->load->view('front/template/appointments/app-front-user', $data);
    }

    public function logout() {
        if ($this->input->method() != "post") {
            redirect('patient-confirmation/display-attendances');
        }
        $middlewareSess = ['unit', 'branch_name', 'username', 'password'];
        $this->session->unset_userdata($middlewareSess);
        $this->session->set_flashdata('success', 'Berhasil Logout');
        redirect('middleware-appointment/login');
        exit();
    }

    public function authenticate()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('warning', 'Lengkapi field untuk melanjutkan');
            redirect('middleware-appointment/login');
            exit();
        }

        $this->load->config('middleware');
        $configMiddleware = $this->config->item('middleware_user');

        $userName = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->config('middleware');
        $configMiddleware = $this->config->item('middleware_user');

        $availableUsers = $configMiddleware;

        $userdata = [];

        foreach ($availableUsers as $key => $users) {
            if ($users['username'] == $userName) {
                $userdata = $users;
            }
        }

        if (empty($userdata)) {
            $this->session->set_flashdata('warning', 'Data dengan username tersebut tidak di temukan!');
            redirect('middleware-appointment/login');
            exit();
        }

        if ($userdata['password'] != $password) {
            $this->session->set_flashdata('warning', 'Password kamu salah, coba lagi dengan menggunakan password yang sudah di berikan!');
            redirect('middleware-appointment/login');
            exit();
        }

        $this->session->set_userdata($userdata);
        $this->session->set_flashdata('warning', 'Login berhasil, selamat datang ' . $_SESSION['unit']);

        $this->db->insert('bwch_unit_logs', [
            'branch' => $userdata['branch_name'],
            'status' => 1,
            'login_at' => date('Y-m-d H:i:s')
        ]);

        redirect('patient-confirmation/display-attendances');
    }

    private function getApiAppointments($branch = null)
    {
        $curl = curl_init();

        if ($branch) {
            $url = $this->middlewareUrl . '/appointment/branch?branch='.urlencode($branch);
        }else{
            $url = $this->middlewareUrl . '/appointment/all';
        }
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic YnJhd2lqYXlhOnBhdGllbnRqb3VybmV5'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
