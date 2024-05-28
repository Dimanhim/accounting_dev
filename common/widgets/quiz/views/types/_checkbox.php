<?php if($answers) : ?>
    <?php foreach($answers as $answer) : ?>
        <?php $id = 'answer_' . $question_id . '_' . $answer['answer_id'] ?>
        <div>
            <input id="<?= $id ?>" name="answer[]" type="checkbox" value="<?= $answer['answer_id'] ?>">
            <label for="<?= $id ?>">
                <?= $answer['name'] ?>
            </label>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

