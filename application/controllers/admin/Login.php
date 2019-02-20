<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index()
    {
        $this->load->view('admin/login');
    }

    public function aksiLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $where = array(
          'username' => $username,
          'password' => md5($password),
          'status' => 'Active'
        );

        $cek = $this->LoginModel->cek_login($where)->num_rows();

        if ($cek > 0) {
            $data_session = array(
            'username' => $username,
            'haslogin' => 'true'
            );

            $this->session->set_userdata($data_session);

          
            redirect(base_url('admin'));
        } else {
            $this->session->set_flashdata('gagal', 'Username atau password salah');
          
            redirect(base_url('admin/login'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('admin/login'));
    }
}

/* End of file Login.php */
