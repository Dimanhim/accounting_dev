<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acc_contact_values".
 *
 * @property int $id
 * @property string $unique_id
 * @property int $contact_id
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class ContactValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_values}}';
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
            [['contact_id'], 'required'],
            [['contact_id'], 'integer'],
            [['phone', 'added', 'email'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'contact_id' => 'Contact ID',
            'phone' => 'Телефон',
            'added' => 'Доб.',
            'email' => 'E-mail',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }
}
