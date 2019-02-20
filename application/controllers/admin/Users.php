<?php
defined('BASEPATH') or exit('No direct script access allowes');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('haslogin') != 'true') {
            $this->session->set_flashdata('gagal', 'Anda harus login dulu !');
            
            redirect(base_url('admin/login'));
        }
        $this->load->model('UsersModel');
        $this->load->library('form_validation');
        $this->output->enable_profiler(false);
    }

    public function index()
    {
        $data['users'] = $this->UsersModel->getAll();
        $this->load->view('admin/users/list', $data);
    }

    public function add()
    {
        $user = $this->UsersModel;
        $validation = $this->form_validation;
        $validation->set_message(array(
      'required' => 'Harus diisi!',
      'alpha' => 'Hanya boleh berupa huruf!',
      'min_length' => 'Minimal {param} karekter!',
      'max_length' => 'Maksimal {param} karakter!',
      'is_unique' => 'Email telah terdaftar!',
      'valid_email' => 'Email tidak valid!',
      'matches' => 'Konfirmasi password tidak sesuai!'
    ));
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->save();
            $this->session->flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view('admin/users/new_form');
    }

    public function edit($id = null)
    {
        if (!isset($id)) {
            redirect('admin/users');
            //print_r($_POST);
        }

        $user = $this->UsersModel;
        $validation = $this->form_validation;
        $validation->set_message(array(
      'required' => 'Harus diisi!',
      'min_length' => 'Minimal {param} karekter!',
      'max_length' => 'Maksimal {param} karakter!',
      'valid_email' => 'Email tidak valid!'
    ));
        $validation->set_rules($user->rules_edit());

        if ($validation->run()) {
            $user->update();
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
        }

        $data['user'] = $user->getById($id);
        if (!$data['user']) {
            show_404();
        }
        $this->load->view('admin/users/edit', $data);
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            show_404();
        }

        if ($this->UsersModel->delete($id)) {
            $this->session->flashdata('success', 'Berhasil dihapus');
      
            redirect(site_url('admin/users'));
        }
    }
}
