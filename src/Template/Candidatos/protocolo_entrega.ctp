<div class="container" id="divDeclaracao">

    <div class="panel-body" style="page-break-after: always">
        <div id="cabecalho" class=" w-100">
            <p style="text-align: center;"><span><strong><img src="http://www.cidadaopg.sp.gov.br/portal/img/misc/cabecalho.jpg" alt="cabecalho" /></strong></span></p>
        </div>



        <div class="row ">
            <div class="col-md-12 mt-5 mb-5 ">
                <h5 class="plesquerda" style="text-align: center;">DECLARAÇÃO DE RECEBIMENTO</h5><br /><br />

                <div class="titulo">
                    Declaro para os devidos fins, que recebemos toda a documentação necessária para a inscrição da Bolsa de Estudos
                    referente à inscrição Nº <b><?= $candidato->id ?> </b>
                    do candidato <?= strtoupper($candidato->nm_candidato) ?>.<br /><br />

                </div>


                <div class="datarodape mt-5 mb-5">

                    Praia Grande, <?= utf8_encode(strftime("%d de %B  de %Y", strtotime('today'))) ?>
                </div>

                <div class="mt-5 " style="text-align: center;">
                    _____________________________________________

                </div>
                <div class="mb-5" style="text-align: center;">
                    Comissão Especial de Bolsa de Estudos
                </div>


            </div>

        </div>
    </div>


</div>
<div class="col-sm-12 mb-5" id="noprint">
    <button class="btn btn-success btn-lg float-right mr-4 no-print" id="btnImprimir" onclick="imprimir()">Imprimir</button>
</div>
</div>
<style>
    @media print {
        #noprint {
            display: none;
        }

        body {
            background: #fff;
        }
    }
</style>

<script>
    function imprimir() {
        window.print();
        window.history.go(-2);
        // window.location.href = "http://localhost/47093bolsaestudo/candidatos/index_admin"
    }

    // window.onload = imprimir();   Não consegui fazer que carregue a tela de impressão e só redirect após imprimir
    // window.history.go(-1);
</script>