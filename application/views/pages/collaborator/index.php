<div class="row justify-content-center mb-5">
    <div class="col-8">
        <h2 class="text-center">Colaboradores</h2>
    </div>
</div>
<div class="row justify-content-center align-items-center mb-3">
    <div class="col-4 d-flex justify-content-start align-items-center">
        <a class="btn btn-sm btn-warning px-3" href="<?= base_url('home'); ?>">Voltar</a>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="btn btn-sm btn-success px-3" href="<?= base_url('colaboradores/registrar'); ?>">Cadastrar &nbsp;&nbsp;<i class="fa-solid fa-plus"></i></a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-8">
        <?php $this->load->view('templates/alert-errors'); ?>
        <?php $this->load->view('templates/flash-messages'); ?>
        <?php if (count($collaborators) > 0) : ?>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <td>Código</td>
                        <td>Nome</td>
                        <td>Celular</td>
                        <td>Cargo</td>
                        <td>Setor</td>
                        <td>Status</td>
                        <td class="text-center">Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($collaborators as $collaborator) : ?>
                        <tr>
                            <td>#<?= $collaborator['id']; ?></td>
                            <td><?= $collaborator['first_name']; ?></td>
                            <td><?= $collaborator['cellphone']; ?></td>
                            <td><?= $collaborator['position']; ?></td>
                            <td><?= $collaborator['sector']; ?></td>
                            <td><span class="badge text-bg-<?= $collaborator['status'] === 'Ativo' ? 'success' : 'danger'; ?>"><?= $collaborator['status']; ?></span></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-success px-3" href="<?= base_url(); ?>colaboradores/editar/<?= $collaborator['id']; ?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-sm btn-danger px-3" href="<?= base_url(); ?>colaboradores/excluir/<?= $collaborator['id']; ?>" title="Excluir"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <table class="table table-dark table-striped table-hover">
                <tbody>
                    <tr class="text-center">
                        <td>Nenhum Colaborador Encontrado!</td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>