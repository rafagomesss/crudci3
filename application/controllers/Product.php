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

		$this->navData = [
			'nav' => true,
			'loggedUser' => $this->session->userdata,
		];

		$this->load->library('form_validation');
		$this->load->model('Product_model', 'product');
		$this->load->model('Category_model', 'category');
	}

	private function rulesMessages(): array
	{
		return [
			'store' =>
			[
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
			],
			'update' =>
			[
				[
					'field' => 'name',
					'label' => 'Produto',
					'rules' => 'required|min_length[3]',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
						'min_length' => '%s deve ter ao menos 3 caracteres!',
					],
				],
			],
		];
	}

	public function index(): void
	{
		$data = ['products' => $this->product->list(),];
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/product/index', $data);
		$this->load->view('templates/footer');
	}

	public function create(): void
	{
		$data = ['categories' => $this->category->all(),];
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/product/create', $data);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules($this->rulesMessages()['store']);

		if ($this->form_validation->run() === false) {
			return $this->create();
		}

		$product = [
			'name' => $this->input->post('name', true),
			'category_id' => empty($this->input->post('category')) ? null : $this->input->post('category'),
			'description' => $this->input->post('description'),
			'price' => empty($this->input->post('price')) ? null : $this->input->post('price'),
		];

		$this->product->store($product);
		$this->session->set_flashdata('success', 'Produto Salvo Com Sucesso!');
		return redirect('produtos');
	}

	public function edit(int $id): void
	{
		$product = $this->product->findById($id);
		if ($product) {
			$data = [
				'categories' => $this->category->all(),
				'product' => $product,
			];
			$this->load->view('templates/header', $this->navData);
			$this->load->view('pages/product/update', $data);
			$this->load->view('templates/footer');
		}
	}

	public function update()
	{
		$this->form_validation->set_rules($this->rulesMessages()['update']);

		if ($this->form_validation->run() === false) {
			return $this->edit($this->input->post('id'));
		}

		$product = [
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'category_id' => empty($this->input->post('category')) ? null : $this->input->post('category'),
			'description' => $this->input->post('description'),
			'price' => empty($this->input->post('price')) ? null : $this->input->post('price'),
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
