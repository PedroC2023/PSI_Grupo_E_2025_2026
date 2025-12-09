<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';

$this->registerCssFile(Yii::getAlias('@web') . '/css/login.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::class]
]);
?>



<div class="login-hero">
    <div class="login-card">
        <div class="login-side">
            <div class="brand">
                <?= Html::img(Yii::getAlias('@web') . '/images/logo.png', ['alt' => 'Logo']) ?>
                <div>
                    <div style="font-size:.95rem;color:#4f46e5;font-weight:700">Plataforma Saúde</div>
                    <div style="font-size:.85rem;color:#6b7280">Gestão e participação em eventos de saúde</div>
                </div>
            </div>

            <h2>Bem vindo(a)!</h2>
            <p>Se ja tiver uma conta criada connosco, faça login.</p>

            <div style="margin-top:auto; width:100%;">
                <div class="divider">Secure login</div>
            </div>
        </div>

        <div class="login-form">
            <h3><?= Html::encode($this->title) ?></h3>
            <p class="form-help">Please fill out the following fields to login:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['autocomplete' => 'off'],
                'fieldConfig' => [
                    'inputOptions' => ['class' => 'form-control form-control-lg']
                ]
            ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username or email']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"form-check\">{input} {label}</div>\n{error}"]) ?>
                    <div class="text-end">
                        <?= Html::a('Forgot password?', ['site/request-password-reset'], ['class' => 'text-decoration-none']) ?>
                    </div>
                </div>

                <div class="mb-3">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
                </div>

                <div class="text-center" style="font-size:.9rem;color:#6b7280">
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>

            <?php ActiveForm::end(); ?>

            <div class="text-center" style="margin-top:18px;font-size:.85rem;color:#9ca3af">
                © <?= date('Y') ?> Plataforma Saúde
            </div>
        </div>
    </div>
</div>