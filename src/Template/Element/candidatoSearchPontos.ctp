<table class="table-striped w-100" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col" class="pr-3" style="width: 4%">Incrição</th>
            <th scope="col" width="8%" style="line-height: 1em">Ano<span style="font-size: 80%"> Anterior</span></th>
            <th scope="col" width="15%">Nome da Mãe</th>
            <th scope="col" width="15%">Candidato</th>
            <th scope="col">Deficiente</th>
            <th scope="col">Escola</th>
            <th scope="col">Ano</th>
            <th scope="col" class="pr-1">Pontos</th>
            <th scope="col" style="width: 10%">Resultado</th>
            <th scope="col" style="width: 20%">Ações</th>

        </tr>
    </thead>

    <tbody>

        <?php foreach ($candidatos as $candidato) : ?>
            <tr>
                <td>
                    <?= ($candidato->candidato->id);    ?>
                </td>
                <td>
                    <?= ($candidato->candidato->ic_ano_anterior == 0 ? 'Não' : 'Sim');    ?>
                </td>
                <td class="position-relative text-left pb-3">
                    <p class="w-100 text-truncate position-absolute  px-2" title="<?= $candidato->responsavel->nm_responsavel ?>"><?= strtoupper($candidato->responsavel->nm_responsavel) ?></p>
                </td>

                <td class="position-relative text-left pb-3">
                    <p class="w-100 text-truncate position-absolute px-2" title="<?= strtoupper($candidato->candidato->nm_candidato); ?>"><?= strtoupper($candidato->candidato->nm_candidato); ?></p>
                </td>
                <td>
                    <?= ($candidato->candidato->ic_deficiente == false ? 'Não' : 'Sim');    ?>
                </td>

                <td>
                    <?= ($candidato->candidato->escola->nm_escola);    ?>
                </td>

                <td>
                    <?= ($candidato->candidato->ano->nm_ano);    ?>
                </td>
                <td>
                    <?= ($candidato->pontos);    ?>
                </td>
                <td>
                    <?php
                    if (is_null($candidato->candidato->ic_aprovado)) {
                        echo '<div class="p-1"><strong>Não avaliado</strong></div>';
                    } else if ($candidato->candidato->ic_aprovado == 0) {
                        echo '<div class="p-1  text-danger"><strong>Indeferido</strong></div>';
                    } else if ($candidato->candidato->ic_aprovado == 1) {
                        echo '<div class="p-1 text-success"><strong>Deferido</strong></div>';
                    } else if ($candidato->candidato->ic_aprovado == -1) {
                        echo '<div class="p-1  text-warning"><strong>Cancelado</strong></div>';
                    }
                    ?>
                </td>
                <td class="d-flex justify-content-center">
                    <?php
                    if (is_null($candidato->candidato->ic_aprovado)) {
                        echo $this->Html->link('Deferir', ['action' => 'deferir', $candidato->candidato->id], ['class' => 'btn btn-success btn-sm mx-1 mb-1']);
                        // echo $this->Html->link('<div class="p-1 bg-success text-white m-1">Deferir</div>', ['action' => 'deferir', $candidato->id], ['escape' => false]);
                        echo $this->Html->link('Indeferir', ['action' => 'indeferir', $candidato->candidato->id], ['class' => 'btn btn-danger btn-sm mx-1 mb-1']);
                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                    } else if ($candidato->candidato->ic_aprovado == 0) {
                        echo $this->Html->link('Exibir', ['action' => 'aprovar', $candidato->candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                    } else if ($candidato->candidato->ic_aprovado == 1) {
                        echo $this->Html->link('Exibir', ['action' => 'aprovar', $candidato->candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                    } else if ($candidato->candidato->ic_aprovado == -1) {
                        echo $this->Html->link('Exibir', ['action' => 'aprovar', $candidato->candidato->id], ['class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
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
<script>

</script>