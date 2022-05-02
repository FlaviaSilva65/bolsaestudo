<!-- SEDUC DPID - Flavia A S Silva 47093 em 05/11/2020 -->
<?= $this->Html->css('bolsas.css'); ?>
<?= $this->Html->script('busca_cep.js'); ?>
<div class="panel panel-info">
    <?php echo $this->Form->create($candidato, ['id' => 'form-candidato']) ?>
    <div class="title">Verificação do Cadastro
    </div>
    <div class="panel-body">

        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mt-3 mt-lg-3 mb-lg-2">Dados do Candidato</p>
        </div>
        <div class="row">

            <div class="col-lg-3 mb-2">

                <?= $this->Form->control('nm_candidato', ['value' =>  $candidato->nm_candidato, 'class' => 'form-control', 'label' => 'Nome completo']); ?>
            </div>

            <div class="col-sm-6 col-lg-2 mb-2">
                <?= $this->Form->control('vl_rg', ['value' =>  $candidato->vl_rg, 'class' => 'form-control', 'label' => 'RG']); ?>
            </div>

            <div class="col-sm-6 col-lg-2 mb-2">
                <label class="required error">Data de Nascimento</label>
                <input type="text" value="<?= $candidato->dt_nascimento ? date_format($candidato->dt_nascimento, 'd/m/Y') : '' ?>" disabled>
            </div>

            <div class="col-sm-4 col-lg-2 mb-2">
                <?= $this->Form->control('vl_ctnumero', ['value' =>  $candidato->vl_ctnumero, 'class' => 'form-control', 'label' => 'Certidão de Nasc.']); ?>
            </div>

            <div class="col-sm-4 col-lg-2 mb-2">
                <?= $this->Form->control('vl_ctlivro', ['value' =>  $candidato->vl_ctlivro, 'class' => 'form-control', 'label' => 'Livro']); ?>
            </div>

            <div class="col-sm-4 col-lg-1 mb-2">
                <?= $this->Form->control('vl_ctfolha', ['value' =>  $candidato->vl_ctfolha, 'class' => 'form-control', 'label' => 'Folha']); ?>
            </div>

            <div class="col-lg-6 mb-2">
                <?= $this->Form->control('nm_mae', ['value' =>  $candidato->nm_mae, 'class' => 'form-control', 'label' => 'Nome da mãe']); ?>
            </div>

            <div class="col-lg-6 mb-2">
                <?= $this->Form->control('nm_pai', ['value' =>  $candidato->nm_pai, 'class' => 'form-control', 'label' => 'Nome do pai']); ?>
            </div>

            <div class="col-lg-4 mb-2">

                <?= $this->Form->control('nm_rua', ['value' =>  $candidato->nm_rua, 'id' => 'logradouro', 'class' => 'form-control', 'label' => 'Endereço']); ?>
            </div>
            <div class="col-lg-1 mb-2">

                <?= $this->Form->control('vl_numero', ['value' =>  $candidato->vl_numero, 'class' => 'form-control', 'label' => 'Num.']); ?>
            </div>
            <div class="col-sm-3 col-lg-2 mb-2">

                <?= $this->Form->control('vl_cep', ['value' => $candidato->vl_cep, 'id' => 'cep', 'class' => 'form-control cep', 'label' => 'CEP']); ?>

                <!-- <input type="text" value="<?= $candidato->vl_cep ?>"> -->
            </div>

            <div class="col-sm-5 col-lg-3 mb-2">

                <?= $this->Form->control('nm_bairro', ['value' => $candidato->nm_bairro, 'class' => 'form-control', 'id' => 'bairro', 'label' => 'Bairro']); ?>

                <!-- <input type="text" value="<?= $candidato->nm_bairro ?>"> -->
            </div>

            <div class="col-sm-4 col-lg-2 mb-2">
                <?= $this->Form->control('nm_cidade', ['value' => $candidato->nm_cidade, 'class' => 'form-control', 'label' => 'Cidade']); ?>

                <!-- <input type="text" value="<?= $candidato->nm_cidade ?>"> -->
            </div>

            <div class="col-sm-6 col-lg-6 mb-2">
                <?= $this->Form->control('vl_tel', ['value' => $candidato->vl_tel, 'class' => 'form-control', 'label' => 'Telefone Residencial/Contato']); ?>
            </div>

            <div class="col-sm-6 col-lg-6 mb-2">
                <label>Celular</label>
                <?= $this->Form->control('vl_cel', ['value' => $candidato->vl_cel, 'class' => 'form-control', 'label' => false]); ?>
            </div>
        </div>
        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mt-3 mt-lg-3 mb-lg-2">Dados Escolar</p>
        </div>
        <div class="row">

            <div class="col-lg-4 mb-2">
                <?= $this->Form->control('escola_id', ['empty' => ' ', 'options' => $escolas, 'value' => $candidato->escola_id, 'class' => 'form-control', 'label' => 'Nome da Escola']); ?>

            </div>
            <div class="col-sm-8 col-lg-4 mb-2">
                <?= $this->Form->control('tipo_id', ['empty' => ' ', 'options' => $tipos, 'value' => $candidato->tipo_id, 'class' => 'form-control', 'label' => 'Nivel de Ensino']); ?>
            </div>
            <div class="col-sm-4 col-lg-4 mb-2">
                <?= $this->Form->control('ano_id', ['empty' => ' ', 'options' => $anos, 'value' => $candidato->ano_id, 'class' => 'form-control', 'label' => 'Ano']); ?>
            </div>
        </div>

        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mt-3 mt-lg-3 mb-lg-2">Dados do Responsável</p>
        </div>
        <div class="row">

            <div class="col-lg-6 mb-2">
                <?= $this->Form->control('responsavel.nm_responsavel', ['value' => $candidato->responsavel->nm_responsavel, 'class' => 'form-control', 'label' => 'Nome do Responsável']); ?>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2">
                <?= $this->Form->control('responsavel.vl_cpf', ['value' => $candidato->responsavel->vl_cpf, 'class' => 'form-control', 'label' => 'CPF']); ?>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2">

                <?= $this->Form->control('responsavel.vl_rg_resp', ['value' => $candidato->responsavel->vl_rg_resp, 'class' => 'form-control', 'label' => 'RG']); ?>
            </div>
            <div class="col-sm-6 col-lg-3 mb-2">
                <?= $this->Form->control('responsavel.vl_titulo', ['value' => $candidato->responsavel->vl_titulo, 'class' => 'form-control', 'label' => 'Título eleitoral']); ?>
            </div>
            <div class="col-sm-3 col-lg-1 mb-2">
                <?= $this->Form->control('responsavel.vl_zona', ['value' => $candidato->responsavel->vl_zona, 'class' => 'form-control', 'label' => 'Zona']); ?>
            </div>
            <div class="col-sm-3 col-lg-1 mb-2">
                <?= $this->Form->control('responsavel.vl_secao', ['value' => $candidato->responsavel->vl_secao, 'class' => 'form-control', 'label' => 'Seção']); ?>
            </div>
            <div class="col-sm-4 col-lg-2 mb-2">
                <label class="required error">Nascimento</label>
                <input type="text" value="<?= $candidato->responsavel->dt_nascimento ? date_format($candidato->responsavel->dt_nascimento, 'd/m/Y') : '' ?>">
            </div>
            <div class="col-sm-8 col-lg-5 mb-2">
                <label>E-mail</label>
                <?= $this->Form->control('nm_email', ['value' => $candidato->responsavel->nm_email, 'class' => 'form-control', 'label' => false]); ?>
            </div>
        </div>
        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mt-3 mt-lg-3 mb-lg-2">Dados profissionais do Responsável</p>
        </div>
        <div class="row">

            <?php if ($candidato->responsavel->ds_trabalho != '') { ?>

                <div class="col-lg-6 mb-2">
                    <label>Trabalho</label>
                    <input type="text" value="<?= $candidato->responsavel->ds_trabalho ?>">
                </div>

            <?php } ?>

            <div class="col-lg-3 mb-2">
                <label>Profissão</label>
                <?php if ($candidato->responsavel->ds_profissao != '') {
                    echo $this->Form->control('ds_profissao', ['value' => $candidato->responsavel->ds_profissao, 'id' => 'ds_prof', 'label' => false]);
                } else {
                    echo $this->Form->control('ds_profissao', ['value' => ' ', 'id' => 'ds_prof', 'label' => false]);
                } ?>
                <!-- <input type="text" id="ds_prof" value=" <?= ($candidato->responsavel->ds_profissao != '' ? $candidato->responsavel->ds_profissao : '') ?>" disabled> -->
            </div>

            <?php if ($candidato->responsavel->ds_profissao !== 'Aposentado') { ?>
                <div class="row" id="prof">

                    <div class="col-lg-6 mb-2">

                        <?= $this->Form->control('responsavel.nm_rua_trab', ['value' => $candidato->responsavel->nm_rua_trab, 'id' => 'logradouroempr', 'class' => 'logradouroempr', 'label' => "Local de Trabalho"]); ?>

                    </div>
                    <div class="col-lg-2 mb-2">

                        <?= $this->Form->control('responsavel.vl_numero_trab', ['value' => $candidato->responsavel->vl_numero_trab, 'id' => 'num_rua_resp', 'label' => 'Número']); ?>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2">

                        <?= $this->Form->control('responsavel.vl_cep_trab', ['value' => $candidato->responsavel->vl_cep_trab, 'id' => 'cepempr', 'class' => 'cepempr', 'label' => 'CEP']); ?>

                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2">

                        <?= $this->Form->control('responsavel.nm_bairro_trab', ['value' => $candidato->responsavel->nm_bairro_trab, 'id' => 'bairroempr', 'label' => 'Bairro']); ?>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2">

                        <?= $this->Form->control('responsavel.nm_cidade_trab', ['value' => $candidato->responsavel->nm_cidade_trab, 'id' => 'cidadeempr', 'label' => 'Cidade']); ?>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2">

                        <?= $this->Form->control('cd_telefone', ['value' => $candidato->responsavel->cd_telefone,  'class' => 'phone_with_ddd', 'label' => 'Telefone']); ?>

                    </div>

                </div>
            <?php } ?>
        </div>

        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mt-3 mt-lg-3 mb-lg-2">Existe alguém da família que possui bolsa pela Prefeitura?</p>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="col-12 d-flex justify-content-left">

                    <!-- <input style='width: 1em;margin-top: 0.3em;' type='radio' name='ic_deficiente' value='1' id='sim' />
                <p class='font-weight-bold' style="margin-bottom: 0em; margin-left: 0.5em">Sim</p> -->

                    <input style='width: 1em;margin-top: 0.3em' type='radio' name='concessao_fam' value='0' <?= ($candidato->responsavel->concessao_fam == 0) ? 'checked' : '' ?> id='concessao_fam_p' onclick='ativaDadosBolsa()' />
                    <p class='font-weight-bold' style='margin-bottom: 0em; margin-left: 0.5em'>Sim / Bolsa Parcial</p>
                </div>
                <div class="col-12 d-flex">
                    <input style='width: 1em;margin-top: 0.3em' type='radio' name='concessao_fam' value='1' <?= ($candidato->responsavel->concessao_fam == 1) ? 'checked' : '' ?> id='concessao_fam_i' onclick='ativaDadosBolsa()' />
                    <p class='font-weight-bold' style='margin-bottom: 0em; margin-left: 0.5em'>Sim / Bolsa Integral</p>
                </div>
                <div class="col-12 d-flex">
                    <input style='width: 1em;margin-top: 0.3em' type='radio' name='concessao_fam' value='2' <?= ($candidato->responsavel->concessao_fam == 2) ? 'checked' : '' ?> id='concessao_fam_u' onclick='ativaDadosBolsa(this)' />
                    <p class='font-weight-bold' style='margin-bottom: 0em; margin-left: 0.5em'>Sim / Transporte Universitário</p>
                </div>
                <div class="col-12 d-flex">
                    <input style='width: 1em;margin-top: 0.3em' type='radio' name='concessao_fam' value='3' <?= ($candidato->responsavel->concessao_fam == 3) ? 'checked' : '' ?> id='concessao_fam_n' onclick='ativaDadosBolsa(this)' />
                    <p class=' font-weight-bold' style='margin-bottom: 0em; margin-left: 0.5em'>Não</p>
                </div>

            </div>
        </div>

        <div class="row mb-5" id="cadinfo">

            <div class="col-lg-6">
                <label>Nome completo do aluno:</label>
                <?= $this->Form->control('concessao_aluno', ['value' => $candidato->responsavel->concessao_aluno, 'placeholder' => 'Digite o nome do aluno que possui bolsa', 'label' => false]); ?>
            </div>
            <div class="col-lg-4">
                <?= $this->Form->control('concessao_escola', ['value' => $candidato->responsavel->concessao_escola, 'options' => $escolas, 'class' => 'p-1 w-100', 'label' => 'Nome da escola: ']); ?>
            </div>

        </div>
        <!-- <div class="row"> -->
        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mt-3 mt-lg-3 mb-lg-2">Questionário Sócio-Econômico</p>
        </div>


        <div class="col-12 d-flex flex-wrap ">


            <div class="col-6 col-lg-2">
                <?= $this->Form->control('ds_moradia', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['1' => 'Própria', '2' => 'Cedida', '3' => 'Financiada', '4' => 'Alugada'], 'value' => $candidato->ds_moradia, 'label' => 'Moradia']); ?>
            </div>

            <div class="col-6 col-lg-3">
                <?= $this->Form->control('ds_dependentes', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => 'mais de 4'], 'value' => $candidato->ds_dependentes, 'label' => 'Menor de 18']); ?>
            </div>

            <div class="col-sm-6 col-lg-2">
                <?= $this->Form->control('ds_rendafamiliar', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['4' => '3 a 5', '3' => '6 a 10', '2' => '11 a 15', '1' => 'mais de 16'], 'value' => $candidato->ds_rendafamiliar, 'label' => 'Renda familiar / Salários']); ?>
            </div>
            <div class="col-sm-6 col-lg-2">
                <?= $this->Form->control('ds_transporte', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['5' => 'Coletivo', '4' => 'Fretado', '3' => 'Particular'], 'value' => $candidato->ds_transporte, 'label' => 'Transporte utilizado']); ?>

            </div>
            <div class="col-sm-6 col-lg-3">
                <?= $this->Form->control('ic_deficiente', ['type' => 'select', 'class' => 'p-1 w-100', 'options' => ['1' => 'Sim', '0' => 'Não'], 'value' => $candidato->ic_deficiente, 'label' => 'O(a) candidato(a) é deficiente?']); ?>
            </div>
        </div>

        <!-- </div> -->
        <div class="col-md-12 ml-md-3 col-sm-12 mt-3 brTitle">
            <p class="mt-3 mt-lg-3 mb-lg-2">Outras informações que julgar necessárias:</p>
        </div>

        <div class="row d-flex justify-content-center">

            <div class="col-12 col-lg-5 d-flex justify-content-left ml-2 position-relative">
                <textarea name=" ds_info_compl" class="form-control" id="limitedText" onKeyUp="limitText(this, 150);"></textarea>
                <p style=" font-size:0.8em; position:absolute; bottom:-1.5em; right:0; display:inline; display:flex; margin:0 20px 0 0">Limite de Caracteres&ensp;<span id='countdown'>150</span></p>
            </div>
            <div class="col-12 d-flex justify-content-left ml-2">

            </div>

            <div class="col-6 mt-4 d-flex justify-content-center">
                <div class="col-md-4 justify-content-lg-start">
                    <button type="button" onclick="history.back()" class="btn btn-warning mt-2 mb-2 px-4" style="color: white"><i class="fas fa-reply" style="padding-right: 5px"></i>Voltar</button>
                </div>

                <?php if (isset($noInscr)) {
                    if ($noInscr == true) { ?>
                        <div class="col-md-4 d-flex justify-content-md-center">
                            <?= $this->Html->link('<i class="fas fa-print"></i> Imprimir', ['action' => 'imprimir', $candidato->id], ['class' => 'btn btn-success mt-2 mb-2 px-4', 'escape' => false]) ?>
                        </div>
                <?php }
                } ?>

                <div class="col-md-4 justify-content-lg-end">
                    <button class="btn btn-bolsa pull-right mt-2 mb-2" type="submit"><i class="fas fa-check" style="padding-right: 5px"></i>Confirmar</button>
                </div>
            </div>

        </div>
    </div>
