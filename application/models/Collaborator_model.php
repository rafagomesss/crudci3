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

    public function activateCollaborator(int $id)
    {
        try {
            $dateNow = (new DateTime('now', (new DateTimeZone('America/Sao_Paulo'))))->format('Y-m-d H:i:s');
            $this->db
                ->where('id', $id)
                ->set('status', 'Ativo')
                ->set('is_deleted', false)
                ->set('updated_at', $dateNow)
                ->update($this->table);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function softDelete(int $id)
    {
        try {
            $dateNow = (new DateTime('now', (new DateTimeZone('America/Sao_Paulo'))))->format('Y-m-d H:i:s');
            $this->db
                ->where('id', $id)
                ->set('status', 'Inativo')
                ->set('is_deleted', true)
                ->set('deleted_at', $dateNow)
                ->update($this->table);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }
}
