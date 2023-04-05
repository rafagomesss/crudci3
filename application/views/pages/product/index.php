<div class="row justify-content-center mb-5">
    <div class="col-8">
        <h2 class="text-center">Lista de Produtos</h2>
    </div>
</div>
<div class="row justify-content-center align-items-center mb-3">
    <div class="col-4 d-flex justify-content-start align-items-center">
        <a class="btn btn-sm btn-warning px-3" href="<?= base_url('home'); ?>">Voltar</a>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="btn btn-sm btn-success px-3" href="<?= base_url('produtos/registrar'); ?>">Cadastrar &nbsp;&nbsp;<i class="fa-solid fa-plus"></i></a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-8">
        <?php $this->load->view('templates/alert-errors'); ?>
        <?php $this->load->view('templates/flash-messages'); ?>
        <?php if (count($products) > 0) : ?>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr class="text-center">
                        <td>Código</td>
                        <td>Nome</td>
                        <td>Descrição</td>
                        <td>Preço</td>
                        <td>Categoria</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr class="text-center">
                            <td>#<?= $product['id']; ?></td>
                            <td><span class="product-name"><?= $product['name']; ?></span></td>
                            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;"><?= $product['description']; ?></td>
                            <td><?= $product['price'] ? 'R$ '. number_format($product['price'], 2, ',', '.') : null; ?></td>
                            <td><?= $product['category']; ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-success" href="<?= base_url(); ?>produtos/editar/<?= $product['id']; ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a id="remove-product" class="btn btn-sm btn-danger remove-product" href="<?= base_url(); ?>produtos/excluir/<?= $product['id']; ?>" title="Excluir"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <table class="table table-dark table-striped table-hover">
                <tbody>
                    <tr class="text-center">
                        <td>Nenhum Produto Encontrado!</td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>