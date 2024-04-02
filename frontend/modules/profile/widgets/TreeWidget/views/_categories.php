<?php

use yii\helpers\Html;

?>

<?php if($categories) : ?>
    <ul class="tree-widget-sublist-group tree-widget-categories" data-level="<?= $level ?>">
        <?php foreach ($categories as $category) : ?>
            <?php
                $listClass = isset($category['products']) ? ' tree-widget-list-item-product' : '';
            ?>
            <li class="tree-widget-list-item">
                <?=
                    Html::a(
                        $category['name'],
                        ['/profile/default/change-tree', 'id' => $category['id'], 'type' => $category['type']],
                        ['class' => 'tree-widget-link']
                    )
                ?>
                <?php if(isset($category['categories'])) : ?>
                    <?= $this->context->categoriesWidgetData($category, $level + 1) ?>
                <?php elseif(isset($category['products'])) : ?>
                    <?= $this->context->productWidgetData($category) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

