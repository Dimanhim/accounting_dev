<?php

use common\models\Client;
use common\models\Order;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\contacts\ContactWidget;

/** @var yii\web\View $this */
/** @var common\models\Organization $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organization-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="card card-success card-outline card-outline-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <!-- Основная информация TAB -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="link-tab-1" aria-selected="false">
                            Основная информация
                        </a>
                    </li>

                    <!-- Изображения TAB -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="link-tab-2" aria-selected="false">
                            Изображения
                        </a>
                    </li>

                    <!-- Реквизиты TAB -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="link-tab-3" aria-selected="false">
                            Реквизиты
                        </a>
                    </li>

                    <!-- Контакты TAB -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#tab-4" role="tab" aria-controls="link-tab-4" aria-selected="false">
                            Контакты
                        </a>
                    </li>

                    <!-- Магазины TAB -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#tab-5" role="tab" aria-controls="link-tab-5" aria-selected="false">
                            Магазины
                        </a>
                    </li>

                    <!-- Товары TAB -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#tab-6" role="tab" aria-controls="link-tab-6" aria-selected="false">
                            Товары
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <!-- Основная информация -->
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                        <?= $this->render('parts/_main', [
                            'form' => $form,
                            'model' => $model,
                        ]) ?>
                    </div>

                    <!-- Изображения -->
                    <div class="tab-pane fade" id="tab-2" role="tabpanel">
                        <?= $this->render('parts/_images', [
                            'form' => $form,
                            'model' => $model,
                        ]) ?>
                    </div>

                    <!-- Реквизиты -->
                    <div class="tab-pane fade" id="tab-3" role="tabpanel">
                        <?= $this->render('parts/_requisites', [
                            'form' => $form,
                            'requisites' => $requisites,
                        ]) ?>
                    </div>

                    <!-- Контакты -->
                    <div class="tab-pane fade" id="tab-4" role="tabpanel">
                        <?= $this->render('parts/_contacts', [
                            'form' => $form,
                            'model' => $model,
                        ]) ?>
                    </div>

                    <!-- Магазины -->
                    <div class="tab-pane fade" id="tab-5" role="tabpanel">
                        <?= $this->render('parts/_stores', [
                            'form' => $form,
                            'model' => $model,
                        ]) ?>
                    </div>

                    <!-- Товары -->
                    <div class="tab-pane fade" id="tab-6" role="tabpanel">
                        <?= $this->render('parts/_products', [
                            'form' => $form,
                            'model' => $model,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group mt10">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
