<?php

use yii\helpers\Html;

?>
<div class="row">
    <div class="col-md-9">
        <?= Html::input('text', 'ContactForm[contact_emails][email][]', $email, ['class' => 'form-control field-val-o', 'type' => 'email']) ?>
    </div>
</div>
