<?php

use yii\helpers\Html;

$data = Yii::$app->app->getData();
?>

<?php if($data) : ?>
    <ul class="tree-widget-list-group">
        <?php foreach($data as $organization) : ?>
            <li class="tree-widget-list-item">
                <?=
                    Html::a(
                        $organization['name'],
                        ['/profile/default/change-tree', 'id' => $organization['id'], 'type' => $organization['type']],
                        ['class' => 'tree-widget-link']
                    )
                ?>

                <?php if($organization['stores']) : ?>
                    <ul class="tree-widget-sublist-group">
                        <?php foreach($organization['stores'] as $store) : ?>
                            <li class="tree-widget-list-item">
                                <?=
                                    Html::a(
                                        $store['name'],
                                        ['/profile/default/change-tree', 'id' => $store['id'], 'type' => $store['type']],
                                        ['class' => 'tree-widget-link']
                                    )
                                ?>
                                <?php if($store['categories']) : ?>
                                    <?=  $this->context->categoriesWidgetData($store) ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

