<?php

namespace common\controllers;

use Yii;
use frontend\models\SiteForm;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AjaxBaseController extends Controller
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

    public function addData($data)
    {
        $this->_data['data'] = $data;
    }

    public function _getErrors()
    {
        return $this->_errors;
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

    protected function _addMessage($message) {
        if($message) {
            $this->_data['message'] = $message;
        }
    }

    protected function _errorSummary()
    {
        if($this->_errors) return implode(' ', $this->_errors);
        return false;
    }

    protected function response($data = [])
    {
        if(!$this->_hasErrors()) {
            if($data) {
                $this->_data['data'] = $data;
            }
        }
        else {
            $this->_data['error'] = 1;
            $this->_data['message'] = $this->_errorSummary();
        }

        $this->response->data = $this->_data;
        return $this->response->data;
    }
}
