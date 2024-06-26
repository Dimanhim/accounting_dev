<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "acc_quizes".
 *
 * @property int $id
 * @property string $unique_id
 * @property int $session_id
 * @property string|null $result
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Quiz extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quizes}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Опросы';
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
            [['session_id'], 'required'],
            [['session_id'], 'integer'],
            [['result'], 'string'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'session_id' => 'Session ID',
            'result' => 'Result',
        ]);
    }

    public function getResultHtml()
    {
        $str = '';
        if($this->result and ($results = json_decode($this->result, true))) {
            $str .= $this->getResultString($results);
        }
        return $str;
    }

    public function getResultString($results)
    {
        $str = '<ul>';
        foreach($results as $resultName => $resultValues) {
            if(!is_array($resultValues)) {
                $str .= '<li>';
                $str .= $resultName . ' = ' . $resultValues;
                $str .= '</li>';
            }
            else {
                $str .= $this->getResultString($resultValues);
            }
        }
        $str .= '</ul>';
        return $str;
    }
}
