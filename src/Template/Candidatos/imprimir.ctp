<?= $this->Html->css('print.css'); ?>

<div class="container-fluid" id="divDeclaracao">
    <div class="row d-flex justify-content-center align-items-center page">
        <div id="cabecalho" class=" w-100">
            <p><span><strong><?= $this->Html->image('cabecalho_pg.jpg', ['class' => 'cabecalho']) ?></strong></span></p>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3 mb-5 px-5">
                <h3 style="text-align: center;">DECLARAÇÃO</h3><br />
                <div class="titulo">
                    <p style="text-align: left;">Declaro para os devidos fins que:
                    </p>
                </div>
                <div class="mb-5">
                    <ol>
                        <li>
                            <p style="text-align: justify;">
                                Responsabilizo-me pela veracidade e idoneidade das informações prestadas por mim, ciente de que será
                                imediatamente cancelada a <b>BOLSA DE ESTUDO</b> concedida, no caso de ser provada a falsidade ou inveracidade
                                das informações declaradas em documentos apresentados, sujeitando-me às penalidades previstas por lei.
                            </p>
                        </li>
                        <br />
                        <li>
                            <p style="text-align: justify;">
                                Estou ciente das normas legais que regulamentam a <b>CONCESSÃO DO BENEFÍCIO</b>, especialmente o art. 7º e incisos
                                da Lei Complementar nº. 497, de 13 de dezembro de 2007, caso seja deferido o pedido de <b>CONCESSÃO DO BENEFÍCIO</b>,
                                sob pena de cancelamento.
                            </p>
                        </li>
                        <br />
                        <li>
                            <p style="text-align: justify;">
                                Não sou beneficiado(a) com Bolsa de Estudo por outra instituição.
                            </p>
                        </li>
                        <br />
                        <li>
                            <p style="text-align: justify;">Resido no Município de Praia Grande</p>
                        </li>
                    </ol>
                </div>

                <div class="mt-5 mb-5" style="text-align: center;">
                    <?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');
                    ?>
                    <p>Praia Grande, <?= utf8_encode(strftime("%d de %B  de %Y", strtotime('today'))) ?></p>
                </div>
                <br />
                <div class="mt-5 " style="text-align: center;">
                    _____________________________________________

                </div>
                <div class="mb-5" style="text-align: center;">
                    <p>Assinatura do candidato ou responsável</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center page">
        <div id="cabecalho" class="mt-0 mb-0 w-100">
            <p><span><strong><?= $this->Html->image('cabecalho_pg.jpg', ['class' => 'cabecalho']) ?></strong></span></p>
        </div>

        <h3 class="mt-0" style=" font-family: Verdana;">Bolsa de Estudos - Formulário de Inscrição</h3>

        <div class="col-md-12">
            <h4>Dados do Candidato</h4>
            <table>
                <thead>
                    <tr>
                        <th>Inscrição Nro:</th>
                        <th>Nome:</th>
                        <th>Data de Nascimento:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center"><?= $bolsa->id; ?></td>
                        <td><?= $bolsa->nm_candidato; ?></td>
                        <td><?=
                                date_format($bolsa->dt_nascimento, 'd/m/Y');
                            ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Certidão</th>
                        <th>Livro</th>
                        <th>Folha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bolsa->vl_ctnumero; ?></td>
                        <td><?= $bolsa->vl_ctlivro; ?></td>
                        <td><?= $bolsa->vl_ctfolha; ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Mãe:</th>
                        <th>Pai</th>
                        <th>Endereço:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bolsa->nm_mae; ?></td>
                        <td><?= $bolsa->nm_pai; ?></td>
                        <td><?= $bolsa->nm_rua . ', Nº' . $bolsa->vl_numero; ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Bairro:</th>
                        <th>Cidade:</th>
                        <th>CEP:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bolsa->nm_bairro; ?></td>
                        <td><?= $bolsa->nm_cidade; ?></td>
                        <td><?= $bolsa->vl_cep; ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Telefone:</th>
                        <th>Telefone Residencial / Contato:</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bolsa->vl_tel; ?></td>
                        <td><?= $bolsa->vl_cel; ?></td>
                        <td></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>1ª Opção Unidade:</th>
                        <th>Ano escolar:</th>
                        <th>Ensino:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bolsa->escola->nm_escola; ?></td>
                        <td>
                            <?php if ($bolsa->tipo_id == 1) : ?>
                                Ed. Infantil
                            <?php elseif ($bolsa->tipo_id == 2) : ?>
                                Ed. Fundamental
                            <?php elseif ($bolsa->tipo_id == 3) : ?>
                                Ens. Médio
                            <?php endif ?>
                        </td>
                        <td><?= $bolsa->ano->nm_ano; ?></td>
                    </tr>
                </tbody>
            </table>

            <h4>Dados do Responsável</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nome:</th>
                        <th>RG:</th>
                        <th>E-mail:</th>
                        <th>Data de Nascimento:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bolsa->responsavel->nm_responsavel; ?></td>
                        <td><?= $bolsa->responsavel->vl_rg_resp; ?></td>
                        <td><?= $bolsa->responsavel->nm_email; ?></td>
                        <td><?= date_format($bolsa->responsavel->dt_nascimento, 'd/m/Y'); ?></td>

                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Título:</th>
                        <th>Zona eleitoral:</th>
                        <th>Seção eleitoral:</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $bolsa->responsavel->vl_titulo; ?></td>
                        <td><?= $bolsa->responsavel->vl_zona; ?></td>
                        <td><?= $bolsa->responsavel->vl_secao; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <?php $trabalho = ($bolsa->responsavel->ds_trabalho == '' ? false : true); ?>
            <h4>Dados Profissionais</h4>
            <table>
                <?php if ($trabalho == true) { ?>
                    <thead>
                        <tr>
                            <th colspan="5">Profissão:</th>

                        </tr>
                    </thead>
                <?php } else if ($trabalho == false) { ?>
                    <thead>
                        <tr>
                            <th>Profissão:</th>
                            <th colspan="2">Trabalho(empresa):</th>
                            <th colspan="2">Endereço:</th>

                        </tr>
                    </thead>
                <?php } ?>

                <?php if ($trabalho == true) { ?>
                    <tbody>
                        <tr>
                            <td colspan="5"><?= $bolsa->responsavel->ds_profissao; ?></td>

                        </tr>
                    </tbody>
                <?php } else if ($trabalho == false) { ?>
                    <tbody>
                        <tr>
                            <td><?= $bolsa->responsavel->ds_profissao; ?></td>
                            <td colspan="2"><?= $bolsa->responsavel->ds_trabalho; ?></td>
                            <td colspan="2"><?= $bolsa->responsavel->nm_rua_trab . ',Nº ' . $bolsa->responsavel->vl_numero_trab; ?></td>

                        </tr>
                    </tbody>
                <?php } ?>

                <?php if ($trabalho == false) { ?>
                    <thead>
                        <tr>
                            <th>Bairro:</th>
                            <th>Cidade:</th>
                            <th>CEP:</th>
                            <th colspan="2">Telefone:</th>
                        </tr>
                    </thead>
                <?php } ?>

                <?php if ($trabalho == false) { ?>
                    <tbody>
                        <tr>
                            <td><?= $bolsa->responsavel->nm_bairro_trab; ?></td>
                            <td><?= $bolsa->responsavel->nm_cidade_trab; ?></td>
                            <td><?= $bolsa->responsavel->vl_cep_trab; ?></td>
                            <td colspan="2"><?= $bolsa->responsavel->cd_telefone; ?></td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
            <table>
                <h4>Alguém da Família possui bolsa pela Prefeitura:</h4>
                <thead>
                    <?php if ($bolsa->responsavel->concessao_fam !== 3) { ?>
                        <tr>
                            <th>Tipo da Concessão</th>
                            <th colspan="3">Nome do aluno</th>
                            <th colspan="3">Nome da escola:</th>
                        </tr>
                    <?php } ?>
                </thead>

                <?php if ($bolsa->responsavel->concessao_fam != 3) { ?>
                    <tbody>
                        <tr>
                            <td>
                                <?php if ($bolsa->responsavel->concessao_fam == 0) : ?>
                                    Sim / Bolsa Parcial
                                <?php elseif ($bolsa->responsavel->concessao_fam  == 1) : ?>
                                    Sim / Bolsa Integral
                                <?php elseif ($bolsa->responsavel->concessao_fam  == 2) : ?>
                                    Sim / Transporte Universitário
                                <?php endif ?>
                            </td>
                            <td colspan="2"><?= $bolsa->responsavel->concessao_aluno; ?></td>
                            <td colspan="3"><?= (isset($escolaResp) ? $escolaResp->nm_escola : ''); ?></td>
                            <td><?= $bolsa->responsavel->concessao_escola; ?></td>
                        </tr>
                    </tbody>

                <?php } ?>

                <?php if ($bolsa->responsavel->concessao_fam  == 3) { ?>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                Não
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>

            </table>
            <h4>Questionário Sócio-Econômico</h4>
            <table>
                <thead>
                    <tr>
                        <th>Moradia:</th>
                        <th> </th>
                        <th>Dependentes Menores de 18 anos:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php if ($bolsa->ds_moradia == 4) : ?>
                                Alugada
                            <?php elseif ($bolsa->ds_moradia == 3) : ?>
                                Financiada
                            <?php elseif ($bolsa->ds_moradia == 2) : ?>
                                Cedida
                            <?php elseif ($bolsa->ds_moradia == 1) : ?>
                                Própria
                            <?php endif ?>
                        </td>
                        <td> </td>
                        <td>
                            <?php if ($bolsa->ds_dependentes == 1) : ?>
                                1
                            <?php elseif ($bolsa->ds_dependentes == 2) : ?>
                                2
                            <?php elseif ($bolsa->ds_dependentes == 3) : ?>
                                3
                            <?php elseif ($bolsa->ds_dependentes == 4) : ?>
                                4
                            <?php elseif ($bolsa->ds_dependentes == 5) : ?>
                                Mais de 4
                            <?php endif ?>
                        </td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Renda familiar / Salário mínimo:</th>
                        <th width="50"> </th>
                        <th>Meio de transporte utilizado:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php if ($bolsa->ds_rendafamiliar == 4) : ?>
                                3 a 5
                            <?php elseif ($bolsa->ds_rendafamiliar == 3) : ?>
                                6 a 10
                            <?php elseif ($bolsa->ds_rendafamiliar == 2) : ?>
                                11 a 15
                            <?php elseif ($bolsa->ds_rendafamiliar == 1) : ?>
                                mais de 16
                            <?php endif ?>
                        </td>
                        <td width="50"> </td>
                        <td>
                            <?php if ($bolsa->ds_transporte == 5) : ?>
                                Coletivo
                            <?php elseif ($bolsa->ds_transporte == 4) : ?>
                                Fretado
                            <?php elseif ($bolsa->ds_transporte == 3) : ?>
                                Particular
                            <?php endif ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if ($bolsa->ds_info_compl != '') { ?>
                <h4> Observações</h4>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <?= $bolsa->ds_info_compl; ?>
                            </td>

                        </tr>
                    </tbody>
                </table>
            <?php } ?>
            <div class="mt-2 mb-4" style="text-align: center; font-size: 26px;">
                Assinatura do Responsável
            </div>

            <div class="mt-4" style="text-align: center;">
                ______________________________________________
            </div>

            <div class="mb-3" style="text-align: center; font-size: 26px;">

                <?= trim($bolsa->responsavel->nm_responsavel) ?>
            </div>
            <div class="row mb-0" style="width: 97%; border: 1px #c40000 solid; background: #ffe6e6; font-size: large; text-align: center;">
                ATENÇÃO: A entrega da documentação deverá ser realizada no período de
                <?= (isset($dtInicio) ? $dtInicio->format('d/m/Y') : '') ?> à <?= (isset($dtFim) ? $dtFim->format('d/m/Y') : '') ?>
                na Secretaria de Educação.
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mt-5 no-print">
            <?php if ($this->request->getSession()->read('Auth.User')) { ?>
                <button type="button" onclick="window.history.go(-2);" class="btn btn-warning float-left px-4" style="color: white;"><i class="fas fa-reply" style="padding-right: 5px;"></i>Voltar</button>
            <?php } else { ?>
                <?= $this->Html->link('home', ['controller' => 'pages', 'action' => 'home'], ['id' => 'home', 'class' => 'd-none']); ?>
                <button type="button" onclick="history.back();document.getElementById('home').click();" class="btn btn-warning float-left px-4" style="color: white;"><i class="fas fa-reply" style="padding-right: 5px"></i>Voltar</button>
            <?php } ?>
            <?php if (isset($aux) && $aux == 2) { ?>
                <button class="btn btn-success float-right" id="btnImprimir" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
            <?php } else { ?>
                <?= $this->Html->link('home', ['controller' => 'candidatos', 'action' => 'home', $bolsa->responsavel_id], ['id' => 'home2', 'class' => 'd-none']); ?>
                <button class="btn btn-success float-right" id="btnImprimir" onclick="imprimir2();document.getElementById('home2').click();"><i class="fas fa-print"></i> Imprimir</button>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    function imprimir() {
        window.print();
        window.history.go(-2);
    }

    function imprimir2() {
        window.print();
    }
</script>