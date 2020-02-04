<nav>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="fal fa-bars"></i></a>

    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right">
            <li><a href="collapsible.html"><?= __('Logout') ?></a></li>
        </ul>
    </div>
</nav>

<ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
        <div class="customer-info">
            <figure class="customer-logo">
                <?= $this->Html->image('customer-logo.png') ?>
            </figure>
            <div class="customer-name">
                El Corral
            </div>
        </div>
    </li>

    <li>
        <div class="user-info">
            <div class="user-name">Sergio Daniel Torres</div>
            <div class="user-role">Administrator</div>
        </div>
    </li>
    
    <li>
        <?= $this->Html->link(
            '<i class="fal fa-file-alt"></i>' . __('Reports'),
            ['controller' => 'reports'],
            ['escape' => false]);
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
</ul>