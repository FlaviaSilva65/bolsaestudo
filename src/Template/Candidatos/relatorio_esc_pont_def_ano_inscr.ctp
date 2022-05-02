<div class="row justify-content-center">
    <div class="col-md-10 mt-4  alinhamento">
        <div class="title">Bolsas de Estudos - Relatório por Escola</div>

        <?= $this->Form->create() ?>

        <input list="escolas" name="escola" id="escolaid" class="col-12 rounded mb-3" onChange="this.form.submit()" autocomplete="off" autofocus required placeholder="Nome da Escola">


        <datalist id="escolas">
            <?php
            foreach ($escolas as $escola) :
                echo "<option value=\"$escola->nm_escola\">";
            endforeach;
            ?>
        </datalist>

        <?= $this->Form->end() ?>

        <?php if (isset($candidatos)) { ?>
            <div class="d-flex justify-content-center">

                <table class="table-striped w-100 mx-2" cellpadding="0" cellspacing="0" id="pontos">
                    <thead>
                        <tr>
                            <th scope="col" class="pr-3" style="width: 4%">Incrição</th>
                            <th scope="col" width="8%" style="line-height: 1em">Ano<span style="font-size: 80%"> Anterior</span></th>
                            <th scope="col" width="25%">Candidato</th>
                            <th scope="col" width="8%">Def.</th>
                            <th scope="col">Escola</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Pontos</th>
                            <th scope="col" width="10%" id="noprint">Resultado</th>
                            <th style="width: 24%" id="noprint">Ações</th>


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
                                    <p class="w-100 px-2" title="<?= strtoupper($candidato->candidato->nm_candidato); ?>"><?= strtoupper($candidato->candidato->nm_candidato); ?></p>
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
                                <td id="noprint">
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
                                        echo $this->Html->link('<i class="fas fa-check"></i> Deferir', ['action' => 'deferir', $candidato->id], ['id' => 'noprint', 'class' => 'btn btn-success btn-sm mx-1 mb-1', 'escape' => false]);
                                        echo $this->Html->link('<i class="fas fa-times"></i> Indeferir', ['action' => 'indeferir', $candidato->id], ['id' => 'noprint', 'class' => 'btn btn-danger btn-sm mx-1 mb-1', 'escape' => false]);
                                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['id' => 'noprint', 'class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                                    } else if ($candidato->ic_aprovado == 0) {
                                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['id' => 'noprint', 'class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                                    } else if ($candidato->ic_aprovado == 1) {
                                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['id' => 'noprint', 'class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                                    } else if ($candidato->ic_aprovado == -1) {
                                        echo $this->Html->link('<i class="far fa-eye"></i> Exibir', ['action' => 'aprovar', $candidato->id], ['id' => 'noprint', 'class' => 'btn btn-info btn-sm mx-1 mb-1 px-3', 'escape' => false]);
                                    }

                                    ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php } ?>

        <style>
            .next,
            .prev {
                list-style-type: none;

            }

            .next>a,
            .prev>a {

                color: #6c757d;

            }

            @media print {
                #noprint {
                    display: none;
                }
            }
        </style>
        <?php if (isset($candidatos)) { ?>
            <div id="noprint">
                <div class="w-100 text-secondary d-flex justify-content-center">
                    <?= $this->Paginator->prev(['format' => __('<< Página Anterior ')]) ?>

                    <?= $this->Paginator->counter(['format' => __('&emsp; - &emsp;Mostrando&nbsp;<b> {{current}} </b>&nbsp;registros de um total de&nbsp;<b>{{count}}</b>&emsp; - &emsp;')]) ?>

                    <?= $this->Paginator->next([' format' => __(' Próximo Página >>')]) ?>

                </div>
            </div>
        <?php } ?>

    </div>
    <div class="col-sm-12 mt-5 mb-5 d-flex justify-content-center" id=" noprint">
        <button class="btn btn-success btn-lg float-right mr-4 no-print" id="btnImprimir" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
    </div>

</div>
<script>
    function imprimir() {
        window.print();
    }
</script>