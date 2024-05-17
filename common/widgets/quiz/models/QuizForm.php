<?php

namespace common\widgets\quiz\models;

use common\models\forms\BaseForm;
use common\widgets\quiz\QuizWidget;

class QuizForm extends BaseForm
{
    public $name;
    public $phone;

    public function rules()
    {
        return [
            [['name', 'phone'], 'required', 'message' => "Необходимо заполнить поле {attribute}"],
            [['name'], 'string', 'min' => 2, 'message' => "Слишком короткое поле {attribute}"],
            [['name', 'phone'], 'string', 'max' => 32, 'message' => "Слишком длинное поле {attribute}"],
            [['phone'], 'validatePhone'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон'
        ];
    }

    public function submitQuizWidgetForm()
    {
        $widget = new QuizWidget();
        return $widget->setContactValues($this->name, $this->phone);
    }

}
