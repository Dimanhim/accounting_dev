<?php

use yii\helpers\Html;

$this->registerJsFile('@web/js/modules/contact-widget.js?v=' . mt_rand(1000,10000), ['depends' => [\backend\assets\AppAsset::className()], 'position' => \yii\web\View::POS_END])
?>
<div class="contact-widget">
    <div class="row">
        <div class="col-md-12">
            <div class="contact-list contact-list-o">
                <div class="form-group">
                    <?= Html::a('+ Добавить', ['#'], ['class' => 'btn btn-sm btn-primary contact-create-o', 'data-type' => $this->context->type, 'data-object_id' => $this->context->object_id]) ?>
                </div>

                <?= $this->context->contactTableHtml() ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="">

            </div>
        </div>
    </div>
</div>


