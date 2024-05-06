<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SiteForm;
use common\controllers\AjaxBaseController;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AjaxController extends AjaxBaseController
{

    /**
     * @return mixed
     */
    public function actionValidateForm()
    {
        $model = new SiteForm();

        if(Yii::$app->request->isAjax and $model->load(Yii::$app->request->post())) {
            if(!$model->validate()) {
                //$this->_addError('Ошибка валидации формы');
                $this->_addModelFirstError($model);
            }
        }

        return $this->response();
    }

    public function actionSubmitForm()
    {
        $model = new SiteForm();

        if(Yii::$app->request->isAjax and $model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                // разобраться зачем в модель сохраняется order и функция уникального емейла нужна ли
                if(!$model->saveData()) {
                    $this->_addError('Ошибка сохранения формы');
                }
            }
        }

        return $this->response();
    }
}
