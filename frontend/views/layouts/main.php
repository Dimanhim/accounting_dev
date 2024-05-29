<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use frontend\models\SiteForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="wide wow-animation">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <?php $this->head() ?>
    <style>
        .ie-panel{
            display: none;
            background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);
            clear: both;
            text-align:center;
            position: relative;
            z-index: 1;
        }
        html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {
            display: block;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="ie-panel">
    <a href="https://windows.microsoft.com/en-US/internet-explorer/">
        <img src="/design/images/ie8-panel/warning_bar_0000_us.jpg"
             height="42"
             width="820"
             alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
    </a>
</div>
<div class="preloader">
    <div class="preloader-body">
        <div class="cssload-container">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
    </div>
</div>
<div class="page">


<?= $content ?>

<?= $this->render('blocks/_form', [
    'model' => new SiteForm(),
    ''
]) ?>
<?= $this->render('blocks/_modal_result', []) ?>


    <!-- Page Footer-->
    <footer class="section footer-classic bg-gray-900 novi-bg novi-bg-img"
            style="background-image: url(/design/images/bg-price-1920x1128.png)">
        <div class="container">
            <div class="row row-30 justify-content-between">
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <p class="footer-classic-title">Our Address</p>
                    <ul class="footer-classic-list">
                        <li>2200 Clarendon Blvd., Suite 1400A Arlington, VA 22201, USA</li>
                    </ul>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <p class="footer-classic-title">Socials</p>
                    <ul class="footer-classic-list">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">YouTube</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <p class="footer-classic-title">phone</p>
                    <ul class="footer-classic-list">
                        <li><a href="tel:#">1-800-901-234</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <p class="footer-classic-title">Email</p>
                    <ul class="footer-classic-list">
                        <li><a href="mailto:#">info@demolink.org</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-classic-logo-wrap"><a class="brand" href="/"><img
                            src="/design/images/logo-default-189x35.png" alt="" width="189" height="35"/></a>
            </div>
            <p class="rights"><span>&copy;&nbsp; </span><span class="copyright-year"></span><span>&nbsp;</span><span>Interia</span><span>. All Rights Reserved. Design by Zemez</span>
            </p>
        </div>
    </footer>
</div>
<div class="snackbars" id="form-output-global"></div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage(); ?>

