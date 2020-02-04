<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City[]|\Cake\Collection\CollectionInterface $cities
 */
?>

<section class="cities index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-cities"></i>
        </div>

        <h2 class="title"><?= __('Cities') ?></h2>
    </div>
    
    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('country_code') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cities as $city): ?>
                <tr>
                                                <td><?= $this->Number->format($city->id) ?></td>
                                                            <td><?= h($city->name) ?></td>
                                                            <td><?= h($city->country_code) ?></td>
            
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $city->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $city->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?>
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