</div>


<?php echo $this->Form->end(); ?>
</div>
<script>
    function limitText(limitField, limitNum) {
        document.getElementById('countdown').innerHTML = limitNum - limitField.value.length
    }

    var ds_prof = document.getElementById('ds_prof').value;

    if (ds_prof !== ' ') {
        // alert('Estou Aqui' + ds_prof);
        document.getElementById('prof').style.display = 'flex';
    } else {
        // alert('Não Estou aqui');
        document.getElementById('prof').style.display = 'none';
    }

    if (document.getElementById('concessao_fam_n').checked) {
        document.getElementById('cadinfo').style.display = 'none';
    } else {
        document.getElementById('cadinfo').style.display = 'flex';
    }


    // document.getElementById('cadinfo').style.display = 'none';
    document.getElementById('atualiza').style.display = 'none';
    document.getElementById('passo2').style.display = 'none';


    function proximo() {
        document.getElementById('cadcand').style.display = 'none';
        document.getElementById('prof').style.display = 'none';
        document.getElementById('passo2').style.display = 'flex';

    }

    if ($("#concessao_fam_n").prop("checked ")) {
        alert('SIM');
        document.getElementById('cadinfo').style.display = 'none';
    } else {
        alert('Não');
        document.getElementById('cadinfo').style.display = 'flex';
    }


    function ativaDadosBolsa(val) {
        if (document.getElementById('concessao_fam_n').checked == true) {
            document.getElementById('cadinfo').style.display = 'none';
        } else {
            document.getElementById('cadinfo').style.display = 'flex';
        }

    }
</script>