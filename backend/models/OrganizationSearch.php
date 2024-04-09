<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Organization;

/**
 * OrganizationSearch represents the model behind the search form of `common\models\Organization`.
 */
class OrganizationSearch extends Organization
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_active', 'deleted', 'position', 'created_at', 'updated_at','unique_id', 'name', 'organization_name', 'position_name', 'action_basis', 'person_name', 'short_person_name', 'phone', 'email', 'legal_address', 'actual_address', 'inn', 'kpp', 'okpo', 'ogrn', 'rs', 'kors', 'bik', 'bank_name', '_actual_address'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Organization::findModels(false, new Organization());

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $tableName = \Yii::$app->db->tablePrefix . 'organizations';

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->_actual_address) {
            $query->joinWith(['requisites']);
            $query->andFilterWhere(['like', \Yii::$app->db->tablePrefix . 'organization_requisites.actual_address', $this->_actual_address]);

        }

        // grid filtering conditions
        $query->andFilterWhere([
            $tableName.'.id' => $this->id,
            $tableName.'.is_active' => $this->is_active,
            $tableName.'.deleted' => $this->deleted,
            $tableName.'.position' => $this->position,
            $tableName.'.created_at' => $this->created_at,
            $tableName.'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', $tableName.'.name', $this->name])
            ->andFilterWhere(['like', $tableName.'.organization_name', $this->organization_name]);

        return $dataProvider;
    }
}
