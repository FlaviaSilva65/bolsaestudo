<table class="table-striped w-100" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col">Inscrição</th>
            <th scope="col" style="width:15%;">Candidato</th>
            <th scope="col" style="width:15%;">Mãe</th>
            <th scope="col">Nascimento</th>
            <th scope="col">Certidão</th>
            <th scope="col" style="width: 30%">Ações</th>

        </tr>
    </thead>

    <tbody>

        <?php foreach ($candidatos as $candidato) : ?>
            <tr>
                <td>
                    <?= ($candidato->id);    ?>
                </td>
                <td style="white-space: nowrap;overflow:hidden;text-overflow: ellipsis;">
                    <?= mb_strtoupper($candidato->nm_candidato);    ?>
                </td>
                <td style="white-space: nowrap;overflow:hidden;text-overflow: ellipsis;">
                    <?= mb_strtoupper($candidato->nm_mae);    ?>
                </td>
                <td>
                    <?= ($candidato->dt_nascimento);    ?>
                </td>
                <td>
                    <?= ($candidato->vl_ctnumero);    ?>
                </td>
                <td class="d-flex justify-content-center">
                    <?= $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'view_admin', $candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'style' => 'width: 100px; height:30px;', 'escape' => false]) ?>
                    <!-- <?= $this->Html->link('<div class="btnAction">Exibir</div>', ['action' => 'view_admin', $candidato->id], ['escape' => false]) ?> -->

                    <?= $this->Html->link('<i class="far fa-edit"></i> Editar', ['action' => 'edit_admin', $candidato->id], ['class' => 'btn btn-warning btn-sm mx-1 mb-1 px-3', 'style' => 'color: #ffffff;  width: 100px; height:30px;', 'escape' => false]) ?>
                    <!-- <?= $this->Html->link('<div class="btnActionEdit">Editar</div>', ['action' => 'edit_admin', $candidato->id], ['escape' => false]) ?> -->

                    <?= $this->Html->link('<i class="fas fa-times"></i> Excluir', ['action' => 'delete', $candidato->id], ['class' => 'btn btn-danger btn-sm mx-1 mb-1 px-3', 'confirm' => 'Você tem certeza que deseja excluir o candidato ?', 'style' => 'width: 100px; height:30px;', 'escape' => false]) ?>
                    <!-- <?= $this->Html->link('<div class="btnActionExc">Excluir</div>', ['action' => 'delete', $candidato->id], ['confirm' => 'Você tem certeza que deseja excluir o candidato ?', 'escape' => false]) ?> -->


                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<style>
    .next,
    .prev {
        list-style-type: none;

    }

    .next>a,
    .prev>a {

        color: #6c757d;

    }
</style>
<div class="w-100 text-secondary d-flex justify-content-center">
    <?= $this->Paginator->prev(['format' => __('<< Página Anterior ')]) ?>

    <?= $this->Paginator->counter(['format' => __('&emsp; - &emsp;Mostrando&nbsp;<b> {{current}} </b>&nbsp;registros de um total de&nbsp;<b>{{count}}</b>&emsp; - &emsp;')]) ?>

    <?= $this->Paginator->next([' format' => __(' Próximo Página >>')]) ?>

</div>
<div class="w-100 d-flex justify-content-center mt-5 mb-5">
    <?= $this->Html->link('<div type="button" class="btn-success btn-sm pa-2"><i class="fas fa-print"></i> Imprimir Lista de Candidatos</div>', ['controller' => 'candidatos', 'action' => 'listar_inscritos'], ['escape' => false]); ?>

</div>
<script>

</script>