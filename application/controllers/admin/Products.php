<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('haslogin') != 'true') {
            $this->session->set_flashdata('gagal', 'Anda harus login dulu !');
            redirect(base_url('admin/login'));
        }
        $this->load->model('ProductsModel');
        $this->load->library('form_validation');
        $this->output->enable_profiler(false);
    }

    public function index()
    {
        $data['products'] = $this->ProductsModel->getAll();
        $this->load->view('admin/products/list', $data);
    }

    public function add()
    {
        $product = $this->ProductsModel;
        $validation = $this->form_validation;
        $validation->set_message(array(
      'required' => 'Harus diisi!',
      'min_length' => 'Minimal {param} karakter!',
      'numeric' => 'Tidak boleh mengandung huruf!'
    ));
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $categories['categories'] = $product->getCategories();
        $this->load->view('admin/products/new_form', $categories);
    }

    public function edit($id = null)
    {
        if (!isset($id)) {
            redirect('admin/products');
        }
    
        $product = $this->ProductsModel;
        $validation = $this->form_validation;
        $validation->set_message(array(
      'required' => 'Harus diisi!',
      'min_length' => 'Minimal {param} karakter!',
      'numeric' => 'Tidak boleh mengandung huruf!'
    ));
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil diupdate');
        }

        $data['product'] = $product->getById($id);
        if (!$data['product']) {
            show_404();
        }
        $data['categories'] = $product->getCategories();
    
        $this->load->view('admin/products/edit', $data);
    }

    public function delete($id = null)
    {
        if (!isset($id)) {
            show_404();
        }
    
        if ($this->CategoriesModel->delete($id)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/products'));
        }
    }
}
