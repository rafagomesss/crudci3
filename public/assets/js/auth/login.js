const inputs = $('form input');

$(document).ready(() => {
    cancelEnableSubmit(false);
    inputs.bind('keyup', () => {
        const button = $('div.d-grid').find('button.btn');
        if (enableDisableButton()) {
            cancelEnableSubmit(true);
            button.prop('disabled', false);
        } else {
            cancelEnableSubmit(false);
            button.prop('disabled', true);
        }
    });
});

function enableDisableButton() {
    let count = 0;
    inputs.each((i) => {
        if (inputs[i].value !== '') {
            count++;
        } else {
            count--;
        }
    });
    if (count === inputs.length) {
        return true;
    }
    return false;
}

function cancelEnableSubmit(isValid) {
    if (isValid) {
        $('form').unbind('submit');
    } else {
        $('form').on('submit', function (ev) {
            ev.preventDefault();
        });
    }
}