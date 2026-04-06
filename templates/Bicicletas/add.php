<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bicicleta $bicicleta
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('Volver'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="bicicletas form content">
            <?= $this->Form->create($bicicleta) ?>
            <fieldset>
                <legend><?= __('Nueva Bicicleta') ?></legend>
                <?php
                    echo $this->Form->control('tipo', ['required' => true]);
                    echo $this->Form->control('material');
                    echo $this->Form->control('tamaño_rueda', ['type' => 'number', 'label' => 'Tamaño rueda']);
                    echo $this->Form->control('modelo');
                    echo $this->Form->control('precio', ['type' => 'number', 'step' => '0.01']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

