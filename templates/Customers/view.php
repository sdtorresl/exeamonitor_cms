<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>

<section class="customers view card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= h($customer->name) ?></h2>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">

                <table>
                                <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($customer->name) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Contact Person') ?></th>
                        <td><?= h($customer->contact_person) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Contact Phone') ?></th>
                        <td><?= h($customer->contact_phone) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Logo') ?></th>
                        <td><?= h($customer->logo) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Logo Dir') ?></th>
                        <td><?= h($customer->logo_dir) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Logo Type') ?></th>
                        <td><?= h($customer->logo_type) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Background') ?></th>
                        <td><?= h($customer->background) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Background Dir') ?></th>
                        <td><?= h($customer->background_dir) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Background Type') ?></th>
                        <td><?= h($customer->background_type) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Stream Name') ?></th>
                        <td><?= h($customer->stream_name) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Stream Url') ?></th>
                        <td><?= h($customer->stream_url) ?></td>
                    </tr>
                                        <tr>
                        <th><?= __('Backup Url') ?></th>
                        <td><?= h($customer->backup_url) ?></td>
                    </tr>
                                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($customer->id) ?></td>
                    </tr>
                        <tr>
                        <th><?= __('Primary Color') ?></th>
                        <td><?= $this->Number->format($customer->primary_color) ?></td>
                    </tr>
                        <tr>
                        <th><?= __('Secondary Color') ?></th>
                        <td><?= $this->Number->format($customer->secondary_color) ?></td>
                    </tr>
                            <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($customer->created) ?></td>
                    </tr>
                        <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($customer->modified) ?></td>
                    </tr>
                    </table>
                    <div class="text">
                    <strong><?= __('Description') ?></strong>
                    <blockquote>
                        <?= $this->Text->autoParagraph(h($customer->description)); ?>
                    </blockquote>
                </div>
    
                        <div class="related">
                    <h4><?= __('Related Points Of Sale') ?></h4>
                    <?php if (!empty($customer->points_of_sale)) : ?>
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
                            <?php foreach ($customer->points_of_sale as $pointsOfSale) : ?>
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
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'class' => ['btn', 'cancel']]); ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id], ['class' => 'btn']) ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</dsection>