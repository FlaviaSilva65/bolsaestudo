<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?= $this->Html->css('estilo.css'); ?>
<div class="row justify-content-center">
    <div class="col-md-10 justify-content-center">
        <!-- <div class="row d-flex justify-content-center"> -->
        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Usuários do Sistema</h4>

        <table class="w-100 table-striped" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col" style="width:25%;">Login</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Grupo</th>
                    <th colspan="2" style="width: 30%">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->nm_user; ?></td>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->active; ?></td>
                        <td><?= $user->grupos_id; ?></td>
                        <!-- <td><?= $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-info text-white px-4', 'escape' => false]) ?></td> -->
                        <td><?= $this->Html->link('<i class="far fa-edit"></i> Editar', ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-warning text-white px-4', 'escape' => false]) ?></td>
                        <td><?= $this->Html->link('<i class="fas fa-times"></i> Excluir', ['action' => 'delete', $user->id], ['confirm' => 'Tem certeza que deseja excluir o usuário? ', 'class' => 'btn btn-sm btn-danger text-white px-4', 'escape' => false]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator d-flex justify-content-center mt-5">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('Primeira', ['class' => 'mr-2'])) ?>
                <?= $this->Paginator->prev('< ' . 'Anterior ') ?>&nbsp;&nbsp;
                <?= $this->Paginator->numbers() ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, Mostrando {{current}} registro(s) de {{count}} no total')]) ?></p>
            <ul class="pagination">&nbsp;&nbsp;
                <?= $this->Paginator->next(__('Próxima') . ' >', ['class' => 'ml-2']) ?>
                <?= $this->Paginator->last(__('Última') . ' >>') ?>
            </ul>

        </div>
    </div>
</div>