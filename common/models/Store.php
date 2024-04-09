<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acc_stores".
 *
 * @property int $id
 * @property string $unique_id
 * @property int $organization_id
 * @property string $name
 * @property string|null $description
 * @property string|null $short_description
 * @property string|null $address
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
            [['organization_id', 'name'], 'required'],
            [['organization_id'], 'integer'],
            [['description', 'short_description', 'address'], 'string'],
            [['name'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'organization_id' => 'Организация',
            'name' => 'Название',
            'description' => 'Описание',
            'short_description' => 'Краткое описание',
            'address' => 'Адрес',
        ]);
    }
}
