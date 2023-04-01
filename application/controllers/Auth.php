<?php

declare(strict_types=1);

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');

		$this->navData = ['nav' => true,];
	}

	private function verifyWrongPassword(): bool
	{
		$wrongPassword = password_hash('wrong' . md5(time() . 'wp'), PASSWORD_ARGON2ID);
		$wrongCompare = md5('WrongCompare_' . time() . rand(0, 99));
		return password_verify($wrongPassword, $wrongCompare);
	}

	private function rulesMessages(): array
	{
		return [
			'login' => [
				[
					'field' => 'email',
					'label' => 'E-mail',
					'rules' => 'required|min_length[3]|valid_email',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
						'min_length' => '%s deve ter ao menos 3 caracteres!',
						'valid_email' => '%s deve conter um e-mail válido!',
					],
				],
				[
					'field' => 'password',
					'label' => 'Senha',
					'rules' => 'required',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
					],
				],
			],
			'store' => [
				[
					'field' => 'name',
					'label' => 'Nome',
					'rules' => 'required|min_length[3]',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
						'min_length' => '%s deve ter ao menos 3 caracteres!',
					],
				],
				[
					'field' => 'email',
					'label' => 'E-mail',
					'rules' => 'required|valid_email|is_unique[users.email]',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
						'min_length' => '%s deve ter ao menos 3 caracteres!',
						'valid_email' => '%s deve conter um e-mail válido!',
						'is_unique' => 'O e-mail informado já existe!',
					],
				],
				[
					'field' => 'password',
					'label' => 'Senha',
					'rules' => 'required|min_length[6]',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
						'min_length' => '%s deve ter ao menos 6 caracteres!',
					],
				],
				[
					'field' => 'passconf',
					'label' => 'Confimação de Senha',
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'O campo %s é obrigatório!',
						'matches' => 'As senhas informadas não são iguais!',
					],
				]
			],
		];
	}

	public function index(): void
	{
		$this->navData['title'] = 'Autenticação';
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/auth/login');
		$this->load->view('templates/footer');
	}

	public function login()
	{
		$this->form_validation->set_rules($this->rulesMessages()['login']);

		if ($this->form_validation->run() === false) {
			return $this->index();
		}

		$data = [
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
		];

		$user = $this->user->findByEmail($data['email']);
		if (
			empty($user) ||
			!password_verify($data['password'], $user['password'])
		) {
			$this->verifyWrongPassword();
			$this->session->set_flashdata('danger', 'E-mail e/ou senha inválido(s)!');
			return redirect('autenticar/acessar');
		}

		$loggedUser = array(
			'username'  => $user['name'],
			'email'     => $user['email'],
			'logged_in' => TRUE
		);

		$this->session->set_userdata($loggedUser);
		return redirect('home');
	}

	public function create(): void
	{
		$this->navData['title'] = 'Cadastrar Usuário';
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/auth/register');
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules($this->rulesMessages()['store']);

		if ($this->form_validation->run() === false) {
			return $this->create();
		}

		$user = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
		];

		$newUser = $this->user->store($user);

		$loggedUser = [
			'username'  => $newUser['name'],
			'email'     => $newUser['email'],
			'logged_in' => true
		];

		$this->session->set_userdata($loggedUser);

		return redirect('home');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('autenticar/acessar');
	}
}
