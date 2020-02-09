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

        <h2 class="title"><?= $customer->name ?></h2>
    </div>

    <div class="card-content">
        <div class="row">

            <div class="col s12 m8 l6 offset-m2 offset-l3">

                <div class="row">
                    <p>
                        <?= $this->Text->autoParagraph(h($customer->description)); ?>
                    </p>
                </div>

                <table class="row">
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
                
                <div class="related row">
                    <h2><?= __('Related Points Of Sale') ?></h2>
                    <?php if (!empty($customer->points_of_sale)) : ?>
                    <div class="table-responsive">
                        <table class="centered responsive-table">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($customer->points_of_sale as $pointsOfSale): ?>
                                <tr>
                                    <td><?= h($pointsOfSale->name) ?></td>
                                    <td><?= $pointsOfSale->has('country') ? $this->Html->link($pointsOfSale->country->name, ['controller' => 'Countries', 'action' => 'view', $pointsOfSale->country->id]) : '' ?></td>
                                    <td><?= $pointsOfSale->has('city') ? $this->Html->link($pointsOfSale->city->name, ['controller' => 'Cities', 'action' => 'view', $pointsOfSale->city->id]) : '' ?></td>

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
