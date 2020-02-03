<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */
?>

<section class="customers index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-customers"></i>
        </div>

        <h2 class="title"><?= __('Customers') ?></h2>
    </div>
    
    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('contact_person') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('contact_phone') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('logo_dir') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('logo_type') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('background') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('background_dir') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('background_type') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('stream_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('stream_url') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('backup_url') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('primary_color') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('secondary_color') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                                                <td><?= $this->Number->format($customer->id) ?></td>
                                                            <td><?= h($customer->name) ?></td>
                                                            <td><?= h($customer->contact_person) ?></td>
                                                            <td><?= h($customer->contact_phone) ?></td>
                                                            <td><?= h($customer->logo) ?></td>
                                                            <td><?= h($customer->logo_dir) ?></td>
                                                            <td><?= h($customer->logo_type) ?></td>
                                                            <td><?= h($customer->background) ?></td>
                                                            <td><?= h($customer->background_dir) ?></td>
                                                            <td><?= h($customer->background_type) ?></td>
                                                            <td><?= h($customer->stream_name) ?></td>
                                                            <td><?= h($customer->stream_url) ?></td>
                                                            <td><?= h($customer->backup_url) ?></td>
                                                            <td><?= $this->Number->format($customer->primary_color) ?></td>
                                                            <td><?= $this->Number->format($customer->secondary_color) ?></td>
                                                            <td><?= h($customer->created) ?></td>
                                                            <td><?= h($customer->modified) ?></td>
            
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<<') ?>
                <?= $this->Paginator->prev('<') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('>') ?>
                <?= $this->Paginator->last('>>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</section>