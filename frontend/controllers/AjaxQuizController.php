<?php

namespace frontend\controllers;

use common\controllers\AjaxBaseController;
use common\widgets\quiz\models\QuizForm;
use common\widgets\quiz\QuizWidget;
use yii\debug\LogTarget;

class AjaxQuizController extends AjaxBaseController
{
    protected $widget;

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function init()
    {
        $this->widget = new QuizWidget();

        return parent::init();
    }
    public function actionSubmitForm()
    {
        $questionId = \Yii::$app->request->post('question');
        $answers = \Yii::$app->request->post('answer');

        if($questionId and $answers) {
            if($this->widget->setFilledQuestions($questionId, $answers)) {
                $data = $this->widget->renderUserData();
                $this->_addMessage('Ответ на вопрос успешно принят!');
                return $this->response($data);
            }
        }

        return $this->response();
    }

    public function actionValidateResultForm()
    {
        $model = new QuizForm();

        if(\Yii::$app->request->isAjax and $model->load(\Yii::$app->request->post())) {
            if(!$model->validate()) {
                $this->_addError($model->getFirstErrorSummary());
            }
        }
        return $this->response();
    }

    public function actionSubmitResultForm()
    {
        $model = new QuizForm();

        if(\Yii::$app->request->isAjax and $model->load(\Yii::$app->request->post())) {
            if($model->validate()) {
                if($html = $model->submitQuizWidgetForm()) {
                    \Yii::$app->infoLog->add('errors', $this->_getErrors());
                    \Yii::$app->infoLog->add('html', $html);
                    $this->addData($html);
                }
            }
        }
        return $this->response();
    }
}
