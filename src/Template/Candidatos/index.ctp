<?= $this->Flash->render() ?>
<div class="container">
    <div class="w-100 d-flex justify-content-center mt-5">
        <table class="table justify-content-center" cellpadding="0" cellspacing="0">
            <?php if ($aux == 3) { ?>
                <thead>
                    <tr>
                        <th scope="col">Candidato</th>
                        <th scope="col" style="width: 25%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidatos as $candidato) : ?>
                        <tr>
                            <td>
                                <?= ($candidato->candidato->nm_candidato); ?>
                            </td>
                            <td>
                                <?= ($this->Html->link('<i class="fas fa-print"></i> Imprimir Recurso', ['action' => 'enviarRecurso', $candidato->candidato_id, $candidato->id, true, 3], ['class' => 'btn btn-success px-4 mr-2', 'escape' => false])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php } else if ($aux == 1) { ?>
                <thead>
                    <tr>
                        <th scope="col">Candidato</th>
                        <th scope="col" style="width: 25%">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($candidatos as $candidato) : ?>
                        <tr>
                            <td>
                                <?= $candidato->candidato->nm_candidato; ?>
                            </td>
                            <td>
                                <?= $this->Html->link('Exibir', ['action' => 'view', $candidato->candidato->id], ['class' => 'btn btn-info px-4 mr-2']); ?>
                            </td>
                        </tr>
                    <?php
                        $responsavel = $candidato->responsavel_id;
                    endforeach; ?>
                </tbody>

            <?php } else if ($aux == 2) { ?>
                <thead>
                    <tr>
                        <th scope="col">Candidato</th>
                        <th scope="col" style="width: 25%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidatos as $candidato) : ?>
                        <tr>
                            <td>
                                <?= $candidato->candidato->nm_candidato; ?>
                            </td>
                            <td>
                                <?= $this->Html->link('Imprimir', ['action' => 'imprimir', $candidato->candidato->id], ['class' => 'btn btn-success']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php } ?>

        </table>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-6 d-flex justify-content-center">
            <button type="button" onclick="history.back()" class="btn btn-warning mb-2 px-4 mr-4" style="color:white;"><i class="fas fa-reply" style="padding-right: 5px;"></i>Voltar</button>

            <?php if ($aux == 1) {
                echo $this->Html->link('<div class="btn btn-bolsa ml-4"><i class="fas fa-plus-square"></i> Adicionar Candidato</div>', ['action' => 'add', $responsavel], ['escape' => false]);
            } ?>
        </div>
    </div>
</div>