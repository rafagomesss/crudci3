<div class="row justify-content-center">
    <div class="col-10 col-xxl-6 p-5">
        <?php $this->load->view('templates/flash-messages'); ?>
        <?php $this->load->view('templates/alert-errors'); ?>
        <div class="card">
            <div class="card-header text-center text-bg-dark">
                Autenticação do Sistema
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url('autenticar/acessar'); ?>">
                    <div class="col form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control mb-3" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="col form-group">
                        <label for="current-password">Senha:</label>
                        <input type="password" class="form-control mb-3" name="password" id="password" placeholder="Digite sua senha" autocomplete="off">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button class="btn btn-sm btn-primary" disabled>Entrar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <a href="<?= base_url('autenticar/registrar'); ?>">Não possui uma conta? Registre-se</a>
            </div>
        </div>
    </div>
</div>