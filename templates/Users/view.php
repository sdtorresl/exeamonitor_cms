<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<section class="users view card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= h($user->first_name . ' ' . $user->last_name) ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

                <div class="row">
                
                    <table>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td><?= $this->Number->format($user->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Role') ?></th>
                            <td><?= h($user->role) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Point Of Sale') ?></th>
                            <td><?= $user->has('points_of_sale') ? $this->Html->link($user->points_of_sale->name, ['controller' => 'PointsOfSale', 'action' => 'view', $user->points_of_sale->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Last Access') ?></th>
                            <td><?= h($user->last_access) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($user->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($user->modified) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Enabled') ?></th>
                            <td><?= $user->enabled ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="row">
                    <div class="form-submit d-flex jc-end">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete user {0}?', $user->username), 'class' => ['btn', 'cancel']]); ?>
                        <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</dsection>
