<?php

use common\models\Contact;
use common\widgets\contacts\ContactWidget;

?>

<!-- Контакты -->
<div class="card">
    <div class="card-body">
        <div>
            <?php if($model->isNewRecord) : ?>
                <p>
                    Добавление контактов возможно только после добавления организации
                </p>
            <?php else : ?>

                <?= ContactWidget::widget(['type' => Contact::TYPE_ORGANIZATION, 'object_id' => $model->id]) ?>

            <?php endif; ?>
        </div>
    </div>
</div>
