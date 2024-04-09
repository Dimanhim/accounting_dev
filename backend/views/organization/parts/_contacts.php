<?php

use common\widgets\contacts\ContactWidget;

?>

<!-- Контакты -->
<div class="card">
    <div class="card-body">
        <div>
            Контакты
        </div>
        <div>
            <?= ContactWidget::widget() ?>
        </div>
    </div>
</div>
