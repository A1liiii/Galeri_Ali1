<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg"><?= __('Masukkan Email Dan Password') ?></p>

        <?= $this->Form->create() ?>

        <?= $this->Form->control('email', [
            'label' => false,
            'placeholder' => __('Email'),
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'label' => false,
            'placeholder' => __('Password'),
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>

        <div class="row justify-content-center">
            <div class="col-4">
                <?= $this->Form->control(__('Sign In'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="social-auth-links text-center mb-3">
        <!-- /.social-auth-links -->

        
        <p class="mb-0">
            <?= $this->Html->link(__('Nggak Ada Akun? Daftar Sekarang'), ['action' => 'register']) ?>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>