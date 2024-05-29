<?php

use frontend\models\SiteForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="modal fade" id="modalForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Заголовок модального окна</h5>
                <button type="button" class="btn-close modal__cross" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="container">
                <?= $this->render('//site/_form_default', [
                    'model' => new SiteForm(),
                ]) ?>
            </div>

        </div>
    </div>
</div>

