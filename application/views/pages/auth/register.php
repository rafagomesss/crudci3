<div class="row justify-content-center">
    <div class="col-10 col-xxl-6 p-5">
        <div class="card">
            <div class="card-header text-center text-bg-dark">
                Registrar-se
            </div>
            <div class="card-body">
                <form method="post" action="<?php base_url(); ?>cadastrar">
                    <div class="col form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control mb-3" name="name" id="name" placeholder="Digite seu nome completo">
                    </div>
                    <div class="col form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control mb-3" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="col form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control mb-3" name="password" id="password" placeholder="Digite sua senha">
                    </div>
                    <div class="col form-group">
                        <label for="password_confirm">Confirme sua Senha:</label>
                        <input type="password" class="form-control mb-3" name="password_confirm" id="password_confirm" placeholder="Confirme sua senha">
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