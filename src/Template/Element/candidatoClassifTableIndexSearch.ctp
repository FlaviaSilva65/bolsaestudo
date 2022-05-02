<table class="table-striped w-100" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col" class="pr-3" style="width: 4%">Incrição</th>
            <th scope="col" style="line-height: 1em">Ano<span style="font-size: 80%"> Anterior</span></th>
            <th scope="col" width="15%">Nome da Mãe</th>
            <th scope="col" width="15%">Candidato</th>
            <th scope="col">Deficiente</th>
            <th scope="col">Escola</th>
            <th scope="col">Ano</th>
            <th scope="col" class="pr-1">Pontos</th>
            <th scope="col" style="width: 8.33%">Resultado</th>
            <th scope="col" style="width: 22%">Ações</th>

        </tr>
    </thead>

    <tbody>

        <?php foreach ($candidatos as $candidato) : ?>
            <tr>
                <td>
                    <?= ($candidato->id);    ?>
                </td>
                <td>
                    <?= ($candidato->ic_ano_anterior == 0 ? 'Não' : 'Sim');    ?>
                </td>
                <td class="position-relative text-left pb-3">
                    <p class="w-100 text-truncate position-absolute  px-2" title="<?= $candidato->nm_mae ?>"><?= strtoupper($candidato->nm_mae) ?></p>
                </td>
                <td class="position-relative text-left pb-3">
                    <p class="w-100 text-truncate position-absolute px-2" title="<?= strtoupper($candidato->nm_candidato); ?>"><?= strtoupper($candidato->nm_candidato); ?></p>
                </td>
                <td>
                    <?= ($candidato->ic_deficiente == false ? 'Não' : 'Sim');    ?>
                </td>

                <td>
                    <?= ($candidato->escola->nm_escola);    ?>
                </td>

                <td>
                    <?= ($candidato->ano->nm_ano);    ?>
                </td>
                <td>
                    <?= ($candidato->ds_moradia + $candidato->ds_dependentes + $candidato->ds_rendafamiliar + $candidato->ds_transporte);    ?>
                </td>
                <td>
                    <?php
                    if (is_null($candidato->ic_aprovado)) {
                        echo '<div class="p-1"><strong>Não avaliado</strong></div>';
                    } else if ($candidato->ic_aprovado == 0) {
                        echo '<div class="p-1  text-danger"><strong>Indeferido</strong></div>';
                    } else if ($candidato->ic_aprovado == 1) {
                        echo '<div class="p-1 text-success"><strong>Deferido</strong></div>';
                    } else if ($candidato->ic_aprovado == -1) {
                        echo '<div class="p-1  text-warning"><strong>Cancelado</strong></div>';
                    }
                    ?>
                </td>
                <td class="d-flex justify-content-center">
                    <?php
                    if (is_null($candidato->ic_aprovado)) {
                        echo $this->Html->link('<i class="fas fa-check"></i> Deferir', ['action' => 'deferir', $candidato->id], ['class' => 'btn btn-success btn-sm mx-1 mb-1', 'escape' => false]);
                        // echo $this->Html->link('<div class="p-1 bg-success text-white m-1">Deferir</div>', ['action' => 'deferir', $candidato->id], ['escape' => false]);
                        echo $this->Html->link('<i class="fas fa-times"></i> Indeferir', ['action' => 'indeferir', $candidato->id], ['class' => 'btn btn-danger btn-sm mx-1 mb-1', 'escape' => false]);
                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                    } else if ($candidato->ic_aprovado == 0) {
                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                    } else if ($candidato->ic_aprovado == 1) {
                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                    } else if ($candidato->ic_aprovado == -1) {
                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                    }

                    ?>
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