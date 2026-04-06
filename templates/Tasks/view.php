<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
$estados = \App\Model\Table\TasksTable::estadosDisponibles();
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $task->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $task->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $task->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List tasks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tasks view content">
            <h3><?= h($task->titulo) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($task->titulo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= nl2br(h((string)$task->descripcion)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($estados[$task->estado] ?? $task->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Due date') ?></th>
                    <td><?= $task->fecha_limite ? h($task->fecha_limite) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($task->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($task->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
