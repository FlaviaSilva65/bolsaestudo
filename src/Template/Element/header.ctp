<!-- SEDUC DPID - Manuel Afonso 47061 em 21/03/2021 -->
<?= $this->Html->css('element_header') . $this->Html->script('element_login') ?>
<div class="row no-gutters headerContainer no-print">
    <div class="col d-flex justify-content-between">
        <?=
            $this->Html->image('header_background.png', ['id' => 'header_background']) .
                $this->Html->image('logo_pg.png', ['id' => 'imgLogo'])
        ?>
        <h2 class="d-none d-lg-block text-center text-white font-weight-bold posicaoTitulo"><i class="fab fa-audible mr-2"></i>Bolsa de Estudo <?= date('Y') ?></h2>
    </div>
    <div class="headerBtns">

        <?php if ($this->request->getParam(['action']) != 'imprimir') {
            echo $this->Html->link('<i class="fas fa-home text-white"></i>', ['controller' => 'Pages', 'action' => 'home'], ['escape' => false, 'class' => 'btn btn-info btn-md mr-1 mr-sm-2', 'title' => 'Início']) .
                ($this->getRequest()->getSession()->read('Auth.User')
                    ? $this->Html->link('<i class="fas fa-sign-out-alt"></i>', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'btn btn-success btn-md', 'title' => 'Sair do Administrativo'])
                    : '<a href="" data-toggle="modal" data-target="#modalLogin" title="Acessar Administrativo" class="btn btn-info btn-md d-none d-lg-inline-block"><i class="fas fa-sign-in-alt"></i></a>');
        } else {
            ($this->getRequest()->getSession()->read('Auth.User')
                ? $this->Html->link('<i class="fas fa-sign-out-alt"></i>', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'btn btn-success btn-md', 'title' => 'Sair do Administrativo'])
                : '');
        }
        ?>
    </div>
</div>
<h3 class="d-block d-lg-none text-center text-azulMedio font-weight-bold mt-3 no-print"><i class="fab fa-audible mr-2"></i>Bolsa de Estudo <?= date('Y') ?></h3>