<?= $this->Html->css('bolsas.css'); ?>
<?= $this->Flash->render() ?>
<div class="container">
    <div class="col-md-8 mt-4  alinhamento">
        <div class="title">Bolsas de Estudos</div>

        <div class="row justify-content-start">

        <?= $this->Html->link('home', ['controller' => 'pages', 'action' => 'home'], ['id' => 'home', 'class' => 'd-none']); ?>

        <div class="col-md-4 mt-3">
        <button type="button" onclick="history.back()" class="btn btn-warning mb-2 px-4"><i class="fas fa-reply" style="padding-right: 5px"></i>Voltar</button>
        </div>
            <div class="col-md-4 mt-3">
            <?= $this->Html->link('<div class="btn btn-bolsa"><i class="fas fa-plus-square"></i> Adicionar Candidato</div>', ['action' => 'add', $responsavel->id], ['escape' => false]); ?>
            </div>
            
        </div>

    </div>
</div>