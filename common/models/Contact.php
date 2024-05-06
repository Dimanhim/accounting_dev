<?php

namespace common\models;

use backend\components\Helpers;
use Yii;
use yii\helpers\Html;

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

    public $contact_phones = [];
    public $contact_emails = [];

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
            [['name'], 'string', 'min' => 2, 'max' => 255, 'message' => 'Слишком короткое или длинное поле ФИО'],
            [['job_title'], 'string', 'min' => 2, 'max' => 255, 'message' => 'Слишком короткое поле Должность'],
            [['contact_phones', 'contact_emails'], 'safe'],
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
            'comment' => 'Комментарий',
            'contact_phones' => 'Телефоны',
            'contact_emails' => 'E-mails',
        ]);
    }

    public function afterFind()
    {
        if($phones = $this->phones) {
            foreach($phones as $phone) {
                $this->contact_phones[] = [
                    'phone' => $phone->phone,
                    'added' => $phone->added,
                ];
            }
        }
        if($emails = $this->emails) {
            foreach($emails as $email) {
                $this->contact_emails[] = [
                    'email' => $email->email,
                ];
            }
        }
        return parent::afterFind();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(ContactValue::className(), ['contact_id' => 'id'])->andWhere(['not', ['phone' => null]]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmails()
    {
        return $this->hasMany(ContactValue::className(), ['contact_id' => 'id'])->andWhere(['not', ['email' => null]]);
    }

    public function getPhonesString()
    {
        $data = [];
        if($this->contact_phones) {
            foreach($this->contact_phones as $attributeValues) {
                $str = '';
                if(isset($attributeValues['phone'])) {
                    $phone = Helpers::phoneFormat($attributeValues['phone']);
                    $str .= Html::a($phone, 'tel:'.$phone) ;
                }
                if(isset($attributeValues['added']) and $attributeValues['added']) {
                    $str .= ' (' . $attributeValues['added'] . ')';
                }
                if($str) {
                    $data[] = $str;
                }
            }
        }
        return implode('<br>', $data);
    }

    public function getEmailsString()
    {
        $data = [];
        if($this->contact_emails) {
            foreach($this->contact_emails as $attributeValues) {
                $str = '';
                if(isset($attributeValues['email'])) {
                    $str .= Html::a($attributeValues['email'], 'mailto:'.$attributeValues['email']) ;
                }
                if($str) {
                    $data[] = $str;
                }

            }
        }
        return implode('<br>', $data);
    }
}
