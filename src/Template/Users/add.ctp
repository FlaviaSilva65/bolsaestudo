<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="col-4 alinhamento">
    <?= $this->Form->create(null, ['url' => ['controller' => 'users', 'action' => 'add']]) ?>
    <div class="title">Cadastro do Usuário</div>

    <?= $this->Form->control('nm_user', ['label' => 'Nome do Usuário', 'escape'=>false,'autocomplete'=>'off']); ?>
    <?= $this->Form->control('username', ['label' => 'Login', 'escape'=>false,'autocomplete'=>'off']); ?>
    <?= $this->Form->control('password',['label' => 'Senha', 'escape'=>false,'autocomplete'=>'off']); ?>
    <?= $this->Form->control('grupos_id', ['options' => $grupos, 'label' => 'Grupo de Usuário', 'escape' => false]); ?>

    <div class="row mt-4 justify-content-end">
        <div class="alinhamento2">
            <button class="btn btn-success" type=" button">Cadastrar</button>
        </div>
    </div>

    <div>

        <div class="users form large-9 medium-8 columns content">


            <?php
            // echo $this->Form->control('active');

            // echo $this->Form->control('sistema');
            ?>


        </div>

        <?php echo $this->Form->end(); ?>
    </div>