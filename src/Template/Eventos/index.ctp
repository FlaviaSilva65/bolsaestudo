<?= $this->Html->css('estilo.css'); ?>
<div class="row justify-content-center">
    <div class="col-md-10 justify-content-center">
        <!-- <div class="row d-flex justify-content-center"> -->
        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Cronograma das Etapas</h4>
        <?php $obs = true; ?>
        <table class="w-100 table-striped" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Tipo da Etapa</th>
                    <th scope="col">Ano do Eventos</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Fim</th>
                    <th scope="col">Status</th>

                    <th colspan="2" scope="col">Ações</th>


                </tr>
            </thead>

            <tbody>
                <?php foreach ($eventos as $evento) : ?>
                    <tr>
                        <td><?= $evento->tp_evento->nm_tp_evento ?></td>
                        <td><?= $evento->ano_evento ?></td>
                        <td><?= $evento->dt_inicio ?></td>
                        <td><?= $evento->dt_fim ?></td>
                        <td><?= $evento->ic_ativo ?></td>

                        <!-- <td>
                            <?= $this->Html->link('Exibir', ['action' => 'view', $evento->id], ['class' => 'btn btn-sm btn-info text-white px-4']) ?>
                        </td> -->
                        <td>
                            <?= $this->Html->link('<i class="far fa-edit"></i> Editar', ['action' => 'edit', $evento->id], ['class' => 'btn btn-sm btn-warning text-white px-4', 'escape' => false]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>