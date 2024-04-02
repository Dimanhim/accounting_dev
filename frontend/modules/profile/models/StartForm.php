<?php

namespace frontend\modules\profile\models;

use common\models\BaseModel;
use common\models\Organization;
use yii\base\Model;

class StartForm extends BaseModel
{
    public $name;
    public $organization_name;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'organization_name'], 'required', 'message' => 'Заполните, пожалуйста, поле'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Краткое название организации',
            'organization_name' => 'Юридическое название организации (ИП, ООО и т.д.)',
        ];
    }

    public function saveData()
    {
        $model = new Organization();
        $model->client_id = \Yii::$app->user->id;
        $model->name = $this->name;
        $model->organization_name = $this->organization_name;
        return $model->save();
    }
}
