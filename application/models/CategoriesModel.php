<?php


defined('BASEPATH') or exit('No direct script access allowed');

class CategoriesModel extends CI_Model
{
    private $_table = 'categories';

    public function rules()
    {
        return [
          [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|min_length[3]|max_length[50]'
          ]
        ];
    }
  
    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id = uniqid();
        $this->category_name = $post['name'];
        $this->image = $this->_uploadImage();

        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post['id'];
        $this->name = $post['name'];

        if (!empty($_FILES['image']['name'])) {
            $this->image = $this->_uploadImage();
        } else {
            $this->image = $post['old_image'];
        }

        $this->db->update($this->_table, $this, ['id' => $this->id]);
    }

    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, ['id' => $id]);
    }

    private function _uploadImage()
    {
        $config['upload_path'] = './upload/categories/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $this->id;
        $config['overwrite'] = true;
        $config['max_size']  = 1024;
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';
      
        $this->load->library('upload', $config);
      
        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        }

        return 'default.jpg';
    }

    private function _deleteImage($id)
    {
        $category = $this->getById($id);

        if ($category->image != 'default.jpg') {
            $filename = explode('.', $category->image)[0];
            return array_map('unlink', glob(FCPATH . "upload/categories/$filename.*"));
        }
    }

    public function getByKeyword($categories)
    {
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->from('categories');
        $this->db->like('name', $categories);
        return $this->db->get()->result();
    }
}

/* End of file CategoriesModel.php */
