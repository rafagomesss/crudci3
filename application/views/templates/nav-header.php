<nav class="navbar navbar-expand-lg bg-dark mb-5" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="">Sistema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (!empty($this->session->username)) : ?>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php base_url(); ?>login">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>colaborador">Colaboradores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>produto">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>