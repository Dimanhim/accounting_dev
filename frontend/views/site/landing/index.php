<?php

use common\widgets\quiz\QuizWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
    <!-- Page Header-->
    <header class="section page-header context-dark" id="home">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                 data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
                 data-xxl-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed"
                 data-lg-device-layout="rd-navbar-fixed" data-xl-device-layout="rd-navbar-static"
                 data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px"
                 data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true"
                 data-xxl-stick-up="true">

                <!--
                <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1"
                     data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
                     -->
                <div class="rd-navbar-main-outer">
                    <div class="rd-navbar-main">
                        <div class="rd-navbar-nav-wrap">
                            <!-- RD Navbar Nav-->
                            <ul class="rd-navbar-nav">
                                <li class="rd-nav-item active"><a class="rd-nav-link" href="#home">Главная</a>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="#quiz">Узнать про систему</a>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="#about">Почему мы?</a>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="#calculate">Расчет стоимости</a>
                                </li>
                            </ul>
                        </div>
                        <!-- RD Navbar Panel-->
                        <div class="rd-navbar-panel">
                            <!-- RD Navbar Toggle-->
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                            </button>
                            <!-- RD Navbar Brand-->
                            <div class="rd-navbar-brand">
                                <a class="brand" href="index.html">
                                    <img src="/design/images/logo-white.png" alt="" width="189" height="35" class="logo"/>
                                </a>
                            </div>
                        </div>

                        <div class="rd-navbar-collapse">
                            <ul class="list-inline list-inline-md">
                                <li><a class="link-bd-btm" href="mailto:#"></a></li>
                                <li><a class="link-bd-btm" href="tel:#"></a></li>
                                <li><a class="link-bd-btm " href="#"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section class="section bg-gray-900 box-custom-1">
        <div class="box-custom-1-aside">
            <!--
            <ul class="box-custom-1-list">
                <li class="wow fadeInLeft" data-wow-delay=".5s">
                    <a class="link link-social" href="#">
                        <div class="icon novi-icon fa-facebook"></div>
                    </a>
                </li>
                <li class="wow fadeInLeft" data-wow-delay=".6s">
                    <a class="link link-social" href="#">
                        <div class="icon novi-icon fa-youtube-play"></div>
                    </a>
                </li>
                <li class="wow fadeInLeft" data-wow-delay=".7s">
                    <a class="link link-social" href="#">
                       <div class="icon novi-icon fa-instagram"></div>
                    </a>
                </li>
            </ul>
            -->
        </div>
        <div class="box-custom-1-main" style="background-image: url(/design/images/home-01-1676x731.jpg)">
            <div class="block-offer">
                <div class="block-sm">
                    <h2 class="wow fadeInRight" data-wow-delay=".5s">
                        Онлайн система учета товаров<br>для вашего бизнеса
                    </h2>
                    <p class="utp wow fadeInRight" data-wow-delay=".6s">
                        Только <span class="promo"></span> зарегистрируйтесь в системе
                        и получите 30 дней пользования в подарок!
                    </p>
                    <a class="button button-primary button-shadow wow fadeInRight popup-form" data-wow-delay=".7s" href="#">
                        Попробовать бесплатно
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section id="quiz" class="section section-sm bg-gray-900 novi-bg novi-bg-img section-quiz">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Узнайте, подходит ли Вам система</h2>
                </div>
                <div class="col-lg-12">
                    <p class="pretitle text-primary">
                        Пройдите короткий тест<br>
                        И получите 30 дней пользования сервисом бесплатно!
                    </p>
                </div>

                <div class="col-lg-12">
                    <?= QuizWidget::widget() ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-lg bg-white bg-img-custom" id="about"
             style="">
        <div class="container">
            <div class="row justify-content-between row-60 row-md-30 flex-wrap-reverse flex-lg-wrap">
                <div class="col-lg-12">
                    <div class="advantages">
                        <div class="box-custom-2">
                            <h2 class="wow fadeInRight" data-wow-delay=".5s">Почему пользуются нашей системой склада?</h2>
                            <p class="wow fadeInRight" data-wow-delay=".6s">
                                Лучше всего система подойдет индивидуальным предпринимателям, имеющим небольшой магазин по продаже товаров.
                            </p>
                            <ul class="list index-list list-classic-wrap">
                                <li class="unit unit-spacing-lg align-items-start list-classic flex-column flex-xs-row wow fadeInRight"
                                    data-wow-delay=".7s">
                                    <div class="unit-left list-index-counter">
                                        <div class="list-classic-rectangle"></div>
                                        <div class="icon novi-icon linearicons-tornado icon-xl"></div>
                                    </div>
                                    <div class="unit-body">
                                        <h4>Низкая стоимость услуг</h4>
                                        <p>
                                            Оплата только за выбранные услуги.<br>
                                            Вы самостоятельно выбираете за что будете платить, без покупки всего функционала системы.
                                        </p>
                                    </div>
                                </li>
                                <li class="unit unit-spacing-lg align-items-start list-classic flex-column flex-xs-row wow fadeInRight"
                                    data-wow-delay=".8s">
                                    <div class="unit-left list-index-counter">
                                        <div class="list-classic-rectangle"></div>
                                        <div class="icon novi-icon linearicons-stamp icon-lg"></div>
                                    </div>
                                    <div class="unit-body">
                                        <h4>Бесплатный пробный период</h4>
                                        <p>
                                            Удобна Вам система или нет - Вы сможете понять за 30 дней пробного периода.<br>
                                            После его окончания, Ваши данные не удаляются и будут доступны еще 60 дней.
                                        </p>
                                    </div>
                                </li>

                                <li class="unit unit-spacing-lg align-items-start list-classic flex-column flex-xs-row wow fadeInRight"
                                    data-wow-delay=".9s">
                                    <div class="unit-left list-index-counter">
                                        <div class="list-classic-rectangle"></div>
                                        <div class="icon novi-icon linearicons-factory icon-lg"></div>
                                    </div>
                                    <div class="unit-body">
                                        <h4>Создана для малого бизнеса</h4>
                                        <p>
                                            Все настройки системы созданы под потребности малого товарного бизнеса.
                                        </p>
                                    </div>
                                </li>
                                <li class="unit unit-spacing-lg align-items-start list-classic flex-column flex-xs-row wow fadeInRight"
                                    data-wow-delay=".9s">
                                    <div class="unit-left list-index-counter">
                                        <div class="list-classic-rectangle"></div>
                                        <div class="icon novi-icon linearicons-store icon-lg"></div>
                                    </div>
                                    <div class="unit-body">
                                        <h4>Удобство работы с маркетплейсами</h4>
                                        <p>
                                            Автоматизация работы с популярными маркетплейсами - Wildberries, Ozon, Яндекс. Это возможность не нанимать менеджера маркетплейсов.
                                        </p>
                                    </div>
                                </li>
                                <li class="unit unit-spacing-lg align-items-start list-classic flex-column flex-xs-row wow fadeInRight"
                                    data-wow-delay=".9s">
                                    <div class="unit-left list-index-counter">
                                        <div class="list-classic-rectangle"></div>
                                        <div class="icon novi-icon linearicons-document icon-lg"></div>
                                    </div>
                                    <div class="unit-body">
                                        <h4>Работа по договору</h4>
                                        <p>
                                            Мы предоставляем Вам личный кабинет и заключаем договор на оказание услуг.
                                        </p>
                                    </div>
                                </li>
                                <li class="unit unit-spacing-lg align-items-start list-classic flex-column flex-xs-row wow fadeInRight"
                                    data-wow-delay=".9s">
                                    <div class="unit-left list-index-counter">
                                        <div class="list-classic-rectangle"></div>
                                        <div class="icon novi-icon linearicons-cloud icon-lg"></div>
                                    </div>
                                    <div class="unit-body">
                                        <h4>Система полностью онлайн</h4>
                                        <p>
                                            Вам не потребуется покупка отдельных услуг и интернет-мощностей.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <div style="text-align: center;">
                                <a class="button button-primary button-shadow wow fadeInRight popup-form" data-wow-delay="1s" href="#">Попробовать бесплатно</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="calculate" class="section section-sm bg-gray-900 novi-bg novi-bg-img text-center"
             style="background-image: url(/design/images/bg-price-1920x1128.png)">
        <div class="container">
            <div class="row justify-content-center wow fadeInDown" data-wow-delay=".25s">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h2>Приблизительный расчет стоимости услуг</h2>
                    <p class="pretitle text-primary">Выберите бюджет в месяц</p>
                </div>
                <div class="col-lg-9">
                    <div class="kraken-range"></div>
                    <button class="button button-icon button-icon-right button-primary button-shadow"
                            data-custom-toggle=".owl-pagination-custom" data-custom-toggle-hide-on-blur="true"><span
                                class="icon mdi mdi-chevron-down"></span>Бюджет
                    </button>
                    <div class="owl-pagination-custom" id="owl-pagination-custom">
                        <div class="data-dots-custom" data-owl-item="0"><span>до 1000 руб./мес.</span></div>
                        <div class="data-dots-custom" data-owl-item="1"><span>1000-5000 руб./мес.</span></div>
                        <div class="data-dots-custom" data-owl-item="2"><span>5000-10000 руб./мес.</span></div>
                        <div class="data-dots-custom" data-owl-item="3"><span>от 10000 руб./мес.</span></div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-carousel-range" data-items="1" data-stage-padding="0" data-loop="false"
                 data-margin="0" data-mouse-drag="false" data-dots-custom="#owl-pagination-custom">
                <div class="row justify-content-center row-37">
                    <div class="col-12">
                        <div class="pricing-box">до 1000 руб./мес.</div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/shop.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="/design/images/stock.jpg" alt="" width="370"
                                                                height="222"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="/design/images/marketplace.jpg" alt="" width="370"
                                                                height="222"/>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-10">
                        <p class="pretitle text-white">Какие услуги можно выбрать?</p>
                        <ul class="list-decorative">
                            <li>Неограниченное количество организаций и магазинов</li>
                            <li>Неограниченное количество категорий товаров и складов</li>
                            <li>До 100 товаров, <br>либо до 70 товаров и работа с одним маркетплейсом</li>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center row-37">
                    <div class="col-12">
                        <div class="pricing-box">1000-5000 руб./мес.</div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/shop.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/stock.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/marketplace.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-10">
                        <p class="pretitle text-white">Какие услуги можно выбрать?</p>
                        <ul class="list-decorative">
                            <li>Неограниченное количество организаций и магазинов</li>
                            <li>Неограниченное количество категорий товаров и складов</li>
                            <li>До 500 товаров, <br>либо до 400 товаров и работа со всеми маркетплейсами</li>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center row-37">
                    <div class="col-12">
                        <div class="pricing-box">5000-10000 руб./мес.</div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/shop.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/stock.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/marketplace.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-10">
                        <p class="pretitle text-white">Какие услуги можно выбрать?</p>
                        <ul class="list-decorative">
                            <li>Неограниченное количество организаций и магазинов</li>
                            <li>Неограниченное количество категорий товаров и складов</li>
                            <li>До 1000 товаров, <br>либо до 900 товаров и работа со всеми маркетплейсами</li>
                        </ul>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center row-37">
                    <div class="col-12">
                        <div class="pricing-box">от 10000 руб./мес.</div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/shop.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/stock.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">

                                <img src="/design/images/marketplace.jpg" alt="" width="370"
                                                                height="222"/>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-10">
                        <p class="pretitle text-white">Какие услуги можно выбрать?</p>
                        <ul class="list-decorative">
                            <li>Неограниченное количество организаций и магазинов</li>
                            <li>Неограниченное количество категорий товаров и складов</li>
                            <li>От 1000 товаров, <br>либо от 900 товаров и работа со всеми маркетплейсами</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div style="margin-top: 80px;">
                <a class="button button-primary button-shadow wow fadeInRight popup-form" data-wow-delay=".7s" href="#">
                    Попробовать бесплатно
                </a>
            </div>
        </div>
    </section>
