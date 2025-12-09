<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\BootstrapAsset;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/signup.css', ['depends' => [BootstrapAsset::class]]);


?>
<div class="site-signup signup-page">
<header class="signup-header">
    <div class="header-content">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="subtitle">Cria uma conta para iniciares</p>
    </div>
</header>

<main class="signup-card">
    <div class="form-wrap">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Escolha o seu username']) ?>

        <?= $form->field($model, 'email')->input('email', ['placeholder' => 'you@email.com']) ?>

        <?= $form->field($model, 'password')->passwordInput(['id' => 'signup-password', 'placeholder' => 'Escreva a sua palavra passe.']) ?>

        <div class="password-strength" id="password-strength" aria-hidden="true">
            <div class="strength-bar"></div>
            <div class="strength-text">Digita uma palavra passe</div>
        </div>

        <div class="form-check terms">
            <?= Html::checkbox('terms', false, ['id' => 'terms-checkbox']) ?>
            <?= Html::label('Concordo com os termos de uso.', 'terms-checkbox') ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-signup', 'name' => 'signup-button', 'disabled' => true]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</main>
</div>

<script>

    (function(){
        const pwd = document.getElementById('signup-password');
        const strengthBar = document.querySelector('#password-strength .strength-bar');
        const strengthText = document.querySelector('#password-strength .strength-text');
        const terms = document.getElementById('terms-checkbox');
        const submitBtn = document.querySelector('.btn-signup');

        function scorePassword(s) {
            let score = 0;
            if (!s) return score;
            // Tamanaho
            score += Math.min(10, s.length) * 2;
            // variety
            if (/[a-z]/.test(s)) score += 10;
            if (/[A-Z]/.test(s)) score += 10;
            if (/[0-9]/.test(s)) score += 10;
            if (/[^A-Za-z0-9]/.test(s)) score += 10;
            return Math.min(100, score);
        }
        function updateStrength() {
            const val = pwd.value;
            const sc = scorePassword(val);
            strengthBar.style.width = sc + '%';
            if (sc < 30) {
                strengthBar.style.background = '#ff4d4f';
                strengthText.textContent = 'Fraca';
            } else if (sc < 60) {
                strengthBar.style.background = '#ffa940';
                strengthText.textContent = 'Média';
            } else if (sc < 85) {
                strengthBar.style.background = '#52c41a';
                strengthText.textContent = 'Boa';
            } else {
                strengthBar.style.background = '#237804';
                strengthText.textContent = 'Forte';
            }
        }

        pwd && pwd.addEventListener('input', updateStrength);
        terms && terms.addEventListener('change', function(){
            submitBtn.disabled = !terms.checked;
            submitBtn.classList.toggle('enabled', terms.checked);
        });

        // initialize
        updateStrength();
    })();
</script>
