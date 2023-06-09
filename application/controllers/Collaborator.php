<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collaborator extends CI_Controller
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
		$this->load->model('Collaborator_model', 'collaborator');
		$this->load->model('User_model', 'user');
	}

	private function saveUserCollaborator(array $user): array
	{
		$newUser = [
			'name' => $user['name'],
			'email' => $user['email'],
			'password' => password_hash($user['password'], PASSWORD_BCRYPT),
		];

		return $this->user->store($newUser) ?? [];
	}

	private function rulesMessages(): array
	{
		return [
			[
				'field' => 'first_name',
				'label' => 'Nome',
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'O campo %s é obrigatório!',
					'min_length' => '%s deve ter ao menos 3 caracteres!',
				],
			],
			[
				'field' => 'last_name',
				'label' => 'Sobrenome',
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'O campo %s é obrigatório!',
					'min_length' => '%s deve ter ao menos 3 caracteres!',
				],

			],
			[
				'field' => 'cellphone',
				'label' => 'Celular',
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'O campo %s é obrigatório!',
					'min_length' => '%s deve ter ao menos 3 caracteres!',
				],
			]

		];
	}

	private function checkActivateStatus(): bool
	{
		$requiredFields = [
			'first_name',
			'last_name',
			'cellphone'
		];
		$postData = array_keys($this->input->post());

		$compare = array_diff($requiredFields, $postData);

		if (
			!empty($compare) &&
			$this->input->post('status') === 'Ativo' &&
			!empty($this->input->post('id')) &&
			in_array('is_activating', $postData)
		) {
			return true;
		}

		return false;
	}

	private function activateCollaborator()
	{
		$this->collaborator->activateCollaborator($this->input->post('id'));
		$this->session->set_flashdata('success', 'Colaborador Ativado Com Sucesso!');
		return redirect('colaboradores');
	}

	private function filterWhereIndex(): array
	{
		$filterStatus = empty($this->input->post('filterStatus')) ? 'Ativo' : $this->input->post('filterStatus');
		$where = ['is_deleted' => false,];
		if (!empty($filterStatus) && $filterStatus === 'Removido') {
			$where['is_deleted'] = true;
		} else {
			$where['status'] = $filterStatus;
		}

		return $where;
	}

	public function index(): void
	{
		$where = $this->filterWhereIndex();

		$data = [
			'collaborators' => $this->collaborator->all('*', $where),
			'filter' => $where,
		];

		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/collaborator/index', $data);
		$this->load->view('templates/footer');
	}

	public function create(): void
	{
		$data = ['users' => $this->user->all('id, email'),];
		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/collaborator/create', $data);
		$this->load->view('templates/footer');
	}

	public function store()
	{
		$this->form_validation->set_rules($this->rulesMessages());

		if ($this->form_validation->run() === false) {
			return $this->create();
		}

		$collaborator = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'cellphone' => $this->input->post('cellphone'),
			'cpf' => $this->input->post('cpf'),
			'zip_code' => $this->input->post('zip_code'),
			'address' => $this->input->post('address'),
			'address_number' => $this->input->post('address_number'),
			'address_complement' => $this->input->post('address_complement'),
			'neighborhood' => $this->input->post('neighborhood'),
			'position' => $this->input->post('position'),
			'sector' => $this->input->post('sector'),
			'user_id' => empty($this->input->post('user')) ? null : $this->input->post('user'),
		];

		if (!empty($this->input->post('new_user'))) {
			$user = [
				'name' => $collaborator['first_name'] . ' ' . $collaborator['last_name'],
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			];
			$this->load->is_loaded('Auth');
			$newUser = $this->saveUserCollaborator($user);
			$collaborator['user_id'] = $newUser['id'];
		}

		$this->collaborator->store($collaborator);
		$this->session->set_flashdata('success', 'Colaborador Salvo Com Sucesso!');
		return redirect('colaboradores');
	}

	public function edit(int $id)
	{
		$disabled = $this->collaborator->findById($id)['status'] ?? null;
		$data = [
			'collaborator' => $this->collaborator->findById($id),
			'users' => $this->user->all('id, email'),
			'disabled' => $disabled === 'Inativo' || $disabled === 'Removido' ? 'disabled' : null,
		];

		if (empty($data['collaborator'])) {
			$this->session->set_flashdata('warning', 'Colaborador Não Encontrado!');
			return redirect('colaboradores');
		}

		$this->load->view('templates/header', $this->navData);
		$this->load->view('pages/collaborator/update', $data);
		$this->load->view('templates/footer');
	}

	public function update()
	{
		if ($this->checkActivateStatus()) {
			return $this->activateCollaborator();
		}
		$this->form_validation->set_rules($this->rulesMessages());

		if ($this->form_validation->run() === false) {
			return redirect('colaboradores/editar/' . $this->input->post('id'));
		}

		$collaborator = [
			'id' => $this->input->post('id'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'cellphone' => $this->input->post('cellphone'),
			'cpf' => $this->input->post('cpf'),
			'zip_code' => $this->input->post('zip_code'),
			'address' => $this->input->post('address'),
			'address_number' => $this->input->post('address_number'),
			'address_complement' => $this->input->post('address_complement'),
			'neighborhood' => $this->input->post('neighborhood'),
			'city' => $this->input->post('city'),
			'position' => $this->input->post('position'),
			'sector' => $this->input->post('sector'),
			'status' => $this->input->post('status'),
			'user_id' => empty($this->input->post('user')) ? null : $this->input->post('user'),
			'updated_at' => (new DateTime(
				'now',
				(new DateTimeZone('America/Sao_Paulo'))
			)
			)->format('Y-m-d H:i:s'),
		];

		$this->collaborator->update($collaborator);
		$this->session->set_flashdata('success', 'Colaborador Atualizado Com Sucesso!');

		return redirect('colaboradores');
	}

	public function softDelete(int $id)
	{
		$this->collaborator->softDelete($id);
		$this->session->set_flashdata('success', 'Colaborador Removido Com Sucesso!');
		return redirect('colaboradores');
	}
}
