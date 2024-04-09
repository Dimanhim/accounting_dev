<!-- Основная информация -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'organization_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'is_active')->checkbox() ?>
            </div>
        </div>
    </div>
</div>
