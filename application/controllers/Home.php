<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		// $this->load->library('../controllers/auth');
	}

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			return redirect('autenticar/acessar');
		}
		$this->load->model('user_model');
		$data['user'] = $this->user_model->all();
		$this->load->view('templates/header', ['nav' => true, 'loggedUser' => $this->session->userdata ?? null]);
		$this->load->view('pages/index');
		$this->load->view('templates/footer');
	}
}
