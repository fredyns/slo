<?php

namespace app\models;

use Yii;
use app\models\Submission;
use fredyns\stringcleaner\StringCleaner;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SubmissionSearch represents the model behind the search form about `app\models\Submission`.
 */
class SubmissionSearch extends Submission
{
    public $instalation_regency_name;

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
    public function rules()
    {
        return [
            'string_filter' => [
                ['agenda_number', 'examination_date', 'instalation_name', 'instalation_location', 'report_number', 'instalation_regency_name'],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
                },
            ],
            [['id', 'created_by', 'updated_by', 'deleted_by', 'progress_status', 'owner_id', 'instalation_type', 'instalation_country_id', 'instalation_province_id', 'instalation_regency_id', 'bussiness_type_id', 'sbu_id', 'technical_pic_id', 'technical_personel_id', 'report_file_id', 'requested_at', 'requested_by', 'registering_at', 'registering_by', 'registered_at', 'registered_by'], 'integer'],
            [['instalation_latitude', 'instalation_longitude'], 'number'],
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
        $query = Submission::find()->joinWith('instalationRegency');

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
            static::tableName().'.progress_status' => $this->progress_status,
            static::tableName().'.examination_date' => $this->examination_date,
            static::tableName().'.owner_id' => $this->owner_id,
            static::tableName().'.instalation_type' => $this->instalation_type,
            static::tableName().'.instalation_country_id' => $this->instalation_country_id,
            static::tableName().'.instalation_province_id' => $this->instalation_province_id,
            static::tableName().'.instalation_regency_id' => $this->instalation_regency_id,
            static::tableName().'.instalation_latitude' => $this->instalation_latitude,
            static::tableName().'.instalation_longitude' => $this->instalation_longitude,
            static::tableName().'.bussiness_type_id' => $this->bussiness_type_id,
            static::tableName().'.sbu_id' => $this->sbu_id,
            static::tableName().'.technical_pic_id' => $this->technical_pic_id,
            static::tableName().'.technical_personel_id' => $this->technical_personel_id,
            static::tableName().'.report_file_id' => $this->report_file_id,
            static::tableName().'.requested_by' => $this->requested_by,
            static::tableName().'.registering_by' => $this->registering_by,
            static::tableName().'.registered_by' => $this->registered_by,
        ]);

        $query
            ->andFilterWhere(['like', static::tableName().'.agenda_number', $this->agenda_number])
            ->andFilterWhere(['like', static::tableName().'.instalation_name', $this->instalation_name])
            ->andFilterWhere(['like', static::tableName().'.instalation_location', $this->instalation_location])
            ->andFilterWhere(['like', static::tableName().'.report_number', $this->report_number])
            ->andFilterWhere(['like', static::ALIAS_INSTALATIONREGENCY.'.search_name', $this->instalation_regency_name])
        ;

        return $dataProvider;
    }

}