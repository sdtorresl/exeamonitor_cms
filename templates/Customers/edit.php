<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */

$this->loadHelper('Form', [
    'templates' => 'materialize_form',
]);

?>

<section class="customers index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Edit Customers') ?></h2>
    </div>
    
    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                
            <?= $this->Form->create($customer, ['class' => 'form', 'type' => 'file']) ?>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description', ['class' => 'materialize-textarea', 'data-length' => '500']);
                    echo $this->Form->control('contact_person');
                    echo $this->Form->control('contact_phone');
                    echo $this->Form->control('logo', ['type' => 'file', 'label' => false, 'placeholder' => __('Logo')]);
                    echo $this->Form->control('background', ['type' => 'file', 'label' => false, 'placeholder' => __('Background')]);
                    echo $this->Form->control('stream_name');
                    echo $this->Form->control('stream_url');
                    echo $this->Form->control('backup_url');
                    echo $this->Form->control('primary_color');
                    echo $this->Form->control('secondary_color');
                ?>
                <div class="form-submit d-flex jc-end">
                    <?= $this->Html->link(__('Cancel'), ['controller' => 'customers', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
                </div>

            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>