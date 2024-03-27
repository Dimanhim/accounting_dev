<?php

namespace frontend\models;

use Yii;
use backend\components\Helpers;
use backend\components\MailSender;
use common\models\Client;
use common\models\Order;
use yii\base\Model;

class SiteForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $pressed_btn;
    public $service_id;
    public $order;
    public $utm;

    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Поле "Имя" должно быть заполнено'],
            ['name', 'string', 'min' => 2, 'tooShort' => 'Слишком короткое поле "Имя"'],
            ['name', 'string', 'max' => 255, 'tooLong' => 'Слишком длинное поле "Имя"'],
            ['phone', 'required', 'message' => 'Поле "Телефон" должно быть заполнено'],
            //['email', 'required', 'message' => 'Поле "E-mail" должно быть заполнено'],
            ['email', 'email', 'message' => 'Введите корректный E-mail адрес'],
            ['phone', 'validatePhone'],
            [['service_id'], 'integer'],
            [['phone', 'email', 'pressed_btn'], 'string', 'message' => 'Недопустимое значение поля'],
            ['utm', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Номер телефона',
            'email' => 'E-mail',
            'pressed_btn' => 'Нажатая кнопка',
        ];
    }

    public function saveData()
    {
        $model = new Order();
        $model->attributes = $this->attributes;
        $model->phone = Helpers::phoneFormat($this->phone);
        $model->setUtmLabels($this);
        //return true;
        return $model->save();
    }

    public function validatePhone($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $phone = Helpers::phoneFormat($this->$attribute);
            \Yii::$app->infoLog->add('phone', $phone);
            if(mb_strlen($phone) != 12) {
                $this->addError($attribute, 'Некорректный номер телефона');
            }
            if (Client::find()->where(['phone' => $phone])->exists()) {
                $this->addError($attribute, 'Пользователь с таким номером телефона уже зарегистрирован в системе');
            }
        }
    }



    public function firstError()
    {
        if($this->errors) {
            return $this->errors[array_key_first($this->errors)];
            return false;
        }
    }

    public function sendAdminEmail()
    {
        return $this->order ? Yii::$app->mailSender->toAdmin(MailSender::SUBJECT_ADMIN_ORDER, $this->order) : false;
    }

    public function getUtms()
    {
        $utmLabels = [];
        if($params = \Yii::$app->request->get()) {
            foreach($params as $utmLabel => $utmValue) {
                $utmLabels[] = $utmLabel.'='.$utmValue;
            }
        }
        return implode(',', $utmLabels);
    }

}
