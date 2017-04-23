<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Fee;

/**
 * FeeSearch represents the model behind the search form about `backend\models\Fee`.
 */
class FeeSearch extends Fee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['int', 'user_id', 'fee', 'fee_type', 'created_by', 'status'], 'integer'],
            [['create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Fee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'int' => $this->int,
            'user_id' => $this->user_id,
            'fee' => $this->fee,
            'fee_type' => $this->fee_type,
            'created_by' => $this->created_by,
            'create_date' => $this->create_date,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
