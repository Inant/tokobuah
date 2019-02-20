<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if ($this->session->userdata('haslogin') != 'true') {
            redirect(base_url('admin/login'));
        }

        $this->load->model('CategoriesModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['categories'] = $this->CategoriesModel->getAll();
        $this->load->view('admin/categories/list', $data);
    }

    public function create()
    {
        $category = $this->CategoriesModel;
        $validation = $this->form_validation;
        $validation->set_message(array(
            'required' => 'Harus diisi!',
            'min_length' => 'Minimal {param} karakter',
        ));
        $validation->set_rules($category->rules());

        if ($validation->run()) {
            $category->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('admin/categories/create');
    }

    public function edit($id = null)
    {
        if (!isset($id)) {
            redirect(base_url('admin/categories'));
        }

        $category = $this->CategoriesModel;
        $validation = $this->form_validation;
        $validation->set_message(array(
            'required' => 'Harus diisi !',
            'min_length' => 'Minimal {param} karakter !',
            'max_length' => 'Maksimal {param} karakter !',
        ));
        $validation->set_rules($category->rules());

        if ($validation->run()) {
            $category->update();
            $this->session->set_flashdata('success', 'Berhasil diperbarui ');
        }

        $data['category'] = $category->getById($id);
        if (!$data['category']) {
            show_404();
        }

        $this->load->view('admin/categories/edit', $data);
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            redirect(base_url('admin/categories'));
        }

        if ($this->CategoriesModel->delete($id)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(base_url('admin/categories'));
        }
    }

    public function ajaxSearch()
    {
        $categories = $this->input->get('categories');
        $result = $this->CategoriesModel->getByKeyword($categories);
        return $result;
    }
}

/* End of file Categories.php */
