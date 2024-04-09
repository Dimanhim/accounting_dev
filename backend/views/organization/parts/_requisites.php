<!-- Реквизиты -->
<div class="card">
    <div class="card-body">
        <?= $form->field($requisites, 'position_name')->textInput(['maxlength' => true, 'placeholder' => 'Генеральный директор']) ?>
        <?= $form->field($requisites, 'action_basis')->textInput(['maxlength' => true, 'placeholder' => 'Устава']) ?>
        <?= $form->field($requisites, 'person_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'short_person_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control phone-mask']) ?>
        <?= $form->field($requisites, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'legal_address')->textarea(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'actual_address')->textarea(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'inn')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'kpp')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'okpo')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'ogrn')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'rs')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'kors')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'bik')->textInput(['maxlength' => true]) ?>
        <?= $form->field($requisites, 'bank_name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
