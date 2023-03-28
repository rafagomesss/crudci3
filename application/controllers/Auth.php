<?php

declare(strict_types=1);

use App\Libraries\User;
use PhpParser\Node\Stmt\TryCatch;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('User_model');
	}

	public function index()
	{
		$data = [
			'nav' => true,
			'title' => 'Autenticação'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/auth/login');
		$this->load->view('templates/footer');
	}

	public function register()
	{
		$this->load->view('templates/header', ['nav' => true]);
		$this->load->view('pages/auth/register');
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$user = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
		];

		try {
			//code...
		} catch (\Throwable $th) {
			//throw $th;
		}
		$newUser = $this->User_model->store($user);

		echo '<pre>' . print_r($newUser, true) . '</pre>';
		exit();

	}
}