<!--
    <section class="section section-md-2 bg-white pb-0" id="portfolio">
        <div class="bg-custom novi-bg novi-bg-img bg-gray-200"></div>
        <div class="container">
            <div class="row row-30">
                <div class="col-xl-6 col-md-6 wow fadeInLeft" data-wow-delay=".5s">
                    <h2>Our Portfolio</h2>
                </div>
                <div class="col-xl-5 col-md-6 wow fadeInRight" data-wow-delay=".5s">
                    <p>All our projects are unique and designed to last. Take a look at our recent works to find it out
                        for yourself.</p>
                </div>
            </div>
        </div>
        <div class="container container-custom-right">

            <div class="owl-carousel owl-carousel-classic" data-items="1" data-sm-items="1" data-md-items="2"
                 data-lg-items="3" data-xl-items="3" data-xxl-items="3" data-nav="true" data-loop="true"
                 data-margin="30" data-mouse-drag="false" data-center="true" data-autoplay="true">
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-05-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Modern Loft Room</a></h4>
                    <ul class="post-classic-description">
                        <li>2018</li>
                        <li>Residential</li>
                        <li>New York</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-06-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Sunny Valley Hotel</a></h4>
                    <ul class="post-classic-description">
                        <li>2017</li>
                        <li>Custom Project</li>
                        <li>Los Angeles</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-07-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Swanson Entertainment Center</a></h4>
                    <ul class="post-classic-description">
                        <li>2016</li>
                        <li>Commercial</li>
                        <li>Seattle</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-08-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Jane McMillan’s House</a></h4>
                    <ul class="post-classic-description">
                        <li>2015</li>
                        <li>Residential</li>
                        <li>Atlanta</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-09-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Divine Concert Hall</a></h4>
                    <ul class="post-classic-description">
                        <li>2015</li>
                        <li>Commercial</li>
                        <li>Sacramento</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-10-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Barracuda Restaurant</a></h4>
                    <ul class="post-classic-description">
                        <li>2014</li>
                        <li>Custom Project</li>
                        <li>Chicago</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-11-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">GMD Travel Agency</a></h4>
                    <ul class="post-classic-description">
                        <li>2014</li>
                        <li>Commercial</li>
                        <li>Dallas</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-12-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Social Support Center</a></h4>
                    <ul class="post-classic-description">
                        <li>2013</li>
                        <li>Custom Project</li>
                        <li>San Diego</li>
                    </ul>
                </div>
                <div class="post-classic">
                    <div class="post-classic-figure"><img src="/design/images/home-13-494x400.jpg" alt="" width="494"
                                                          height="400"/>
                    </div>
                    <h4 class="post-classic-title"><a href="#">Boston Airport</a></h4>
                    <ul class="post-classic-description">
                        <li>2013</li>
                        <li>Commercial</li>
                        <li>Boston</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
