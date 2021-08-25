<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('Model_login');  
    }

    public function index()
    {
        // $data['hasil'] = $this->Model_login->cekdata();
        $this->load->view('login');
    }

    public function ceklogin()
    {
        $namauser = $this->input->post('inputUser');
        $namasandi = $this->input->post('inputPassword');

        $where = array('nameuser' => $namauser, 
                       'passuser' => $namasandi );
        $cek = $this->Model_login->loginrnd($where);
        if ($cek->num_rows() > 0) {
            $data_session = array('last_name' => $namauser, 'status' => "login");
            $this->session->set_userdata($data_session);
            redirect(base_url('admin'));
        } else {
            echo ("Username dan Password salah, silahkan periksa kembali");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('Login'));
    }

    public function register()
    {
        $this->load->view('loginewregister');
    }

    public function regin()
    {
        $nama = $this->input->post('firstName');
        $otoritas = $this->input->post('inputAuth');
        $user = $this->input->post('inputUser');
        $sandi = $this->input->post('inputPassword');

        $data = array('usernames' => $nama,
                      'nameuser' => $user,
                      'passuser' => $sandi,
                      'roleuser' => $otoritas );
        
        $this->Model_login->simpanuser($data,'usradmin');
        redirect ('login');
    }

    public function forgot()
    {
        $this->load->view('loginforgotpassword');
    }

    public function reset()
    {
        $user = $this->input->post('inputUser');
        $sandi = $this->input->post('inputPassword');

        $data = array(
                      'passuser' => $sandi
                     );

        $where = array( 'nameuser' => $user );
        $this->Model_login->update($where, $data,'usradmin');
        redirect ('login');
    }
}
