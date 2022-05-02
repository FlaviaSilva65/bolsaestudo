<?= $this->Html->css('bolsas.css'); ?>
<?= $this->Flash->render() ?>
<div class="container">
    <div class="col-md-8 mt-4  alinhamento">
        <div class="title">Bolsas de Estudos - Recurso</div>

        <blockquote class="ml-2 mt-3 ml-lg-4 mt-lg-3 mb-lg-2">Digite os dados</blockquote>
        <?= $this->Form->create(null, ['id' => 'form-evento', 'novalidate']) ?>

        <div class="row justify-content-start">
            <div class="col-md-4 mt-3">
                <label>Nascimento</label>
                <?= $this->Form->text('dt_nascimento', ['class' => 'rounded', 'style' => 'height: 2rem;', 'type' => 'date', 'label' => false]); ?>
            </div>
            <div class="col-md-4 mt-3">
                <label>Cert. Nascimento</label>
                <?= $this->Form->control('vl_numero', ['label' => false]); ?>

            </div>
            <div class="col-md-3 mt-5">
                <button class="btn btn-bolsa mt-2" type="submit"><i class="fas fa-check" style="padding-right: 5px;"></i>Recurso</button>


            </div>
            <?= $this->Form->end() ?>
        </div>

    </div>
</div>