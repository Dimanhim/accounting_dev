<div class="container">
    <h1>
        Заголовок
    </h1>
    <div>
        <h2>Здесь форма обратной связи</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?= $this->render('_form_default', [
                    'model' => $model,
                ]) ?>
            </div>

        </div>
    </div>
    <div>
        <h2>Кнопка вызова формы</h2>
        <div>
            <div>
                <a href="#" class="popup-form" data-bs-toggle="modal" data-bs-target="#modalForm">
                    Вызвать попап
                </a>
            </div>
        </div>
    </div>
</div>


