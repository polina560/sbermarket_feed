<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BuildingSearch represents the model behind the search form of `common\models\Building`.
 */
final class BuildingSearch extends Building
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'id_build', 'fz_214', 'id_complex', 'floors', 'floors_ready', 'building_state', 'passenger_lifts_count', 'cargo_lifts_count'], 'integer'],
            [['name', 'image'], 'safe'],
            [['ceiling_height'], 'number']
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
        $query = Building::find();

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
            'id_build' => $this->id_build,
            'fz_214' => $this->fz_214,
            'id_complex' => $this->id_complex,
            'floors' => $this->floors,
            'floors_ready' => $this->floors_ready,
            'building_state' => $this->building_state,
            'ceiling_height' => $this->ceiling_height,
            'passenger_lifts_count' => $this->passenger_lifts_count,
            'cargo_lifts_count' => $this->cargo_lifts_count,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
