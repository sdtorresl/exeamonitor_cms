<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>

<section class="customers index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Add Customers') ?></h2>
    </div>
    
    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                
<?= $this->Form->create($customer, ['class' => 'form']) ?>
<?php
    echo $this->Form->control('name');
    echo $this->Form->control('description');
    echo $this->Form->control('contact_person');
    echo $this->Form->control('contact_phone');
    echo $this->Form->control('logo');
    echo $this->Form->control('logo_dir');
    echo $this->Form->control('logo_type');
    echo $this->Form->control('background');
    echo $this->Form->control('background_dir');
    echo $this->Form->control('background_type');
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
