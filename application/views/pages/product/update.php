<div class="row justify-content-center mb-3">
    <div class="col-8">
        <h2 class="text-center">Cadastro de Produtos</h2>
    </div>
</div>
<div class="row justify-content-center align-items-center mb-5">
    <div class="col-8 d-flex justify-content-start align-items-center">
        <a class="btn btn-sm btn-warning px-3" href="<?= base_url('produtos'); ?>">Cancelar</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-8">
        <?php $this->load->view('templates/alert-errors'); ?>
        <form method="post" action="<?= base_url('produtos/atualizar'); ?>">
            <input type="hidden" name="id" value="<?= $product['id']; ?>">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Produto</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Digite o nome do produto" value="<?= $product['name'] ?? null; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select class="form-select" name="category" id="category">
                            <option value="">Selecione uma opção...</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id']; ?>" <?= !empty($product) && intval(trim($product['category_id'])) === intval(trim($category['id'])) ? 'selected' : '' ?>><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="price" class="form-label">Preço</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">R$</span>
                            <input id="price" name="price" type="text" class="form-control money" placeholder="Digite o valor do produto" value="<?= $product['price'] ?? null; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição do Produto</label>
                        <textarea id="description" name="description" class="form-control" rows="3"><?= $product['description'] ?? null; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-grid gap-2">
                        <button class="btn btn-sm btn-success">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>