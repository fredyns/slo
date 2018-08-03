<?php

namespace app\modules\location\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\location\models\PlaceLang;

/**
 * PlaceLangSearch represents the model behind the search form about `app\modules\location\models\PlaceLang`.
 */
class PlaceLangSearch extends PlaceLang
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'place_id'], 'integer'],
            [['language', 'name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return '';
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
        $query = PlaceLang::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere([
                'id' => $this->id,
                'place_id' => $this->place_id,
        ]);

        $query
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}