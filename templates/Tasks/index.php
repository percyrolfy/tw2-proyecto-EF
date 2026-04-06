<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Task> $tasks
 * @var array<string, string> $estados
 */
?>
<div class="tasks index content">
    <?= $this->Html->link(__('New task'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tasks') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('titulo', __('Title')) ?></th>
                    <th><?= $this->Paginator->sort('estado', __('Status')) ?></th>
                    <th><?= $this->Paginator->sort('fecha_limite', __('Due date')) ?></th>
                    <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) : ?>
                <tr>
                    <td><?= $this->Number->format($task->id) ?></td>
                    <td><?= h($task->titulo) ?></td>
                    <td><?= h($estados[$task->estado] ?? $task->estado) ?></td>
                    <td><?= $task->fecha_limite ? h($task->fecha_limite) : '' ?></td>
                    <td><?= h($task->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $task->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $task->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $task->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $task->id),
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
