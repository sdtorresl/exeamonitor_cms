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
                            <th><?= _('Volume') ?></th>
                            <th><?= _('Date') ?></th>
                            <th><?= _('Status') ?></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>


            <section id="historic" class="col s12">
                <div>
                    <canvas id="realtimeChart"></canvas>
                </div>

                <div>
                    <canvas id="todayChart"></canvas>
                </div>
            </section>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0"></script>

<script>
    const statsURI = '<?= $this->Url->build([
            "controller" => "Checks",
            "action" => "stats",
            "_ext" => "json",
            $customer->id,
    ]); ?>';
    const customerId = <?= $customer->id; ?>

    const status = {
        'stopped': '<?= _('Stopped') ?>',
        'playing': '<?= _('Playing') ?>',
        'unknown': '<?= _('Unknown') ?>',
        'disconnected': '<?= _('Disconnected') ?>'
    };
</script>

<?= $this->Html->script('checks'); ?>
