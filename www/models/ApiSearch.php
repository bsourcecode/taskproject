<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Api;

/**
 * ApiSearch represents the model behind the search form about `app\models\Api`.
 */
class ApiSearch extends Api
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'url', 'formats', 'http_method', 'parameters', 'prerequisites', 'notes', 'sample_request', 'sample_response', 'error_response'], 'safe'],
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
        $query = Api::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'formats', $this->formats])
            ->andFilterWhere(['like', 'http_method', $this->http_method])
            ->andFilterWhere(['like', 'parameters', $this->parameters])
            ->andFilterWhere(['like', 'prerequisites', $this->prerequisites])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'sample_request', $this->sample_request])
            ->andFilterWhere(['like', 'sample_response', $this->sample_response])
            ->andFilterWhere(['like', 'error_response', $this->error_response]);

        return $dataProvider;
    }
}
