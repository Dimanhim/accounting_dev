<?php

use yii\helpers\Html;

?>
<table class="table table-striped table-bordered contact-table-o">
    <thead>
    <tr>
        <th>№ п/п</th>
        <th>Должность</th>
        <th>ФИО</th>
        <th>Телефоны</th>
        <th>E-mails</th>
        <th>Комментарий</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php if($models) : ?>
        <?php $i=1; foreach($models as $model) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $model->job_title ?></td>
                <td><?= $model->name ?></td>
                <td>
                    <?= $model->getPhonesString() ?>
                </td>
                <td>
                    <?= $model->getEmailsString() ?>
                </td>
                <td>
                    <?= $model->comment ?>
                </td>
                <td class="contact-actions">
                    <?= Html::a('<i class="bi bi-pencil"></i>', ['#'], ['class' => 'contact-update-o', 'data-id' => $model->id]) ?>
                    <?= Html::a('<i class="bi bi-trash"></i>', ['#'], [
                        'target' => '_blanc',
                        'class' => 'contact-trash-o',
                        'data-id' => $model->id,
                    ]) ?>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="7">Контактов не найдено</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
