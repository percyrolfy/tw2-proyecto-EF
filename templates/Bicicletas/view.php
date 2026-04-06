<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bicicleta $bicicleta
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $bicicleta->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $bicicleta->id],
                ['confirm' => __('¿Seguro que deseas eliminar # {0}?', $bicicleta->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Volver'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="bicicletas view content">
            <h3><?= h($bicicleta->modelo ?: ('Bicicleta #' . $bicicleta->id)) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= h($bicicleta->tipo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Material') ?></th>
                    <td><?= h($bicicleta->material) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tamaño rueda') ?></th>
                    <td><?= $bicicleta->tamaño_rueda === null ? '' : $this->Number->format($bicicleta->tamaño_rueda) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modelo') ?></th>
                    <td><?= h($bicicleta->modelo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Precio') ?></th>
                    <td><?= $bicicleta->precio === null ? '' : h($bicicleta->precio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha registro') ?></th>
                    <td><?= h($bicicleta->fecha_registro) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID') ?></th>
                    <td><?= $this->Number->format($bicicleta->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

