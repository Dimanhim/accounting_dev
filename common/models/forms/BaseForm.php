<?php

namespace common\models\forms;

use backend\components\Helpers;
use yii\base\Model;

class BaseForm extends Model
{
    public function validatePhone($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $phone = Helpers::phoneFormat($this->$attribute);
            if(mb_strlen($phone) != 12) {
                $this->addError($attribute, 'Некорректный номер телефона');
            }
        }
    }

    public function getFirstErrorSummary()
    {
        if($this->errors) {
            $firstAttributeKey = array_key_first($this->errors);
            $firstAttributeErrors = $this->errors[$firstAttributeKey];
            $firstErrorKey = array_key_first($firstAttributeErrors);
            return $firstAttributeErrors[$firstErrorKey];
        }
        return false;
    }
}
