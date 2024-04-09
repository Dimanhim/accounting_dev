<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Store $model */

$this->title = 'Добавление магазина';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
