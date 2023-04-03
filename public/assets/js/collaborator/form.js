$(document).ready(() => {
	const checkbox_status = $('#checkbox_status[name="checkbox_status[]"]');
	const status = $('#status[name="status"]');
	if (checkbox_status.length) {
		$(checkbox_status).on("change", (el) => {
			if ($(el.currentTarget).is(":checked")) {
				$(status).val("Ativo");
			} else {
				$(status).val("Inativo");
			}
		});
	}

	$("#cpf.form-control").mask("000.000.000-00", {
		placeholder: "___.___.___-__",
	});

	$("#cellphone.form-control").mask("(00) 0 0000-0000", {
		placeholder: "(__) _ ____-____",
	});

	$("#zip_code.form-control").mask("00000-000", {
		placeholder: "_____-___",
	});

	const is_activating = $('input[name="is_activating"]').length;
	if (is_activating > 0) {
		$(".form-control").removeAttr("name");
		$(".form-control").removeAttr("id");
		$("form").submit(function (e) {
			return e.preventDefalt();
		});
		$("form").find("button").attr("type", "button");
		$("form").find("button").on("click", () => {
            if (checkbox_status.is(":checked")) {
                return $("form").find("button").removeAttr("type");
            }
            Swal.fire({
                toast: true,
                position: "bottom-right",
                iconColor: "white",
                icon: "warning",
                title: "Ação não permitida!",
                text: "O usuário deve estar ativo para poder alterá-lo!",
                customClass: {
                    popup: "bg-dark",
                    title: 'text-warning text-center',
                    htmlContainer: 'text-light text-center'
                },
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        });
	}
});
