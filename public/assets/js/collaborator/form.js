$(document).ready(() => {
	const formButton = $('form').find('button');
	const checkboxStatus = $('#checkbox_status[name="checkbox_status[]"]');
	const status = $('#status[name="status"]');
	if (checkboxStatus.length) {
		$(checkboxStatus).on('change', (el) => {
			if ($(el.currentTarget).is(':checked')) {
				$(status).val('Ativo');
			} else {
				$(status).val('Inativo');
			}
		});
	}

	$('#cpf.form-control, .cpf-validate').mask('000.000.000-00', {
		placeholder: '___.___.___-__',
	});

	$('#cellphone.form-control').mask('(00) 0 0000-0000', {
		placeholder: '(__) _ ____-____',
	});

	$('#zip_code.form-control').mask('00000-000', {
		placeholder: '_____-___',
	});

	function limpa_formulário_cep() {
		$('#address').val('');
		$('#neighborhood').val('');
		$('#city').val('');
		$('#address').prop('disabled', false);
		$('#neighborhood').prop('disabled', false);
		$('#city').prop('disabled', false);
	}

	$('#zip_code').on('blur', (el) => {
		let cep = $(el.currentTarget).val().replace(/\D/g, '');

		if (cep != '') {
			let validacep = /^[0-9]{8}$/;

			if (validacep.test(cep)) {
				$('#address').val('...');
				$('#neighborhood').val('...');
				$('#city').val('...');
				$('#address').prop('disabled', true);
				$('#neighborhood').prop('disabled', true);
				$('#city').prop('disabled', true);

				$.getJSON(
					'https://viacep.com.br/ws/' + cep + '/json/?callback=?',
					function (dados) {
						console.log(dados)
						if (!('erro' in dados)) {
							$('#address').val(dados.logradouro);
							$('#neighborhood').val(dados.bairro);
							$('#city').val(dados.localidade);
							$('#address').prop('disabled', false);
							$('#neighborhood').prop('disabled', false);
							$('#city').prop('disabled', false);
							$('#address_number').focus();
						} else {
							limpa_formulário_cep();
							Swal.fire({
								title: 'Atenção!',
								text: 'CEP não encontrado!',
								position: 'center',
								toast: true,
								iconColor: 'warning',
								icon: 'warning',
								customClass: {
									title: 'text-warning',
								},
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true,
							});
						}
					}
				);
			} else {
				limpa_formulário_cep();
				Swal.fire({
					title: 'Atenção!',
					text: 'Formato de CEP inváido!',
					position: 'center',
					toast: true,
					iconColor: 'warning',
					icon: 'warning',
					customClass: {
						title: 'text-warning',
					},
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
				});
				$('#zip_code').val('');
				$('#zip_code').focus();
			}
		} else {
			limpa_formulário_cep();
		}
	});

	const is_activating = $('input[name="is_activating"]').length;
	if (is_activating > 0) {
		$('.form-control').removeAttr('name');
		$('.form-control').removeAttr('id');
		$('form').submit(function (e) {
			return e.preventDefalt();
		});
		$('form').find('button').attr('type', 'button');
		formButton.on('click', () => {
			if (checkboxStatus.is(':checked')) {
				return formButton.removeAttr('type');
			}
			Swal.fire({
				toast: true,
				position: 'center',
				iconColor: 'white',
				icon: 'warning',
				title: 'Ação não permitida!',
				text: 'O usuário deve estar ativo para poder alterá-lo!',
				customClass: {
					popup: 'colored-toast',
					title: 'text-danger',
				},
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
			});
		});
	}

	const checkForNewUser = $('#user_register');
	const userSelect = $('select#user[name="user"]');

	if (checkForNewUser.length) {
		checkForNewUser.on('change', (el) => {
			$('.user-create').html('');
			$('#new_user').val(false);
			userSelect.prop('disabled', false);
			if ($(el.currentTarget).is(':checked')) {
				$('#new_user').val(true);
				userSelect.prop('disabled', true);
				$(`#${userSelect.attr('id')} option[value=""]`).prop('selected', true)
				let userCreateHtml = `<hr />
					<div class="row justify-content-center mb-4">
						<div class="col">
							<div class="accordion accordion-flush " id="accordionFlushExample">
								<div class="accordion-item ">
									<h2 class="accordion-header">
										<button class="accordion-button collapsed bg-secondary text-white" type="button"
											data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
											aria-controls="flush-collapseOne">
											Usuário
										</button>
									</h2>
									<div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
										<div class="accordion-body">
											<div class="card">
												<div class="card-header text-center text-bg-dark">Usuário</div>
												<div class="card-body">
													<div class="col form-group">
														<label for="email">E-mail:</label>
														<input type="text" class="form-control mb-3" name="email" id="email"
															placeholder="Digite seu e-mail" />
													</div>
													<div class="col form-group">
														<label for="password">Senha:</label>
														<input type="password" class="form-control mb-3" name="password" id="password"
															placeholder="Digite sua senha" />
													</div>
													<div class="col form-group">
														<label for="passconf">Confirme sua Senha:</label>
														<input type="password" class="form-control mb-3" name="passconf" id="passconf"
															placeholder="Confirme sua senha" />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>`;
				$('.user-create').html(userCreateHtml);
			}
		});
	}

	const inputCPF =  $("#cpf, .cpf-validate");
	 if (inputCPF.length) {
		validarCpf(inputCPF);
	 }
});
