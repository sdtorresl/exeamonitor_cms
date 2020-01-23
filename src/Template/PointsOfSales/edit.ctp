<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointsOfSale $pointsOfSale
 */
?>

<?= $this->Form->create('$pointsOfSale') ?>
<?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('name');
            echo $this->Form->control('phone');
            echo $this->Form->control('contact');
            echo $this->Form->control('address');
            echo $this->Form->control('last_access');
            echo $this->Form->control('customer_id', ['options' => $customers]);
?>
<div class="form-submit d-flex jc-end">
    <?= $this->Html->link(__('Cancel'), ['controller' => 'pointsOfSales', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
</div>
<?= $this->Form->end() ?>
