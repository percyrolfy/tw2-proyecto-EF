<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('apellido');
                    echo $this->Form->control('correo');
                    echo $this->Form->control('password', [
                        'type' => 'password',
                        'label' => __('Password'),
                        'help' => __('Leave blank to keep the current password.'),
                    ]);
                    echo $this->Form->control('lenguaje', [
                        'type' => 'select',
                        'options' => [
                            'es' => __('Spanish'),
                            'en' => __('English'),
                            'pt' => __('Portuguese'),
                            'fr' => __('French'),
                        ],
                        'label' => __('Preferred language'),
                    ]);
                    echo $this->Form->control('edad');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
