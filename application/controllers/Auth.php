<?php

declare(strict_types=1);

use App\Libraries\User;
use PhpParser\Node\Stmt\TryCatch;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');
	}

	private function verifyWrongPassword(): bool
	{
		$wrongPassword = password_hash('wrong' . md5(time() . 'wp'), PASSWORD_ARGON2ID);
		$wrongCompare = md5('WrongCompare_' . time() . rand(0, 99));
		return password_verify($wrongPassword, $wrongCompare);
	}

	public function index()
	{
		$data = [
			'nav' => true,
			'title' => 'Autenticação',
			'loggedUser' => null,
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/auth/login');
		$this->load->view('templates/footer');
	}

	public function login()
	{
		$rules = [
			[
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'required|valid_email'
			],
			[
				'field' => 'password',
				'label' => 'Senha',
				'rules' => 'required',
				'errors' => [
					'required' => 'You must provide a %s.',
				],
			],
		];

		$this->form_validation->set_rules($rules);

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

	public function create()
	{
		$this->load->view('templates/header', ['nav' => true]);
		$this->load->view('pages/auth/register');
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$rules = [
			[
				'field' => 'name',
				'label' => 'Nome',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'required|valid_email|is_unique[users.email]'
			],
			[
				'field' => 'password',
				'label' => 'Senha',
				'rules' => 'required',
				'errors' => [
					'required' => 'You must provide a %s.',
				],
			],
			[
				'field' => 'passconf',
				'label' => 'Confimação de Senha',
				'rules' => 'required',
			]
		];

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() === false) {
			return $this->register();
		}

		$user = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
		];

		$newUser = $this->user->store($user);

		$loggedUser = array(
			'username'  => $newUser['name'],
			'email'     => $newUser['email'],
			'logged_in' => TRUE
		);

		$this->session->set_userdata($loggedUser);

		return redirect('produtos');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('autenticar/acessar');
	}
}
