<?php

use frontend\modules\profile\widgets\TreeWidget\TreeWidget;
use yii\helpers\Html;
use common\models\Order;
use yii\helpers\Url;

//$this->title = (Yii::$app->user->identity->name ? Yii::$app->user->identity->name .' - ' : ''). 'Личный кабинет ';
$this->title = 'Главная';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$orderModel = new Order();
?>
<div class="container-fluid profile-main">












    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <!-- Заявки TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-1" data-toggle="tab" href="#main-tab" role="tab" aria-controls="main-tab" aria-selected="true">
                Заявки
            </a>
        </li>

        <!-- Этапы TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-2" data-toggle="tab" href="#step-tab" role="tab" aria-controls="step-tab" aria-selected="false">
                Этапы работы
            </a>
        </li>

        <!-- Оплаты TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-3" data-toggle="tab" href="#payment-tab" role="tab" aria-controls="payment-tab" aria-selected="false">
                Оплаты
            </a>
        </li>

        <!-- Документы TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-4" data-toggle="tab" href="#document-tab" role="tab" aria-controls="document-tab" aria-selected="false">
                Документы
            </a>
        </li>

    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- Заявки -->
        <div class="tab-pane fade show active" id="main-tab" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="card-body">
                    <?= TreeWidget::widget() ?>
                </div>
            </div>
        </div>

        <!-- Этапы работы -->
        <div class="tab-pane fade" id="step-tab" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>

        <!-- Оплаты -->
        <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>

        <!-- Документы -->
        <div class="tab-pane fade" id="document-tab" role="tabpanel" aria-labelledby="document-tab">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>



    </div>


</div>
