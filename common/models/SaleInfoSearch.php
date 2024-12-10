<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SaleInfoSearch represents the model behind the search form of `common\models\SaleInfo`.
 */
final class SaleInfoSearch extends SaleInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'id_complex'], 'integer'],
            [['sales_phone', 'address', 'timezone'], 'safe'],
            [['sales_latitude', 'sales_longitude'], 'number']
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
        $query = SaleInfo::find();

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
            'sales_latitude' => $this->sales_latitude,
            'sales_longitude' => $this->sales_longitude,
        ]);

        $query->andFilterWhere(['like', 'sales_phone', $this->sales_phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'timezone', $this->timezone]);

        return $dataProvider;
    }
}
