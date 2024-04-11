<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acc_contacts".
 *
 * @property int $id
 * @property string $unique_id
 * @property int $object_type_id
 * @property int $object_id
 * @property string $name
 * @property string|null $job_title
 * @property string|null $comment
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Contact extends BaseModel
{
    const TYPE_ORGANIZATION = 1;
    const TYPE_SHOP         = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contacts}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Контакты';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_ANY;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['object_type_id', 'object_id', 'name'], 'required'],
            [['object_type_id', 'object_id'], 'integer'],
            [['comment'], 'string'],
            [['name', 'job_title'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'object_type_id' => 'Object Type ID',
            'object_id' => 'Object ID',
            'name' => 'ФИО',
            'job_title' => 'Должность',
            'comment' => 'Comment',
        ]);
    }
}
