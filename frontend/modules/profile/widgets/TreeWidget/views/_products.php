<?php

use yii\helpers\Html;

?>

<?php if($products) : ?>
    <ul class="tree-widget-sublist-group tree-widget-products">
        <?php foreach($products as $product) : ?>
            <li class="tree-widget-list-item">
                <?=
                    Html::a(
                        $product['name'],
                        ['/profile/default/change-tree', 'id' => $product['id'], 'type' => $product['type']],
                        ['class' => 'tree-widget-link']
                    )
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif;  ?>
