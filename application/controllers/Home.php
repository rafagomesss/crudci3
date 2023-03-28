<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
		// $this->load->library('session');
		// $this->load->library('../controllers/auth');
	}

	public function index()
	{
		if (empty($this->session->username)) {
			return redirect('autenticacao/acessar');
		}
		$this->load->model('user_model');
		$data['user'] = $this->user_model->all();
		$this->load->view('templates/header', ['nav' => true]);
		$this->load->view('pages/index');
		$this->load->view('templates/footer');
	}
}
