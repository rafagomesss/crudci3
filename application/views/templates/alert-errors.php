<?php if (!empty(validation_errors())) : ?>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>