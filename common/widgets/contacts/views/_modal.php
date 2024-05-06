<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(['id' => 'contact_form']) ?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Создание контакта</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="contacts-table" style="width: 100%">
            <tr>
                <th <?= $model->_contact->getRequiredClassHtml('name') ?>>
                    <?= $model->getAttributeLabel('name') ?>
                </th>
                <td>
                    <?= $form->field($model, 'name', ['template' => '{input} {error}'])->textInput(['class' => 'form-control field-val-o', 'placeholder' => 'Иванов Иван Иванович']) ?>
                </td>
            </tr>
            <tr>
                <th <?= $model->_contact->getRequiredClassHtml('job_title') ?>>
                    <?= $model->getAttributeLabel('job_title') ?>
                </th>
                <td>
                    <?= $form->field($model, 'job_title', ['template' => '{input} {error}'])->textInput(['class' => 'form-control field-val-o', 'placeholder' => 'Генеральный директор']) ?>
                </td>
            </tr>
            <tr>
                <th <?= $model->_contact->getRequiredClassHtml('contact_phones') ?>>
                    <?= $model->getAttributeLabel('contact_phones') ?>
                    <div>
                        <a href="#" class="badge badge-primary contact-phone-create-field-o">
                            <i class="bi bi-plus"></i>
                        </a>
                    </div>
                </th>
                <td class="dynamic-contact-lines">
                    <div class="form-group contact-phone-list-o">
                        <?= $this->context->getPhoneFieldsHtml($model->_contact) ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th <?= $model->_contact->getRequiredClassHtml('contact_emails') ?>>
                    <?= $model->getAttributeLabel('contact_emails') ?>
                    <div>
                        <a href="#" class="badge badge-primary contact-email-create-field-o">
                            <i class="bi bi-plus"></i>
                        </a>
                    </div>
                </th>
                <td class="dynamic-contact-lines">
                    <div class="form-group contact-email-list-o">
                        <?= $this->context->getEmailFieldsHtml($model->_contact) ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th <?= $model->_contact->getRequiredClassHtml('comment') ?>>
                    <?= $model->getAttributeLabel('comment') ?>
                </th>
                <td>
                    <div class="form-group">
                        <?= $form->field($model, 'comment', ['template' => '{input} {error}'])->textarea(['class' => 'form-control field-val-o', 'cols' => 2, 'rows' => 2]) ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <?= $form->field($model, 'object_type_id', ['template' => '{input}'])->hiddenInput(['value' => $this->context->type]) ?>
        <?= $form->field($model, 'object_id', ['template' => '{input}'])->hiddenInput(['value' => $this->context->object_id]) ?>
        <?= $form->field($model, 'model_id', ['template' => '{input}'])->hiddenInput(['value' => $model->model_id]) ?>
        <?= Html::button('Закрыть', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) ?>
        <?= Html::submitButton('Сохранить', ['class' => "btn btn-success btn-submit-contact-form-o btn-disabled", 'disabled' => true]) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
