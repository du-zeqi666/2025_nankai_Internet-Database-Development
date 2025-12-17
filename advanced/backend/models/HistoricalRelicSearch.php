<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HistoricalRelic;

/**
 * HistoricalRelicSearch represents the model behind the search form of `common\models\HistoricalRelic`.
 */
class HistoricalRelicSearch extends HistoricalRelic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'category', 'era', 'description', 'current_location', 'image'], 'safe'],
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
        $query = HistoricalRelic::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'era', $this->era])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'current_location', $this->current_location])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
