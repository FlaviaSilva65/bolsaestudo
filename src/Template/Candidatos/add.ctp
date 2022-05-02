<!-- SEDUC DPID - Flavia A S Silva 47093 em 11/12/2020 -->

<body onload="chama">
    <div class=" panel panel-info">
        <?= $this->Form->create($candidato, ['id' => 'form-candidato', 'novalidate']) ?>
        <div class="title">Ficha de Inscrição</div>
        <div class="panel-body">

            <div class="col-md-12 justify-content-between">

                <div class="radio col-md-4 d-inline-flex justify-content-between">
                    <p class="labelBenef required">Possuiu o benefício no ano anterior ?</p>
                    <?= $this->Form->radio('ic_ano_anterior', ['1' => 'Sim', '0' => 'Não']); ?>

                </div>
                <div class="col-md-4 error-message d-flex justify-content-end"><?= $erroanoant ?? '' ?></div>


                <div class="col-md-12 ml-md-3 col-sm-12 mt-2 brTitle">
                    <p>Dados do Candidato</p>
                </div>




                <div class="col-md-12 p-sm-0 col-sm-12 d-sm-flex flex-sm-wrap">

                    <div class="col-12 col-sm-8">
                        <?= $this->Form->control('nm_candidato', ['placeholder' => 'Digite o nome do candidato',  'onkeypress' => 'return ApenasLetras(event,this);', 'label' => 'Nome completo']); ?>
                    </div>

                    <div class="col-12 col-sm-4">
                        <?= $this->Form->control('vl_rg', ['id' => 'rg', 'maxlength' => 12, 'label' => 'RG', 'class' => 'rg', 'placeholder' => 'RG do candidato']); ?>
                    </div>

                </div>

                <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                    <!-- <div class="col-sm-1 mt-lg-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-link icon" data-toggle="modal" data-target="#exampleModal"></button>
                    </div> -->


                    <div class="col-sm-8 col-md-4">
                        <?= $this->Form->control(str_pad('vl_ctnumero', 7, '0', STR_PAD_LEFT), ['id' => 'termo', 'class' => 'form-control termo', 'type' => 'text', 'label' => 'Certidão Nasc.(Termo) ' . $this->Html->image("question-circle.svg", ['data-toggle' => 'modal', 'data-target' => '#exampleModal']), 'escape' => false,   'placeholder' => 'Número da certidão de nascimento']); ?>
                    </div>

                    <div class="col-sm-4 col-md-4 ">
                        <?= $this->Form->control('vl_ctlivro', ['id' => 'ctLivro', 'maxlength' => 5, 'label' => 'Livro',  'placeholder' => 'Número do livro']); ?>

                    </div>

                    <div class="col-sm-6 col-md-2 ">
                        <?= $this->Form->control('vl_ctfolha', ['id' => 'ctFolha', 'label' => 'Folha', 'maxlength' => 5, 'placeholder' => 'Número da folha']); ?>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label class="required error">Nascimento</label>
                        <!-- <?= $this->Form->date('dt_nasciment0', ['id' => 'dt_nascimento', 'type' => 'date', 'onfocusout' => 'verdatacand()', 'label' => 'Nascimento']); ?> -->
                        <input type="date" name="dt_nascimento" id="dt_nascimento" value="<?= $candidato->dt_nascimento ? date_format($candidato->dt_nascimento, 'Y-m-d') : '' ?>" />
                        <div class="error-message"><?= $errodt ?? '' ?></div>
                    </div>
                </div>
                <div class="col-md-12 px-0 d-sm-flex">

                    <div class="col-md-6">
                        <?= $this->Form->control('nm_mae', ['label' => 'Mãe',  'type' => 'text',  'placeholder' => 'Nome completo da mãe', 'onkeypress' => 'return ApenasLetras(event,this);']); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('nm_pai', ['label' => 'Pai', 'placeholder' => 'Nome completo da pai (não obrigatório)', 'onkeypress' => 'return ApenasLetras(event,this);']); ?>
                    </div>
                </div>
                <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                    <div class="col-sm-4 col-md-2">
                        <?= $this->Form->control('vl_cep', ['id' => 'cep', 'label' => 'CEP', 'class' => 'cep', 'placeholder' => 'CEP ex:. 11999999...']); ?>
                    </div>
                    <div class="col-sm-8 col-md-5">
                        <?= $this->Form->control('nm_rua', ['label' => 'Endereço', 'id' => 'logradouro', 'class' => 'logradouro', 'placeholder' => 'Ex:. rua abc...']); ?>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <?= $this->Form->control('vl_numero', ['type' => 'number', 'label' => 'Número', 'placeholder' => 'Número']); ?>
                    </div>
                    <div class="col-sm-8 col-md-3">
                        <?= $this->Form->control('nm_bairro', ['label' => 'Bairro', 'id' => 'bairro', 'placeholder' => 'Bairro']); ?>
                    </div>
                </div>
                <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                    <div class="col-sm-6 col-md-3">
                        <?= $this->Form->control('nm_cidade', ['label' => 'Cidade', 'id' => 'cidade', 'placeholder' => 'Cidade']); ?>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <?= $this->Form->control('nm_complemento', ['label' => 'Complemento (apto/bloco)', 'placeholder' => 'Complemento ex:. apto/bloco']); ?>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <?= $this->Form->control('vl_tel', ['id' => 'tel', 'label' => 'Telefone Residencial/Contato', 'class' => 'required phone_with_ddd', 'placeholder' => 'Telefone para contato']); ?>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <?= $this->Form->control('vl_cel', ['id' => 'cel', 'label' => 'Celular', 'class' => 'cel',  'placeholder' => 'Celular']); ?>
                    </div>
                </div>
                <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
                    <p class="mb-lg-2">Unidades Escolares - Opções</p>
                </div>

                <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                    <div class="col-12 col-sm-4">
                        <?= $this->Form->control('escola_id', ['id' => 'escola', 'class' => 'p-1 w-100 rounded b-sencondary',  'label' => 'Selecione a escola', 'empty' => '---', 'options' => $escolas, 'onclick' => 'verificaContato()']); ?>
                    </div>

                    <div class="col-12 col-sm-4" id="xx">
                        <?= $this->Form->control('tipo_id', ['id' => 'tipo', 'class' => 'p-1 w-100', 'empty' => '---', 'type' => 'select', 'options' => $tipos,  'label' => 'Nível de Ensino']); ?>
                    </div>

                    <div class="col-12 col-sm-4" id="anoid">

                        <?= $this->Form->control('ano_id', ['id' => 'ano', 'class' => 'p-1 w-100', 'empty' => '---', 'type' => 'select', 'options' => $anos, 'label' => 'Anos Escolares ']); ?>
                    </div>
                </div>

                <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
                    <p class="mb-lg-2">Dados do Responsável</p>
                </div>

                <!-- Esse Bloco é para cadastrar Candidato para Responsável que já esteja cadastrado -->
                <?php if (isset($responsavel)) { ?>
                    <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                        <div class="col-md-6 ">
                            <?= $this->Form->control('responsavel.nm_responsavel', ['label' => 'Nome completo do Responsável', 'value' => $responsavel->nm_responsavel]); ?>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <?= $this->Form->control('responsavel.vl_rg_resp', ['id' => 'rg', 'maxlength' => 12, 'label' => 'RG', 'class' => 'rg',   'value' => $responsavel->vl_rg_resp]); ?>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <?= $this->Form->control('responsavel.vl_cpf', ['id' => 'cpf', 'class' => 'cpf', 'label' => 'CPF', 'value' => $responsavel->vl_cpf,]); ?>
                        </div>
                        <div class="col-sm-5 col-md-2 ">
                            <?= $this->Form->control('responsavel.vl_titulo', ['id' => 'titulo', 'maxlength' => 12, 'value' => $responsavel->vl_titulo, 'label' => 'Título eleitoral']); ?>
                        </div>
                        <div class="col-sm-3 col-md-2">
                            <?= $this->Form->control('responsavel.vl_zona', ['id' => 'zona', 'class' => 'p-1 w-100', 'type' => 'select', 'empty' => '---', 'options' => ['317' => '317', '406' => '406'], 'value' => $responsavel->vl_zona, 'label' => 'Zona']); ?>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <?= $this->Form->control('responsavel.vl_secao', ['id' => 'secao', 'maxlength' => 4, 'value' => $responsavel->vl_secao, 'label' => 'Seção']); ?>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <label>Nascimento</label>
                            <input type="date" name="responsavel[dt_nascimento]" id="nasc" value="<?= $responsavel['dt_nascimento'] ? date_format($responsavel->dt_nascimento, 'Y-m-d') : '' ?>" />
                        </div>
                        <div class="col-sm-8 col-md-4">
                            <?= $this->Form->control('responsavel.nm_email', ['value' => $responsavel->nm_email, 'label' => 'E-mail']); ?>
                        </div>
                    </div>

                    <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
                        <p class="mb-lg-2">Informações Profissionais</p>
                    </div>

                    <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                        <?php if ($responsavel->ds_profissao == 'Aposentado') { ?>
                            <div class="form-check col-md-2 d-flex">

                                <input class="form-check-input mt-1" style="width: 1em;" type="radio" name="ic_autonomo" value="0" disabled id="chkAutonomo" onchange="ativaDadosEmpresa()" />
                                <p class="font-weight-bold mb-0 ml-2">Autônomo</p>
                            </div>
                            <div class="form-check col-md-2 d-flex">
                                <input class="form-check-input mt-1" style="width: 1em;" type="radio" name="ic_aposentado" value="0" checked id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                                <p class="font-weight-bold mb-0 ml-2">Aposentado(a)</p>
                            </div>

                        <?php } elseif ($responsavel->ds_profissao == 'Autônomo') { ?>
                            <div class="col-md-2 d-flex">
                                <input class="mt-1" style="width: 1em;" type="checkbox" name="ic_autonomo" value="0" checked id="chkAutonomo" onchange="ativaDadosEmpresa()" />
                                <p class="font-weight-bold mb-0 ml-2">Autônomo</p>
                            </div>
                            <div class="col-md-2 d-flex">
                                <input class="mt-1" style="width: 1em;" type="checkbox" name="ic_aposentado" value="0" disabled id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                                <p class="font-weight-bold mb-0 ml-2">Aposentado(a)</p>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-2 d-flex">
                                <input class="mt-1" style="width: 1em;" type="checkbox" name="ic_autonomo" value="0" id="chkAutonomo" onchange="ativaDadosEmpresa()" />
                                <p class="font-weight-bold mb-0 ml-2">Autônomo</p>
                            </div>
                            <div class="col-md-2 d-flex">
                                <input class="mt-1" style="width: 1em;" type="checkbox" name="ic_aposentado" value="0" id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                                <p class="font-weight-bold mb-0 ml-2">Aposentado(a)</p>
                            </div>
                        <?php } ?>

                    </div>

            </div>
            <?php if ($responsavel->ds_profissao == 'Autônomo') { ?>
                <div class="col-md-12" id="informacoesProfissao">
                    <div class="col-md-4">
                        <?= $this->Form->control('responsavel.ds_profissao', ['type' => 'text', 'id' => 'dsProfissao', 'placeholder' => 'Insira a profissão.', 'label' => 'Profissão', 'value' => $responsavel->ds_profissao]); ?>
                    </div>
                </div>
            <?php } else if ($responsavel->ds_profissao != 'Aposentado') { ?>
                <div class="col-md-12" id="informacoesProfissao">
                    <div class="col-md-4">
                        <?= $this->Form->control('responsavel.ds_profissao', ['type' => 'text', 'id' => 'dsProfissao', 'placeholder' => 'Insira a profissão.', 'label' => 'Profissão', 'value' => $responsavel->ds_profissao]); ?>
                    </div>
                </div>

                <div id="informacoesTrabalho">
                    <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                        <div class="col-md-4">
                            <?= $this->Form->control('responsavel.ds_trabalho', ['type' => 'text', 'id' => 'nomeEmpresa', 'placeholder' => 'Insira o nome do local de trabalho.', 'label' => 'Local de trabalho (Nome da Empresa):', 'value' => $responsavel->ds_trabalho]); ?>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <?= $this->Form->control('responsavel.vl_cep_trab', ['type' => 'text', 'id' => 'cepempr', 'class' => 'cepempr', 'placeholder' => 'CEP ex:. 11999999...', 'label' => 'CEP:', 'value' => $responsavel->vl_cep_trab]); ?>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <?= $this->Form->control('responsavel.nm_rua_trab', ['type' => 'text', 'id' => 'logradouroempr', 'class' => 'logradouroempr', 'placeholder' => 'Insira o endereço da empresa.', 'label' => 'Endereço:', 'value' => $responsavel->nm_rua_trab]); ?>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <?= $this->Form->control('responsavel.vl_numero_trab', ['type' => 'text', 'id' => 'num_rua_resp', 'placeholder' => 'Insira o número.', 'label' => 'Número:', 'value' => $responsavel->vl_numero_trab]); ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $this->Form->control('responsavel.nm_bairro_trab', ['type' => 'text', 'id' => 'bairroempr', 'placeholder' => 'Insira o número.', 'label' => 'Bairro:', 'value' => $responsavel->nm_bairro_trab]); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Form->control('responsavel.nm_cidade_trab', ['type' => 'text', 'id' => 'cidadeempr', 'placeholder' => 'Insira a cidade.', 'label' => 'Cidade:', 'value' => $responsavel->nm_cidade_trab]); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Form->control('responsavel.cd_telefone', ['type' => 'text', 'class' => 'phone_with_ddd', 'placeholder' => 'Telefone da empresa.', 'label' => 'Telefone:', 'value' => $responsavel->cd_telefone]); ?>
                        </div>
                    </div>
                </div>
            <?php }

            ?>
            <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
                <p class="mb-lg-2">Existe alguém da família que possui bolsa pela Prefeitura?</p>
            </div>
            <?php if ($responsavel->concessao_fam !== 3) {  ?>
                <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                    <div class="col-md-3">
                        <?= $this->Form->control('responsavel.concessao_fam', ['id' => 'concessao_fam', 'type' => 'select', 'class' => 'p-1 w-100', 'empty' => '---', 'options' => [0 => 'Sim / Bolsa Parcial', 1 => 'Sim / Bolsa Integral', 2 => 'Sim / Transp. Univ.', 3 => 'Não'], 'label' => 'Concessão Familiar', 'onChange' => 'ativaDadosBolsa(this)', 'value' => $responsavel->concessao_fam]); ?>
                    </div>
                    <?php if ($responsavel->concessao_fam !== 3) { ?>
                        <div class="col-md-5" id="informacoesBolsa1">
                            <?= $this->Form->control('responsavel.concessao_aluno', [
                                'placeholder' => 'Nome do aluno que possui bolsa',
                                'value' => $responsavel->concessao_aluno, 'label' => 'Nome completo do aluno:'
                            ]); ?>
                        </div>

                        <div class="col-md-4" id="informacoesBolsa2">
                            <?= $this->Form->control('responsavel.concessao_escola', ['id' => 'nm_escola', 'empty' => 'Selecione a escola', 'options' => $escolas, 'class' => 'p-1 w-100', 'value' => $responsavel->concessao_escola, 'label' => 'Nome da escola: ']); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                    <div class="col-md-3">
                        <?= $this->Form->control('responsavel.concessao_fam', ['id' => 'concessao_fam', 'type' => 'select', 'class' => 'p-1 w-100', 'empty' => '---', 'options' => [0 => 'Sim / Bolsa Parcial', 1 => 'Sim / Bolsa Integral', 2 => 'Sim / Transp. Univ.', 3 => 'Não'], 'label' => 'Concessão Familiar', 'onChange' => 'ativaDadosBolsa(this)']); ?>
                    </div>
                    <div class="col-md-5" id="informacoesBolsa1" style="display: none;">
                        <?= $this->Form->control('responsavel.concessao_aluno', [
                            'placeholder' => 'Nome do aluno que possui bolsa',
                            'label' => 'Nome completo do aluno:'
                        ]); ?>
                    </div>

                    <div class="col-md-4" id="informacoesBolsa2" style="display: none;">
                        <?= $this->Form->control('responsavel.concessao_escola', ['id' => 'nm_escola', 'empty' => 'Selecione a escola', 'options' => $escolas, 'class' => 'p-1 w-100',  'label' => 'Nome da escola: ']); ?>
                    </div>
                </div>
            <?php } ?>

            <!-- Fim do Bloco Acima Mencionado -->
        <?php } else { ?>

            <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                <div class="col-md-6 ">
                    <?= $this->Form->control('responsavel.nm_responsavel', ['placeholder' => 'Digite o nome do Responsável', 'label' => 'Nome completo do Responsável']); ?>
                </div>
                <div class="col-sm-6 col-md-3 ">
                    <?= $this->Form->control('responsavel.vl_rg_resp', ['id' => 'rg', 'maxlength' => 12, 'label' => 'RG', 'class' => 'rg',   'placeholder' => 'RG do Responsável']); ?>
                </div>
                <div class="col-sm-6 col-md-3 ">
                    <?= $this->Form->control('responsavel.vl_cpf', ['id' => 'cpf', 'class' => 'cpf', 'placeholder' => 'CPF do Responsável', 'label' => 'CPF']); ?>
                </div>
                <div class="col-sm-5 col-md-2 ">
                    <?= $this->Form->control('responsavel.vl_titulo', ['id' => 'titulo', 'maxlength' => 12, 'placeholder' => 'CPF do Responsável', 'placeholder' => 'Título eleitoral', 'label' => 'Título eleitoral']); ?>
                </div>
                <div class="col-sm-3 col-md-2">
                    <?= $this->Form->control('responsavel.vl_zona', ['id' => 'zona', 'class' => 'p-1 w-100', 'type' => 'select', 'empty' => '---', 'options' => ['317' => '317', '406' => '406'], 'label' => 'Zona']); ?>
                </div>
                <div class="col-sm-4 col-md-2">
                    <?= $this->Form->control('responsavel.vl_secao', ['id' => 'secao', 'maxlength' => 4, 'placeholder' => 'Número da seção', 'label' => 'Seção']); ?>
                </div>
                <div class="col-sm-4 col-md-2">
                    <label>Nascimento</label>
                    <input type="date" name="responsavel[dt_nascimento]" id="nasc" value="<?= $candidato->responsavel['dt_nascimento'] ? date_format($candidato->responsavel->dt_nascimento, 'Y-m-d') : '' ?>" />
                </div>
                <div class="col-sm-8 col-md-4">
                    <?= $this->Form->control('responsavel.nm_email', ['placeholder' => 'Digite o E-mail', 'label' => 'E-mail']); ?>
                </div>
            </div>

            <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
                <p class="mb-lg-2">Informações Profissionais</p>
            </div>

            <div class="col-md-12 ml-3 px-0 d-sm-flex flex-sm-wrap">
                <div class="form-check col-md-4 d-flex">
                    <p class="font-weight-bold">Autônomo</p>
                    <input class="form-check-input" style="width: 1em;" type="radio" name="flexRadioDisabled" value="0" id="chkAutonomo" onchange="ativaDadosEmpresa()" />
                </div>
                <div class="form-check col-md-4 d-flex">
                    <input class="form-check-input mt-1" style="width: 1em;" type="radio" name="flexRadioDisabled" value="0" id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                    <p class="font-weight-bold mb-0 ml-2">Aposentado(a)</p>
                </div>
                <div class="form-check col-md-4 d-flex">
                    <input class="form-check-input mt-1" style="width: 1em;" type="radio" name="flexRadioDisabled" value="0" id="chkEmpregado" onclick="ativaDadosEmpregado()" />
                    <p class="font-weight-bold mb-0 ml-2">Empregado(a)</p>
                </div>

                <div class="col-md-12 error-message d-flex justify-content-center"><?= $errodsprof ?? '' ?></div>
            </div>
            <div class="col-md-12" id="informacoesProfissao" style="display: none;">
                <div class="col-md-4 pl-0">
                    <?= $this->Form->control('responsavel.ds_profissao', ['type' => 'text', 'id' => 'dsProfissao', 'placeholder' => 'Insira a profissão.', 'label' => 'Profissão']); ?>
                </div>
            </div>
            <div id="informacoesTrabalho" style="display: block;">
                <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                    <div class="col-md-4">
                        <?= $this->Form->control('responsavel.ds_trabalho', ['type' => 'text', 'id' => 'nomeEmpresa', 'placeholder' => 'Insira o nome do local de trabalho.', 'label' => 'Local de trabalho (Nome da Empresa):']); ?>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <?= $this->Form->control('responsavel.vl_cep', ['type' => 'text', 'id' => 'cepempr', 'class' => 'cepempr', 'placeholder' => 'CEP ex:. 11999999...', 'label' => 'CEP:']); ?>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <?= $this->Form->control('responsavel.nm_rua_trab', ['type' => 'text', 'id' => 'logradouroempr', 'class' => 'logradouroempr', 'placeholder' => 'Insira o endereço da empresa.', 'label' => 'Endereço:']); ?>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <?= $this->Form->control('responsavel.vl_numero_trab', ['type' => 'text', 'id' => 'num_rua_resp', 'placeholder' => 'Insira o número.', 'label' => 'Número:']); ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $this->Form->control('responsavel.nm_bairro_trab', ['type' => 'text', 'id' => 'bairroempr', 'placeholder' => 'Insira o número.', 'label' => 'Bairro:']); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $this->Form->control('responsavel.nm_cidade_trab', ['type' => 'text', 'id' => 'cidadeempr', 'placeholder' => 'Insira a cidade.', 'label' => 'Cidade:']); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $this->Form->control('responsavel.cd_telefone', ['type' => 'text', 'class' => 'phone_with_ddd', 'placeholder' => 'Telefone da empresa.', 'label' => 'Telefone:']); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
                <p class="mb-lg-2">Existe alguém da família que possui bolsa pela Prefeitura?</p>
            </div>
            <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                <div class="col-md-3">
                    <?= $this->Form->control('responsavel.concessao_fam', ['id' => 'concessao_fam', 'type' => 'select', 'class' => 'p-1 w-100', 'empty' => '---', 'options' => [0 => 'Sim / Bolsa Parcial', 1 => 'Sim / Bolsa Integral', 2 => 'Sim / Transp. Univ.', 3 => 'Não'], 'label' => 'Concessão Familiar', 'onChange' => 'ativaDadosBolsa(this)']); ?>
                </div>
                <div class="col-md-5" id="informacoesBolsa1" style="display: none;">
                    <?= $this->Form->control('responsavel.concessao_aluno', ['placeholder' => 'Nome do aluno que possui bolsa', 'label' => 'Nome completo do aluno:']); ?>
                </div>

                <div class="col-md-4" id="informacoesBolsa2" style="display: none;">
                    <?= $this->Form->control('responsavel.concessao_escola', ['id' => 'nm_escola', 'empty' => 'Selecione a escola', 'options' => $escolas, 'class' => 'p-1 w-100', 'label' => 'Nome da escola: ']); ?>
                </div>
            </div>


        <?php } ?>

        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mb-lg-2">Questionário Sócio-Econômico</p>
        </div>

        <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
            <div class="col-sm-6 col-md-3">
                <?= $this->Form->control('ds_moradia', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['empty' => '---', '1' => 'Própria', '2' => 'Cedida', '3' => 'Financiada', '4' => 'Alugada'], 'label' => 'Tipo de Moradia']); ?>
            </div>
            <div class="col-sm-6 col-md-3">
                <?= $this->Form->control('ds_dependentes', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['empty' => '---', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => 'mais de 4'], 'label' => 'Depend. menor(s) de 18 anos.']); ?>
            </div>
            <div class="col-sm-6 col-md-3">
                <?= $this->Form->control('ds_rendafamiliar', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['empty' => '---', '4' => '3 a 5', '3' => '6 a 10', '2' => '11 a 15', '1' => ' mais de 16'], 'label' => 'Renda familiar / Salário mínimo']); ?>
            </div>
            <div class="col-sm-6 col-md-3">
                <?= $this->Form->control('ds_transporte', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['empty' => '---', '5' => 'Coletivo', '4' => 'Fretado', '3' => 'Particular'], 'label' => 'Meio de transporte']); ?>
            </div>

            <div class="col-md-12">
                <label>Possuiu alguma deficiência ?</label>
                <div class="radio col-md-1 d-inline-flex justify-content-between">

                    <?= $this->Form->radio('ic_deficiente', ['1' => 'Sim', '0' => 'Não']); ?>
                </div>
                <div class="col-md-4 error-message d-flex justify-content-start"><?= $erroicdef ?? '' ?></div>
            </div>

            <div class="col-md-12">
                <?= $this->Form->control('ds_info_compl', ['class' => 'w-100', 'id' => 'limitedText', 'onKeyDown' => 'limitText(this,255);', 'onKeyUp' => 'limitText(this,255);',  'label' => 'Observações:']); ?>
                <p style="font-size:0.8em;">Limite de Caracteres&ensp;<span id='countdown'>255</span></p>
            </div>
        </div>
        <div class="row mb-4 d-flex justify-content-center">

            <div class="col-4 d-flex justify-content-around">
                <button type="button" onclick="history.back()" class="btn btn-warning" style="color: white;"><i class="fas fa-reply" style="padding-right: 5px"></i>Voltar</button>
                <button class="btn btn-success float-right" id="subir" type="submit"><i class="fas fa-check" style="padding-right: 5px"></i>Enviar</button>
            </div>
        </div>


        <?php echo $this->form->end(); ?>

        <!-- <div class="modal fade" id="exampleModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
        </div>

    </div>
    <div>
        <input id="urltipo" value="<?= $this->Url->build(['controller' => 'Candidatos', 'action' => 'opcoes_tipos']) ?>" class="d-none">
    </div>
    <div>
        <input id="urlano" value="<?= $this->Url->build(['controller' => 'Candidatos', 'action' => 'opcoes_anos']) ?>" class="d-none">
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="w-50 p-3 bg-white">
                <?= $this->Html->image('Informe.jpg', ['class' => 'w-100 mb-2']) ?>
                <p class="alert alert-danger text-justify"><b>Atenção:</b> O número da certidão de nascimento, corresponde ao <b style="font-size:16px">Número do Termo</b> de 7 dígitos, caso seja menos completar com 0 no início.</p>
            </div>
        </div>
    </div>
</body>