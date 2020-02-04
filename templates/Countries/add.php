<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country $country
 */
?>

<section class="countries index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Add Countries') ?></h2>
    </div>
    
    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                
<?= $this->Form->create($country, ['class' => 'form']) ?>
<?php
    echo $this->Form->control('name');
    echo $this->Form->control('code');
?>
<div class="form-submit d-flex jc-end">
    <?= $this->Html->link(__('Cancel'), ['controller' => 'countries', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
</div>

<?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
