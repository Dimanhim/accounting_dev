<?php

use common\widgets\quiz\QuizWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Quiz $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-view">

    <p>
        <?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'session_id',
            [
                'attribute' => 'result',
                'format' => 'raw',
                'value' => function($data) {
                    return QuizWidget::widget(['print' => true, '_session_id' => $data->session_id]);
                }
            ],
            'is_active:boolean',
            'deleted:boolean',
            'created_at:datetime',
        ],
    ]) ?>

</div>
