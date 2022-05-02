<!-- SEDUC DPID - Flavia Aparecida 47093 em 23/03/2021 -->
<script>
    $(".passingID").click(function() {
        var ids = $(this).attr('data-id');
        $("#aux").val(ids);
        $('#myModal').modal('show');
    });
</script>
<div class="modal fade" id="modalLogincand" tabindex="-1" aria-hidden="true">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Candidatos', 'action' => 'login']]) ?>
    <div class="modal-dialog modal-dialog-centered justify-content-center">
        <div class="col-12 col-sm-8 col-lg-4 p-0 bg-white shadow modal-content">
            <div class="d-flex text-center py-2 bg-td8">
                <h6 class="w-100 ls01 font-weight-bold text-white ml-3"><i class="fas fa-id-card mr-2"></i>IDENTIFICAÇÃO</h6>
                <button type="button" class="btn btn-primary btn-sm py-0 mr-2" data-dismiss="modal" title="Fechar"><i class="fas fa-times"></i></button>
            </div>
            <div class="px-3">

                <?=
                    $this->form->control('aux', ['value' => '', 'id' => 'aux', 'type' => 'hidden']) .
                        $this->Form->control('vl_cpf', ['label' => '<i class="fas fa-user mr-1"></i>Digite o CPF do Responsável', 'maxlength' => 40, 'escape' => false, 'autocomplete' => 'off', 'class' => 'cpf']) .
                        '<div class="mostra_pass_eye mt-2">' .
                        $this->Form->control('dt_nascimento', ['label' => '<i class="fas fa-key mr-1"></i>Data de Nasc. Responsável', 'maxlength' => 40, 'escape' => false, 'class' => 'date']) .
                        '<i class="far fa-eye-slash mostra_pass mt-2" onClick="mostra_pass(\'password\',this)"></i>' .
                        '</div>'
                ?>
            </div>
            <div class="d-flex justify-content-end p-2 mt-3 bg-td8">
                <?= $this->Html->image('cps.png', ['id' => 'cps']) ?>
                <button type="submit" class="btn btn-primary btn-sm ml-2"><i class="fas fa-sign-in-alt mr-2"></i>Acessar</button>
                <script>
                    capslock()
                </script>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>