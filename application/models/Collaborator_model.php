<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collaborator_model extends CI_Model
{
    protected string $table = 'collaborators';

    public function store($collaborator)
    {
        try {
            $this->db->insert($this->table, $collaborator);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function update(array $collaborator)
    {
        try {
            $this->db
                ->where('id', $collaborator['id'])
                ->update($this->table, $collaborator);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }
}
