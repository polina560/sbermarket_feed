<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FlatSearch represents the model behind the search form of `common\models\Flat`.
 */
final class FlatSearch extends Flat
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'flat_id', 'id_building', 'apartment', 'floor', 'room', 'ceiling_height', 'balcony', 'renovation', 'price', 'window_view', 'bathroom', 'housing_type'], 'integer'],
            [['description', 'layout_type'], 'safe'],
            [['area', 'living_area', 'kitchen_area'], 'number']
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
        $query = Flat::find();

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
            'flat_id' => $this->flat_id,
            'id_building' => $this->id_building,
            'apartment' => $this->apartment,
            'floor' => $this->floor,
            'room' => $this->room,
            'ceiling_height' => $this->ceiling_height,
            'balcony' => $this->balcony,
            'renovation' => $this->renovation,
            'price' => $this->price,
            'area' => $this->area,
            'living_area' => $this->living_area,
            'kitchen_area' => $this->kitchen_area,
            'window_view' => $this->window_view,
            'bathroom' => $this->bathroom,
            'housing_type' => $this->housing_type,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'layout_type', $this->layout_type]);

        return $dataProvider;
    }
}
