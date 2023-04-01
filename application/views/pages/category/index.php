<div class="row justify-content-center mb-5">
    <div class="col-8">
        <h2 class="text-center">Categorias dos Produtos</h2>
    </div>
</div>
<div class="row justify-content-center align-items-center mb-3">
    <div class="col-4 d-flex justify-content-start align-items-center">
        <a class="btn btn-sm btn-warning px-3" href="<?= base_url('home'); ?>">Voltar</a>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="btn btn-sm btn-success px-3" href="<?= base_url('categorias/registrar'); ?>">Cadastrar &nbsp;&nbsp;<i class="fa-solid fa-plus"></i></a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-8">
        <?php $this->load->view('templates/alert-errors'); ?>
        <?php $this->load->view('templates/flash-messages'); ?>
        <?php if (count($categories) > 0) : ?>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <td>Código</td>
                        <td>Nome</td>
                        <td class="text-center">Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td>#<?= $category['id']; ?></td>
                            <td><?= $category['name']; ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-success px-3" href="<?= base_url(); ?>categorias/editar/<?= $category['id']; ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-sm btn-danger px-3" href="<?= base_url(); ?>categorias/excluir/<?= $category['id']; ?>" title="Excluir"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <table class="table table-dark table-striped table-hover">
                <tbody>
                    <tr class="text-center">
                        <td>Nenhuma Categoria Encontrada!</td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>