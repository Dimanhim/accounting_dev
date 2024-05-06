<?php

use yii\helpers\Html;

?>
<div class="row">
    <div class="col-md-9">
        <?= Html::input('text', 'ContactForm[contact_phones][phone][]', $phoneValue, ['class' => 'form-control field-val-o phone-mask']) ?>
    </div>
    <div class="col-md-3">
        <?= Html::input('text', 'ContactForm[contact_phones][added][]', $addedValue, ['class' => 'form-control field-val-o', 'placeholder' => 'Доб.']) ?>
    </div>
</div>
