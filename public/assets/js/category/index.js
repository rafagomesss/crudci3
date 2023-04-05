$('#remove-category, .remove-category').on('click', (el) => {
    el.preventDefault();

    const category = $(el.currentTarget).closest('tr').find('.category-name').html();

    Swal.fire({
        title: `Deseja realmente remover a categoria "${category}"?`,
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