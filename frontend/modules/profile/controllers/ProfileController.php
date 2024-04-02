<?php

namespace frontend\modules\profile\controllers;

use backend\controllers\BaseController;
use common\models\Client;
use common\models\Organization;
use frontend\modules\profile\Profile;

class ProfileController extends BaseController
{
    public $client;
    public $organization;

    public function beforeAction($action)
    {
        $this->client = Client::findOne(\Yii::$app->user->id);
        $this->organization = Organization::findOne(['client_id' => \Yii::$app->user->id]);
        if($action->id != 'login' and !$this->client) return $this->redirect([Profile::ROUTE.'/login']);
        if($action->id != 'start' and !$this->organization) return $this->redirect([Profile::ROUTE.'/start']);
        return parent::beforeAction($action);
    }
}
