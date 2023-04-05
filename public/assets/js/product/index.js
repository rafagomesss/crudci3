$(document).ready(() => {
    $('#remove-product, .remove-product').on('click', (el) => {
        el.preventDefault();

        const product = $(el.currentTarget).closest('tr').find('.product-name').html();

        Swal.fire({
            title: 'Atenção!',
            html: `Deseja realmente remover a categoria <span class="text-info"><b>${product}</b></span>?`,
            showCancelButton: true,
            confirmButtonText: 'Remover',
            cancelButtonText: 'Cancelar',
            toast: true,
            reverseButtons: true,
            icon: 'warning',
            customClass: {
                title: 'text-center',
                htmlContainer: 'text-center',
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
})