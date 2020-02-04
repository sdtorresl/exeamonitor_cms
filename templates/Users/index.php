<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<section class="users index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Users') ?></h2>
    </div>
    
    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('last_access') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('point_of_sale_id') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->first_name) ?></td>
                    <td><?= h($user->last_name) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= $user->enabled ? '<i class="fas fa-circle enabled"></i> ': '<i class="fas fa-circle disabled"></i>' ?></td>
                    <td><?= h($user->last_access) ?></td>
                    <td><?= $user->has('points_of_sale') ? $this->Html->link($user->points_of_sale->name, ['controller' => 'PointsOfSale', 'action' => 'view', $user->points_of_sale->id]) : '' ?></td>
            
                    <td class="actions">
                        <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $user->id], ['escape' => false, 'title' => __('View')] ) ?>
                        <?= $this->Html->link('<i class="fal fa-edit"></i>', ['action' => 'edit', $user->id], ['escape' => false, 'title' => __('Edit')] ) ?>
                        <?= $this->Form->postLink('<i class="fal fa-trash"></i>', ['action' => 'delete', $user->id], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                            'escape' => false,
                            'class' => 'delete',
                            'title' => __('Delete')]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="paginator center-align">
            <ul class="pagination">
                <?= $this->Paginator->first('<<') ?>
                <?= $this->Paginator->prev('<') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('>') ?>
                <?= $this->Paginator->last('>>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>

        <div class="form-submit d-flex jc-end">
            <?= $this->Html->link(__('Create'), ['controller' => 'users', 'action' => 'add'], ['class' => ['btn']]) ?>
        </div>
    </div>
</section>