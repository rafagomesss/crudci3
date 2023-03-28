<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected string $table = 'users';

    public function all()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function store($user)
    {
        try {
            $query = $this->db->insert($this->table, $user);
            echo '<pre>' . print_r($this->db->error(), true) . '</pre>';
            exit();
            if (true) {
                $this->db->select('id, name, email');
                $this->db->where('email', $user['email']);
                $newUser = $this->db->get($this->table)->row_array();
                return $newUser;
            }
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
        
    }
}
