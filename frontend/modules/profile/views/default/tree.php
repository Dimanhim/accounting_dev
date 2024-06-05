<?php

use yii\helpers\Html;
use common\models\Order;
use yii\helpers\Url;
use frontend\modules\profile\widgets\TreeWidget\TreeWidget;

//$this->title = (Yii::$app->user->identity->name ? Yii::$app->user->identity->name .' - ' : ''). 'Личный кабинет ';
$this->title = 'Главная';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$orderModel = new Order();
?>
<div class="container-fluid profile-main">

    <?//= $this->render('/default/tree/default') ?>
    <?= TreeWidget::widget() ?>






<!--
    <ul class="list-group">
        <li class="list-group-item">
            Организация 1
            <ul class="list-group">
                <li class="list-group-item">
                    Магазин 1.1
                </li>
                <li class="list-group-item">
                    Магазин 1.2
                    <ul class="list-group">
                        <li class="list-group-item">
                            Товар 1.2.1
                        </li>
                        <li class="list-group-item">
                            Товар 1.2.2
                        </li>
                        <li class="list-group-item">
                            Товар 1.2.3
                        </li>
                    </ul>
                </li>
                <li class="list-group-item">
                    Магазин 2.3
                    <ul class="list-group">
                        <li class="list-group-item">
                            Товар 2.3.1
                        </li>
                        <li class="list-group-item">
                            Товар 2.3.2
                        </li>
                        <li class="list-group-item">
                            Товар 2.3.3
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="list-group-item">
            Организация 2
            <ul class="list-group">
                <li class="list-group-item">
                    Магазин 2.1
                </li>
                <li class="list-group-item">
                    Магазин 2.2
                    <ul class="list-group">
                        <li class="list-group-item">
                            Товар 2.2.1
                        </li>
                        <li class="list-group-item">
                            Товар 2.2.2
                        </li>
                        <li class="list-group-item">
                            Товар 2.2.3
                        </li>
                    </ul>
                </li>
                <li class="list-group-item">
                    Магазин 2.3
                    <ul class="list-group">
                        <li class="list-group-item">
                            Товар 2.3.1
                        </li class="list-group-item">
                        <li>
                            Товар 2.3.2
                        </li>
                        <li class="list-group-item">
                            Товар 2.3.3
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
-->











</div>

