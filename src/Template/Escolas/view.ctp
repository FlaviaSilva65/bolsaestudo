<div class="alinhamento">
    <div class="azul-claro font-weight-bold w-100 mb-0 p-3">Escola: <?= $escola->nm_escola ?></div>
    <table class="w-100" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="p-2" scope="col">Tipo de Ensino</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($escola_tipos as $tipos) : ?>
                <tr>
                    <td style="width:15%;">
                        <?php if ($tipos->ic_ativo == false) { ?>
                            <?= $tipos->tipo->nm_tipo . " - Inativo"; ?>
                        <?php } else { ?>
                            <?= $tipos->tipo->nm_tipo ?>
                        <?php } ?>
                    </td>

                    <?php foreach ($tipos->escolas_tipos_anos as $anos) : ?>
                        <?php if ($tipos->ic_ativo == false) { ?>
                            <td style="width:8%; color:red">
                                <?= $anos->ano->nm_ano ?>
                            </td>
                        <?php } else if ($anos->ic_ativo == false) { ?>
                            <td style="width:8%; color:red">
                                <?= $anos->ano->nm_ano ?>
                            </td>
                        <?php } else { ?>
                            <td style="width:10%;">
                                <?= $anos->ano->nm_ano ?>
                            </td>
                        <?php } ?>
                    <?php endforeach; ?>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="alinhamento3 mt-2">
    <div class="float-left">
        <button class="btn btn-warning" type=" button" onclick="history.back()" style="color: white"><i class="fas fa-reply"></i> Voltar</button>
    </div>
    <div class="float-right">
        <?= $this->Html->link('<i class="far fa-edit"></i> Editar', ['action' => 'edit', $escola->id], ['type' => 'button', 'class' => 'btn btn-bolsa', 'escape' => false]); ?>
    </div>

</div>