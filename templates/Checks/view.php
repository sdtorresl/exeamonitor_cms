<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>

<section class="checks view card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-chart-bar"></i>
        </div>

        <h2 class="title"><?= $customer->name . ' ' .  _('report') ?></h2>
    </div>

    <div class="card-content">

        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active"  href="#real-time"><?= _('Real time') ?></a></li>
                    <li class="tab col s3"><a href="#historic"><?= _('Historic') ?></a></li>
                </ul>
            </div>


            <div id="real-time" class="col s12">
                <table>
                    <thead>
                        <tr>
                            <th><?= _('Point of sale') ?></th>
                            <th><?= _('Current song') ?></th>
                            <th><?= _('Status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customer->points_of_sale as $pos): ?>
                        <tr>
                            <td><?= $pos->name ?></td>
                            <td><?= $pos->current_song ? $pos->current_song : _('Unknown') ?></td>
                            <td><?php
                                switch ($pos->state) {
                                    case 'stopped':
                                        echo _('Stopped');
                                        break;
                                    case 'playing':
                                        echo _('Playing');
                                        break;
                                    default:
                                        echo _('Unknown');
                                        break;
                                }
                            ?></td>

                            <?php if ($pos->state == 'playing'): ?>
                                <td><i class="fas fa-circle enabled"></td>
                            <?php else: ?>
                                <td><i class="fas fa-circle disabled"></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


            <div id="historic" class="col s12">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
                <p>
                    <button id="randomizeData">Randomize Data</button>
                    <button id="addDataset">Add Dataset</button>
                    <button id="removeDataset">Remove Dataset</button>
                    <button id="addData">Add Data</button>
                </p>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0"></script>

<?= $this->Html->script('checks'); ?>
