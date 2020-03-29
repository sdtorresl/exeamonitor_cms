<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'EMS - Exea Monitoring System';
$menuCell = $this->cell('Menu');
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('/node_modules/materialize-css/dist/css/materialize.min.css') ?>
    <?= $this->Html->script('/node_modules/materialize-css/dist/js/materialize.min.js') ?>
    <?= $this->Html->css('main.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav>
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="fal fa-bars"></i></a>

        <div class="nav-wrapper">
            <a href="#" class="brand-logo">Logo</a>
            <ul id="nav-mobile" class="right">
                <li>
                    <?= $this->Html->link(_('Logout'), [
                        'controller' => 'Users',
                        'action' => 'logout'
                    ]) ?>
                </li>
            </ul>
        </div>
    </nav>

    <?= $menuCell ?>

    <main>
        <div class="container">
            <?= $this->fetch('content'); ?>
        </div>
    </main>

    <script type="text/javascript">
        M.AutoInit();

        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.sidenav');
            var options = {
                preventScrolling: false
            }
            var instances = M.Sidenav.init(elems, options);
        });

        var collapsibleElem = document.querySelector('.collapsible');
        var collapsibleInstance = M.Collapsible.init(collapsibleElem);
    </script>

    <?= $this->Flash->render('flash') ?>
</body>

</html>
