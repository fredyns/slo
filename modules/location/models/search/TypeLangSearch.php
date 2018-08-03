<?php

namespace app\modules\location\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\location\models\TypeLang;

/**
 * TypeLangSearch represents the model behind the search form about `app\modules\location\models\TypeLang`.
 */
class TypeLangSearch extends TypeLang
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id'], 'integer'],
            [['language', 'name', 'abbreviation'], 'string'],
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
        $query = TypeLang::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
        ]);

        $query
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'abbreviation', $this->abbreviation]);

        return $dataProvider;
    }

}