<div class="col-md-8 mt-4  alinhamento">
    <?= $this->Form->create($evento, ['id' => 'form-evento', 'novalidate']) ?>
    <div class="title">Cadastro do cronograma da Etapa</div>

    <div class="row justify-content-start">
        <div class="col-md-3 mt-3">
            <label>Inicio</label>
            <?= $this->Form->text('dt_inicio', ['class' => 'rounded', 'type' => 'date', 'label' => false]); ?>
        </div>
        <div class="col-md-3 mt-3">
            <label>Fim</label>
            <?= $this->Form->text('dt_fim', ['class' => 'rounded', 'type' => 'date', 'label' => false]); ?>
        </div>
        <div class="col-md-3 mt-3">
            <?= $this->Form->control('tp_eventos_id', ['options' => $tp_eventos, 'class' => 'form-control', 'label' => 'Selecione a Etapa']); ?>
        </div>

        <div class="mt-5">
            <button class="btn btn-success" type=" button"><i class="fas fa-check"></i> Cadastrar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
    <div class="col-12 d-flex justify-content-center mt-5">
        <button type="button" onclick="history.back()" class="btn btn-warning" style="color: #fff;"><i class="fas fa-reply" style="padding-right: 5px;"></i>Voltar</button>
    </div>
</div>