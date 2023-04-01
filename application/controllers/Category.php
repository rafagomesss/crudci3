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

		$this->navData = [
			'nav' => true,
			'loggedUser' => $this->session->userdata ?? null,
		];

		$this->load->library('form_validation');
		$this->load->model('Category_model', 'category');
	}

	private function rulesMessages(): array
	{
		return [
			'store' => [
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
			],
			'update' => [
				[
					'field' => 'category',
					'label' => 'Categoria',
					'rules' => 'required|min_length[3]',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
						'min_length' => '%s deve ter ao menos 3 caracteres!',
					],
				],
			]
		];
	}

	public function index(): void
	{
		$data = ['categories' => $this->category->all(),];
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/category/index', $data);
		$this->load->view('templates/footer');
	}

	public function create(): void
	{
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/category/create');
		$this->load->view('templates/footer');
	}

	public function edit(int $id): void
	{
		$data = ['category' => $this->category->findById($id),];
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/category/update', $data);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules($this->rulesMessages()['store']);

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
		$this->form_validation->set_rules($this->rulesMessages()['update']);

		if ($this->form_validation->run() === false) {
			return $this->edit($this->input->post('id'));
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
