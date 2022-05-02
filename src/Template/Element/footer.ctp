<!-- SEDUC DPID - Manuel Afonso 47061 em 21/03/2021 -->
<?= $this->Html->css('element_footer') ?>
<div class="sf mt-5 mt-sm-0 no-print"></div>
<footer class="row flex-column-reverse flex-sm-row py-2 position-absolute fixed-bottom fixed-left no-print">
    <div class="col-sm-6 dpid d-flex justify-content-center justify-content-sm-start">
        <a href="http://www.cidadaopg.sp.gov.br/portal/" target="blank"><?= $this->Html->image('dpid.png') ?></a>
        <p>
            Desenvolvido por DPID - Departamento de Programas de Inclusão Digital<br>
            cidadaopg.sp.gov.br - Portal Educacional | &copy; 2020-<?= date("Y") ?>
        </p>
    </div>
    <div class="col-sm-6 pmpg mb-3 mb-sm-0 d-flex justify-content-center justify-content-sm-end">
        <a href="http://www.praiagrande.sp.gov.br/" target="blank">
            <p>
                <u>Município da Estância Balneária de Praia Grande</u><br>
                <span>Estado de São Paulo</span><br>
                <span>Secretaria de Educação</span>
            </p>
            <?= $this->Html->image('brasãoPG.png') ?>
        </a>
    </div>
</footer>