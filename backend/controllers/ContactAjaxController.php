<?php

namespace backend\controllers;

use common\controllers\AjaxBaseController;
use common\models\Contact;
use common\widgets\contacts\ContactWidget;
use Yii;
use frontend\models\SiteForm;
use yii\filters\ContentNegotiator;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\widgets\contacts\models\ContactForm;

class ContactAjaxController extends AjaxController
{
    protected $widget;

    public function init()
    {
        $this->widget = new ContactWidget();

        return parent::init();
    }

    /**
     * @return mixed
     */
    public function actionValidateForm()
    {
        $model = new ContactForm();

        if(Yii::$app->request->isAjax and $model->load(Yii::$app->request->post())) {
            if(!$model->validate()) {
                $this->_addModelFirstError($model);
            }
        }

        return $this->response();
    }

    /**
     * @return mixed
     */
    public function actionSubmitForm()
    {
        $model = new ContactForm();
        $data = [];

        if($model->load(Yii::$app->request->post()) and $model->validate()) {
            if(!$model->saveContact()) {
                $this->_addError('Произошла ошибка сохранения контакта');
                return $this->response();
            }
            $data = [
                'type' => $model->object_type_id,
                'object_id' => $model->object_id,
            ];
            $this->_addMessage('Контакт успешно сохранен');
        }

        return $this->response($data);
    }

    /**
     * @return mixed
     */
    public function actionCreateContact()
    {
        $type = Yii::$app->request->post('type');
        $object_id = Yii::$app->request->post('object_id');

        if(!$type) {
            $this->_addError('Не указан тип контакта');
            return $this->response();
        }

        $this->widget->type = $type;
        $this->widget->object_id = $object_id;

        $data = $this->widget->createModalForm();

        return $this->response($data);
    }

    /**
     * @return mixed
     */
    public function actionUpdateContact()
    {
        $contact_id = Yii::$app->request->post('contact_id');

        if(!$contact_id) {
            $this->_addError('Не указан ID контакта');
            return $this->response();
        }

        $model = Contact::findModels()->andWhere(['id' => $contact_id])->one();

        if(!$model) {
            $this->_addError('Контакт не найден');
            return $this->response();
        }

        $this->widget->type = $model->object_type_id;
        $this->widget->object_id = $model->object_id;

        $data = $this->widget->updateModalForm($model);

        return $this->response($data);
    }

    public function actionDeleteContact()
    {
        $contact_id = Yii::$app->request->post('contact_id');

        if(!$contact_id) {
            $this->_addError('Не указан ID контакта');
            return $this->response();
        }

        $model = Contact::findModels()->andWhere(['id' => $contact_id])->one();

        if(!$model) {
            $this->_addError('Контакт не найден');
            return $this->response();
        }

        $data = [
            'type' => $model->object_type_id,
            'object_id' => $model->object_id,
        ];

        $this->_addMessage('Удаление прошло успешно');

        if(!$model->delete()) {
            $this->_addError('Произошла ошибка удаления');
        }

        return $this->response($data);
    }

    public function actionUpdateContactList()
    {
        $type = Yii::$app->request->post('type');
        $object_id = Yii::$app->request->post('object_id');

        if(!$type) {
            $this->_addError('Не указан тип контакта');
            return $this->response();
        }

        if(!$object_id) {
            $this->_addError('Не указан ID контакта');
            return $this->response();
        }

        $this->widget->type = $type;
        $this->widget->object_id = $object_id;

        $data = $this->widget->contactTableHtml();

        return $this->response($data);
    }

    /**
     * @return mixed
     */
    public function actionAddPhoneField()
    {
        $data = $this->widget->getPhoneFieldHtml();

        return $this->response($data);
    }

    /**
     * @return mixed
     */
    public function actionAddEmailField()
    {
        $data = $this->widget->getEmailFieldHtml();

        return $this->response($data);
    }
}

