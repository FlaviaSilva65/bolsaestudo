<div class="col-md-8 mt-5 alinhamento">
    <?= $this->Form->create(null, ['id' => 'form-arquivo', 'enctype' => 'multipart/form-data']) ?>
    <div class="title">Carregamento de Arquivos</div>
    <div class="row d-flex justify-content">
        <div class="col-md-4">
            <?= $this->Form->control('tp_edital', ['options' => $tipos, 'label' => 'Tipo do Edital']); ?>
        </div>
        <div class="col-md-4">
            <label>Publicação</label>
            <?= $this->Form->text('dt_public', ['class' => 'rounded', 'type' => 'date']); ?>
        </div>
        <div class="form-group col-md-4 mt-2">
            <label class='labelInput mt-4 mb-0'>

                <?= $this->Form->control('nm_arquivo', ['id' => 'selecao-arquivo', 'type' => 'file', 'label' => false, 'accept' => '.docx,.pdf,.doc', 'data-max-size' => 2048, 'onchange' => 'getFileData(this)']); ?>
                <span><i class="fas fa-plus"></i></span>
                Anexar Arquivo
            </label>
            <label id='arquivo'></label>
        </div>
        <div class="col-6 d-flex justify-content-md-end mt-5">
            <button type="button" onclick="history.back()" class="btn btn-warning" style="color: white"><i class="fas fa-reply text-white" style="padding-right: 5px;"></i>Voltar</button>
        </div>
        <div class="col-6 d-flex justify-content-md-start mt-5">
            <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Cadastrar</button>
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