<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointsOfSale[]|\Cake\Collection\CollectionInterface $pointsOfSale
 */
?>

<section class="pointsOfSale index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-store"></i>
        </div>

        <h2 class="title"><?= __('Points Of Sale') ?></h2>
    </div>
    
    <div class="card-content">
        <table class="centered responsive-table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort(__('name')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('country_id')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('city_id')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('created')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('modified')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort(__('customer_id')) ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pointsOfSale as $pointsOfSale): ?>
                <tr>
                    <td><?= h($pointsOfSale->name) ?></td>
                    <td><?= $pointsOfSale->has('country') ? $pointsOfSale->country->name : '' ?></td>
                    <td><?= $pointsOfSale->has('city') ? $pointsOfSale->city->name : '' ?></td>
                    <td><?= h($pointsOfSale->created) ?></td>
                    <td><?= h($pointsOfSale->modified) ?></td>
                    <td><?= $pointsOfSale->has('customer') ? $this->Html->link($pointsOfSale->customer->name, ['controller' => 'Customers', 'action' => 'view', $pointsOfSale->customer->id]) : '' ?></td>
                            
                    <td class="actions">
                        <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $pointsOfSale->id], ['escape' => false, 'title' => __('View')] ) ?>
                        <?= $this->Html->link('<i class="fal fa-edit"></i>', ['action' => 'edit', $pointsOfSale->id], ['escape' => false, 'title' => __('Edit')] ) ?>
                        <?= $this->Form->postLink('<i class="fal fa-trash"></i>', ['action' => 'delete', $pointsOfSale->id], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $pointsOfSale->id),
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
            <?= $this->Html->link(__('Create'), ['controller' => 'pointsOfSale', 'action' => 'add'], ['class' => ['btn']]) ?>
        </div>
    </div>
</section>