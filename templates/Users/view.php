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

        <h2 class="title"><?= h($user->id) ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

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
                        <th><?= __('Point Of Sale Id') ?></th>
                        <td><?= $this->Number->format($user->point_of_sale_id) ?></td>
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

                <div class="row">
                    <div class="form-submit d-flex jc-end">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => ['btn', 'cancel']]); ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn']) ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</dsection>