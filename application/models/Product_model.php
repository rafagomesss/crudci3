<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    protected string $table = 'products';

    public function list(): array
    {
        $this->db->select('p.*, pc.name as category');
        $this->db->from($this->table . ' p');
        $this->db->join('product_categories pc', 'pc.id = p.category_id', 'left');
        return $this->db->get()->result_array() ?? [];
    }

    public function store(array $product): void
    {
        try {
            $this->db->insert($this->table, $product);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }

    public function update(array $product): void
    {
        try {
            $this->db
                ->where('id', $product['id'])
                ->update($this->table, $product);
        } catch (\Throwable $th) {
            exit($th->getMessage());
            throw new Exception($th->getMessage());
        }
    }
}
