<?= $this->layout = false; ?>
<?= $this->Form->control('tipo_id', ['id' => 'tipos', 'class' => 'p-1 w-100', 'empty' => '---', 'type' => 'select', 'options' => $tipos, 'label' => 'Nível de Ensino', 'onchange' => 'chama(this.value)']); ?>