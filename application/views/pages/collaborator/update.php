<div class="row justify-content-center mb-3">
    <div class="col-8">
        <h2 class="text-center">Atualizar Dados Colaborador</h2>
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
        <?= form_open('colaboradores/atualizar'); ?>
            <div class="row">
                <input type="hidden" name="id" value="<?= $collaborator['id']; ?>">
                <div class="col">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nome</label>
                        <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Digite o nome" value="<?= $collaborator['first_name'] ?? null; ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Sobrenome</label>
                        <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Digite o sobrenome" value="<?= $collaborator['last_name'] ?? null; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input id="cpf" name="cpf" type="text" class="form-control" placeholder="XXX.XXX.XXX-XX" value="<?= $collaborator['cpf'] ?? null; ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="cellphone" class="form-label">Celular</label>
                        <input id="cellphone" name="cellphone" type="text" class="form-control" placeholder="(XX) X XXXX-XXXX" value="<?= $collaborator['cellphone'] ?? null; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">CEP</label>
                        <input id="zip_code" name="zip_code" type="text" class="form-control" placeholder="XXXXX-XXX" value="<?= $collaborator['zip_code'] ?? null; ?>">
                    </div>
                </div>
                <div class="col-8">
                    <div class="mb-3">
                        <label for="address" class="form-label">Endereço</label>
                        <input id="address" name="address" type="text" class="form-control" placeholder="Digite o endereço" value="<?= $collaborator['address'] ?? null; ?>">
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label for="address_number" class="form-label">Número</label>
                        <input id="address_number" name="address_number" type="text" class="form-control" placeholder="Digite o número" value="<?= $collaborator['address_number'] ?? null; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="address_complement" class="form-label">Complemento</label>
                        <input id="address_complement" name="address_complement" type="text" class="form-control" placeholder="Casa, Apto, Loja..." value="<?= $collaborator['address_complement'] ?? null; ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="neighborhood" class="form-label">Bairro</label>
                        <input id="neighborhood" name="neighborhood" type="text" class="form-control" placeholder="Digite o bairro" value="<?= $collaborator['neighborhood'] ?? null; ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="city" class="form-label">Cidade</label>
                        <input id="city" name="city" type="text" class="form-control" placeholder="Digite a cidade" value="<?= $collaborator['city'] ?? null; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="position" class="form-label">Cargo</label>
                        <input id="position" name="position" type="text" class="form-control" placeholder="Analista, Administrador, Desenvolvedor..." value="<?= $collaborator['position'] ?? null; ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="sector" class="form-label">Setor</label>
                        <input id="sector" name="sector" type="text" class="form-control" placeholder="Administração, TI, Marketing..." value="<?= $collaborator['sector'] ?? null; ?>">
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
                                    <option value="<?= $user['id']; ?>" <?= $collaborator['user_id'] === $user['id'] ? 'selected' : ''; ?>><?= $user['email']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <div class="mb-3">
                        <div class="form-check me-2 mt-2">
                            <input
                                id="checkbox_status"
                                name="checkbox_status[]"
                                class="form-check-input"
                                type="checkbox"
                                <?= $collaborator['status'] === 'Ativo' ? 'checked' : '';?>
                            >
                            <input id="status"name="status" type="hidden" value="<?= $collaborator['status'];?>">
                            <label class="form-check-label" for="status">
                                Ativo
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>