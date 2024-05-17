<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\widgets\quiz\models\QuizForm;

$model = new QuizForm();
?>
<?php if(!$this->context->isQuizFilled()) : ?>
<div class="quiz-footer">
    <p>
        Для получения предложения, оставьте, пожалуйста, номер телефона и мы зарегистрируем Вас в системе!
    </p>

    <?php $form = ActiveForm::begin(['id' => 'quiz-form-result']) ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'name', ['template' => '{input}'])->textInput(['placeholder' => "Введите имя"]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'phone', ['template' => '{input}'])->textInput(['placeholder' => "+7 (xxx) xxx-xx-xx", 'class' => 'form-control phone-mask']) ?>
                    </div>
                </div>
                <div class="col-md-8 offset-md-2 btn-quiz-result">
                    <?= Html::submitButton('Получить предложение', ['class' => 'btn btn-success btn-disabled btn-quiz-submit-o', 'disabled' => true]) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>
<?php endif; ?>
