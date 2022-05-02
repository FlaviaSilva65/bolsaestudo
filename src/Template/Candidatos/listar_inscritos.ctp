<!-- <style>
.break { page-break-before: always; }
</style> -->

<div class="container" id="divDeclaracao">

    <div class="panel-body" style="page-break-after: always">


        <div class="col-sm-12 mb-5" id="noprint">
            <button class="btn btn-success btn-lg float-right mr-4 no-print" id="btnImprimir" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
        </div>

        <div class="row">

            <div class="col-xl-12">

                <table class="table">
                    <thead>
                        <tr style="width: 100%;">
                            <th colspan="4">

                                <div id="cabecalho" class="mt-0 mb-0 w-100">
                                    <p><span><?= $this->Html->image('cabecalho_pg.jpg', ['class' => 'cabecalho']) ?></span></p>
                                </div>
                                <p style="text-align:center">Bolsa de Estudos - Inscritos</p>
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <th scope="col">Candidato</th>
                        <th scope="col">Inscrição</th>
                        <th scope="col">Data</th>
                        <th scope="col">Assinatura</th>
                    </tr>

                    <?php foreach ($inscritos as $inscrito) : ?>

                        <tr>
                            <td style="width: 40%;"><?= strtoupper($inscrito->nm_candidato) ?></td>
                            <td style="width: 10%;"><?= $inscrito->id ?></td>
                            <td style="width: 20%;">___/___/______</td>
                            <td style="width: 30%;">&nbsp;</td>
                        </tr>

                    <?php endforeach ?>

                </table>


            </div>

        </div>
    </div>


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
        window.history.go(-1);
        // window.location.href = "http://localhost/47093bolsaestudo/candidatos/index_admin"
    }

    // window.onload = imprimir();   Não consegui fazer que carregue a tela de impressão e só redirect após imprimir
    // window.history.go(-1);
</script>