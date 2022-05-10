<?= $this->Html->css('pages_home') ?>
<div class="col-md-6 mt-4  alinhamento">
    <div class="col-12 d-flex justify-content-center title mb-5">Ficha de Inscrição</div>
    <div class="row justify-content-between">
        <div class="col-10 col-md-4 p-0 mt-0 mt-sm-3">
            <?= $this->Html->link('<i class="fas fa-user-plus fa-2x mr-2 text-verdeMedio"></i>
                        <p class="w-100 text-center m-0 fs">Bolsa Parcial</p>', ['controller' => 'candidatos', 'action' => 'add_cand', $responsavel->id], ['class' => 'd-flex btn-verdeClaro p-2 rounded', 'escape' => false]); ?>
        </div>
        <div class="col-10 col-md-4 p-0 mt-0 mt-sm-3">
            <?= $this->Html->link('<i class="fas fa-user-plus fa-2x mr-2 text-verdeClaro"></i>
                        <p class="w-100 text-center m-0 fs">Bolsa Integral</p>', ['controller' => 'candidatos', 'action' => 'add_cand', $responsavel->id], ['class' => 'd-flex btn-verdeMedio p-2 rounded', 'escape' => false]); ?>

        </div>
    </div>
</div>