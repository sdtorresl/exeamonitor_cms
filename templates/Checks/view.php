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

<script type="text/javascript">
/*
window.setInterval(function() {
    location.reload();
}, 60000);*/

var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

function randomScalingFactor() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}

function onRefresh(chart) {
    chart.config.data.labels.push(Date.now());
    chart.config.data.datasets.forEach(function(dataset) {
        dataset.data.push(randomScalingFactor());
    });
}

var color = Chart.helpers.color;
var config = {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Dataset 1 (line)',
            type: 'line',
            backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
            borderColor: chartColors.red,
            fill: false,
            cubicInterpolationMode: 'monotone',
            data: []
        }, {
            label: 'Dataset 2 (bars)',
            backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
            borderColor: chartColors.blue,
            borderWidth: 1,
            data: []
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Mixed chart (horizontal scroll) sample'
        },
        scales: {
            xAxes: [{
                type: 'realtime',
                realtime: {
                    duration: 60000,
                    refresh: 1000,
                    delay: 2000,
                    onRefresh: onRefresh
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'value'
                }
            }]
        },
        tooltips: {
            mode: 'nearest',
            intersect: false
        },
        hover: {
            mode: 'nearest',
            intersect: false
        }
    }
};

window.onload = function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    window.myChart = new Chart(ctx, config);
};

document.getElementById('randomizeData').addEventListener('click', function() {
    config.data.datasets.forEach(function(dataset) {
        for (var i = 0; i < dataset.data.length; ++i) {
            dataset.data[i] = randomScalingFactor();
        }
    });

    window.myChart.update();
});

var colorNames = Object.keys(chartColors);
document.getElementById('addDataset').addEventListener('click', function() {
    var colorName = colorNames[config.data.datasets.length % colorNames.length];
    var newColor = chartColors[colorName];
    var newDataset = {
        label: 'Dataset ' + (config.data.datasets.length + 1),
        type: 'line',
        backgroundColor: color(newColor).alpha(0.5).rgbString(),
        borderColor: newColor,
        fill: false,
        cubicInterpolationMode: 'monotone',
        data: new Array(config.data.labels.length)
    };

    config.data.datasets.push(newDataset);
    window.myChart.update();
});

document.getElementById('removeDataset').addEventListener('click', function() {
    config.data.datasets.pop();
    window.myChart.update();
});

document.getElementById('addData').addEventListener('click', function() {
    onRefresh(window.myChart);
    window.myChart.update();
});

</script>
