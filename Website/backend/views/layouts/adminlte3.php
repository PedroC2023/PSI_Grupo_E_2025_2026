<?php

use hail812\adminlte3\assets\AdminLteAsset;
use yii\helpers\Html;

AdminLteAsset::register($this);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCsrfMetaTags() ?> 
    <?php $this->head() ?>
</head>

<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline']) ?>
                <?= Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-danger btn-sm']
                ) ?>
                <?= Html::endForm() ?>
            </li>

        </ul>

    </nav>

    <!-- Main Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="brand-link">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </div>

        <div class="sidebar">
            <nav>
                <ul class="nav nav-pills nav-sidebar flex-column">

                    <li class="nav-item">
                        <a href="/PSI_Grupo_E_2025_2026/Website/backend/web/site/index" class="nav-link">
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/PSI_Grupo_E_2025_2026/Website/backend/web/pessoa/index" class="nav-link">
                            <p>Pessoas</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/PSI_Grupo_E_2025_2026/Website/backend/web/rbac/index" class="nav-link">
                            <p>Gestão de Roles</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/PSI_Grupo_E_2025_2026/Website/backend/web/laboratorio/index" class="nav-link">
                            <p>Laboratórios</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/PSI_Grupo_E_2025_2026/Website/backend/web/tipo-acao/index" class="nav-link">
                            <p>Tipo de Ações</p>
                        </a>
                    </li>


                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper p-3">
        <?= $content ?>
    </div>

</div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
