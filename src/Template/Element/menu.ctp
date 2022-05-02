<nav class="navbar navbar-expand-lg navbar-dark fixed-end" style="background-color: #428bca;">
    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Candidatos
                </a>

                <div class="dropdown-menu divdd" aria-labelledby="navbarDropdown" style="background-color: #428bca;">
                    <?= $this->Html->link('Listar', ['controller' => 'candidatos', 'action' => 'index_admin'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Classificados', ['controller' => 'candidatos', 'action' => 'classificacao'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Relatórios
                </a>
                <div class="dropdown-menu divdd" aria-labelledby="navbarDropdown" style="background-color: #428bca;">
                    <?= $this->Html->link('Relatório por Pontos', ['controller' => 'candidatos', 'action' => 'relatorios'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Relatórios por Escola', ['controller' => 'candidatos', 'action' => 'relatorio_escola'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Relatórios por Ano Escolar', ['controller' => 'candidatos', 'action' => 'relatorio_ano'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Rel. Escola, Pontuação, Deficiente, Ano e Inscr', ['controller' => 'candidatos', 'action' => 'relatorio_esc_pont_def_ano_inscr'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Escolas
                </a>

                <div class="dropdown-menu divdd" aria-labelledby="navbarDropdown" style="background-color: #428bca;">
                    <?= $this->Html->link('Listar', ['controller' => 'escolas', 'action' => 'index'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Cadastrar', ['controller' => 'escolas', 'action' => 'add'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cronograma
                </a>

                <div class="dropdown-menu divdd" aria-labelledby="navbarDropdown" style="background-color: #428bca;">
                    <?= $this->Html->link('Listar', ['controller' => 'eventos', 'action' => 'index'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Cadastrar', ['controller' => 'eventos', 'action' => 'add'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Arquivos
                </a>
                <div class="dropdown-menu divdd" aria-labelledby="navbarDropdown" style="background-color: #428bca;">
                    <?= $this->Html->link('Listar', ['controller' => 'documentos', 'action' => 'index'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Cadastrar', ['controller' => 'documentos', 'action' => 'add'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuário
                </a>

                <div class="dropdown-menu divdd" aria-labelledby="navbarDropdown" style="background-color: #428bca;">
                    <?= $this->Html->link('Listar', ['controller' => 'Users', 'action' => 'index'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                    <?= $this->Html->link('Cadastrar', ['controller' => 'Users', 'action' => 'add'], ['class' => 'tfont dropdown-item', 'escape' => false]) ?>
                </div>
            </li>
            <li class="nav-item mt-2 ml-2">
                <a class="text-light" aria-haspopup="true" style="text-transform:uppercase;" aria-expanded="false">
                    Bem-vindo: <?= $this->request->getSession()->read('Auth.User')['nm_user']; ?>
                </a>
            </li>

        </ul>
    </div>
</nav>