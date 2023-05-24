<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->loadHelper('Form', [
    'templates' => 'materialize_form',
]);

?>

<section class="users index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Edit Users') ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

                <?= $this->Form->create($user, ['class' => 'form']) ?>
                <?php
                    echo $this->Form->control(__('username'));
                    echo $this->Form->control(__('password'));
                    echo $this->Form->control(__('first_name'));
                    echo $this->Form->control(__('last_name'));
                    echo $this->Form->control(__('email'));
                    echo $this->Form->control(__('role'));
                    echo $this->Form->control(__('amount_customers'), [
                        'visibility' => '{"field":"role","value":"customers_manager"}', // Para ocultar el campo inicialmente
                    ]);
                    echo $this->Form->control(__('point_of_sale_id'), ['empty' => true]);
                    echo $this->Form->control('enabled', ['type' => 'checkbox', 'label' => '<span>' . __('Enable') . '</span>', 'escape' => false]);

                ?>
                <div class="form-submit d-flex jc-end">
                    <?= $this->Html->link(__('Cancel'), ['controller' => 'users', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
