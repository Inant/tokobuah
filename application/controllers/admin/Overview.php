<?php

class Overview extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('haslogin') != 'true') {
            $this->session->set_flashdata('gagal', 'Anda harus login dulu !');
            redirect(base_url('admin/login'));
        }
    }

    public function index()
    {
        $this->load->view('admin/overview');
    }
}
