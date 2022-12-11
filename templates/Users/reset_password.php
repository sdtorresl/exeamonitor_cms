<div class="users login">
    <div class="card-panel">
        <figure class="logo-container">
            <?= $this->Html->image('logo-ems.png', ['alt' => 'Logo EMS', 'id' => 'logo']); ?>
        </figure>

        <?= $this->Flash->render() ?>

        <div class="form">
            <div>
                <h2><?= __('Restore password') ?></h2>
                <p><?= __('Please input a new password for your account') ?></p>
            </div>
            <?= $this->Form->create() ?>
            <div class="form form-control">
                <?= $this->Form->control('password', ['label' => 'Contraseña', 'placeholder' => 'Por favor ingrese su contraseña']) ?>
                <?= $this->Form->control('passwordConfirmation', ['label' => 'Confirmación de contraseña', 'type' => 'password', 'placeholder' => 'Por favor ingrese su contraseña']) ?>
                <div id="login-btn">
                    <?= $this->Form->button(__('Submit'), [
                        'class' => 'btn g-recaptcha',
                        // 'data-sitekey' => Configure::read('reCaptchaKeys.site_key'),
                        // 'data-callback' => 'onSubmit',
                        // 'data-action' => 'submit'
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>