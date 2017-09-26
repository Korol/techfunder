<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['asin', 'title', 'picture', 'ean', 'brand', 'formatted_price', 'url'], 'safe'],
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
        $query = Product::find();

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

        $query->andFilterWhere(['like', 'asin', $this->asin])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'ean', $this->ean])
            ->andFilterWhere(['like', 'formatted_price', $this->formatted_price])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'brand', $this->brand]);

        return $dataProvider;
    }
}
