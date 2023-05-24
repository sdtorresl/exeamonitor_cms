<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */
?>

<section class="customers index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-briefcase"></i>
        </div>

        <h2 class="title"><?= __('Customers') ?></h2>
    </div>

    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort(__('name')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('contact_person')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('contact_phone')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('stream_name')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('created')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('modified')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('created_by')) ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= h($customer->name) ?></td>
                    <td><?= h($customer->contact_person) ?></td>
                    <td><?= h($customer->contact_phone) ?></td>
                    <td><?= h($customer->stream_name) ?></td>
                    <td><?= h($customer->created) ?></td>
                    <td><?= h($customer->modified) ?></td>
                    <td><?= h($customer->created_by) ?></td>

                    <td class="actions">
                        <?= $this->Html->link('<i class="fal fa-play"></i>', ['action' => 'player', $customer->id, '?' => ['preview' => true]], ['escape' => false]) ?>
                        <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $customer->id], ['escape' => false]) ?>
                        <?= $this->Html->link('<i class="fal fa-edit"></i>', ['action' => 'edit', $customer->id], ['escape' => false]) ?>
                        <?= $this->Form->postLink('<i class="fal fa-trash"></i>', ['action' => 'delete', $customer->id], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $customer->id),
                            'escape' => false,
                            'class' => 'delete']) ?>
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
            <?= $this->Html->link(__('Create'), ['controller' => 'customers', 'action' => 'add'], ['class' => ['btn']]) ?>
        </div>
    </div>
</section>
