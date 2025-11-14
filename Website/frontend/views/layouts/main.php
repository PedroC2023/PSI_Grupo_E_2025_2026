<?php

use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;
use frontend\assets\AppAsset;

/** @var yii\web\View $this */
/** @var string $content */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>

    <!-- ===== CSS do template Orthoc ===== -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/animate.css">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/style.css">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap d-flex flex-column min-vh-100">

    <?php
    NavBar::begin([
        'brandLabel' => 'Plataforma de Saúde',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-lg navbar-light bg-light shadow-sm'],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Sobre', 'url' => ['/site/about']],
            ['label' => 'Contacto', 'url' => ['/site/contact']],
            ['label' => 'Signup', 'url' => ['/site/signup']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline'])
                    . Html::submitButton(
                        'Logout (' . Html::encode(Yii::$app->user->identity->username) . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>',
        ],
    ]);
    NavBar::end();
    ?>

    <main role="main" class="flex-grow-1 container my-5">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
            'options' => ['class' => 'breadcrumb bg-light p-2 rounded shadow-sm'],
        ]) ?>

        <?= \common\widgets\Alert::widget() ?>
        <?= $content ?>
    </main>
</div>

<footer class="footer mt-auto py-3 bg-dark text-white text-center">
    <div class="container">
        <p class="mb-0">&copy; Plataforma de Saúde <?= date('Y') ?></p>
    </div>
</footer>

<!-- ===== JS do template Orthoc ===== -->
<script src="<?= Yii::getAlias('@web') ?>/js/jquery.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/js/owl.carousel.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/js/main.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
