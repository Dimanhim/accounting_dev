<?php

use yii\helpers\Html;

$this->registerCssFile('@web/modules/css/quiz-widget.css?v=' . mt_rand(1000,10000), ['depends' => [\frontend\assets\AppAsset::className()], 'position' => \yii\web\View::POS_END]);
$this->registerJsFile('@web/modules/js/quiz-widget.js?v=' . mt_rand(1000,10000), ['depends' => [\frontend\assets\AppAsset::className()], 'position' => \yii\web\View::POS_END]);

?>
<div id="quiz-container" class="quiz-container">
    <?= $userData ?>
</div>
