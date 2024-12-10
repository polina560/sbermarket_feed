<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DeveloperSearch represents the model behind the search form of `common\models\Developer`.
 */
final class DeveloperSearch extends Developer
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'id_complex', 'id_developer'], 'integer'],
            [['name', 'site', 'logo'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with a search query applied
     *
     * @throws InvalidConfigException
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Developer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_complex' => $this->id_complex,
            'id_developer' => $this->id_developer,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
