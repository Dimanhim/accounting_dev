<div class="quiz-content">
    <div>
        <div class="quiz-header">
            <?= $resultId ?> Спасибо за ответы!
        </div>
        <div class="quiz-body">
            <?php if($result['result']) : ?>
                Теперь мы примерно знаем, что Вам нужно!<br>
            <?php endif; ?>

            <?= $result['text'] ?>
        </div>

        <?= $result['result'] ? $this->render('result/_form') : '' ?>

    </div>
</div>
