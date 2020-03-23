<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $checks
 */
?>

<section class="checks index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-checks"></i>
        </div>

        <h2 class="title"><?= __('Checks') ?></h2>
    </div>
    
    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('pos_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('volume') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('current_song') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($checks as $check): ?>
                <tr>
                                                <td><?= $this->Number->format($check->id) ?></td>
                                                            <td><?= h($check->state) ?></td>
                                                            <td><?= $this->Number->format($check->pos_id) ?></td>
                                                            <td><?= $this->Number->format($check->volume) ?></td>
                                                            <td><?= h($check->current_song) ?></td>
                                                            <td><?= h($check->created) ?></td>
            
                    <td class="actions">
                        <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $check->id], ['escape' => false, 'title' => __('View')] ) ?>
                        <?= $this->Html->link('<i class="fal fa-edit"></i>', ['action' => 'edit', $check->id], ['escape' => false, 'title' => __('Edit')] ) ?>
                        <?= $this->Form->postLink('<i class="fal fa-trash"></i>', ['action' => 'delete', $check->id], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $check->id),
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
    </div>
</section>