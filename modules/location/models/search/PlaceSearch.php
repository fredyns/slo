<?php

namespace app\modules\location\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\location\models\Place;

/**
 * app\modules\location\models\search\PlaceSearch represents the model behind the search form about `app\modules\location\models\Place`.
 */
class PlaceSearch extends Place
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sublocation_of'], 'default', 'value' => NULL],
            [['search_name'], 'string', 'max' => 1024],
            [['id', 'type_id', 'sublocation_of'], 'integer'],
            [['latitude', 'longitude'], 'number'],
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
        $query = Place::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere([
            'sublocation_of' => $this->sublocation_of,
        ]);

        $query->andFilterWhere([
            'type_id' => $this->type_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $query->andFilterWhere(['like', 'search_name', $this->search_name]);

        return $dataProvider;
    }

}