<?php

namespace common\models;

use common\models\traits\OrganizationTrait;
use Faker\Provider\Base;
use Yii;

/**
 * This is the model class for table "stv_organization".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property string|null $organization_name
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
class Organization extends BaseModel
{
    use OrganizationTrait;

    public $_requisites;
    public $_actual_address;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%organizations}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Организации';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_ORGANIZATION;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name', 'organization_name'], 'required'],
            [['client_id'], 'integer'],
            [['name', 'organization_name'], 'string', 'max' => 255],
            [['_actual_address'], 'safe'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        // как то с этим надо разобраться, чтобы свойства реквизитов прокинулись в модель
        return array_merge(parent::attributeLabels(), [
            'client_id' => 'Клиент',
            'name' => 'Название',
            'organization_name' => 'Организация',
            '_actual_address' => 'Адрес'
        ]);
    }

    /*public function attributes()
    {
        return array_merge(parent::attributes(), [
            'action_basis' => 'На основании чего',
        ]);
    }*/

    /**
     *
     */
    public function afterFind()
    {
        $this->_requisites = $this->requisites;
        return parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->handleRequisites();
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequisites()
    {
        return $this->hasOne(OrganizationRequisite::className(), ['organization_id' => 'id']);
    }

    /*public static function findModels($admin = false)
    {
        $tableName = \Yii::$app->db->tablePrefix . 'organizations';
        return $admin
            ?
            self::className()::find()->where(['is', $tableName . '.deleted', null])->orderBy([$tableName . '.position' => 'SORT ASC'])
            :
            self::className()::find()->where(['is', $tableName . '.deleted', null])->andWhere([$tableName . '.is_active' => 1])->orderBy([$tableName . '.position' => 'SORT ASC']);
    }*/
}
