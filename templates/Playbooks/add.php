<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playbook $playbook
 */

$this->loadHelper('Form', [
    'templates' => 'materialize_form',
]);

?>

<section class="playbooks index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Add Playbooks') ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m10 l8 offset-l2">

                <?= $this->Form->create($playbook, ['class' => 'form']) ?>
                <?php
                echo $this->Form->control('name');
                echo $this->Form->control('customer_id', ['options' => $customers]);
                ?>
                <!-- <?php for ($i = 0; $i < 3; $i++) : ?>
                    <div class="row">
                        <div class="col s6">
                            <?= $this->Form->control('rules.' . $i . '.tag'); ?>
                        </div>
                        <div class="col s6">

                            <?= $this->Form->control('rules.' . $i . '.logic', ['options' => $logicValues]); ?>
                        </div>
                    </div>
                <?php endfor ?> -->

                <div id="rules" class="row"></div>

                <div class="d-flex jc-end">

                    <a id="remove-button" class="waves-effect waves-light btn-small cancel">
                        <i class="fal fa-trash left"></i><?= __('Delete Rule') ?>
                    </a>

                    <a id="add-button" class="waves-effect waves-light btn-small">
                        <i class="fal fa-plus left"></i><?= __('Add Rule') ?>
                    </a>
                </div>

                <div class="form-submit d-flex jc-end">
                    <?= $this->Html->link(__('Cancel'), ['controller' => 'playbooks', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<div id="logic-values" data-value='<?= json_encode($logicValues) ?>'></div>

<?= $this->Html->script('playbooks', ['block' => true]); ?>