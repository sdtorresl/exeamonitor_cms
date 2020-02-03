<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointsOfSale $pointsOfSale
 */
?>

<section class="pointsOfSale view card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= h($pointsOfSale->name) ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

                <table>
                                <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($pointsOfSale->name) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Contact') ?></th>
                        <td><?= h($pointsOfSale->contact) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Address') ?></th>
                        <td><?= h($pointsOfSale->address) ?></td>
                    </tr>
                                                    <tr>
                        <th><?= __('Country') ?></th>
                        <td><?= $pointsOfSale->has('country') ? $this->Html->link($pointsOfSale->country->name, ['controller' => 'Countries', 'action' => 'view', $pointsOfSale->country->id]) : '' ?></td>
                    </tr>
                                                    <tr>
                        <th><?= __('City') ?></th>
                        <td><?= $pointsOfSale->has('city') ? $this->Html->link($pointsOfSale->city->name, ['controller' => 'Cities', 'action' => 'view', $pointsOfSale->city->id]) : '' ?></td>
                    </tr>
                                                    <tr>
                        <th><?= __('Customer') ?></th>
                        <td><?= $pointsOfSale->has('customer') ? $this->Html->link($pointsOfSale->customer->name, ['controller' => 'Customers', 'action' => 'view', $pointsOfSale->customer->id]) : '' ?></td>
                    </tr>
                                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($pointsOfSale->id) ?></td>
                    </tr>
                        <tr>
                        <th><?= __('Phone') ?></th>
                        <td><?= $this->Number->format($pointsOfSale->phone) ?></td>
                    </tr>
                            <tr>
                        <th><?= __('Last Access') ?></th>
                        <td><?= h($pointsOfSale->last_access) ?></td>
                    </tr>
                        <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($pointsOfSale->created) ?></td>
                    </tr>
                        <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($pointsOfSale->modified) ?></td>
                    </tr>
                    </table>

                </div>

                <div class="row">
                    <div class="form-submit d-flex jc-end">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pointsOfSale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pointsOfSale->id), 'class' => ['btn', 'cancel']]); ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pointsOfSale->id], ['class' => 'btn']) ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</dsection>