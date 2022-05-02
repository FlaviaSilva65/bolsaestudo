<div class="col-md-8 mt-4  alinhamento">
    <?= $this->Form->create($evento, ['id' => 'form-evento', 'novalidate']) ?>
    <div class="titlEvento">Edição do cronograma da Etapa - <?= $evento->tp_evento->nm_tp_evento ?> (<?= $evento->ic_ativo == 1 ? 'Ativo' : 'Inativo' ?>)</div>

    <div class="row justify-content-start">
        <div class="col-md-3 mt-3">
            <label>Inicio</label>
            <?= $this->Form->text('dt_inicio', ['class' => 'rounded','type' => 'date', 'value' => date_format($evento->dt_inicio, 'Y-m-d'), 'label' => false]); ?>
        </div>
        <div class="col-md-3 mt-3">
            <label>Fim</label>
            <?= $this->Form->text('dt_fim', ['class' => 'rounded','type' => 'date', 'value' => date_format($evento->dt_fim, 'Y-m-d'), 'label' => false]); ?>
        </div>
        <div class="col-md-3 mt-3">

            <?= $this->Form->control('ic_ativo', ['style' => 'width: 7em; height: 2.4em', 'type' => 'select', 'options' => ['0' => 'Inativar', '1' => 'Ativar'], 'label' => 'Alterar Status']); ?>

        </div>

        <div class="mt-5">
            <button class="btn btn-success" type=" button"><i class="fas fa-check"></i> Salvar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>