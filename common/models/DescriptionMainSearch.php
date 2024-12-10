<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DescriptionMainSearch represents the model behind the search form of `common\models\DescriptionMain`.
 */
final class DescriptionMainSearch extends DescriptionMain
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'id_complex'], 'integer'],
            [['title', 'text'], 'safe']
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
        $query = DescriptionMain::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
