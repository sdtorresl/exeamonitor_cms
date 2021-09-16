<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */

$this->loadHelper('Form', [
    'templates' => 'materialize_form',
]);

?>

<?= $this->Html->css('materialize-colorpicker.min.css') ?>
<?= $this->Html->script('/node_modules/jquery/dist/jquery.min.js') ?>
<?= $this->Html->script('materialize-colorpicker.min.js') ?>

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
                    echo $this->Form->control(__('name'));
                    echo $this->Form->control(__('description'), ['class' => 'materialize-textarea', 'data-length' => '500']);
                    echo $this->Form->control(__('contact_person'));
                    echo $this->Form->control(__('contact_phone'));
                    echo $this->Form->control(__('logo'), ['type' => 'file', 'label' => false, 'placeholder' => __('Logo')]);
                    echo $this->Form->control(__('background'), ['type' => 'file', 'label' => false, 'placeholder' => __('Background')]);
                    echo $this->Form->control(__('stream_name'));
                    echo $this->Form->control(__('stream_url'));
                    echo $this->Form->control(__('backup_url'));
                ?>

                <div id="primary-component" class="file-field">
                    <div class="btn"></div>
                    <div class="file-path-wrapper">
                    <?= $this->Form->control(__('primary_color')); ?>
                    </div>
                </div>
                <div id="secondary-component" class="file-field">
                    <div class="btn"></div>
                    <div class="file-path-wrapper">
                    <?= $this->Form->control(__('secondary_color')); ?>
                    </div>
                </div>

                <div class="form-submit d-flex jc-end">
                    <?= $this->Html->link(__('Cancel'), ['controller' => 'customers', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
                </div>

            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('#primary-component').colorpicker({
            format: 'hex',
            component: '.btn'
        });
        $('#primary-component').colorpicker('setValue', '<?= $customer->primary_color ?>');

        $('#secondary-component').colorpicker({
            format: 'hex',
            component: '.btn'
        });
        $('#secondary-component').colorpicker('setValue', '<?= $customer->secondary_color ?>');
    });
</script>
