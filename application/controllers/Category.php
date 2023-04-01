<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('logged_in')) {
			return redirect('autenticar/acessar');
		}
		$this->load->library('form_validation');
		$this->load->model('Category_model', 'category');
	}

	public function index()
	{
		$data = [
			'nav' => true,
			'loggedUser' => $this->session->userdata,
			'categories' => $this->category->all(),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/category/index');
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data = [
			'nav' => true,
			'loggedUser' => $this->session->userdata,
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/category/create');
		$this->load->view('templates/footer');
	}

	public function edit(int $id)
	{
		$category = $this->category->findById($id);
		$data = [
			'nav' => true,
			'loggedUser' => $this->session->userdata,
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/category/update', ['category' => $category]);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$rules = [
			[
				'field' => 'category',
				'label' => 'Categoria',
				'rules' => 'required|min_length[3]|is_unique[product_categories.name]',
				'errors' => [
					'required' => 'O campo %s é obrigatório!',
					'min_length' => '%s deve ter ao menos 3 caracteres!',
					'is_unique' => 'A %s informada já existe!',
				],
			],
		];

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === false) {
			return $this->create();
		}

		$category = [
			'name' => $this->input->post('category'),
		];

		$this->category->store($category);
		$this->session->set_flashdata('success', 'Categoria Salva Com Sucesso!');

		return redirect('categorias');
	}

	public function update()
	{
		$rules = [
			[
				'field' => 'category',
				'label' => 'Categoria',
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'O campo %s é obrigatório!',
					'min_length' => '%s deve ter ao menos 3 caracteres!',
				],
			],
		];

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === false) {
			return $this->create();
		}

		$category = [
			'id' => $this->input->post('id'),
			'name' => $this->input->post('category'),
			'updated_at' => (new DateTime(
				'now',
				(new DateTimeZone('America/Sao_Paulo'))
			)
			)->format('Y-m-d H:i:s'),
		];

		$this->category->update($category);
		$this->session->set_flashdata('success', 'Categoria Atualizada Com Sucesso!');
		return redirect('categorias');
	}

	public function delete(int $id)
	{
		$this->category->delete($id);
		$this->session->set_flashdata('success', 'Categoria Removida Com Sucesso!');
		return redirect('categorias');
	}
}
