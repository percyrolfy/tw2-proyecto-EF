<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="users form">
    <h1><?= __('Sign in') ?></h1>

    <?= $this->Form->create(null) ?>
    <fieldset>
        <legend><?= __('Access') ?></legend>
        <?= $this->Form->control('correo', ['label' => __('Email'), 'required' => true]) ?>
        <?= $this->Form->control('password', ['label' => __('Password'), 'type' => 'password', 'required' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('Sign in')) ?>
    <?= $this->Form->end() ?>

    <p><?= $this->Html->link(__('Create an account'), ['action' => 'register']) ?></p>
</div>

