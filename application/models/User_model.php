<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected string $table = 'users';

    public function store($user): array
    {
        try {
            $query = $this->db->insert($this->table, $user);
            if ($query) {
                $this->db->select('id, name, email');
                $this->db->where('email', $user['email']);
                return $this->db->get($this->table)->row_array();
            }
            return ['error' => $this->db->error(),];
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function findByEmail(string $email): array
    {
        try {
            return $this->db
                ->select('name, email, password')
                ->get_where($this->table, ['email' => $email])
                ->row_array() ?? [];
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }
}
