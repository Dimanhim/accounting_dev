<?php

use frontend\modules\profile\Profile;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Brief;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = 'Заявка: '.($model->order_name ? $model->order_name : $model->name);
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Сгенерировать документ', ['document/generate', 'order_id' => $model->id], [
            'class' => 'btn btn-success'
        ]) ?>
    </p>


    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <!-- Основная информация TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-1" data-toggle="tab" href="#main-tab" role="tab" aria-controls="main-tab" aria-selected="true">
                Основная информация
            </a>
        </li>

        <!-- Оплаты TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-3" data-toggle="tab" href="#payment-tab" role="tab" aria-controls="payment-tab" aria-selected="false">
                Оплаты
                <?= Html::a('<i class="bi bi-plus-square-fill"></i>', ['payment/create', 'order_id' => $model->id], ['class' => 'action-link pull-right']) ?>
            </a>
        </li>

        <!-- Документы TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-4" data-toggle="tab" href="#document-tab" role="tab" aria-controls="document-tab" aria-selected="false">
                Документы
                <?= Html::a('<i class="bi bi-plus-square-fill"></i>', ['document/create', 'order_id' => $model->id], ['class' => 'action-link pull-right']) ?>
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- Основная информация -->
        <div class="tab-pane fade show active" id="main-tab" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="card-body card-body-o">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'order_name',
                                'format' => 'raw',
                                'value' => function($data) {
                                    return Html::a($data->orderName, ['order/view', 'id' => $data->id]);
                                }
                            ],
                            'order_name',
                            'name',
                            [
                                'attribute' => 'status_id',
                                'value' => function($data) {
                                    return $data->statusName;
                                }
                            ],
                            [
                                'attribute' => 'client_id',
                                'format' => 'raw',
                                'value' => function($data) {
                                    if($data->client) {
                                        return Html::a($data->client->name, ['client/view', 'id' => $data->client->id]);
                                    }
                                },
                            ],
                            [
                                'attribute' => 'Личный кабинет',
                                'format' => 'raw',
                                'value' => function($data) {
                                    if($data->client) {
                                        if($data->client->user_id) {
                                            return Html::a('Перейти', Yii::$app->urlManager->hostInfo.Profile::ROUTE.'/login?user_id='.$data->client->user_id, ['target' => '_blanc']);

                                        }
                                        else {
                                            return Html::a('Создать', ['client/create-lk', 'id' => $data->client->id], ['class' => 'btn btn-warning']);
                                        }
                                    }

                                }
                            ],
                            //'service_id',
                            'price',
                            'phone',
                            'email:email',
                            'split_template',
                            'pressed_btn',
                            'utm_source',
                            'utm_campaign',
                            'utm_medium',
                            'utm_content',
                            'utm_term',
                            'comment',


                            [
                                'attribute' => 'image_fields',
                                'format' => 'raw',
                                'value' => function($data) {
                                    return $data->imagesHtml;
                                }
                            ],
                            [
                                'attribute' => 'is_active',
                                'value' => function($data) {
                                    return $data->active;
                                }
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => function($data) {
                                    return $data->createdAt;
                                }
                            ],
                            [
                                'attribute' => 'updated_at',
                                'value' => function($data) {
                                    return $data->updatedAt;
                                }
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Оплаты -->
        <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Название</th>
                            <th>Тип</th>
                            <th>Основание</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                        </tr>
                        <?php if($payments = $model->payments) : ?>
                            <?php foreach($payments as $payment) : ?>
                                <tr>
                                    <td><?= $payment->name ?></td>
                                    <td><?= $payment->typeName ?></td>
                                    <td><?= $payment->document ? $payment->document->name.' '.$payment->document->mainImageHtml : '' ?></td>
                                    <td><?= $payment->price ?></td>
                                    <td><?= date('d.m.Y', $payment->created_at) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">Оплаты не проводились</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- Документы -->
        <div class="tab-pane fade" id="document-tab" role="tabpanel" aria-labelledby="document-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Название</th>
                            <th>Скачать</th>
                        </tr>
                        <?php if($documents = $model->documents) : ?>
                            <?php foreach($documents as $document) : ?>
                                <tr>
                                    <td>
                                        <?= Html::a($document->name, ['document/view', 'id' => $document->id]) ?>
                                    </td>
                                    <td>
                                        <?= $document->mainImageHtml ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Документов не найдено</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
