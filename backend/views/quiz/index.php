<?php

use common\models\Quiz;
use common\widgets\quiz\QuizWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\QuizSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'session_id',
            [
                'attribute' => 'result',
                'format' => 'raw',
                'value' => function($data) {
                    return QuizWidget::widget(['print' => true, '_session_id' => $data->session_id]);
                    //return $data->resultHtml;
                }
            ],
            'created_at:datetime',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, Quiz $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
