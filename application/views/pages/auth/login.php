<div class="row justify-content-center">
    <div class="col-10 col-xxl-6 p-5">
        <div class="card">
            <div class="card-header text-center text-bg-dark">
                Autenticação do Sistema
            </div>
            <div class="card-body">
                <form>
                    <div class="col form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control mb-3" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="col form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control mb-3" name="password" id="password" placeholder="Digite sua senha">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <a href="<?= base_url(); ?>home" class="btn btn-sm btn-primary" type="button">Entrar</a>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <a href="registrar">Não possui uma conta? Registre-se</a>
            </div>
        </div>
    </div>
</div>