<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>

<section class="cities view card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= h($city->name) ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

                <table>
                                <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($city->name) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Country Code') ?></th>
                        <td><?= h($city->country_code) ?></td>
                    </tr>
                                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($city->id) ?></td>
                    </tr>
                    </table>

                        <div class="related">
                    <h4><?= __('Related Points Of Sale') ?></h4>
                    <?php if (!empty($city->points_of_sale)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Name') ?></th>
                                    <th><?= __('Phone') ?></th>
                                    <th><?= __('Contact') ?></th>
                                    <th><?= __('Address') ?></th>
                                    <th><?= __('Country Id') ?></th>
                                    <th><?= __('City Id') ?></th>
                                    <th><?= __('Last Access') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th><?= __('Customer Id') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($city->points_of_sale as $pointsOfSale) : ?>
                            <tr>
                                    <td><?= h($pointsOfSale->id) ?></td>
                                    <td><?= h($pointsOfSale->name) ?></td>
                                    <td><?= h($pointsOfSale->phone) ?></td>
                                    <td><?= h($pointsOfSale->contact) ?></td>
                                    <td><?= h($pointsOfSale->address) ?></td>
                                    <td><?= h($pointsOfSale->country_id) ?></td>
                                    <td><?= h($pointsOfSale->city_id) ?></td>
                                    <td><?= h($pointsOfSale->last_access) ?></td>
                                    <td><?= h($pointsOfSale->created) ?></td>
                                    <td><?= h($pointsOfSale->modified) ?></td>
                                    <td><?= h($pointsOfSale->customer_id) ?></td>
                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'PointsOfSale', 'action' => 'view', $pointsOfSale->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'PointsOfSale', 'action' => 'edit', $pointsOfSale->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PointsOfSale', 'action' => 'delete', $pointsOfSale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pointsOfSale->id)]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                            <?php endif; ?>
                            </div>

                <div class="row">
                    <div class="form-submit d-flex jc-end">
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id), 'class' => ['btn', 'cancel']]); ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $city->id], ['class' => 'btn']) ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</dsection>