-->
<!--
    <section class="section section-sm bg-gray-900 novi-bg novi-bg-img pb-0 text-center" id="contacts"
             style="background-image: url(/design/images/bg-price-1920x1128.png)">
        <div class="container">
            <div class="row row-fix justify-content-center wow fadeInDown" data-wow-delay=".25s">
                <div class="col-lg-6 col-md-8">
                    <h2>Как мы с Вами будем работать?</h2>
                    <p class="pretitle text-primary">A great way to your new interior</p>
                </div>
            </div>
            <div class="row row-50 justify-content-center">
                <div class="col-md-4">
                    <div class="box-classic wow fadeInLeft" data-wow-delay=".5s">
                        <div class="box-classic-icon">
                            <div class="icon novi-icon icon-xl linearicons-bubble-text"></div>
                        </div>
                        <div class="box-classic-text">
                            <p class="subtitle">Discuss every aspect of your interior with one of our designers</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-classic wow fadeInDown" data-wow-delay=".5s">
                        <div class="box-classic-icon">
                            <div class="icon novi-icon icon-xl linearicons-calculator"></div>
                        </div>
                        <div class="box-classic-text">
                            <p class="subtitle">Let us plan and calculate every part of your new interior</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-classic wow fadeInRight" data-wow-delay=".5s">
                        <div class="box-classic-icon">
                            <div class="icon novi-icon icon-xl linearicons-star"></div>
                        </div>
                        <div class="box-classic-text">
                            <p class="subtitle">You can also ask questions and suggest any project changes</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-fix align-items-center mt-112">
                <div class="col-12">
                    <div class="box-cta bg-gray-700 novi-bg">
                        <div class="row row-30">
                            <div class="col-xl-10">
                                <?php $form = ActiveForm::begin([
                                    'enableClientScript' => false,
                                    'fieldConfig' => ['options' => ['tag' => false]],
                                    'options' => [
                                        'class' => 'modalForm rd-form rd-mailform rd-form-inline'
                                    ],
                                ]) ?>
                                <div class="form-wrap">
                                    <?= $form->field($model, 'name', ['template' => '{input}'])->textInput(['class' => 'form-input', 'placeholder' => 'Имя']) ?>
                                    <label class="form-label" for="contact-2-name"><?= $model->getAttributeLabel('name') ?></label>
                                </div>
                                <div class="form-wrap">
                                    <?= $form->field($model, 'phone', ['template' => '{input}'])->textInput(['class' => 'form-input phone-mask', 'placeholder' => 'Телефон']) ?>
                                    <label class="form-label" for=""><?= $model->getAttributeLabel('phone') ?></label>
                                </div>
                                <div class="form-button">
                                    <?= Html::submitButton('Зарегистрироваться', ['class' => "button button-primary button-shadow btn-disabled", 'disabled' => true,]) ?>
                                </div>
                                <?= $form->field($model, 'pressed_btn', ['template' => '{input}'])->hiddenInput(['value' => 'Нижняя форма']) ?>
                                <?= $form->field($model, 'service_id', ['template' => '{input}'])->hiddenInput(['value' => '']) ?>
                                <?= $form->field($model, 'utm', ['template' => '{input}'])->hiddenInput(['value' => $model->getUtms()]) ?>
                                <p class="info-message"></p>
                                <?php ActiveForm::end() ?>

                            </div>
                            <div class="col-xl-2">
                                <div class="box-cta-text">
                                    <p class="small">or call us now</p>
                                    <h4><a href="tel:#">1-800-901-234</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->
