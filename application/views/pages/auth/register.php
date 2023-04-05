<div class="row justify-content-center">
    <div class="col-10 col-xxl-6 p-5">
        <?php $this->load->view('templates/flash-messages'); ?>
        <?php $this->load->view('templates/alert-errors'); ?>
        <div class="card">
            <div class="card-header text-center text-bg-dark">
                Registrar-se
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url('autenticar/cadastrar'); ?>">
                    <div class="col form-group mb-3">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Digite seu nome completo">
                    </div>
                    <div class="col form-group mb-3">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="col form-group mb-3">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha">
                        <div id="passwordHelp" class="form-text text-info"><small>A senha deve conter no mínimo 6 caracteres.</small></div>
                    </div>
                    <div class="col form-group mb-3">
                        <label for="passconf">Confirme sua Senha:</label>
                        <input type="password" class="form-control" name="passconf" id="passconf" placeholder="Confirme sua senha">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button class="btn btn-sm btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <a href="acessar">Já possui uma conta? Faça o Login</a>
            </div>
        </div>
    </div>
</div>