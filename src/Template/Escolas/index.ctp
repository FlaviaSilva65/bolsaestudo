<?= $this->Html->css('estilo.css'); ?>
<!-- <div class="container"> -->
<div class="row justify-content-center">
    <div class="col-md-10 justify-content-center">
        <!-- <div class="row d-flex justify-content-center"> -->
        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Escolas</h4>
        <div class="col-12 d-flex justify-content-center mt-4 mb-3">
            <?= $this->Html->link('<i class="fas fa-plus"></i> Cadastrar', ['action' => 'add'], ['class' => 'btn btn-sm btn-success', 'escape' => false]); ?>
        </div>
        <?php $obs = true; ?>
        <table class="w-100 table-striped mb-5">
            <thead>
                <tr>
                    <th scope="col" style="width:25%;">Nome</th>
                    <th scope="col">Tipo de Ensino</th>
                    <th scope="col">Status</th>
                    <th colspan="3" scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($escolas as $escola) : ?>
                    <tr>
                        <?php if ($escola->ic_ativo == 0) { ?>
                            <td style="font-weight:bold; color: red;"><?= ($escola->nm_escola); ?></td>
                        <?php } else { ?>
                            <td><?= ($escola->nm_escola); ?></td>
                        <?php } ?>

                        <td>
                            <?php foreach ($escola->escolas_tipos as $tipo) :
                                if ($tipo->ic_ativo == false) { ?>
                                    <?php $cor = dechex(mt_rand(0xFF0000, 0xFF0000));

                                    echo "<b><span style=\"color:#{$cor}\">" . $tipo->tipo->nm_tipo . "</span></b>" . ', '; ?>


                                <?php } else { ?>

                                    <?= ($tipo->tipo->nm_tipo) . ', '; ?>

                            <?php }
                            endforeach; ?>
                        </td>
                        <?php if ($escola->ic_ativo == 0) { ?>
                            <td style="font-weight:bold; color: red;"><?= 'Inativo' ?></td>
                        <?php } else { ?>
                            <td> <?= 'Ativo'  ?></td>
                        <?php } ?>
                        <td>
                            <?= $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'view', $escola->id], ['class' => 'btn btn-sm btn-info text-white px-4', 'escape' => false]) ?>
                        </td>
                        <!-- <td>
                            
                        </td> -->
                        <td>
                            <?= $this->Html->link('<i class="far fa-edit"></i> Editar', ['action' => 'edit', $escola->id], ['class' => 'btn btn-sm btn-warning text-white px-4', 'escape' => false]) ?>

                        </td>
                        <td>
                            <?= $this->Html->link('<i class="fas fa-times"></i> Excluir', ['action' => 'delete', $escola->id], ['confirm' => 'Tem certeza que deseja excluir a escola? ', 'class' => 'btn btn-sm btn-danger text-white px-4', 'escape' => false]) ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="w-100 text-secondary d-flex justify-content-center">
            <?= $this->Paginator->prev(['format' => __('<< Anterior')]) ?>
            <?= $this->Paginator->counter(['format' => __('&emsp; - &emsp;Mostrando&nbsp;<b> {{current}} </b>&nbsp;registros de um total de&nbsp;<b>{{count}}</b>&emsp; - &emsp;')]) ?>
            <?= $this->Paginator->next('Próxima >>') ?>
        </div>
    </div>
</div>