<?php
$organizations = Yii::$app->app->getData();
?>
<?php if($organizations) : ?>
    <ul>
        <?php foreach($organizations as $organization) : ?>
            <li>
                <?= $organization['name'] ?>
                <?php if($organization['shops']) : ?>
                    <ul>
                        <?php foreach($organization['shops'] as $shop) : ?>
                            <li>
                                <?= $shop['name'] ?>
                                <?php if($shop['categories']) : ?>
                                     <?= Yii::$app->app->categoriesData($shop['categories']) ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
