<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * InfrastructureSearch represents the model behind the search form of `common\models\Infrastructure`.
 */
final class InfrastructureSearch extends Infrastructure
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'id_complex', 'parking', 'security', 'fenced_area', 'sports_ground', 'playground', 'school', 'kindergarten'], 'integer']
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
        $query = Infrastructure::find();

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
            'parking' => $this->parking,
            'security' => $this->security,
            'fenced_area' => $this->fenced_area,
            'sports_ground' => $this->sports_ground,
            'playground' => $this->playground,
            'school' => $this->school,
            'kindergarten' => $this->kindergarten,
        ]);

        return $dataProvider;
    }
}
