<script src="<?= base_url('public/assets/js/jquery/jquery-3.6.4.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="<?= base_url('public/assets/fontawesome/js/all.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/inputmask/jquery.mask.min.js'); ?>"></script>

<?php if (!empty($this->uri->rsegment(2)) && $this->uri->rsegment(2) === 'login') : ?>
    <script src="<?= base_url('public/assets/js/auth/login.js'); ?>"></script>
<?php endif; ?>
<?= '<h2>' . $this->uri->rsegment(2) . '</h2>' ?>
<?php if (!empty($this->uri->rsegment(1)) && $this->uri->rsegment(1) === 'collaborator') : ?>
    <?php if (!empty($this->uri->rsegment(2)) && $this->uri->rsegment(2) === 'index') : ?>
        <script src="<?= base_url('public/assets/js/collaborator/index.js'); ?>"></script>
    <?php endif; ?>
    <?php if (!empty($this->uri->rsegment(2)) && $this->uri->rsegment(2) === 'edit' ||  $this->uri->rsegment(2) === 'create') : ?>
        <script src="<?= base_url('public/assets/js/collaborator/form.js'); ?>"></script>
    <?php endif; ?>
<?php endif; ?>


