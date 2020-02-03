<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointsOfSale $pointsOfSale
 */
?>

<section class="pointsOfSale index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Add Points Of Sale') ?></h2>
    </div>
    
    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                
<?= $this->Form->create($pointsOfSale, ['class' => 'form']) ?>
<?php
    echo $this->Form->control('name');
    echo $this->Form->control('phone');
    echo $this->Form->control('contact');
    echo $this->Form->control('address');
    echo $this->Form->control('country_id', ['options' => $countries]);
    echo $this->Form->control('city_id', ['options' => $cities]);
    echo $this->Form->control('last_access');
    echo $this->Form->control('customer_id', ['options' => $customers]);
?>
<div class="form-submit d-flex jc-end">
    <?= $this->Html->link(__('Cancel'), ['controller' => 'pointsOfSale', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
</div>

<?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
