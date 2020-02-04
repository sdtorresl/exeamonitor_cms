<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country[]|\Cake\Collection\CollectionInterface $countries
 */
?>

<section class="countries index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-countries"></i>
        </div>

        <h2 class="title"><?= __('Countries') ?></h2>
    </div>
    
    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($countries as $country): ?>
                <tr>
                                                <td><?= $this->Number->format($country->id) ?></td>
                                                            <td><?= h($country->name) ?></td>
                                                            <td><?= h($country->code) ?></td>
            
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $country->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $country->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?>
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