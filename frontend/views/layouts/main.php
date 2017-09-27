<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php /*nav class="navbar navbar-default header-nav">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="#">
                    <?= Html::img('@web/images/logo.png', ['class' => 'top-logo-img', 'alt' => $this->title]); ?>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right header-nav-links">
                    <li><a href="#">REVIEWSCORE</a></li>
                    <li><a href="#">LOGIN</a></li>
                    <li><a href="#" class="btn btn-primary">FUR HANDLER</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav*/?>
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['class' => 'top-logo-img', 'alt' => $this->title]),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [],
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar navbar-default header-nav',
        ],
    ]);
    $menuItems = [
        ['label' => 'REVIEWSCORE', 'url' => ['#']],
        ['label' => 'LOGIN', 'url' => ['#']],
        ['label' => 'FUR HANDLER', 'url' => ['#'], 'linkOptions' => ['class' => 'btn btn-primary']],
    ];
    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
        'options' => ['class' => 'navbar-nav navbar-right  header-nav-links'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 top-search-block"></div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="content-wrap">
            <?= $content; ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 footer-wrap">
                <div class="footer-logo text-center"><?= Html::img('@web/images/bottom_logo.png', ['class' => 'footer-logo-img']); ?></div>
                <div class="footer-copy text-center">
                    Copyright © 2015 - 2017 Review Bridge Research GmbH Alle Rechte vorbehalten
                </div>
                <div class="footer-menu text-center">
                    <ul>
                        <li>EINFACH.KAUFEN</li>
                        <li>IMPRESSUM</li>
                        <li>DATENSCHUTZ</li>
                        <li>KONTACT</li>
                        <li>AGB VERBRAUCHER</li>
                        <li>AGB HANDLER</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
