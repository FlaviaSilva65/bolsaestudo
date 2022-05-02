<!--SEDUC DPID - Manuel Afonso 47061 em 20/03/2021-->
<!-- Cake v3.9.2 -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsas</title>
    <?= $this->Html->meta('favicon.png', '/img/favicon.png', ['type' => 'icon']) ?>
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


    <?= $this->Flash->render() ?>
    <div class="container-fluid p-0">
        <?=
            $this->Element('header') .
                $this->fetch('content') .
                (!$this->request->getSession()->read('Auth.User')
                    ? $this->Element('modal_login')
                    : '') .
                $this->Element('modal_logincand')

        ?>
    </div>
    <div>
        <?= $this->Element('footer') ?>
    </div>

</body>

</html>