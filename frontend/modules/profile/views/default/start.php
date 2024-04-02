<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>
<div id="login-form" class="col-4 offset-4">
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Здравствуйте, <?= Yii::$app->user->identity->name ?> <br>Создайте свою организацию</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

            <?= $form->field($model, 'name', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user-circle"></span></div></div>',
                'template' => '{beginWrapper}{input}{error}{endWrapper}',
                'wrapperOptions' => ['class' => 'input-group mb-3']
            ])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>

            <?= $form->field($model, 'organization_name', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user-circle"></span></div></div>',
                'template' => '{beginWrapper}{input}{error}{endWrapper}',
                'wrapperOptions' => ['class' => 'input-group mb-3']
            ])
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('organization_name')]) ?>

            <div class="row">
                <div class="col-4">
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>


