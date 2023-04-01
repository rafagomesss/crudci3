<div class="row justify-content-center mb-3">
    <div class="col-8">
        <h2 class="text-center">Cadastro de Colaboradores</h2>
    </div>
</div>
<div class="row justify-content-center align-items-center mb-5">
    <div class="col-8 d-flex justify-content-start align-items-center">
        <a class="btn btn-sm btn-warning px-3" href="<?= base_url('colaboradores'); ?>">Cancelar</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-8">
        <?php $this->load->view('templates/alert-errors'); ?>
        <form method="post" action="<?= base_url('colaboradores/salvar'); ?>">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nome</label>
                        <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Digite o nome">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Sobrenome</label>
                        <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Digite o sobrenome">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input id="cpf" name="cpf" type="text" class="form-control" placeholder="XXX.XXX.XXX-XX">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="cellphone" class="form-label">Celular</label>
                        <input id="cellphone" name="cellphone" type="text" class="form-control" placeholder="(XX) X XXXX-XXXX">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">CEP</label>
                        <input id="zip_code" name="zip_code" type="text" class="form-control" placeholder="XXXXX-XXX">
                    </div>
                </div>
                <div class="col-8">
                    <div class="mb-3">
                        <label for="address" class="form-label">Endereço</label>
                        <input id="address" name="address" type="text" class="form-control" placeholder="Digite o endereço">
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="address_number" class="form-label">Número</label>
                        <input id="address_number" name="address_number" type="text" class="form-control" placeholder="Digite o número">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="address_complement" class="form-label">Complemento</label>
                        <input id="address_complement" name="address_complement" type="text" class="form-control" placeholder="Casa, Apto, Loja...">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="neighborhood" class="form-label">Bairro</label>
                        <input id="neighborhood" name="neighborhood" type="text" class="form-control" placeholder="Digite o bairro">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="city" class="form-label">Cidade</label>
                        <input id="city" name="city" type="text" class="form-control" placeholder="Digite a cidade">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="position" class="form-label">Cargo</label>
                        <input id="position" name="position" type="text" class="form-control" placeholder="Analista, Administrador, Desenvolvedor...">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="sector" class="form-label">Setor</label>
                        <input id="sector" name="sector" type="text" class="form-control" placeholder="Administração, TI, Marketing...">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="user" class="form-label">Usuário</label>
                        <select id="user" name="user" class="form-control">
                            <option value="">Selecione um usuário...</option>
                            <?php if (count($users) > 0) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user['id']; ?>"><?= $user['email']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>