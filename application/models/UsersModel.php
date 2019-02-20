<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model
{
  private $_table = 'users';

  public $user_id;
  public $name;
  public $email;
  public $avatar = 'default.jpg';
  public $username;
  public $password;

  public function rules()
  {
    return[
      [
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'required|min_length[3]|max_length[50]'
      ],
      [
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|max_length[60]|is_unique[users.email]'
      ],
      [
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'required|min_length[3]|max_length[20]|is_unique[users.username]'
      ],
      [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required|min_length[8]|max_length[64]'
      ],
      [
        'field' => 'confirm_password',
        'label' => 'Confirm password',
        'rules' => 'required|min_length[8]|max_length[64]|matches[password]'
      ],
    ];
  }

  public function rules_edit()
  {
    return[
      [
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'required|min_length[3]|max_length[50]'
      ],
      [
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|max_length[60]'
      ],
      [
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'required|min_length[3]|max_length[20]'
      ],
    ];
  }

  /*public function error_message()
  {
    array(
      
        'required' => 'Harus diisi!',
        'alpha' => 'Hanya boleh berupa huruf!',
        'min_length' => 'Minimal {param} karekter!',
        'max_length' => 'Maksimal {param} karakter!',
        'is_unique' => 'Email telah terdaftar!',
        'valid_email' => 'Email tidak valid!',
        'matches' => 'Konfirmasi password tidak sesuai!'
      
    );
  }*/

  public function getAll()
  {
    return $this->db->get($this->_table)->result();
  }

  public function getById($id)
  {
    return $this->db->get_where($this->_table, ['user_id' => $id])->row();
  }

  public function save()
  {
    $post = $this->input->post();
    $this->user_id = uniqid();
    $this->name = $post['name'];
    $this->email = $post['email'];
    $this->avatar = $this->_avatar();
    $this->username = $post['username'];
    $this->password = md5($post['password']);
    $this->status = 'Active';
    $this->db->insert($this->_table, $this);
  }

  public function update()
  {
    $post = $this->input->post();
    $this->user_id = $post['id'];
    $this->name = $post['name'];
    $this->email = $post['email'];
    
    if (!empty($_FILES['avatar']['name'])) {
      $this->avatar = $this->_avatar();
    }
    else {
      $this->avatar = $post['old_avatar'];
    }

    $this->username = $post['username'];
    //$this->password = $post['password'];
    $this->status = $post['status'];
    $this->db->update($this->_table, $this, array('user_id' => $post['id']));
  }

  public function delete($id)
  {
    $this->_deleteAvatar($id);
    return $this->db->delete($this->_table, ['user_id' => $id]);
  }

  public function _avatar()
  {
    
    $config['upload_path'] = './upload/avatars/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $this->user_id;
    $config['overwrite'] = true;
    $config['max_size']  = 1024;
    //$config['max_width']  = '1024';
    //$config['max_height']  = '768';
    
    $this->load->library('upload', $config);
    
    if ($this->upload->do_upload('avatar')){
      return $this->upload->data('file_name');
    }

    return 'default.jpg';
    
  }

  public function _deleteAvatar($id)
  {
    $user = $this->getById($id);
    if ($user->avatar != 'default.jpg') {
      $filename = explode('.', $user->avatar)[0];
      return array_map('unlink', glob(FCPATH."upload/avatars/$filename.*"));
    }
  }


}
