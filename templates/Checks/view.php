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
                            <th><?= _('Status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customer->points_of_sale as $pos): ?>
                        <tr>
                            <td><?= $pos->name ?></td>

                            <?php 
                            $gotStatus = false;
                            foreach ($checks as $check) {
                                if ($check->points_of_sale->id == $pos->id && !$gotStatus) {
                                    echo '<td>' . ucfirst($check->state) . '</td>';
                                    echo '<td><i class="fas fa-circle enabled"></td>';
                                    $gotStatus = true;
                                }
                            } 
                            
                            if (!$gotStatus) {
                                echo '<td>Failed</td>';
                                echo '<td><i class="fas fa-circle disabled"></td>';
                            }
                            ?>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div id="historic" class="col s12">Test 2</div>
        </div>

    </div>
</section>
