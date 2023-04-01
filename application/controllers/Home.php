<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');

		$this->navData = [
			'nav' => true,
			'loggedUser' => $this->session->userdata ?? null,
		];
	}

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			return redirect('autenticar/acessar');
		}

		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/index');
		$this->load->view('templates/footer');
	}
}
