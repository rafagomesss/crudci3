<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
	public function index()
	{
		return 'Products';
		// $this->load->model('user_model');
		// $data['user']= $this->user_model->all();
		// $this->load->view('templates/header', ['nav' => true]);
		// $this->load->view('pages/index');
		// $this->load->view('templates/footer');
	}

	public function list()
	{
		echo 'list';
	}
}