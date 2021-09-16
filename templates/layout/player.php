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
$session = $this->getRequest()->getSession();
$name = $session->read('Auth.first_name') . ' ' . $session->read('Auth.last_name');
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
        <div class="nav-wrapper">
            <p class="brand-logo">
                <?= $name; ?>
            </p>
            <ul id="nav-mobile" class="right">
                <li>
                    <?php if (I18n::getLocale() == 'es_CO') {
                            echo $this->Html->link(__("English"), ['controller' => 'Languages', 'action' => 'en']);
                        } else {
                            echo $this->Html->link(__("Spanish"), ['controller' => 'Languages', 'action' => 'es']);
                        }
                        ?>
                </li>
                <li>
                <?= $this->Html->link(__('Logout'), [
                        'controller' => 'Users',
                        'action' => 'logout'
                    ]) ?>
                </li>
            </ul>
        </div>
    </nav>

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
