<?php
use yii\helpers\Url;
use yii\helpers\Html;

// Utilizador logado?
$isLogged = !Yii::$app->user->isGuest;
$userId = $isLogged ? Yii::$app->user->id : null;

$auth = Yii::$app->authManager;

?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="<?= Url::to(['/site/index']) ?>">
            Plataforma Saúde
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/site/index']) ?>">Home</a>
                </li>

                <?php if ($isLogged && $auth->checkAccess($userId, 'paciente')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/participacao/index']) ?>">Área do Paciente</a>
                    </li>
                <?php endif; ?>

                <?php if ($isLogged && $auth->checkAccess($userId, 'colaborador')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/evento/index']) ?>">Eventos</a>
                    </li>
                <?php endif; ?>

                <?php if (!$isLogged): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/site/signup']) ?>">Signup</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/site/login']) ?>">Login</a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <?= Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton('Logout ('.Yii::$app->user->identity->username.')',
                            ['class' => 'btn btn-link nav-link'])
                        . Html::endForm();
                        ?>
                    </li>
                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>
