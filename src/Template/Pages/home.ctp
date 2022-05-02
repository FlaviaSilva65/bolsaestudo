<!--SEDUC DPID - Manuel Afonso 47061 em 20/03/2021-->
<?= $this->Html->css('pages_home') ?>
<div class="row justify-content-center">
    <!-- Bolsa Parcial -->
    <fieldset class="col-11 col-lg-11 col-xl-10 fieldset-border p-0 mt-3 sombra overflow-hidden">
        <legend class="w-auto ml-3 fieldset-legend">
            <p class="text-azulEscuro font-weight-bold mr-2"><i class="fas fa-user-graduate mx-2 text-azulMedio"></i>Bolsa de Estudo Parcial</p>
        </legend>
        <div class="d-flex flex-wrap justify-content-around mb-4">
            <div class="col-10 col-md-3 p-0 mt-0 mt-sm-3">
                <?php
                // btn Cadastrar-se
                if (isset($inscricao) && $inscricao == true) {
                    echo $this->Html->link('
                        <i class="fas fa-user-plus fa-2x mr-2 text-verdeMedio"></i>
                        <p class="w-100 text-center m-0 fs">Cadastrar-se</p>
                    ', ['controller' => 'candidatos', 'action' => 'add'], ['class' => 'd-flex btn-verdeClaro p-2 rounded', 'escape' => false]);
                } else {
                    // btn Fora do Período de Inscrição
                    echo $this->Html->link('
                        <i class="fas fa-user-plus fa-2x mr-2 text-verdeMedio"></i>
                        <p class="w-100 text-center m-0 fs">Fora do Perído de Inscrição</p>
                    ', ['controller' => 'pages', 'action' => 'home'], ['class' => 'd-flex btn-verdeClaro p-2 rounded disabled', 'escape' => false]);
                }
                ?>
            </div>
            <div class="col-10 col-md-3 p-0 d-flex flex-wrap justify-content-end mt-3">
                <?php if (isset($recurso) && $recurso == true) { ?>
                <?=
                        // btn Recurso
                        $this->Html->link('
                        <i class="fas fa-user-edit fa-2x mr-2 text-laranjaMedio"></i>
                        <p class="w-100 text-center m-0 fs">Recurso</p>
                    ', ['controller' => 'candidatos', 'action' => 'recurso'], ['class' => 'w-100 d-flex btn-laranjaClaro p-2 rounded', 'escape' => false]) .

                            // btn Imprimir Novamente
                            '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="3" class="col-9 p-0 d-flex justify-content-center btn-laranjaMedio text-white rounded passingID"><i class="fas fa-print mr-2 mt-1 text-white"></i>
                    <p class="m-0 ">Imprimir Novamente</p></a>';
                } else {
                    // brn Recurso Fora do Período de Inscrição
                    echo $this->Html->link('
                    <i class="fas fa-user-edit fa-2x mr-2 text-laranjaMedio"></i>
                    <p class="w-100 text-center m-0 fs">Fora do Período de Recurso</p>
                ', ['controller' => 'pages', 'action' => 'home'], ['class' => 'w-100 d-flex btn-laranjaClaro p-2 rounded', 'escape' => false]);
                } ?>
            </div>
            <div class="col-10 col-md-3 p-0 d-flex flex-wrap justify-content-end mt-3">
                <?php if (isset($inscricao) && $inscricao == true) { ?>
                    <?=
                        // btn Já sou cadastrado
                        '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="1" class="w-100 d-flex btn-azulClaro p-2 rounded passingID"><i class="fas fa-user-check fa-2x mr-2 text-azulEscuro"></i>
                        <p class="w-100 text-center m-0 fs">Já sou cadastrado</p></a>' .

                            // btn Imprimir Novamente
                            '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="2" class="col-9 p-0 d-flex justify-content-center btn-azulEscuro text-white rounded passingID"><i class="fas fa-print mr-2 mt-1 text-white"></i>
                    <p class="m-0 ">Imprimir Novamente</p></a>'
                    ?>
                <?php } else {
                    // btn Fora do Período de Inscrição
                    echo '<a href="#" data-toggle="modal" data-id="1" class="w-100 d-flex btn-azulClaro p-2 rounded passingID"><i class="fas fa-user-check fa-2x mr-2 text-azulEscuro"></i>
                <p class="w-100 text-center m-0 fs">Fora do Período de Inscrição</p></a>' .

                        // btn Imprimir Novamente
                        '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="2" class="col-9 p-0 d-flex justify-content-center btn-azulEscuro text-white rounded passingID"><i class="fas fa-print mr-2 mt-1 text-white"></i>
                 <p class="m-0 ">Imprimir Novamente</p></a>';
                } ?>
            </div>
        </div>
        <h5 class="mb-0 mt-3 bg-amareloMedio text-center px-2 py-1"><i class="fas fa-info-circle bg-white text-laranjaMedio mr-2 rounded-circle"></i>Para cadastrar um segundo dependente (criança/adolescente), acessar através do botão JÁ SOU CADASTRADO.</h5>
        <h6 class="mb-0 mt-3 bg-azulEscuro text-white px-2 py-1"><i class="fas fa-info-circle bg-white text-laranjaMedio mr-2 rounded-circle"></i>As bolsas parciais (50% do valor da anuidade escolar), para alunos de Educação Infantil, Ensinos Fundamental e Médio.</h6>
    </fieldset>

    <!-- Bolsa Integral -->

    <fieldset class="col-11 col-lg-11 col-xl-10 fieldset-border p-0 mt-3 mt-lg-4 sombra overflow-hidden">
        <legend class="w-auto ml-3 fieldset-legend">
            <p class="text-azulEscuro font-weight-bold mr-2"><i class="fas fa-user-graduate mx-2 text-azulMedio"></i>Bolsa de Estudo Integral</p>
        </legend>
        <div class="d-flex flex-wrap justify-content-around mb-4">
            <div class="col-10 col-md-3 p-0 mt-0 mt-sm-3">
                <?php
                // btn Cadastrar-se
                if (isset($inscricaoBAtleta) && $inscricaoBAtleta == true) {
                    echo $this->Html->link('
                        <i class="fas fa-user-plus fa-2x mr-2 text-verdeMedio"></i>
                        <p class="w-100 text-center m-0 fs">Cadastrar-se</p>
                    ', ['controller' => '../bolsaatleta/candidatos', 'action' => 'add'], ['class' => 'd-flex btn-verdeClaro p-2 rounded', 'escape' => false]);
                    // echo '<a href="http://dpid.cidadaopg.sp.gov.br/bolsaatleta/candidatos/add"  class="w-100 d-flex btn-verdeClaro p-2 rounded"><i class="fas fa-user-plus fa-2x mr-2 text-verdeMedio">
                    // </i>
                    // <p class="w-100 text-center m-0 fs">Cadastrar-se</p></a>';
                } else {

                    echo $this->Html->link('
                        <i class="fas fa-user-plus fa-2x mr-2 text-verdeMedio"></i>
                        <p class="w-100 text-center m-0 fs">Fora do Perído de Inscrição</p>
                    ', ['controller' => 'pages', 'action' => 'home'], ['class' => 'd-flex btn-verdeClaro p-2 rounded disabled', 'escape' => false]);
                }
                ?>
            </div>
            <div class="col-10 col-md-3 p-0 d-flex flex-wrap justify-content-end mt-3">
                <?php if (isset($recursoBA) && $recursoBA == true) { ?>
                    <?=
                        // btn Recurso
                        $this->Html->link('
                        <i class="fas fa-user-edit fa-2x mr-2 text-laranjaMedio"></i>
                        <p class="w-100 text-center m-0 fs">Recurso</p>
                    ', ['controller' => '../bolsaatleta/candidatos', 'action' => 'recurso'], ['class' => 'w-100 d-flex btn-laranjaClaro p-2 rounded', 'escape' => false]) .
                            // btn Imprimir Novamente
                            '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="6" class="col-9 p-0 d-flex justify-content-center btn-laranjaMedio text-white rounded passingID"><i class="fas fa-print mr-2 mt-1 text-white"></i>
                    <p class="m-0 ">Imprimir Novamente</p></a>';





                    ?>
                <?php } else {
                    // brn Recurso Fora do Período de Inscrição
                    echo $this->Html->link('<i class="fas fa-user-edit fa-2x mr-2 text-laranjaMedio"></i>
                    <p class="w-100 text-center m-0 fs">Fora do Período de Recurso</p>
                    ', ['controller' => 'pages', 'action' => 'home'], ['class' => 'w-100 d-flex btn-laranjaClaro p-2 rounded', 'escape' => false]);
                } ?>
            </div>
            <div class="col-10 col-md-3 p-0 d-flex flex-wrap justify-content-end mt-3">
                <?php if (isset($inscricao) && $inscricao == true) {

                    // btn Já sou cadastrado
                    echo
                        '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="4" class="w-100 d-flex btn-azulClaro p-2 rounded passingID"><i class="fas fa-user-check fa-2x mr-2 text-azulEscuro"></i>
                        <p class="w-100 text-center m-0 fs">Já sou cadastrado</p></a>' .


                            // btn Imprimir Novamente
                            '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="5" class="col-9 p-0 d-flex justify-content-center btn-azulEscuro text-white rounded passingID"><i class="fas fa-print mr-2 mt-1 text-white"></i>
                        <p class="m-0 ">Imprimir Novamente</p></a>';
                } else {
                    // btn Fora do Período de Inscrição
                    echo '<a href="#" data-toggle="modal" data-id="1" class="w-100 d-flex btn-azulClaro p-2 rounded passingID"><i class="fas fa-user-check fa-2x mr-2 text-azulEscuro"></i>
                    <p class="w-100 text-center m-0 fs">Fora do Período de Inscrição</p></a>' .

                        // btn Imprimir Novamente
                        '<a href="" data-toggle="modal" data-target="#modalLogincand" data-id="5" class="col-9 p-0 d-flex justify-content-center btn-azulEscuro text-white rounded passingID"><i class="fas fa-print mr-2 mt-1 text-white"></i>
                    <p class="m-0 ">Imprimir Novamente</p></a>';
                }
                ?>
            </div>
            <div class="col-10 col-md-2 p-0 mt-0 mt-sm-3">
                <?=
                    // btn Login ADM
                    '<a href="http://dpid.cidadaopg.sp.gov.br/bolsaatleta/users/login"  class="w-100 d-flex btn-cinzaClaro p-2 rounded"><i class="fas fa-user-lock fa-2x mr-2 text-cinzaClaro"></i>
                        <p class="w-100 text-center m-0 fs">Login ADM</p></a>'
                ?>
            </div>
        </div>
        <h6 class="mb-0 mt-3 bg-azulEscuro text-white px-2 py-1"><i class="fas fa-info-circle bg-white text-laranjaMedio mr-2 rounded-circle"></i>As bolsas integrais, para estudantes/atletas do Ensino Fundamental e Médio, que representam a cidade por meio de seleções coordenadas pela Secretaria de Esporte e Lazer (Seel).</h6>
    </fieldset>
    <!-- Avisos e Informações -->
    <div class="col-11 col-lg-11 col-xl-10 p-sm-0 mt-4 text-secondary d-flex avisos-border">
        <h4><i class="fas fa-info-circle mr-2"></i>Avisos e Informações</h4>
    </div>
    <div class="col-11 col-lg-11 col-xl-10 p-0 mt-4 d-flex flex-wrap justify-content-between">
        <div class="col-sm-6 col-lg-3 px-0 position-relative giro">
            <?=
                $this->Html->link(
                    $this->Html->image('avisos.png', ['class' => 'image-aviso']) . '
                <i class="far fa-file-alt icone"></i>
                <p class="descricao">Edital</p>
                <p class="publicado">Publicado em ' . (!is_null($edital) ?   $edital->dt_public : '00/00/2021') . '</p>',
                    (!is_null($edital) ? '/arquivos/' . $edital->nm_arquivo : '#'),
                    ['target' => 'blank', 'escape' => false, 'title' => 'Clique para visualizar']
                )
            ?>
        </div>
        <div class="col-sm-6 mt-4 mt-sm-0 col-lg-3 p-0 position-relative giro">
            <?=
                $this->Html->link(
                    $this->Html->image('avisos.png', ['class' => 'image-aviso']) . '
                <i class="far fa-file-alt icone"></i>
                <p class="descricao">Esclarecimentos</p>
                <p class="publicado">Publicado em ' . (!is_null($esclarecimento) ?   $esclarecimento->dt_public : '00/00/2021') . '</p>',
                    (!is_null($esclarecimento) ? '/arquivos/' . $esclarecimento->nm_arquivo : '#'),
                    ['target' => 'blank', 'escape' => false, 'title' => 'Clique para visualizar']
                )
            ?>
        </div>
        <div class="col-sm-6 mt-4 mt-lg-0 col-lg-3 p-0 position-relative giro">
            <?=
                $this->Html->link(
                    $this->Html->image('avisos.png', ['class' => 'image-aviso']) . '
                <i class="far fa-file-alt icone"></i>
                <p class="descricao">Classificação</p>
                <p class="publicado">Publicado em ' . (!is_null($classificacao) ?   $classificacao->dt_public : '00/00/2021') . '</p>',
                    (!is_null($classificacao) ? '/arquivos/' . $classificacao->nm_arquivo : '#'),
                    ['target' => 'blank', 'escape' => false, 'title' => 'Clique para visualizar']
                )
            ?>
        </div>
        <div class="col-sm-6 mt-4 mt-lg-0 col-lg-3 p-0 position-relative giro">
            <?=
                $this->Html->link(
                    $this->Html->image('avisos.png', ['class' => 'image-aviso']) . '
                <i class="fas fa-phone-alt icone-fone"></i>
                <p class="fale-conosco pr-0">Fale Conosco</p>
                <p class="fone w-75 mt-3 d-flex justify-content-center">(13) 3496-2350</p>
                <p class="publicado">das 08h00 às 17h00</p>',
                    '#',
                    ['target' => 'blank', 'escape' => false, 'title' => 'Clique para visualizar']
                )
            ?>
        </div>
    </div>
</div>