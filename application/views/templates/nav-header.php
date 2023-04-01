<nav class="navbar navbar-expand-lg bg-dark mb-5" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="">Sistema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (!empty($loggedUser['username'])) : ?>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(1) === 'home' ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(1) === 'colaboradores' ? 'active' : ''; ?>" href="<?= base_url(); ?>colaboradores">Colaboradores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(1) === 'produtos' ? 'active' : ''; ?>" href="<?= base_url(); ?>produtos">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(1) === 'categorias' ? 'active' : ''; ?>" href="<?= base_url(); ?>categorias">Categorias</a>
                    </li>
                </ul>
                <span class="navbar-text me-5">
                    <?= $loggedUser['username']; ?>
                </span>
                <a class="me-2 btn btn-sm btn-warning" href="<?= base_url('autenticar/sair'); ?>">Sair <i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        <?php endif; ?>
    </div>
</nav>
