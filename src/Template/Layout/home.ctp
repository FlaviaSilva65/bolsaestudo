<!--SEDUC DPID - Flavia Aparecida S Silva - 47093 em 24/03/2021-->
<!-- Cake v3.9.2 -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsas</title>
    <?= $this->Html->meta('favicon.png', '/img/favicon.png',['type' => 'icon']) ?>
    <?=
    
        $this->Html->css([
            'bootstrap',
            'all.min',
            'bolsas'
        ]) .
        $this->Html->script([
            'jquery.min', 'bootstrap.min',
            'jsapi',
            'script',
            'jquery.maskedinput',
            'jquery.mask',
            'busca_cep'
        ]) .
        $this->fetch('meta') . $this->fetch('css') . $this->fetch('script')
    ?>
    
</head>

<body>
    <header>
    <?= $this->Element('header'); ?>
        <nav class="navbar navbar-inverse navbar-static-top" style="background: #428bca" role="navigation">
        <div class="container-fluid">
            <?= $this->Element('menu'); ?>
</div>
        </nav>
    </header>
    <main>
        <?php echo $this->Flash->render(); ?>
        <div id="content">
            <?php echo $this->fetch('content'); ?>
        </div>
    </main>
    <?php
    //echo $this->fetch('script');
    ?>
    <footer>
    </footer>
</body>

</html>