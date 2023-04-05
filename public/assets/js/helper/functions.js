function validarCpf(inputCPF) {
	if (inputCPF.length) {
		inputCPF.on("blur", () => {
			const cpfAlert = Swal.mixin({
				title: "Atenção!",
				text: "CPF inválido!",
				position: "center",
				toast: true,
				iconColor: "warning",
				icon: "warning",
				customClass: {
					title: "text-warning",
				},
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
			});

			let sum = 0;
			let rest;

			let cpf = inputCPF.val().replace(/\D/g, "");
			if (cpf == "00000000000") {
				inputCPF.val('');
                return cpfAlert.fire();
			}

			for (i = 1; i <= 9; i++) {
				sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
			}

			rest = (sum * 10) % 11;

			if (rest == 10 || rest == 11) {
				rest = 0;
			}

			if (rest != parseInt(cpf.substring(9, 10))) {
				inputCPF.val('');
                return cpfAlert.fire();
			}

			sum = 0;
			for (i = 1; i <= 10; i++) {
				sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
			}
			rest = (sum * 10) % 11;

			if (rest == 10 || rest == 11) {
				rest = 0;
			}

			if (rest != parseInt(cpf.substring(10, 11))) {
				inputCPF.val('');
                return cpfAlert.fire();
			}

			return true;
		});
	}
}
