<div id="quiz-print-container" class="quiz-container">
    <?php if($userData) : ?>
        <ul>
            <?php foreach($userData as $userQuestionName => $userQuestionAnswers) : ?>
                <li>
                    <?= $userQuestionName ?>
                    <ul>
                        <?php foreach($userQuestionAnswers as $userQuestionAnswer) : ?>
                            <li><?= $userQuestionAnswer ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
    Результатов не найдено
    <?php endif; ?>
</div>
