<?= $this->layout = false; ?>
<?= $this->Form->control('ano_id', ['id' => 'anos', 'class' => 'p-1 w-100', 'empty' => '---', 'type' => 'select', 'options' => $anos, 'label' => 'Anos Escolares ']); ?>