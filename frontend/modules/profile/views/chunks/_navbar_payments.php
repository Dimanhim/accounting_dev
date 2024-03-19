<?php

use yii\helpers\Url;

?>
<?php if($models) : ?>
<li class="dropdown-submenu dropdown-hover">
    <a id="dropdownSubMenu2" href="<?= Url::to(['payment/index']) ?>" role="button" <?php if($models) : ?>data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"<?php endif; ?> class="dropdown-item<?= $models ? ' dropdown-toggle' : '' ?> ">Оплаты</a>

        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <?php foreach($models as $model) : ?>
                <li>
                    <a tabindex="-1" href="<?= Url::to(['payment/view', 'id' => $model->id]) ?>" class="dropdown-item"><?= $model->name ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

</li>
<?php endif; ?>