<!--
    <section class="section section-xs bg-gray-200">
        <div class="container">
            <div class="row row-50 justify-content-between align-items-center">
                <div class="col-xl-6 col-lg-6 wow fadeInLeft" data-wow-delay=".5s">

                    <div class="owl-carousel owl-carousel-modern" data-items="1" data-dots="true" data-stage-padding="0"
                         data-loop="false" data-margin="0" data-mouse-drag="false" data-autoplay="true">
                        <div class="quote-modern">
                            <div class="quote-modern-header">
                                <div class="quote-classic-avatar"><img src="/design/images/home-08-100x100.jpg" alt=""
                                                                       width="100" height="100"/>
                                </div>
                                <div class="quote-classic-description">
                                    <h4 class="quote-classic-name">Kate Peterson</h4>
                                    <p class="quote-classic-position">Regular client</p>
                                </div>
                            </div>
                            <div class="quote-modern-body">
                                <p>Interia designed my home from top to bottom, and 5 years later I still appreciate
                                    their work. They designed built-in cabinetry that works perfectly. They are the most
                                    reliable designers I’ve ever met.</p>
                            </div>
                        </div>
                        <div class="quote-modern">
                            <div class="quote-modern-header">
                                <div class="quote-classic-avatar"><img src="/design/images/home-09-100x100.jpg" alt=""
                                                                       width="100" height="100"/>
                                </div>
                                <div class="quote-classic-description">
                                    <h4 class="quote-classic-name">Peter Smith</h4>
                                    <p class="quote-classic-position">Regular client</p>
                                </div>
                            </div>
                            <div class="quote-modern-body">
                                <p>This agency was highly recommended to me. The sensitivity, knowledge, vision and
                                    ultimate execution this firm brought to the table was tremendous. They have
                                    enormously talented designers.</p>
                            </div>
                        </div>
                        <div class="quote-modern">
                            <div class="quote-modern-header">
                                <div class="quote-classic-avatar"><img src="/design/images/home-10-100x100.jpg" alt=""
                                                                       width="100" height="100"/>
                                </div>
                                <div class="quote-classic-description">
                                    <h4 class="quote-classic-name">Jane Williams</h4>
                                    <p class="quote-classic-position">Regular client</p>
                                </div>
                            </div>
                            <div class="quote-modern-body">
                                <p>I chose Interia because of their knowledge, experience and attention to detail that
                                    has proven invaluable to me in creating a superior finished project, which attracts
                                    more clients to my shop.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 wow fadeInRight" data-wow-delay=".5s">
                    <div class="box-modern novi-bg">
                        <p class="box-modern-title">companies that trust us</p>
                        <ul class="box-modern-list">
                            <li><img src="/design/images/brand-01-94x34.png" alt="" width="94" height="34"/>
                            </li>
                            <li><img src="/design/images/brand-02-82x44.png" alt="" width="82" height="44"/>
                            </li>
                            <li><img src="/design/images/brand-03-96x41.png" alt="" width="96" height="41"/>
                            </li>
                            <li><img src="/design/images/brand-04-145x32.png" alt="" width="145" height="32"/>
                            </li>
                            <li><img src="/design/images/brand-05-78x45.png" alt="" width="78" height="45"/>
                            </li>
                            <li><img src="/design/images/brand-06-108x68.png" alt="" width="108" height="68"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->
<!--
    <section>
        <a class="d-block"
                href="https://www.templatemonster.com/landing-page-template/interia-design-one-page-creative-html-landing-page-template-75772.html"
                target="_blank">
            <img class="img-responsive" src="/design/images/banner-bottom-2050x310.jpg" alt="" width="2050"
                                     height="310"/>
        </a>
    </section>
-->





