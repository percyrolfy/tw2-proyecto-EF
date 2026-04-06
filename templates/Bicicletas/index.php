<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Bicicleta> $bicicletas
 */
?>
<div class="bicicletas index content">
    <?= $this->Html->link(__('Nueva Bicicleta'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bicicletas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tipo') ?></th>
                    <th><?= $this->Paginator->sort('material') ?></th>
                    <th><?= $this->Paginator->sort('tamaño_rueda') ?></th>
                    <th><?= $this->Paginator->sort('modelo') ?></th>
                    <th><?= $this->Paginator->sort('precio') ?></th>
                    <th><?= $this->Paginator->sort('fecha_registro') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bicicletas as $bicicleta): ?>
                <tr>
                    <td><?= $this->Number->format($bicicleta->id) ?></td>
                    <td><?= h($bicicleta->tipo) ?></td>
                    <td><?= h($bicicleta->material) ?></td>
                    <td><?= $bicicleta->tamaño_rueda === null ? '' : $this->Number->format($bicicleta->tamaño_rueda) ?></td>
                    <td><?= h($bicicleta->modelo) ?></td>
                    <td><?= $bicicleta->precio === null ? '' : h($bicicleta->precio) ?></td>
                    <td><?= h($bicicleta->fecha_registro) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $bicicleta->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $bicicleta->id]) ?>
                        <?= $this->Form->postLink(
                            __('Eliminar'),
                            ['action' => 'delete', $bicicleta->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('¿Seguro que deseas eliminar # {0}?', $bicicleta->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

