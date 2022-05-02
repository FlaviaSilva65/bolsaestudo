<?= $this->Html->css('estilo.css'); ?>
<!-- <div class="container"> -->
<div class="row justify-content-center">
    <div class="col-md-10 justify-content-center">
        <!-- <div class="row d-flex justify-content-center"> -->
        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Arquivos</h4>
        <div class="col-12 d-flex justify-content-center mt-4 mb-3">
            <?= $this->Html->link('<i class="fas fa-plus"></i> Cadastrar', ['action' => 'add'], ['class' => 'btn btn-sm btn-success', 'escape' => false]); ?>
        </div>
        <?php $obs = true; ?>
        <table class="w-100 table-striped" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" style="width:25%;">Nome</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Status</th>
                    <th colspan="3" scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($arquivos as $arquivo) : ?>
                    <tr>
                        <?php if ($arquivo->ativo == 0) { ?>
                            <td style="font-weight:bold; color: red;"><?= strtoupper($arquivo->nm_arquivo); ?></td>
                        <?php } else { ?>
                            <td><?= strtoupper($arquivo->nm_arquivo); ?></td>
                        <?php } ?>

                        <td><?= strtoupper($arquivo->tp_edital); ?></td>

                        <?php if ($arquivo->ativo == 1) { ?>
                            <td style="font-weight:bold; color: red;"><?= strtoupper('Ativo') ?></td>
                        <?php } else { ?>
                            <td> <?= strtoupper('Inativo') ?></td>
                        <?php } ?>
                        <td>
                            <?= $this->Html->link('<i class="far fa-eye"></i> Exibir', '/arquivos/' . $arquivo->nm_arquivo, ['target' => 'blank', 'class' => 'btn btn-sm btn-info text-white px-4', 'escape' => false]) ?>
                        </td>

                        <td>
                            <?= $this->Html->link('<i class="far fa-edit"></i> Editar', ['action' => 'edit', $arquivo->id], ['class' => 'btn btn-sm btn-warning text-white px-4', 'escape' => false]) ?>

                        </td>
                        <td>
                            <?= $this->Html->link('<i class="fas fa-times"></i> Excluir', ['action' => 'delete', $arquivo->id], ['confirm' => 'Tem certeza que deseja excluir a arquivo? ', 'class' => 'btn btn-sm btn-danger text-white px-4', 'escape' => false]) ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="w-100 text-secondary d-flex justify-content-center mt-5">
            <?= $this->Paginator->prev(['format' => __('<< Anterior')]) ?>
            <?= $this->Paginator->counter(['format' => __('&emsp; - &emsp;Mostrando&nbsp;<b> {{current}} </b>&nbsp;registros de um total de&nbsp;<b>{{count}}</b>&emsp; - &emsp;')]) ?>
            <?= $this->Paginator->next('Próxima >>') ?>
        </div>
    </div>
</div>