<?php

namespace app\models;

use Yii;
use app\models\BussinessType;
use fredyns\stringcleaner\StringCleaner;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
* BussinessTypeSearch represents the model behind the search form about `app\models\BussinessType`.
*/
class BussinessTypeSearch extends BussinessType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*//
            'string_filter' => [
                ['name'],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
                },
            ],
            //*/
            [['id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name'], 'safe'],
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
        $query = BussinessType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            static::tableName().'.id' => $this->id,
            static::tableName().'.created_by' => $this->created_by,
            static::tableName().'.updated_by' => $this->updated_by,
            static::tableName().'.is_deleted' => $this->is_deleted,
            static::tableName().'.deleted_by' => $this->deleted_by,
        ]);

        $query
            ->andFilterWhere(['like', static::tableName().'.name', $this->name])
        ;

        return $dataProvider;
    }

}