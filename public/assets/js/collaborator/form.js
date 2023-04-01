$(document).ready(() => {
    const checkbox_status = $('#checkbox_status[name="checkbox_status[]"]');
    const status = $('#status[name="status"]');
    if (checkbox_status.length) {
        $(checkbox_status).on('change', (el) => {
            if ($(el.currentTarget).is(":checked")) {
                $(status).val('Ativo');
            } else {
                $(status).val('Inativo');
            }
        });
    }
});