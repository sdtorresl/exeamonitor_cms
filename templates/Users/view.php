<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($user->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($user->last_name) ?></td>
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
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Passwords Resets') ?></h4>
                <?php if (!empty($user->passwords_resets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Uuid') ?></th>
                            <th><?= __('Used') ?></th>
                            <th><?= __('Expiry Date') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->passwords_resets as $passwordsResets) : ?>
                        <tr>
                            <td><?= h($passwordsResets->uuid) ?></td>
                            <td><?= h($passwordsResets->used) ?></td>
                            <td><?= h($passwordsResets->expiry_date) ?></td>
                            <td><?= h($passwordsResets->user_id) ?></td>
                            <td><?= h($passwordsResets->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'PasswordsResets', 'action' => 'view', $passwordsResets->uuid]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'PasswordsResets', 'action' => 'edit', $passwordsResets->uuid]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PasswordsResets', 'action' => 'delete', $passwordsResets->uuid], ['confirm' => __('Are you sure you want to delete # {0}?', $passwordsResets->uuid)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Points Of Sales') ?></h4>
                <?php if (!empty($user->points_of_sales)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Contact') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Last Access') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->points_of_sales as $pointsOfSales) : ?>
                        <tr>
                            <td><?= h($pointsOfSales->id) ?></td>
                            <td><?= h($pointsOfSales->name) ?></td>
                            <td><?= h($pointsOfSales->phone) ?></td>
                            <td><?= h($pointsOfSales->contact) ?></td>
                            <td><?= h($pointsOfSales->address) ?></td>
                            <td><?= h($pointsOfSales->last_access) ?></td>
                            <td><?= h($pointsOfSales->created) ?></td>
                            <td><?= h($pointsOfSales->modified) ?></td>
                            <td><?= h($pointsOfSales->customer_id) ?></td>
                            <td><?= h($pointsOfSales->user_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'PointsOfSales', 'action' => 'view', $pointsOfSales->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'PointsOfSales', 'action' => 'edit', $pointsOfSales->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PointsOfSales', 'action' => 'delete', $pointsOfSales->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pointsOfSales->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>