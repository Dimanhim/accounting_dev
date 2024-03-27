<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SiteForm;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AjaxController extends Controller
{

    public $_errors = [];
    public $_data = [
        'error' => 0,
        'message' => null,
        'data' => [],
    ];

    /**
     * @return array
     */
    public function behaviors() {
        return [
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

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








    public function _addModelFirstError($model)
    {
        if($modelErrors = $model->errors) {
            foreach ($modelErrors as $modelAttributeName => $modelAttributeErrors) {
                if($modelAttributeErrors) {
                    foreach($modelAttributeErrors as $modelAttributeError) {
                        $this->_addError($modelAttributeError);
                        break;
                    }
                }
            }
        }
    }

    protected function _hasErrors()
    {
        return !empty($this->_errors);
    }

    protected function _addError($message)
    {
        if($message) {
            $this->_errors[] = $message;
        }
    }

    protected function _errorSummary()
    {
        if($this->_errors) return implode(' ', $this->_errors);
        return false;
    }

    private function response($data = [])
    {
        if(!$this->_hasErrors()) {
            $this->_data['data'] = $data;
        }
        else {
            $this->_data['error'] = 1;
            $this->_data['message'] = $this->_errorSummary();
        }

        $this->response->data = $this->_data;
        return $this->response->data;
    }



}
