<div class="alinhamento">
    <?= $this->Form->create($escola, ['id' => 'form-escola', 'novalidate']) ?>
    <div class="title">Cadastro Escola</div>
    <div>
        <div class="row">
            <div class="col-md-6 p-2 justify-content-start">
                <?= $this->form->control('nm_escola', ['label' => 'Escola', 'value' => $escola->nm_escola]); ?><br />

            </div>
            <div class="col-md-4 p-5 justify-content-end">
                <?php if ($ativo == true) { ?>
                    <?= $this->Html->link('<div class="btn btn-danger">Inativar</div>', ['action' => 'inativar', $escola->id], ['confirm' => 'Você tem certeza que deseja INATIVAR a Escola ?', 'escape' => false]) ?>
                <?php } ?>
            </div>
        </div>
        <div class="d-sm-flex flex-sm-wrap">

            <!-- <input type=hidden name="nm_tipo" value="0" /> -->


            <div class="col-4 d-flex">
                <?php if ($ei == 1 and $ei_ativo == true) {
                    echo $this->Form->control('tipo_id_1', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[1]', 'type' => 'checkbox',  'checked',  'onclick' => 'ativaAnosEI()', 'label' => 'Educação Infantil']);
                } else if ($ei == 1 and $ei_ativo == false) {
                    echo $this->Form->control('tipo_id_1', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[1]', 'type' => 'checkbox',    'onclick' => 'ativaAnosEI()', 'label' => 'Educação Infantil']);
                } else {
                    echo $this->Form->control('tipo_id_1', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[1]', 'type' => 'checkbox',    'onclick' => 'ativaAnosEI()', 'label' => 'Educação Infantil']);
                } ?>
            </div>
            <div class="col-4">
                <?php if ($ef == 2 and $ef_ativo == true) {
                    echo $this->Form->control('tipo_id_2', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[2]', 'type' => 'checkbox',  'checked', 'onclick' => 'ativaAnosEF()', 'label' => 'Ensino Fundamental']);
                } else if ($ef == 2 and $ef_ativo == false) {
                    echo $this->Form->control('tipo_id_2', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[2]', 'type' => 'checkbox', 'onclick' => 'ativaAnosEF()', 'label' => 'Ensino Fundamental']);
                } else {
                    echo $this->Form->control('tipo_id_2', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;',  'id' => 'tipo_id[2]', 'type' => 'checkbox',  'checked', 'onclick' => 'ativaAnosEF()', 'label' => 'Ensino Fundamental']);
                } ?>
            </div>
            <div class="col-4">
                <?php if ($em == 3 and $em_ativo == true) {
                    echo $this->Form->control('tipo_id_3', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;', 'id' => 'tipo_id[3]', 'type' => 'checkbox', 'checked', 'onclick' => 'ativaAnosEM()', 'label' => 'Ensino Médio']);
                } else if ($em == 3 and $em_ativo == false) {
                    echo $this->Form->control('tipo_id_3', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;', 'id' => 'tipo_id[3]', 'type' => 'checkbox',  'onclick' => 'ativaAnosEM()', 'label' => 'Ensino Médio']);
                } else {
                    echo $this->Form->control('tipo_id_3', ['class' => 'mt-4 mr-2', 'style' => 'width: 1em;', 'id' => 'tipo_id[3]', 'type' => 'checkbox',  'onclick' => 'ativaAnosEM()', 'label' => 'Ensino Médio']);
                } ?>
            </div>


        </div>


        <div class="row allimpa">

            <div class="col-4 position-relative allimpa">
                <?php if ($ei == 1) { ?>
                    <!-- AQUI VERIFICA QUAIS ANOS A ESCOLA ESTÁ DISPONIBILIZANDO DE CADA NÍVEL DE ENSINO-->

                    <div id="infantil">
                        <?php $i = 0; ?>
                        <?php foreach ($ei_tipos as $ei_tipo) : ?>
                            <?php $i++; ?>
                            <?php if ($ei_tipo->ic_ativo == false) { ?>
                                <?= $this->Form->control('ano_id_ei,' . $i, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ei_tipo->id, 'label' => $ei_tipo->ano->nm_ano]); ?>
                            <?php } else { ?>
                                <?= $this->Form->control('ano_id_ei,' . $i, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ei_tipo->id, 'checked', 'label' => $ei_tipo->ano->nm_ano]); ?>
                            <?php } ?>
                            <div><?php echo $this->Form->text('id_ei,' . $i, ['value' => $ei_tipo->id, 'type' => 'hidden']) ?></div>
                        <?php endforeach; ?>
                    </div>

                <?php } else { ?>

                    <div id="infantil" style="display: none;">
                        <?php $i = 0; ?>
                        <?php foreach ($ei_tipos as $ei_tipo) : ?>
                            <?php $i++; ?>
                            <?= $this->Form->control('ano_id_ei,' . $i, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ei_tipo->id, 'label' => $ei_tipo->nm_ano]); ?>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>

            <!-- FALTA COLOCAR A VERIFICAÇÃO PARA EXIBIR OU EDITAR }-->

            <div class="col-4 position-relative allimpa">
                <?php if ($ef == 2) { ?>
                    <div id="fundamental">
                        <?php $f = 0; ?>
                        <?php foreach ($ef_tipos as $ef_tipo) : ?>
                            <?php $f++; ?>
                            <?php if ($ef_tipo->ic_ativo == false) { ?>
                                <?= $this->Form->control('ano_id_ef,' . $f, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ef_tipo->id, 'label' => $ef_tipo->ano->nm_ano]); ?>
                            <?php } else { ?>
                                <?= $this->Form->control('ano_id_ef,' . $f, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ef_tipo->id, 'checked', 'label' => $ef_tipo->ano->nm_ano]); ?>
                            <?php } ?>

                            <div><?php echo $this->Form->text('id_ef,' . $f, ['value' => $ef_tipo->id, 'type' => 'hidden']) ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php } else { ?>
                    <div id="fundamental" style="display: none;">
                        <?php $f = 0; ?>
                        <?php foreach ($ef_tipos as $ef_tipo) : ?>
                            <?php $f++; ?>
                            <?= $this->Form->control('ano_id_ef,' . $f, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $ef_tipo->id, 'label' => $ef_tipo->nm_ano]); ?>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>

            <div class="col-4 position-relative allimpa">
                <?php if ($em == 3) { ?>
                    <div id="medio">
                        <?php $m = 0; ?>
                        <?php foreach ($em_tipos as $em_tipo) : ?>
                            <?php $m++; ?>
                            <?php if ($em_tipo->ic_ativo == false) { ?>
                                <?= $this->Form->control('ano_id_em,' . $m, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $em_tipo->id, 'label' => $em_tipo->ano->nm_ano]); ?>
                            <?php } else { ?>
                                <?= $this->Form->control('ano_id_em,' . $m, ['class' => 'mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'value' => $em_tipo->id, 'checked', 'label' => $em_tipo->ano->nm_ano]); ?>
                            <?php } ?>
                            <div><?php echo $this->Form->text('id_em,' . $m, ['value' => $em_tipo->id, 'type' => 'hidden']) ?></div>

                        <?php endforeach; ?>
                    </div>
                <?php } else { ?>

                    <div id="medio" style="display: none;">
                        <?php $m = 0; ?>
                        <?php foreach ($em_tipos as $em_tipo) : ?>
                            <?php $m++; ?>
                            <?= $this->Form->control('ano_id_em,' . $m, ['class' => 'mr-2', 'style' => 'width: 1em;', 'id' => 'ano_id[$em_tipo->id]', 'type' => 'checkbox', 'value' => $em_tipo->id, 'label' => $em_tipo->nm_ano]); ?>

                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
    <div class="row justify-content-end">
        <div class="alinhamento2">
            <button class="btn btn-success" type=" button"><i class="fas fa-check"></i> Salvar</button>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>

</div>
<div>
    <input id="urlano" value="<?= $this->Url->build(['controller' => 'Escolas', 'action' => 'opcoes_anos1']) ?>" class="d-none">
</div>
<div>
    <script>
        function pegarid() {
            var elemento = document.getElementsByName('ano_id_ef').value;
            if (elemento.checked) {
                alert(elemento);
            }
        }
    </script>