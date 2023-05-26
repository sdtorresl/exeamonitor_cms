<?php
$roles = $roles ?? [];
$email = $this->getRequest()->getSession()->read('Auth.email');
$first_name = $this->getRequest()->getSession()->read('Auth.first_name');
$last_name = $this->getRequest()->getSession()->read('Auth.last_name');
$role = $this->getRequest()->getSession()->read('Auth.role');

# Gravatar
$default = "retro";
$size = 80;
$grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . $default . "&s=" . $size;

$name = $first_name . ' ' . $last_name;

?>

<ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
        <div class="customer-info">
            <figure class="customer-logo">
                <?= $this->Html->image('logo-ems.svg', ['alt' => 'Logo EMS', 'id' => 'logo', 'style' => 'width:150px;']); ?>
            </figure>
            <div class="customer-name">
                <?= $name ?>
            </div>
        </div>
    </li>

    <li>
        <div class="user-info">
            <div class="user-name"><?= $roles[$role] ?? ''?></div>
            <div class="user-role"><?= $email ?></div>
        </div>
    </li>

    <li>
        <?= $this->Html->link(
            '<i class="fal fa-file-alt"></i>' . __('Reports'),
            ['controller' => 'checks'],
            ['escape' => false]
        );
        ?>
    </li>

    <li>
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">
                    <i class="fal fa-users"></i>
                    <?= __('Users') ?>
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li><?= $this->Html->link(__('List'), ['controller' => 'users']) ?></li>
                        <li><?= $this->Html->link(__('Create'), ['controller' => 'users', 'action' => 'add']) ?></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>

    <li>
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">
                    <i class="fal fa-briefcase"></i>
                    <?= __('Customers') ?>
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li><?= $this->Html->link(__('List'), ['controller' => 'customers']) ?></li>
                        <li><?= $this->Html->link(__('Create'), ['controller' => 'customers', 'action' => 'add']) ?></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">
                    <i class="fal fa-store"></i>
                    <?= __('Points Of Sales') ?>
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li><?= $this->Html->link(__('List'), ['controller' => 'points-of-sale']) ?></li>
                        <li><?= $this->Html->link(__('Create'), ['controller' => 'points-of-sale', 'action' => 'add']) ?></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">
                    <i class="fal fa-music"></i>
                    <?= __('Playbooks') ?>
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li><?= $this->Html->link(__('List'), ['controller' => 'playbooks']) ?></li>
                        <li><?= $this->Html->link(__('Create'), ['controller' => 'playbooks', 'action' => 'add']) ?></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
</ul>
