<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 * @var array<string, string> $estados
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $task->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $task->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List tasks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tasks form content">
            <?= $this->Form->create($task) ?>
            <fieldset>
                <legend><?= __('Edit task') ?></legend>
                <?= $this->Form->control('titulo', ['label' => __('Title'), 'required' => true]) ?>
                <?= $this->Form->control('descripcion', ['label' => __('Description'), 'type' => 'textarea', 'rows' => 5]) ?>
                <?= $this->Form->control('estado', [
                    'type' => 'select',
                    'options' => $estados,
                    'label' => __('Status'),
                ]) ?>
                <?= $this->Form->control('fecha_limite', [
                    'label' => __('Due date'),
                    'empty' => true,
                ]) ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
