<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected string $table = 'users';

    public function store($user)
    {
        try {
            $query = $this->db->insert($this->table, $user);
            if ($query) {
                $this->db->select('name, email');
                $this->db->where('email', $user['email']);
                $newUser = $this->db->get($this->table)->row_array();
                return $newUser;
            }
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function findByEmail(string $email)
    {
        try {
            return $this->db
                ->select('name, email, password')
                ->where('email', $email)
                ->get($this->table)->row_array();
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }
}
