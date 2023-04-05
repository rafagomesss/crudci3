<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    protected string $table = 'product_categories';

    public function store($category)
    {
        try {
            $this->db->insert($this->table, $category);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function update(array $category)
    {
        try {
            $this->db->update($this->table, $category, ['id' => $category['id']]);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }
}
