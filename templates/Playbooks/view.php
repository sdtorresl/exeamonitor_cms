<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playbook $playbook
 */
?>

<section class="playbooks view card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-music"></i>
        </div>

        <h2 class="title"><?= h($playbook->name) ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                <div class="row">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($playbook->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Customer') ?></th>
                            <td><?= $playbook->has('customer') ? $this->Html->link($playbook->customer->name, ['controller' => 'Customers', 'action' => 'view', $playbook->customer->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($playbook->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($playbook->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($playbook->modified) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="row related">
                    <h4><?= __('Related Rules') ?></h4>
                    <?php if (!empty($playbook->rules)) : ?>
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th><?= __('Tag') ?></th>
                                    <th><?= __('Logic') ?></th>
                                </tr>
                                <?php foreach ($playbook->rules as $rules) : ?>
                                    <tr>
                                        <td><?= $playlistValues[$rules->tag] ?></td>
                                        <td><?= $logicValues[$rules->logic] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="form-submit d-flex jc-end">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $playbook->id], ['confirm' => __('Are you sure you want to delete # {0}?', $playbook->id), 'class' => ['btn', 'cancel']]); ?>
                        <?= $this->Html->link(__('Back'), ['controller' => 'playbooks', 'action' => 'index'], ['class' => ['btn']]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $playbook->id], ['class' => 'btn']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </section>
