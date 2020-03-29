<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="users login">
    <div class="card-panel">
        <figure class="logo-container">
            <?= $this->Html->image('logo-ems.png', ['alt' => 'Logo EMS', 'id' => 'logo']); ?>
        </figure>

        <?= $this->Flash->render() ?>
        
        <div class="form">
            <?= $this->Form->create() ?>
            <div class="form form-control">
                <?= $this->Form->control('username', ['placeholder' => __('Please input your username')]) ?>
                <?= $this->Form->control('password', ['placeholder' => __('Please input your password')]) ?>
                <div id="login-btn">
                    <?= $this->Form->submit(__('Login'), ['class' => 'btn']); ?>
                </div>

                <div id="password-remember" class="center-align">
                    <p><?= $this->Html->link(
                        __('Have you forgotten your password?'), 
                        ['controller' => 'Users', 'action' => 'reset']) ?>
                    </p>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>