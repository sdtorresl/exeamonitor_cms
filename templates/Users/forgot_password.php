<div class="users login">
    <div class="card-panel">
        <figure class="logo-container">
            <?= $this->Html->image('logo-ems.png', ['alt' => 'Logo EMS', 'id' => 'logo']); ?>
        </figure>

        <?= $this->Flash->render() ?>

        <div class="form">
            <div>
                <h2>Recupera tu cuenta</h2>
                <p>Ingresa tu correo electrónico y nosotros te enviaremos un correo de vuelta con las instrucciones para recuperar tu cuenta.</p>
            </div>
            <?= $this->Form->create() ?>
            <div class="form form-control">
                <?= $this->Form->control('email', ['label' => 'Correo', 'placeholder' => 'Por favor ingrese su correo']) ?>
                <div class="form-submit d-flex jc-end">
                    <?= $this->Form->button(__('Submit'), [
                        'class' => 'btn g-recaptcha'
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>