<?php defined('BASEPATH') or exit('No direct script access allowed');

class ProductsModel extends CI_Model
{
    private $_table = 'products';

    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function rules()
    {
        return[
      [
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'trim|required|min_length[3]|max_length[100]',
        /*'errors' => array(
          'required' => 'Harus diisi!',
          'min_length' => 'Minimal {param} karakter'
        )*/
      ],
      [
        'field' => 'price',
        'label' => 'Price',
        'rules' => 'numeric|required'
      ],
      [
        'field' => 'description',
        'label' => 'Description',
        'rules' => 'trim|required|min_length[8]|max_length[500]',
        /*'errors' => array(
          'required' => 'Harus diisi!',
          'min_length' => 'Minimal {param} karakter'
        )*/
        ],
        [
            'field' => 'category',
            'label' => 'Category',
            'rules' => 'required'
        ]
        /*
        [
          'field' => 'image',
          'label' => 'Image',
          'rules' => 'required'
        ]*/
    ];
    }

    public function getAll()
    {
        $this->db->select("products.*, categories.category_name")
        ->from($this->_table)
        ->join('categories', 'products.category_id = categories.id');
        return $this->db->get()->result();
        // return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        $this->db->select("products.*, categories.category_name")
        ->from('products')
        ->join('categories', 'products.category_id = categories.id')
        ->where('products.product_id', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->product_id = uniqid();
        $this->name = $post['name'];
        $this->price = $post['price'];
        $this->image = $this->_uploadImage();
        $this->description = $post['description'];
        $this->category_id = $post['category'];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->product_id = $post['id'];
        $this->name = $post['name'];
        $this->price = $post['price'];

        if (!empty($_FILES['image']['name'])) {
            $this->image = $this->_uploadImage();
        } else {
            $this->image = $post['old_image'];
        }

        $this->description = $post['description'];
        $this->category_id = $post['category'];
        $this->db->update($this->_table, $this, array('product_id' => $post['id']));
    }

    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, array('product_id' => $id));
    }

    private function _uploadImage()
    {
        $config['upload_path'] = './upload/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $this->product_id;
        $config['overwrite']  = true;
        $config['max_size']  = 1024;
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        }

        return 'default.jpg';
    }

    private function _deleteImage($id)
    {
        $product = $this->getById($id);
        if ($product->image != 'default.jpg') {
            $filename = explode('.', $product->image)[0];
            return array_map('unlink', glob(FCPATH . "upload/products/$filename.*"));
        }
    }

    public function getCategories()
    {
        return $this->db->get('categories')->result();
    }
}
