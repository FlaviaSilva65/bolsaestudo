<!-- SEDUC DPID - Flavia A S Silva 47093 em 12/01/2021 -->

<?= $this->Html->css('estilo.css'); ?>
<div class="container pl-0 pr-0">


    <div class="row d-flex justify-content-center">

        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Dados do Candidato</h4>

        <table class="w-100 table-striped ">
            <thead>
                <tr>
                    <th>Inscrição Nro</th>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>Data de Nascimento</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?= $candidato->id; ?></td>
                    <td><?= $candidato->nm_candidato; ?></td>
                    <td><?= $candidato->vl_rg ?></td>
                    <td><?= $candidato->dt_nascimento->format('d/m/Y'); ?></td>
                </tr>
            </tbody>

            <thead>
                <tr>
                    <th>Certidão</th>
                    <th>Livro</th>
                    <th></th>
                    <th>Folha</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?= $candidato->vl_ctnumero; ?></td>
                    <td><?= $candidato->vl_ctlivro; ?></td>
                    <td></td>
                    <td><?= $candidato->vl_ctfolha; ?></td>
                </tr>
            </tbody>

            <thead>
                <tr>
                    <th>Mãe</th>
                    <th>Pai</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?= $candidato->nm_mae; ?></td>
                    <td><?= $candidato->nm_pai; ?></td>
                    <td><?= $candidato->nm_rua . ', Nº' . $candidato->vl_numero; ?></td>
                    <td><?= $candidato->nm_bairro; ?></td>
                </tr>
            </tbody>

            <thead>
                <tr>
                    <th>Cidade</th>
                    <th>CEP</th>
                    <th>Telefone</th>
                    <th>Telefone Residencial / Contato</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><?= $candidato->nm_cidade; ?></td>
                    <td><?= $candidato->vl_cep; ?></td>
                    <td><?= $candidato->vl_tel; ?></td>
                    <td><?= $candidato->vl_cel; ?></td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th>1ª Opção Unidade</th>
                    <th>Ano escolar</th>
                    <th>Ensino</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $candidato->escola->nm_escola; ?></td>
                    <td>
                        <?php if ($candidato->tipo_id == 1) : ?>
                            Ed. Infantil
                        <?php elseif ($candidato->tipo_id == 2) : ?>
                            Ed. Fundamental
                        <?php elseif ($candidato->tipo_id == 3) : ?>
                            Ens. Médio
                        <?php endif ?>
                    </td>
                    <td><?= $candidato->ano->nm_ano; ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <br /><br />
        <!-- <div class="row d-flex justify-content-center"> -->
        <!-- <div class="w-100 title"> -->
        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Dados do Responsável</h4>
        <!-- </div> -->
        <table class="w-100 table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $candidato->responsavel->nm_responsavel; ?></td>
                    <td><?= $candidato->responsavel->vl_rg_resp; ?></td>
                    <td><?= $candidato->responsavel->nm_email; ?></td>
                    <td><?= date_format($candidato->responsavel->dt_nascimento, 'd/m/Y'); ?></td>
                </tr>
            </tbody>

            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Título</th>
                    <th>Zona eleitoral</th>
                    <th>Seção eleitoral</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $candidato->responsavel->vl_cpf; ?></td>
                    <td><?= $candidato->responsavel->vl_titulo; ?></td>
                    <td><?= $candidato->responsavel->vl_zona; ?></td>
                    <td><?= $candidato->responsavel->vl_secao; ?></td>

                </tr>
            </tbody>
        </table>
        <!-- </div> -->
        <br /><br />
        <?php $trabalho = ($candidato->responsavel->nm_rua != '' ? true : false); ?>

        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Dados da Empresa</h4>

        <table class="w-100 table-striped">
            <tr>
                <?php if ($trabalho == true) { ?>
                    <th colspan="5">Profissão</th>
                <?php } else {  ?>
                    <th>Profissão</th>
                    <th>Trabalho(empresa)</th>
                    <th colspan="2">Endereço</th>
                    <th>Bairro</th>
                <?php } ?>
            </tr>

            <tr> <?php if ($trabalho == true) { ?>
                    <td colspan="5"><?= $candidato->responsavel->ds_profissao; ?></td>
                <?php } else { ?>
                    <td><?= $candidato->responsavel->ds_profissao; ?></td>
                    <td><?= $candidato->responsavel->ds_trabalho . ' ' . $trabalho; ?></td>
                    <td colspan="2"><?= $candidato->responsavel->nm_rua_trab . ' , Nº ' . $candidato->responsavel->vl_numero_trab; ?></td>
                    <td><?= $candidato->responsavel->nm_bairro_trab; ?></td>

            </tr>

            <tr>
                <th>Cidade</th>
                <th>CEP</th>
                <th colspan="2">Telefone</th>
                <th></th>
            </tr>

            <tr>
                <td><?= $candidato->responsavel->nm_cidade_trab; ?></td>
                <td><?= $candidato->responsavel->vl_cep_trab; ?></td>
                <td colspan="2"><?= $candidato->responsavel->cd_telefone; ?></td>
                <td></td>
            <?php } ?>
            </tr>

            <tr>

                <?php if ($candidato->responsavel->concessao_fam == 3) { ?>
                    <th colspan="2">Alguém da Família possui bolsa pela Prefeitura</th>
                    <th>Não</th>
                    <th></th>
                <?php } else { ?>
                    <th>Alguém da Família possui bolsa pela Prefeitura</th>
                    <th>Nome do aluno</th>
                    <th colspan="2">Nome da escola</th>

                <?php } ?>
                <th></th>
            </tr>
            <tr>
                <td>
                    <?php if ($candidato->responsavel->concessao_fam == 0) : ?>
                        Sim / Bolsa Parcial
                    <?php elseif ($candidato->responsavel->concessao_fam  == 1) : ?>
                        Sim / Bolsa Integral
                    <?php elseif ($candidato->responsavel->concessao_fam  == 2) : ?>
                        Sim / Transporte Universitário
                    <?php endif ?>
                </td>
                <td><?= $candidato->responsavel->concessao_aluno; ?></td>

                <td><?= $candidato->responsavel->concessao_escola; ?></td>
                <td></td>
            </tr>
        </table>

        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Questionário Sócio-Econômico</h4>


        <table class="w-100 table-striped">
            <tr>
                <th>Moradia</th>
                <th> </th>
                <th>Dependentes Menores de 18 anos</th>
            </tr>

            <tr>
                <td>
                    <?php if ($candidato->ds_moradia == 4) : ?>
                        Alugada
                    <?php elseif ($candidato->ds_moradia == 3) : ?>
                        Financiada
                    <?php elseif ($candidato->ds_moradia == 2) : ?>
                        Cedida
                    <?php elseif ($candidato->ds_moradia == 1) : ?>
                        Própria
                    <?php endif ?>
                </td>

                <td> </td>
                <td>
                    <?php if ($candidato->ds_dependentes == 1) : ?>
                        1
                    <?php elseif ($candidato->ds_dependentes == 2) : ?>
                        2
                    <?php elseif ($candidato->ds_dependentes == 3) : ?>
                        3
                    <?php elseif ($candidato->ds_dependentes == 4) : ?>
                        4
                    <?php elseif ($candidato->ds_dependentes == 5) : ?>
                        Mais de 4
                    <?php endif ?>
                </td>
            </tr>

            <tr>
                <th>Renda familiar / Salário mínimo</th>
                <th width="50"> </th>
                <th>Meio de transporte utilizado</th>
            </tr>

            <tr>
                <td>
                    <?php if ($candidato->ds_rendafamiliar == 4) : ?>
                        3 a 5
                    <?php elseif ($candidato->ds_rendafamiliar == 3) : ?>
                        6 a 10
                    <?php elseif ($candidato->ds_rendafamiliar == 2) : ?>
                        11 a 15
                    <?php elseif ($candidato->ds_rendafamiliar == 1) : ?>
                        mais de 16
                    <?php endif ?>
                </td>
                <td width="50"> </td>

                <td>
                    <?php if ($candidato->ds_transporte == 5) : ?>
                        Coletivo
                    <?php elseif ($candidato->ds_transporte == 4) : ?>
                        Fretado
                    <?php elseif ($candidato->ds_transporte == 3) : ?>
                        Particular
                    <?php endif ?>
                </td>
            </tr>
        </table>
        <h4 class="azul-claro font-weight-bold w-100 text-center mb-0 p-3">Observações</h4>
        <table class="w-100 table-striped">
            <tr>
                <td colspan="4">
                    <?= $candidato->ds_info_compl ?>
                </td>
            </tr>
        </table>

    </div>
    <div class="row mt-4 mb-4 justify-content-around">
        <div class="col-4">
            <button type="button" onclick="history.back()" class="btn btn-warning" style="color: white"><i class="fas fa-reply text-white" style="padding-right: 5px;"></i>Voltar</button>
        </div>
        <div class="col-4 d-flex justify-content-center">
            <button class="btn btn-bolsa" type=" button">
                <?= $this->Html->link('<i class="fas fa-print"></i> Imprimir Ficha de Inscrição', ['action' => 'imprimir', $candidato->id], ['style' => 'color: #ffffff;', 'escape' => false]) ?>
            </button>

        </div>

        <div class="col-4 d-flex justify-content-end">
            <button class="btn btn-success" type=" button">
                <?= $this->Html->link('<i class="fas fa-check"></i> Receber ', ['action' => 'receber', $candidato->id], ['style' => 'color: #ffffff', 'escape' => false]) ?>
            </button>
        </div>
    </div>




</div>