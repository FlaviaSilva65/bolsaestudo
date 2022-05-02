<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="col-4 alinhamento">
    <?= $this->Form->create($user, ['id' => 'formedit', 'novalidate']) ?>
    <div class="title">Edição do cadastro do Usuário</div>

    <div class="row d-flex justify-content-center">
        <div class="col-8 p-0">
            <?= $this->Form->control('nm_user', ['value' => $user->nm_user, 'label' => 'Nome do Usuário',  'escape' => false, 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-4">
            <?php if ($user->active == 1) { ?>
                <?= $this->Form->control('active', ['checked', 'label' => 'Ativo', 'class' => 'mt-4 mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'escape' => false]); ?>
            <?php } else { ?>
                <?= $this->Form->control('active', ['label' => 'Ativo', 'class' => 'mt-4 mr-2', 'style' => 'width: 1em;', 'type' => 'checkbox', 'escape' => false]); ?>
            <?php } ?>
        </div>
        <div class="col-12 p-0">
            <?= $this->Form->control('username', ['value' => $user->username, 'label' => 'Login',  'escape' => false, 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-6 pl-0">
            <?= $this->Form->control('password', ['label' => 'Senha', 'maxlength' => 10,   'id' => 'pass1', 'escape' => false, 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-6 pr-0">
            <?= $this->Form->control('password', ['label' => 'Confirme a Senha', 'onfocusout' => 'versenha()',  'id' => 'pass2', 'escape' => false, 'autofocus' => '']); ?>
        </div>
        <div class="col-12 p-0">
            <?= $this->Form->control('grupos_id', ['options' => $grupos, 'label' => 'Grupo de Usuário', 'escape' => false]); ?>
        </div>
    </div>
    <div class="row mt-4 justify-content-end">
        <div class="col-lg-12 d-flex justify-content-center">
            <button type="button" onclick="window.history.go(-1);" class="btn btn-warning mt-2 mb-2 mr-4 px-4 text-white" style="width: 140px"><i class="fas fa-reply"></i>Voltar</button>
            <button class="btn btn-success mt-2 mb-2 ml-4 px-4" type=" button"><i class="fas fa-check"></i> Confirmar</button>
        </div>
    </div>

    <div>

        <?php echo $this->Form->end(); ?>
    </div>
    <script>
        function versenha() {

            var pass1 = document.getElementById('pass1').value;
            // alert(pass1);
            var pass2 = document.getElementById('pass2').value;

            if (pass1 != pass2) {
                alert('Senha não confere!');
                document.getElementById('pass1').focus();
                document.getElementById('confirma').disabled = true;
            } else {
                document.getElementById('confirma').disabled = false;
            }
        }
    </script>