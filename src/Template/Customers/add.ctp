<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>

<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?= __('$Customers') ?></h2>
    </div>
</header>

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4"><?= __('$Customer') ?></h3>
                    </div>

                    <div class="card-body">
                        <?= $this->Form->create('$customer') ?>
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

                        <?= $this->Form->button(__('Submit')) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>