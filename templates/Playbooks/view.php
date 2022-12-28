<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playbook $playbook
 */
?>

<section class="playbooks view card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= h($playbook->name) ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

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

                        <div class="related">
                    <h4><?= __('Related Rules') ?></h4>
                    <?php if (!empty($playbook->rules)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Tag') ?></th>
                                    <th><?= __('Logic') ?></th>
                                    <th><?= __('Playbook Id') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($playbook->rules as $rules) : ?>
                            <tr>
                                    <td><?= h($rules->id) ?></td>
                                    <td><?= h($rules->tag) ?></td>
                                    <td><?= h($rules->logic) ?></td>
                                    <td><?= h($rules->playbook_id) ?></td>
                                    <td><?= h($rules->created) ?></td>
                                    <td><?= h($rules->modified) ?></td>
                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Rules', 'action' => 'view', $rules->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Rules', 'action' => 'edit', $rules->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rules', 'action' => 'delete', $rules->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rules->id)]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                            <?php endif; ?>
                            </div>

                <div class="row">
                    <div class="form-submit d-flex jc-end">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $playbook->id], ['confirm' => __('Are you sure you want to delete # {0}?', $playbook->id), 'class' => ['btn', 'cancel']]); ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $playbook->id], ['class' => 'btn']) ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</dsection>