<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acc_stores".
 *
 * @property int $id
 * @property string $unique_id
 * @property string $name
 * @property int $client_id
 * @property string|null $comment
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Store extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stores}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Магазины';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_STORE;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name', 'client_id'], 'required'],
            [['client_id'], 'integer'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Название',
            'client_id' => 'Клиент',
            'comment' => 'Описание',
        ]);
    }
}
