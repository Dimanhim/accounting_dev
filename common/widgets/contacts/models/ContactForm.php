<?php

namespace common\widgets\contacts\models;

use backend\components\Helpers;
use common\models\BaseModel;
use common\models\Contact;
use common\models\ContactValue;
use yii\base\Model;
use yii\validators\EmailValidator;

class ContactForm extends Model
{
    public $_contact;

    public $name;
    public $job_title;
    public $comment;
    public $contact_phones = [];
    public $contact_emails = [];
    public $object_type_id;
    public $object_id;

    public $model_id;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            //[['object_type_id', 'object_id', 'name'], 'required'],
            [['name'], 'required'],
            [['object_type_id', 'object_id', 'model_id'], 'integer'],
            [['comment'], 'string'],
            [['name'], 'string', 'min' => 2, 'max' => 255, 'message' => 'Слишком короткое или длинное поле ФИО'],
            [['job_title'], 'string', 'min' => 2, 'max' => 255, 'message' => 'Слишком короткое поле Должность'],
            [['contact_phones'], 'phoneValidator'],
            [['contact_emails'], 'emailValidator']
        ];
    }

    public function init()
    {
        if(!$this->_contact) {
            $this->_contact = new Contact();
        }
        $this->attributes = $this->_contact->attributes;
        $this->model_id = $this->_contact->id;
        //$this->contact_phones = $this->_contact->contact_phones;

        //\Yii::$app->infoLog->add('attributes', $this->attributes);
        //\Yii::$app->infoLog->add('contact_phones', $this->contact_phones);
        //\Yii::$app->infoLog->add('$this->_contact', $this->_contact);
        return parent::init();
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'job_title' => 'Должность',
            'comment' => 'Комментарий',
            'contact_phones' => 'Телефоны',
            'contact_emails' => 'E-mails',
        ];
    }

    public function phoneValidator($attribute, $params)
    {
        foreach($this->$attribute as $attributeName => $attributeValues) {
            if($attributeName == 'phone') {
                foreach($attributeValues as $phoneNumber) {
                    if($phoneNumber) {
                        $phoneFormat = Helpers::phoneFormat($phoneNumber, false);
                        if(mb_strlen($phoneFormat) != 11) {
                            $this->addError($attribute, 'Неверный формат номера телефона');
                        }
                    }
                }
            }
        }
    }

    public function emailValidator($attribute, $params)
    {
        foreach($this->$attribute as $attributeName => $attributeValues) {
            if($attributeName == 'email') {
                foreach($attributeValues as $email) {
                    if($email) {
                        $validator = new EmailValidator();
                        if(!$validator->validate($email)) {
                            $this->addError($attribute, 'Неверный формат E-mail');
                        }
                    }
                }
            }
        }
    }

    public function saveContact()
    {
        if($this->model_id) {
            $model = Contact::findModels()->andWhere(['id' => $this->model_id])->one();
        }
        if(!$model) {
            $model = new Contact();
        }

        $model->name = $this->name;
        $model->job_title = $this->job_title;
        $model->comment = $this->comment;
        $model->object_type_id = $this->object_type_id;
        $model->object_id = $this->object_id;
        if(!$model->save()) return false;

        ContactValue::deleteAll(['contact_id' => $model->id]);

        if($this->contact_phones) {
            foreach($this->contact_phones as $attributeName => $attributeValues) {
                if($attributeValues) {
                    if($attributeName == 'phone') {
                        foreach($attributeValues as $phoneKey => $phoneNumber) {
                            $contactValue = new ContactValue();
                            $contactValue->contact_id = $model->id;
                            $contactValue->phone = Helpers::phoneFormat($phoneNumber);
                            if(isset($this->contact_phones['added'][$phoneKey])) {
                                $contactValue->added = $this->contact_phones['added'][$phoneKey];
                            }
                            if(!$contactValue->save()) return false;
                        }
                    }
                }

            }
        }
        if($this->contact_emails) {
            foreach($this->contact_emails as $attributeName => $attributeValues) {
                if($attributeValues) {
                    if($attributeName == 'email') {
                        foreach($attributeValues as $emailKey => $emailValue) {
                            $contactValue = new ContactValue();
                            $contactValue->contact_id = $model->id;
                            $contactValue->email = trim($emailValue);
                            if(!$contactValue->save()) return false;
                        }
                    }
                }
            }
        }
        return true;
    }

}
