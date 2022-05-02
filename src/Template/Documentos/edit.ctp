<div class="col-md-8 mt-5 alinhamento">
    <?= $this->Form->create(null, ['id' => 'form-arquivo', 'enctype' => 'multipart/form-data']) ?>
    <div class="title">Edição de Arquivos</div>
    <div class="row d-flex justify-content">
        <div class="col-md-4">
            <?= $this->Form->control('tp_edital', ['value' => $arquivo->tp_edital, 'options' => $tipos, 'label' => 'Tipo do Edital']); ?>
        </div>
        <div class="col-md-4">
            <label>Publicação</label>
            <input type="date" name="dt_public" id="dt_public" value="<?= $arquivo->dt_public ? date_format($arquivo->dt_public, 'Y-m-d') : '' ?>" />
        </div>
        <div class="form-group col-md-4 mt-4">
            <?= $this->Html->link('<i class="far fa-eye mr-2"> </i>  ' . $arquivo->nm_arquivo, '/arquivos/' . $arquivo->nm_arquivo, ['target' => 'blank', 'class' => 'btn btn-sm btn-info text-white px-4 mt-3', 'escape' => false]) ?>
        </div>
        <div class="col-6 d-flex justify-content-md-end mt-5">
            <button type="button" onclick="history.back()" class="btn btn-warning" style="color: white"><i class="fas fa-reply text-white" style="padding-right: 5px;"></i>Voltar</button>
        </div>
        <div class="col-6 d-flex justify-content-md-start mt-5">
            <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Salvar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<script>
    function getFileData(myFile) {
        var file = myFile.files[0];
        var filename = file.name;
        document.getElementById('arquivo').innerHTML = filename;
    }
</script>