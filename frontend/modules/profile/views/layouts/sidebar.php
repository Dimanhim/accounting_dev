<?php

use yii\helpers\Url;
use common\models\SessionOrder;
use frontend\modules\profile\models\Profile;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to('/') ?>" class="brand-link">
        <img src="/images/short_logo.png" alt="<?= Yii::$app->name ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::$app->params['avatarPath'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="d-block"><?= Yii::$app->user->identity->name ?></span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            $briefBadge = '<span class="right badge badge-danger">Не заполнен</span>';
            if(Yii::$app->params['brief'] == 1) {
                $briefBadge = '<span class="right badge badge-warning">Частично</span>';

            }
            elseif(Yii::$app->params['brief'] == 2) {
                $briefBadge = '<span class="right badge badge-success">Заполнен</span>';
            }
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    Profile::getSidebarStores(),
                    Profile::getSidebarOrders(),
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
