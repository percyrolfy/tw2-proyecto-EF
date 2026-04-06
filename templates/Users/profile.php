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
    <h1><?= __('Profile') ?></h1>

    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Your data') ?></legend>
        <?= $this->Form->control('nombre', ['required' => true]) ?>
        <?= $this->Form->control('apellido', ['required' => true]) ?>
        <?= $this->Form->control('lenguaje', [
            'type' => 'select',
            'options' => $langOptions,
            'label' => __('Preferred language'),
        ]) ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
