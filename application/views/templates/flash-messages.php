<?php if (!empty($this->session->flashdata())) : ?>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-<?= current(array_keys($this->session->flashdata())) ?? 'info'; ?> text-center alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata()[current(array_keys($this->session->flashdata()))]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>