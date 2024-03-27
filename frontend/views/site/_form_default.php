<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
    'enableClientScript' => false,
    'options' => [
        'class' => 'modalForm'
    ],
]) ?>
<?= $form->field($model, 'name')->textInput(['placeholder' => "Имя"]) ?>
<?= $form->field($model, 'phone')->textInput(['placeholder' => "Телефон", 'class' => 'form-control phone-mask']) ?>
<?= $form->field($model, 'email')->textInput(['placeholder' => "e-mail", 'type' => 'email']) ?>
<?= $form->field($model, 'pressed_btn', ['template' => '{input}'])->hiddenInput(['value' => 'Нижняя форма']) ?>
<?= $form->field($model, 'service_id', ['template' => '{input}'])->hiddenInput(['value' => '']) ?>
<?= $form->field($model, 'utm', ['template' => '{input}'])->hiddenInput(['value' => $model->getUtms()]) ?>
<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            <?= Html::submitButton('Отправить', ['class' => "btn btn-success", 'disabled' => true,]) ?>
        </div>
        <div class="col-md-9">
            <p class="info-message"></p>
        </div>
    </div>


</div>
<?php ActiveForm::end() ?>
