<?php

namespace app\models;

use Yii;
use app\models\TechnicalPic;
use fredyns\stringcleaner\StringCleaner;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
* TechnicalPicSearch represents the model behind the search form about `app\models\TechnicalPic`.
*/
class TechnicalPicSearch extends TechnicalPic
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
            [['id', 'created_by', 'updated_by', 'deleted_by', 'country_id', 'province_id', 'regency_id'], 'integer'],
            [['name', 'phone', 'email', 'address'], 'safe'],
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
        $query = TechnicalPic::find();

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
            static::tableName().'.country_id' => $this->country_id,
            static::tableName().'.province_id' => $this->province_id,
            static::tableName().'.regency_id' => $this->regency_id,
        ]);

        $query
            ->andFilterWhere(['like', static::tableName().'.name', $this->name])
            ->andFilterWhere(['like', static::tableName().'.phone', $this->phone])
            ->andFilterWhere(['like', static::tableName().'.email', $this->email])
            ->andFilterWhere(['like', static::tableName().'.address', $this->address])
        ;

        return $dataProvider;
    }

}