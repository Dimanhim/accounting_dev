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
<?= $form->field($model, 'name', ['template' => '{input}'])->textInput(['placeholder' => "Имя"]) ?>
<?= $form->field($model, 'phone', ['template' => '{input}'])->textInput(['placeholder' => "Телефон", 'class' => 'form-control phone-mask']) ?>
<?= $form->field($model, 'email', ['template' => '{input}'])->textInput(['placeholder' => "e-mail", 'type' => 'email']) ?>
<?= $form->field($model, 'pressed_btn', ['template' => '{input}'])->hiddenInput(['value' => 'Нижняя форма']) ?>
<?= $form->field($model, 'service_id', ['template' => '{input}'])->hiddenInput(['value' => '']) ?>
<?= $form->field($model, 'utm', ['template' => '{input}'])->hiddenInput(['value' => $model->getUtms()]) ?>
<div class="form-group">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?= Html::submitButton('Отправить', ['class' => "button button-primary button-shadow btn-disabled", 'disabled' => true,]) ?>
        </div>
        <div class="col-md-9">
            <p class="info-message"></p>
        </div>
    </div>


</div>
<?php ActiveForm::end() ?>
