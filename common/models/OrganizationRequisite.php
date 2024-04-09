<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acc_organization_requisites".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $organization_id
 * @property string|null $position_name
 * @property string|null $action_basis
 * @property string|null $person_name
 * @property string|null $short_person_name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $legal_address
 * @property string|null $actual_address
 * @property string|null $inn
 * @property string|null $kpp
 * @property string|null $okpo
 * @property string|null $ogrn
 * @property string|null $rs
 * @property string|null $kors
 * @property string|null $bik
 * @property string|null $bank_name
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class OrganizationRequisite extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%organization_requisites}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Реквизиты оргазинаций';
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
            [['organization_id'], 'integer'],
            [['position_name', 'action_basis', 'person_name', 'short_person_name', 'phone', 'email', 'legal_address', 'actual_address', 'inn', 'kpp', 'okpo', 'ogrn', 'rs', 'kors', 'bik', 'bank_name'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'organization_id' => 'Organization ID',
            'position_name' => 'Должность руководителя',
            'action_basis' => 'На основании чего',
            'person_name' => 'ФИО уполномоченного полностью',
            'short_person_name' => 'ФИО уполномоченного',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'legal_address' => 'Юридический адрес',
            'actual_address' => 'Фактический адрес',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'okpo' => 'ОКПО',
            'ogrn' => 'ОГРН',
            'rs' => 'Р/С',
            'kors' => 'Кор/сч',
            'bik' => 'БИК',
            'bank_name' => 'Банк',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }


}
