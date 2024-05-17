<form id="quiz-form" method="post">
    <div class="quiz-header">
        <?= $data['name'] ?>
    </div>
    <div class="quiz-body">
        <?= $this->render('types/_'.$data['type'], [
            'answers' => $data['answers'],
            'question_id' => $data['question_id'],
        ]) ?>
    </div>
    <div class="quiz-footer">
        <input type="hidden" name="question" value="<?= $data['question_id'] ?>">
        <button type="submit" class="btn btn-success btn-disabled" disabled>Следующий вопрос</button>
    </div>
</form>
