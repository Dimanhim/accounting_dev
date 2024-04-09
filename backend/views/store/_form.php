<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Organization;

/** @var yii\web\View $this */
/** @var common\models\Store $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Основная информация
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'organization_id')->widget(Select2::className(), [
                        'data' => Organization::getList(),
                        'options' => ['prompt' => '[Не выбрана]']
                    ]) ?>
                    <?//= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'name')->widget(\kartik\widgets\DatePicker::className()) ?>
                    <?= $form->field($model, 'short_description')->textarea(['rows' => 3]) ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
                    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <?= $model->getImagesField($form) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
