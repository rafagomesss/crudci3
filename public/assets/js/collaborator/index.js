$(document).ready(() => {
	$('#filterStatus').on('change', (el) => {
		$(el.currentTarget).closest('form').submit();
	});

	$('.remove-collab').on('click', (el) => {
		el.preventDefault();

		Swal.fire({
			title: 'Deseja realmente remover o colaborador?',
			showCancelButton: true,
			confirmButtonText: 'Remover',
			cancelButtonText: 'Cancelar',
            toast: true,
            reverseButtons: true,
            icon: 'warning',
            customClass: {
                title: 'text-center',
                actions: 'justify-content-between',
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-warning text-white'
            },
            buttonsStyling: false
		}).then((result) => {
			if (result.isConfirmed) {
				return window.location.href = $(el.currentTarget).attr('href');
			}
		});
	});
});
