<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Version;

/**
 * VersionSeach represents the model behind the search form about `app\models\Version`.
 */
class VersionSeach extends Version
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_major', 'v_minor', 'v_patch', 'v_realpatch', 'v_database', 'v_acl'], 'integer'],
            [['v_tag', 'id'], 'safe'],
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
        $query = Version::find();

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
            'v_major' => $this->v_major,
            'v_minor' => $this->v_minor,
            'v_patch' => $this->v_patch,
            'v_realpatch' => $this->v_realpatch,
            'v_database' => $this->v_database,
            'v_acl' => $this->v_acl,
        ]);

        $query->andFilterWhere(['like', 'v_tag', $this->v_tag])
            ->andFilterWhere(['like', 'id', $this->id]);

        return $dataProvider;
    }
}
