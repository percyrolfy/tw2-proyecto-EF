<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$langOptions = [
    'es' => __('Spanish'),
    'en' => __('English'),
    'pt' => __('Portuguese'),
    'fr' => __('French'),
];
?>
<div class="users form">
    <h1><?= __('Create an account') ?></h1>

    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Registration') ?></legend>
        <?= $this->Form->control('nombre', ['required' => true]) ?>
        <?= $this->Form->control('apellido', ['required' => true]) ?>
        <?= $this->Form->control('correo', ['label' => __('Email'), 'required' => true]) ?>
        <?= $this->Form->control('password', ['type' => 'password', 'required' => true]) ?>
        <?= $this->Form->control('lenguaje', [
            'type' => 'select',
            'options' => $langOptions,
            'label' => __('Preferred language'),
            'default' => 'es',
        ]) ?>
    </fieldset>
    <?= $this->Form->button(__('Register')) ?>
    <?= $this->Form->end() ?>

    <p><?= $this->Html->link(__('Already have an account? Sign in'), ['action' => 'login']) ?></p>
</div>
