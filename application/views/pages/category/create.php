<div class="row justify-content-center mb-3">
    <div class="col-8">
        <h2 class="text-center">Cadastro de Categorias</h2>
    </div>
</div>
<div class="row justify-content-center align-items-center mb-5">
    <div class="col-8 d-flex justify-content-start align-items-center">
        <a class="btn btn-sm btn-warning px-3" href="<?= base_url('categorias'); ?>">Cancelar</a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-8">
        <?php $this->load->view('templates/alert-errors'); ?>
        <?= form_open('categorias/salvar'); ?>
            <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <input id="category" name="category" type="text" class="form-control" placeholder="Digite o nome da categoria">
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>