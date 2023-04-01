<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('logged_in')) {
			return redirect('autenticar/acessar');
		}
		$this->load->library('form_validation');
		$this->load->model('Product_model', 'product');
		$this->load->model('Category_model', 'category');
	}

	public function index()
	{
		$data = [
			'nav' => true,
			'loggedUser' => $this->session->userdata,
			'products' => $this->product->list(),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/product/index');
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data = [
			'nav' => true,
			'loggedUser' => $this->session->userdata,
			'categories' => $this->category->all(),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/product/create');
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$rules = [
			[
				'field' => 'name',
				'label' => 'Produto',
				'rules' => 'required|min_length[3]|is_unique[products.name]',
				'errors' => [
					'required' => 'O campo %s é obrigatório!',
					'min_length' => '%s deve ter ao menos 3 caracteres!',
					'is_unique' => 'A %s informado já existe!',
				],
			],
		];

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === false) {
			return $this->create();
		}

		$product = [
			'name' => $this->input->post('name', true),
			'category_id' => empty($this->input->post('category')) ? null : $this->input->post('category'),
			'description' => $this->input->post('description'),
			'price' => $this->input->post('price'),
		];

		$this->product->store($product);
		$this->session->set_flashdata('success', 'Produto Salvo Com Sucesso!');
		return redirect('produtos');
	}

	public function edit(int $id)
	{
		$product = $this->product->findById($id);
		if ($product) {
			$data = [
				'nav' => true,
				'loggedUser' => $this->session->userdata,
				'categories' => $this->category->all(),
				'product' => $product,
			];
			$this->load->view('templates/header', $data);
			$this->load->view('pages/product/update', $data);
			$this->load->view('templates/footer');
		}
	}

	public function update()
	{
		$rules = [
			[
				'field' => 'name',
				'label' => 'Produto',
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'O campo %s é obrigatório!',
					'min_length' => '%s deve ter ao menos 3 caracteres!',
				],
			],
		];

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === false) {
			return $this->edit($this->input->post('id'));
		}

		$product = [
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'category_id' => empty($this->input->post('category')) ? null : $this->input->post('category'),
			'description' => $this->input->post('description'),
		];

		$this->product->update($product);
		$this->session->set_flashdata('success', 'Produto Atualizado Com Sucesso!');
		return redirect('produtos');
	}

	public function delete(int $id)
	{
		$this->product->delete($id);
		$this->session->set_flashdata('success', 'Produto Removido Com Sucesso!');
		return redirect('produtos');
	}
}
