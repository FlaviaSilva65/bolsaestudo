<div class="row justify-content-center">
    <div class="col-md-10 mt-4  alinhamento">
        <div class="title">Bolsas de Estudos - Relatório por Escola</div>

        <?= $this->Form->create() ?>
        <?php if (isset($candidatos)) {
            unset($anos);
        } ?>
        <?php if (!isset($anos)) { ?>
            <div class="col-6">
                <label>Nível de Ensino</label>
                <input list="tipos" name="tipo" id="tipoid" class="col-5 rounded mb-3 ml-3" onchange="this.form.submit()" autocomplete="off" autofocus required placeholder="Selecione o Tipo de Ensino">
            </div>
        <?php } else { ?>
            <div class="col-6">
                <label>Nível de Ensino</label>
                <input list="tipos" name="tipo" id="tipoid" class="col-5 rounded mb-3 ml-3" value="<?= $nmTipo ?>" autocomplete="off" autofocus required placeholder="Selecione o Tipo de Ensino">
            </div>

        <?php } ?>


        <datalist id="tipos">
            <?php
            foreach ($tipos as $tipo) :
                echo "<option value=\"$tipo->nm_tipo\">";
            endforeach;
            ?>
        </datalist>

        <!-- Esse Datalist só vai carregar após escolher os Tipo de Ensino -->
        <?php if (isset($anos)) { ?>
            <div class="col-6" id="divAno">
                <label>Anos Escolares</label>
                <input list="anos" name="ano" id="anoid" class="col-5 rounded mb-3 ml-3" onChange="this.form.submit()" autocomplete="off" autofocus required placeholder="Selecione o Ano">
            </div>

            <datalist id="anos">
                <?php
                foreach ($anos as $ano) :
                    echo "<option value=\"$ano->nm_ano\">";
                endforeach;
                ?>
            </datalist>
        <?php } ?>



        <?= $this->Form->end() ?>

        <?php if (isset($candidatos) && $candidatos->count() > 0) { ?>
            <div class="d-flex justify-content-center">

                <table class="table-striped w-100 mx-2" cellpadding="0" cellspacing="0" id="pontos">
                    <thead>
                        <tr>
                            <th scope="col" class="pr-3" style="width: 4%">Incrição</th>
                            <th scope="col" width="8%" style="line-height: 1em">Ano<span style="font-size: 80%"> Anterior</span></th>
                            <th scope="col" width="20%">Candidato</th>
                            <th scope="col" width="10%">Deficiente</th>
                            <th scope="col">Escola</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Pontos</th>
                            <th scope="col" width="10%">Resultado</th>
                            <th style="width: 24%">Ações</th>


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

                                <td class="position-relative text-left pb-4">
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
                                    <?= ($candidato->pontos ?? '');    ?>
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
            </div>
        <?php } else { ?>
            <?php if (isset($nmAno)) : ?>
                <div class="d-flex justify-content-center">
                    <h4>Não tem candidato para <?= ($nmAno) ?> !</h4>
                </div>
            <?php endif; ?>
        <?php } ?>

    </div>

</div>
<script>
    // document.getElementById("divAno").style.display = 'none';
</script>