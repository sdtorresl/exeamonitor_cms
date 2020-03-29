<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $checks
 */
?>

<section class="checks index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-chart-pie"></i>
        </div>

        <h2 class="title"><?= __('Reports') ?></h2>
    </div>

    <div class="card-content">
    </div>
</section>

<div class="row">
    <?php foreach ($customers as $customer): ?>
    <div class="col s12 m4 l3">
        <div class="card">
            <div class="card-image">
                <?= $this->Html->image(str_replace(WWW_ROOT, '', $customer->logo_dir) . DS . $customer->logo) ?>
                <?= $this->Html->link('<i class="fal fa-arrow-right"></i>', 
                    ['action' => 'view', $customer->id], ['class' => 'btn-floating halfway-fab waves-effect waves-light bg-red', 'escape' => false]) ?>

                <!-- <a class="btn-floating halfway-fab waves-effect waves-light red" href="https://google.com">
                    <i class="fal fa-arrow-right"></i>
                </a> -->
            </div>
            <div class="card-content">
                <span class="card-title"><?= $customer->name ?></span>
                <!-- <p><?= $customer->description ?></p> -->
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
