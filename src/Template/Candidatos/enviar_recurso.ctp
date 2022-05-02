<?= $this->Html->css('bolsas.css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

<style>
    @media print {
        .noprint {
            display: none;
        }

        body {
            background: #fff;
        }
    }
</style>
<?= $this->Flash->render() ?>
<div class="container">


    <?php if ($impressao == null) { ?>
        <div class="col-md-8 mt-4  alinhamento noprint">
            <div class="title">Bolsas de Estudos - Recurso</div>
            <blockquote class="ml-2 mt-3 ml-lg-4 mt-lg-3 mb-lg-2">Requerimento contra o Indeferimento</blockquote>
            <?= $this->Form->create(null, ['id' => 'fom-recurso', 'novalidate']) ?>
            <div class="row justify-content-start">
                <div class="col-md-2">
                    <?= $this->Form->control('inscricao_id', ['type' => 'text', 'label' => 'Protocolo', 'value' => $inscricao->id, 'disabled' => 'disabled']); ?>
                </div>
                <div class="col-md-5">
                    <?= $this->Form->control('nm_candidato', ['type' => 'text', 'label' => 'Candidato', 'value' => $candidato->nm_candidato, 'disabled' => 'disabled']); ?>
                </div>
                <div class="col-md-5">
                    <?= $this->Form->control('nm_escola', ['type' => 'text', 'label' => 'Escola Pretendida', 'value' => $candidato->escola->nm_escola, 'disabled' => 'disabled']); ?>
                </div>
                <div class="col-md-7">
                    <?= $this->Form->control('nm_responsavel', ['type' => 'text', 'label' => 'Responsável', 'value' => $candidato->responsavel->nm_responsavel, 'disabled' => 'disabled']); ?>
                </div>
                <div class="col-md-5">
                    <?= $this->Form->control('vl_rg_resp', ['type' => 'text', 'label' => 'RG', 'value' => $candidato->responsavel->vl_rg_resp, 'disabled' => 'disabled']); ?>
                </div>
                <div class="col-12 mt-4 mb-4">
                    <?= $this->Form->textarea('ds_motivo_recurso', ['value' => $candidato->ds_motivo_recurso, 'onkeyUp' => 'limitText(this,250)', 'style' => 'border: 1px solid #7c7c7c; width: 100%;']); ?>

                    <p style=" font-size:0.8em; position:absolute; bottom:-1.5em; right:0; display:inline; display:flex; margin:0 20px 0 0">Limite de Caracteres&ensp;<span id='countdown'>250</span></p>
                </div>

                <div class="col-lg-12 d-flex justify-content-end">

                    <button class="btn btn-bolsa mt-2" type="submit"><i class="fas fa-check" style="padding-right: 5px"></i>Confirmar</button>

                </div>
                <?= $this->Form->end() ?>
            </div>

        </div>
    <?php } else { ?>
        <?= $this->Html->css('print.css'); ?>


        <div class="panel-body" style="page-break-after: avoid">
            <div id="cabecalho" class=" w-100">
                <p><span><strong><?= $this->Html->image('cabecalho_pg.jpg', ['class' => 'cabecalho']) ?></strong></span></p>
            </div>
            <div class="col-md-12 mt-5 px-5">
                <h2 style="text-align: center;"><b>REQUERIMENTO</b></h2><br /><br />

                <p style="text-align: justify;">&emsp;<?= $candidato->nm_candidato ?> cadastrado sob o número de inscrição <?= $inscricao->id ?> neste ato representado(a) por <?= $candidato->responsavel->nm_responsavel ?>, responsável legal pelo aluno(a), devidamente inscrito no R.G. nº <?= $candidato->responsavel->vl_rg ?> vem mui respeitosamente apresentar REQUERIMENTO contra o indeferimento da Bolsa de Estudos pelos motivos abaixos.</p><br />
                <p style="text-align: justify;">&emsp;<?= $inscricao->ds_motivo_recurso ?></p><br />
                <p style="text-align: justify;">&emsp;Informo ainda que a escola pretendida é <?= $candidato->escola->nm_escola ?></p><br /><br />

                <?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                ?>

                <p>Praia Grande, <?= utf8_encode(strftime('%d de %B de %Y', strtotime('today'))); ?></p><br /><br />
                <p>______________________________________________________</p>
                <p>Assinatura</p>

            </div>
            <?= $this->Html->link('home', ['controller' => 'pages', 'action' => 'home'], ['id' => 'home', 'class' => 'd-none']); ?>

            <div class="row mb-5 d-flex justify-content-center no-print">
                <div class="col-lg-4 col-sm-12 d-flex justify-content-between">
                    <button type="button" onclick="history.back();document.getElementById('home').click();" class="btn btn-warning float-left mb-2 px-4" style="color: white"><i class="fas fa-reply" style="padding-right: 5px"></i> Voltar</button>

                    <button class="btn btn-success float-right mr-4 mb-2 pb-2" id="btnImprimir" onclick="imprimir();document.getElementById('home').click();"><i class="fas fa-print"></i> Imprimir</button>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<script>
    function imprimir() {
        window.print();
        // window.history.go(-3);
        // window.location.href = "http://dpid.cidadaopg.sp.gov.br/47093bolsaestudo/"
    }
</script>