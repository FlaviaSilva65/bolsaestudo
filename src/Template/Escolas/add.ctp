<div class="alinhamento">
    <?= $this->Form->create($escola, ['id' => 'form-escola', 'novalidate']) ?>
    <div class="title">Cadastro Escola</div>
    <div>

        <?= $this->form->control('nm_escola', ['label' => 'Escola']); ?><br />

        <div class="d-sm-flex flex-sm-wrap">

            <!-- <input type=hidden name="nm_tipo" value="0" /> -->
            <div class="col-4">
                <?= $this->Form->control('tipo_id_1', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[1]', 'type' => 'checkbox',  'value' => 1, 'onclick' => 'ativaAnosEI()', 'label' => 'Educação Infantil']); ?>
            </div>
            <div class="col-4">

                <?= $this->Form->control('tipo_id_2', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[2]', 'type' => 'checkbox', 'value' => 2, 'onclick' => 'ativaAnosEF()', 'label' => 'Ensino Fundamental']); ?>

            </div>
            <div class="col-4">
                <?= $this->Form->control('tipo_id_3', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;', 'id' => 'tipo_id[3]', 'type' => 'checkbox', 'value' => 3, 'onclick' => 'ativaAnosEM()', 'label' => 'Ensino Médio']); ?>

            </div>
        </div>
        <div class="row allimpa">
            <div class="col-4 position-relative allimpa">
                <div id="infantil" style="display: none;">
                    <?php foreach ($ei_tipos as $ei_tipo) : ?>

                        <?= $this->Form->control('ano_id_ei' . $ei_tipo->id, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ei_tipo->id, 'label' => $ei_tipo->nm_ano]); ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-4 position-relative allimpa">
                <div id="fundamental" style="display: none;">
                    <?php foreach ($ef_tipos as $ef_tipo) : ?>

                        <?= $this->Form->control('ano_id_ef' . $ef_tipo->id, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ef_tipo->id, 'label' => $ef_tipo->nm_ano]); ?>

                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-4 position-relative allimpa">
                <div id="medio" style="display: none;">
                    <?php foreach ($em_tipos as $em_tipo) : ?>

                        <?= $this->Form->control('ano_id_em' . $em_tipo->id, ['class' => 'mr-2', 'style' => 'width: 1em;', 'id' => 'ano_id[$em_tipo->id]', 'type' => 'checkbox', 'value' => $em_tipo->id, 'label' => $em_tipo->nm_ano]); ?>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-around mt-5">

            <div class="col-6 d-flex justify-content-end">
                <button type="button" onclick="history.back()" class="btn btn-warning" style="color: white"><i class="fas fa-reply" style="padding-right: 5px"></i>Voltar</button>
            </div>
            <div class="col-6 d-flex justify-content-start">
                <button class="btn btn-success" type=" button"><i class="fas fa-check"></i> Cadastrar</button>
            </div>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>



</div>
<div>
    <input id="urlano" value="<?= $this->Url->build(['controller' => 'Escolas', 'action' => 'opcoes_anos1']) ?>" class="d-none"></div>
<div>