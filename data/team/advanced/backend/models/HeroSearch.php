<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Hero;

/**
 * HeroSearch represents the model behind the search form of `common\models\Hero`.
 */
class HeroSearch extends Hero
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'birth_year', 'death_year'], 'integer'],
            [['name', 'alias', 'title', 'birth_place', 'death_place', 'introduction', 'biography', 'heroic_deeds', 'photo', 'army', 'rank', 'honor', 'quote', 'quote_source'], 'safe'],
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
        $query = Hero::find();

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
            'birth_year' => $this->birth_year,
            'death_year' => $this->death_year,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'birth_place', $this->birth_place])
            ->andFilterWhere(['like', 'death_place', $this->death_place])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'biography', $this->biography])
            ->andFilterWhere(['like', 'heroic_deeds', $this->heroic_deeds])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'army', $this->army])
            ->andFilterWhere(['like', 'rank', $this->rank])
            ->andFilterWhere(['like', 'honor', $this->honor])
            ->andFilterWhere(['like', 'quote', $this->quote])
            ->andFilterWhere(['like', 'quote_source', $this->quote_source]);

        return $dataProvider;
    }
}
