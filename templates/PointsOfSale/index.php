<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointsOfSale[]|\Cake\Collection\CollectionInterface $pointsOfSale
 */
?>

<section class="pointsOfSale index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-pointsOfSale"></i>
        </div>

        <h2 class="title"><?= __('Points Of Sale') ?></h2>
    </div>
    
    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('contact') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('last_access') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pointsOfSale as $pointsOfSale): ?>
                <tr>
                                                                                                                        <td><?= $this->Number->format($pointsOfSale->id) ?></td>
                                                                                                                                    <td><?= h($pointsOfSale->name) ?></td>
                                                                                                                                    <td><?= h($pointsOfSale->phone) ?></td>
                                                                                                                                    <td><?= h($pointsOfSale->contact) ?></td>
                                                                                                                                    <td><?= h($pointsOfSale->address) ?></td>
                                                                            <td><?= $pointsOfSale->has('country') ? $this->Html->link($pointsOfSale->country->name, ['controller' => 'Countries', 'action' => 'view', $pointsOfSale->country->id]) : '' ?></td>
                                                                                                                                                        <td><?= $pointsOfSale->has('city') ? $this->Html->link($pointsOfSale->city->name, ['controller' => 'Cities', 'action' => 'view', $pointsOfSale->city->id]) : '' ?></td>
                                                                                                                                                                        <td><?= h($pointsOfSale->last_access) ?></td>
                                                                                                                                    <td><?= h($pointsOfSale->created) ?></td>
                                                                                                                                    <td><?= h($pointsOfSale->modified) ?></td>
                                                                                                                    <td><?= $pointsOfSale->has('customer') ? $this->Html->link($pointsOfSale->customer->name, ['controller' => 'Customers', 'action' => 'view', $pointsOfSale->customer->id]) : '' ?></td>
                            
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $pointsOfSale->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pointsOfSale->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pointsOfSale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pointsOfSale->id)]) ?>
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
    </div>
</section>