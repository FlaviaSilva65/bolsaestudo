<div class="panel-body">

    <div class="row d-flex justify-content-center">
        <?php if ($responsavels) { ?>
            <div class="col-md-10 px-0 d-sm-flex justify-content-center flex-sm-wrap">
                <div class="col-md-6 ">
                    <?= $this->Form->control('nm_responsavel', ['label' => 'Nome completo do Responsável', 'value' => $responsavels->nm_responsavel]); ?>
                    <?= $this->Form->control('id', ['label' => 'id', 'value' => $responsavels->id, 'type' => 'hidden']); ?>
                </div>

                <div class="col-sm-6 col-md-3 ">
                    <?= $this->Form->control('vl_rg_resp', ['id' => 'rg', 'maxlength' => 12, 'label' => 'RG', 'class' => 'rg',   'value' => $responsavels->vl_rg_resp]); ?>
                </div>
                <div class="col-sm-4 col-md-3">
                    <label>Nascimento</label>
                    <input type="date" name="responsavel[dt_nascimento]" id="nasc" value="<?= $responsavels['dt_nascimento'] ? date_format($responsavels->dt_nascimento, 'Y-m-d') : '' ?>" />
                </div>
                <div class="col-sm-5 col-md-2 ">
                    <?= $this->Form->control('vl_titulo', ['id' => 'titulo', 'maxlength' => 12, 'value' => $responsavels->vl_titulo, 'label' => 'Título eleitoral']); ?>
                </div>
                <div class="col-sm-3 col-md-2">
                    <?= $this->Form->control('vl_zona', ['id' => 'zona', 'class' => 'p-1 w-100', 'type' => 'select', 'empty' => '---', 'options' => ['317' => '317', '406' => '406'], 'value' => $responsavels->vl_zona, 'label' => 'Zona']); ?>
                </div>
                <div class="col-sm-4 col-md-2">
                    <?= $this->Form->control('vl_secao', ['id' => 'secao', 'maxlength' => 4, 'value' => $responsavels->vl_secao, 'label' => 'Seção']); ?>
                </div>

                <div class="col-sm-8 col-md-4">
                    <?= $this->Form->control('responsavel.nm_email', ['value' => $responsavels->nm_email, 'label' => 'E-mail']); ?>
                </div>
            </div>


            <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
                <p class="mb-lg-2">Informações Profissionais</p>
            </div>

            <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                <?php if ($responsavels->ds_profissao == 'Aposentado') { ?>
                    <div class="form-check col-md-2 d-flex">

                        <input class="form-check-input mt-1" style="width: 1em;" type="radio" name="ic_autonomo" value="0" disabled id="chkAutonomo" onchange="ativaDadosEmpresa()" />
                        <p class="font-weight-bold mb-0 ml-2">Autônomo</p>
                    </div>
                    <div class="form-check col-md-2 d-flex">
                        <input class="form-check-input mt-1" style="width: 1em;" type="radio" name="ic_aposentado" value="0" checked id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                        <p class="font-weight-bold mb-0 ml-2">Aposentado(a)</p>
                    </div>

                <?php } elseif ($responsavels->ds_profissao == 'Autônomo') { ?>
                    <div class="col-md-2 d-flex">
                        <input class="mt-1" style="width: 1em;" type="radio" name="ic_autonomo" value="0" checked id="chkAutonomo" onchange="ativaDadosEmpresa()" />
                        <p class="font-weight-bold mb-0 ml-2">Autônomo</p>
                    </div>
                    <div class="col-md-2 d-flex">
                        <input class="mt-1" style="width: 1em;" type="radio" name="ic_aposentado" value="0" disabled id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                        <p class="font-weight-bold mb-0 ml-2">Aposentado(a)</p>
                    </div>
                <?php } else { ?>
                    <div class="col-md-2 d-flex">
                        <input class="mt-1" style="width: 1em;" type="radio" name="ic_autonomo" value="0" id="chkAutonomo" onchange="ativaDadosEmpresa()" />
                        <p class="font-weight-bold mb-0 ml-2">Autônomo</p>
                    </div>
                    <div class="col-md-2 d-flex">
                        <input class="mt-1" style="width: 1em;" type="radio" name="ic_aposentado" value="0" id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                        <p class="font-weight-bold mb-0 ml-2">Aposentado(a)</p>
                    </div>
                    <div class="col-md-2 d-flex">
                        <input class="mt-1" style="width: 1em;" type="radio" name="ic_aposentado" value="0" checked id="chkAposentado" onclick="ativaDadosEmpresaAposentado()" />
                        <p class="font-weight-bold mb-0 ml-2">Assalariado(a)</p>
                    </div>
                <?php } ?>

            </div>

            <?php if ($responsavels->ds_profissao == 'Autônomo') { ?>
                <div class="col-md-12 px-0" id="informacoesProfissao">
                    <div class="col-md-4">
                        <?= $this->Form->control('responsavel.ds_profissao', ['type' => 'text', 'id' => 'dsProfissao', 'placeholder' => 'Insira a profissão.', 'label' => 'Profissão', 'value' => $responsavels->ds_profissao]); ?>
                    </div>
                </div>
            <?php } else if ($responsavels->ds_profissao != 'Aposentado') { ?>
                <div class="col-md-12 px-0" id="informacoesProfissao">
                    <div class="col-md-4">
                        <?= $this->Form->control('responsavel.ds_profissao', ['type' => 'text', 'id' => 'dsProfissao', 'placeholder' => 'Insira a profissão.', 'label' => 'Profissão', 'value' => $responsavels->ds_profissao]); ?>
                    </div>
                </div>

                <div id="informacoesTrabalho">
                    <div class="col-md-12 px-0 d-sm-flex flex-sm-wrap">
                        <div class="col-md-4">
                            <?= $this->Form->control('responsavel.ds_trabalho', ['type' => 'text', 'id' => 'nomeEmpresa', 'placeholder' => 'Insira o nome do local de trabalho.', 'label' => 'Local de trabalho (Nome da Empresa):', 'value' => $responsavels->ds_trabalho]); ?>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <?= $this->Form->control('responsavel.vl_cep_trab', ['type' => 'text', 'id' => 'cepempr', 'class' => 'cepempr', 'placeholder' => 'CEP ex:. 11999999...', 'label' => 'CEP:', 'value' => $responsavels->vl_cep_trab]); ?>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <?= $this->Form->control('responsavel.nm_rua_trab', ['type' => 'text', 'id' => 'logradouroempr', 'class' => 'logradouroempr', 'placeholder' => 'Insira o endereço da empresa.', 'label' => 'Endereço:', 'value' => $responsavels->nm_rua_trab]); ?>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <?= $this->Form->control('responsavel.vl_numero_trab', ['type' => 'text', 'id' => 'num_rua_resp', 'placeholder' => 'Insira o número.', 'label' => 'Número:', 'value' => $responsavels->vl_numero_trab]); ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $this->Form->control('responsavel.nm_bairro_trab', ['type' => 'text', 'id' => 'bairroempr', 'placeholder' => 'Insira o número.', 'label' => 'Bairro:', 'value' => $responsavels->nm_bairro_trab]); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Form->control('responsavel.nm_cidade_trab', ['type' => 'text', 'id' => 'cidadeempr', 'placeholder' => 'Insira a cidade.', 'label' => 'Cidade:', 'value' => $responsavels->nm_cidade_trab]); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Form->control('responsavel.cd_telefone', ['type' => 'text', 'class' => 'phone_with_ddd', 'placeholder' => 'Telefone da empresa.', 'label' => 'Telefone:', 'value' => $responsavels->cd_telefone]); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>





        <?php } else { ?>
            <div class="col-md-10 px-0 d-sm-flex justify-content-center flex-sm-wrap">
                <div class="col-md-6 ">
                    <?= $this->Form->control('nm_responsavel', ['label' => 'Nome completo do Responsável']); ?>
                </div>

                <div class="col-sm-6 col-md-3 ">
                    <?= $this->Form->control('vl_rg_resp', ['id' => 'rg', 'maxlength' => 12, 'label' => 'RG', 'class' => 'rg']); ?>
                </div>
                <div class="col-sm-4 col-md-2">
                    <label>Nascimento</label>
                    <input type="date" name="responsavel[dt_nascimento]" id="nasc" />
                </div>
                <div class="col-sm-5 col-md-2 ">
                    <?= $this->Form->control('vl_titulo', ['id' => 'titulo', 'maxlength' => 12, 'label' => 'Título eleitoral']); ?>
                </div>
                <div class="col-sm-3 col-md-2">
                    <?= $this->Form->control('vl_zona', ['id' => 'zona', 'class' => 'p-1 w-100', 'type' => 'select', 'empty' => '---', 'options' => ['317' => '317', '406' => '406'],  'label' => 'Zona']); ?>
                </div>
                <div class="col-sm-4 col-md-2">
                    <?= $this->Form->control('vl_secao', ['id' => 'secao', 'maxlength' => 4, 'label' => 'Seção']); ?>
                </div>

                <div class="col-sm-8 col-md-4">
                    <?= $this->Form->control('responsavel.nm_email', ['label' => 'E-mail']); ?>
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
    </div>
</div>