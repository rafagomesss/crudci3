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
                ->update(
                    $this->table,
                    $collaborator,
                    ['id' => $collaborator['id']]
                );
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function activateCollaborator(int $id)
    {
        try {
            $data = [
                'status' => 'Ativo',
                'is_deleted' => false,
                'updated_at' => nowDateTime(),
            ];
            $this->db
                ->update($this->table, $data, ['id' => $id]);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function softDelete(int $id)
    {
        try {
            $data = [
                'status' => 'Inativo',
                'is_deleted' => true,
                'deleted_at' => nowDateTime(),
            ];
            $this->db
                ->update($this->table, $data, ['id' => $id]);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }
}
