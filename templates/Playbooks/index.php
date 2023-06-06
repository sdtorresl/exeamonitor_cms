<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playbook[]|\Cake\Collection\CollectionInterface $playbooks
 */

$this->loadHelper('Form', [
    'templates' => 'materialize_form',
]);
?>

<section class="playbooks index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-music"></i>
        </div>

        <h2 class="title"><?= __('Playbooks') ?></h2>
    </div>

    <?= $this->Form->create($playbooks) ?>
    <?= $this->Form->control('name'); ?>
    <?= $this->Form->button(__('Filtrar'), ['class' => 'btn']) ?>
    <?= $this->Html->link(__('Limpiar filtros'), ['controller' => 'Playbooks', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
    <?= $this->Form->end() ?>

    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($playbooks as $playbook) : ?>
                    <tr>
                        <td><?= $this->Number->format($playbook->id) ?></td>
                        <td><?= h($playbook->name) ?></td>
                        <td><?= $playbook->has('customer') ? $this->Html->link($playbook->customer->name, ['controller' => 'Customers', 'action' => 'view', $playbook->customer->id]) : '' ?></td>
                        <td><?= h($playbook->created) ?></td>
                        <td><?= h($playbook->modified) ?></td>

                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $playbook->id], ['escape' => false, 'title' => __('View')]) ?>
                            <?= $this->Html->link('<i class="fal fa-edit"></i>', ['action' => 'edit', $playbook->id], ['escape' => false, 'title' => __('Edit')]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash"></i>', ['action' => 'delete', $playbook->id], [
                                'confirm' => __('Are you sure you want to delete # {0}?', $playbook->id),
                                'escape' => false,
                                'class' => 'delete',
                                'title' => __('Delete')
                            ]) ?>
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
            <?= $this->Html->link(__('Create'), ['controller' => 'Playbooks', 'action' => 'add'], ['class' => ['btn']]) ?>
        </div>
    </div>
</section>
