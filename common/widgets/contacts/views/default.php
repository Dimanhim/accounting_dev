<?php

use yii\helpers\Html;

$this->registerJsFile('@web/js/modules/contact-widget.js?v=' . mt_rand(1000,10000), ['depends' => [\backend\assets\AppAsset::className()], 'position' => \yii\web\View::POS_END])
?>
<div class="contact-widget">
    <div class="row">
        <div class="col-md-12">
            <div class="contact-list contact-list-o">
                <div class="form-group">
                    <?= Html::a('+ Добавить', ['#'], ['class' => 'btn btn-xs btn-primary contact-create-o']) ?>
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>№ п/п</th>
                        <th>Должность</th>
                        <th>ФИО</th>
                        <th>Телефоны</th>
                        <th>E-mails</th>
                        <th>Комментарий</th>
                        <th>Действия</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Генеральный директор</td>
                        <td>Иванов Иван Иванович</td>
                        <td>
                            +7 (988) 111-22-33,
                            +7 (988) 444-55-66
                        </td>
                        <td>
                            test@test.ru,
                            test1@test.ru
                        </td>
                        <td>
                            Хороший человек
                        </td>
                        <td class="contact-actions">
                            <?= Html::a('<i class="bi bi-pencil"></i>', ['#'], ['class' => 'contact-update-o']) ?>
                            <?= Html::a('<i class="bi bi-trash"></i>', ['#'], ['class' => 'contact-trash-o']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Генеральный директор</td>
                        <td>Иванов Иван Иванович</td>
                        <td>
                            +7 (988) 111-22-33,
                            +7 (988) 444-55-66
                        </td>
                        <td>
                            test@test.ru,
                            test1@test.ru
                        </td>
                        <td>
                            Хороший человек
                        </td>
                        <td class="contact-actions">
                            <?= Html::a('<i class="bi bi-pencil"></i>', ['#'], ['class' => 'contact-update-o']) ?>
                            <?= Html::a('<i class="bi bi-trash"></i>', ['#'], ['class' => 'contact-trash-o']) ?>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="">

            </div>
        </div>
    </div>
</div>
<?= $this->render('_modal') ?>


