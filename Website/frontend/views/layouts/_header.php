
<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* register external css for header */
$cssPath = Yii::getAlias('@webroot') . '/css/header.css';
$this->registerCssFile(
    Yii::getAlias('@web') . '/css/header.css?v=' . (@file_exists($cssPath) ? filemtime($cssPath) : time()),
    ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]
);

$isLogged = !Yii::$app->user->isGuest;
$userId = $isLogged ? Yii::$app->user->id : null;
$auth = Yii::$app->authManager;

/* helper avatar path (fallback) */
$avatar = Yii::getAlias('@web') . '/images/avatar-default.png';
if ($isLogged && isset(Yii::$app->user->identity->avatar) && Yii::$app->user->identity->avatar) {
    $avatar = Yii::getAlias('@web') . '/uploads/avatars/' . Yii::$app->user->identity->avatar;
}
?>
<nav class="navbar navbar-expand-lg navbar-styled shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="<?= Url::to(['/site/index']) ?>">
            <span class="brand-badge me-2"><?= Html::img(Yii::getAlias('@web') . '/images/logo.png', ['alt' => 'Logo']) ?></span>
            <span class="site-title">Plataforma Saúde</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/site/index']) ?>">Home</a>
                </li>

                <?php if (!Yii::$app->user->isGuest): ?>

                    <!-- ÁREA DO PACIENTE -->
                    <?php if (Yii::$app->user->can('participateEvents')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/participacao/index']) ?>">
                                Área do Paciente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/participacao/meus-eventos']) ?>">
                                Meus Eventos
                            </a>
                        </li>
                    <?php endif; ?>


                    <!-- ÁREA DO COLABORADOR -->
                    <?php if (Yii::$app->user->can('manageEvents')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/evento/index']) ?>">
                                Gestão de Eventos
                            </a>
                        </li>                        
                    <?php endif; ?>

                    <?php if (Yii::$app->user->can('participateEvents')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/meus-testes/index']) ?>">
                                Meus Testes
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (Yii::$app->user->can('manageEvents')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/teste-laboratorial/index']) ?>">
                                Testes Laboratoriais
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/calendario/calendar']) ?>">
                            Calendário
                        </a>
                    </li>

                <?php endif; ?>


                <?php if (!$isLogged): ?>

                    <li class="nav-item">
                        <a class="nav-link btn-color" href="<?= Url::to(['/site/signup']) ?>">Signup</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/site/login']) ?>">Login</a>
                    </li>

                <?php else: ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link user-btn dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="user-name"><?= Html::encode(Yii::$app->user->identity->username) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="<?= Url::to(['/profile/view']) ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= Url::to(['/site/settings']) ?>">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <?= Html::beginForm(['/site/logout'], 'post', ['class'=>'d-inline']) .
                                    Html::submitButton('Logout', ['class'=>'dropdown-item']) .
                                    Html::endForm();
                                ?>
                            </li>
                        </ul>
                    </li>

                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>
