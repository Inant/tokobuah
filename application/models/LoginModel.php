<?php


defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    private $_table = 'users';

    public function cek_login($where)
    {
        return $this->db->get_where($this->_table, $where);
    }
}

/* End of file LoginModel.php */
