<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Bolsas');
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->css('bootstrap.css'); ?>
    <?= $this->Html->css('bolsas.css'); ?>
    <?= $this->Html->css('all.min.css'); ?>


    <?= $this->Html->script('jquery.min'); ?>
    <?= $this->Html->script('bootstrap.min'); ?>
    <?= $this->Html->script('script'); ?>
    <?= $this->Html->script('jquery.maskedinput'); ?>
    <?= $this->Html->script('jquery.mask.js'); ?>
    <?= $this->Html->script('busca_cep.js'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <header>
        <div class="container-fluid p-0">
            <!-- <a class="navbar-brand" style="color: #fff" href="/bolsaestudo2021/">Secretaria de Educação</a> -->
            <?= $this->element('header'); ?>
        </div>
        <!-- <?php
                if ($user['sistema'] == 1) {
                    echo $this->element('menu');
                }
                ?> -->
    </header>
    <main>
        <?php echo $this->Flash->render(); ?>
        <div id="content">
            <?php echo $this->fetch('content'); ?>
        </div>
    </main>

    <footer>
    </footer>
</body>

</html>