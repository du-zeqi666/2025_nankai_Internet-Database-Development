<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Config;

/**
 * ConfigSearch represents the model behind the search form of `common\models\Config`.
 */
class ConfigSearch extends Config
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort_order'], 'integer'],
            [['config_key', 'config_value', 'config_name', 'config_group'], 'safe'],
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
        $query = Config::find();

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
            'sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'config_key', $this->config_key])
            ->andFilterWhere(['like', 'config_value', $this->config_value])
            ->andFilterWhere(['like', 'config_name', $this->config_name])
            ->andFilterWhere(['like', 'config_group', $this->config_group]);

        return $dataProvider;
    }
}
