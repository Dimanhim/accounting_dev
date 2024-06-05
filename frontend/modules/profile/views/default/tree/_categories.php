<?php if($categories) : ?>
    <ul>
        <?php foreach ($categories as $category) : ?>
            <li>
                <?= $category['name'] ?>
                <?php if(isset($category['categories'])) : ?>
                    <?= Yii::$app->app->categoriesData($category['categories']) ?>
                <?php elseif(isset($category['products'])) : ?>
                    <?= Yii::$app->app->productData($category['products']) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

