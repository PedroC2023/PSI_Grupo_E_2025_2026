<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

    <!-- Template CSS -->
    <link href="<?= Url::to('@web/template/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= Url::to('@web/template/css/style.css') ?>" rel="stylesheet">
</head>

<body>
<?php $this->beginBody() ?>

<!-- HEADER -->
<?= $this->render('_header') ?>

<!-- CONTENT -->
<div class="container py-5">
    <?= $content ?>
</div>

<!-- FOOTER -->
<?= $this->render('_footer') ?>

<!-- JS -->
<script src="<?= Url::to('@web/template/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= Url::to('@web/template/js/main.js') ?>"></script>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
