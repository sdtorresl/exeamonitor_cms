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

        <h2 class="title"><?= __('Edit Playbooks') ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

                <?= $this->Form->create($playbook, ['class' => 'form']) ?>
                <?php
                echo $this->Form->control('name');
                echo $this->Form->control('customer_id', ['options' => $customers]);
                ?>

                <!--<div id="rules" class="">
                    <?php /*foreach ($playbook->rules as $i => $rule) : */?>
                        <div class="row">

                            <?php /*= $this->Form->control("rules.$i.id"); */?>

                            <div class="col s6">
                                <?php /*= $this->Form->control('rules.' . $i . '.tag', ['options' => $playlistValues]); */?>
                            </div>
                            <div class="col s6">

                                <?php /*= $this->Form->control('rules.' . $i . '.logic', ['options' => $logicValues]); */?>
                            </div>
                        </div>
                    <?php /*endforeach */?>
                </div>

                <div class="d-flex jc-end">

                    <a id="remove-button" class="waves-effect waves-light btn-small cancel">
                        <i class="fal fa-trash left"></i><?php /*= __('Delete Rule') */?>
                    </a>

                    <a id="add-button" class="waves-effect waves-light btn-small">
                        <i class="fal fa-plus left"></i><?php /*= __('Add Rule') */?>
                    </a>
                </div>-->
                <div id="rules"></div>

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

<div id="rules-values" data-value='<?= json_encode($playbook->rules) ?>'></div>
<div id="logic-values" data-value='<?= json_encode($logicValues) ?>'></div>
<div id="playlist-values" data-value='<?= json_encode($playlistValues) ?>'></div>
<div id="days-values" data-value='<?= json_encode($daysValues) ?>'></div>

<?= $this->Html->script('playbooks', ['block' => true]); ?>
