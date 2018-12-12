<?php

namespace app\models;

use Yii;
use app\models\Submission;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "submission".
 */
class SubmissionForm extends Submission
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            # filter
            /*//
            'string_filter' => [
                ['name'],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
                },
            ],
            //*/
            # default
            # required
            # type
            # format
            # option
            # constraint
            # safe
            [['progress_status', 'owner_id', 'instalation_country_id', 'instalation_province_id', 'instalation_regency_id', 'bussiness_type_id', 'sbu_id', 'technical_pic_id', 'technical_personel_id', 'report_file_id', 'requested_at', 'requested_by', 'registering_at', 'registering_by', 'registered_at', 'registered_by'], 'integer'],
            [['examination_date'], 'safe'],
            [['instalation_location'], 'string'],
            [['instalation_latitude', 'instalation_longitude'], 'number'],
            [['agenda_number', 'report_number'], 'string', 'max' => 64],
            [['instalation_name'], 'string', 'max' => 128],
            [['bussiness_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\BussinessType::className(), 'targetAttribute' => ['bussiness_type_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Owner::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['sbu_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Sbu::className(), 'targetAttribute' => ['sbu_id' => 'id']],
            [['technical_personel_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\TechnicalPersonel::className(), 'targetAttribute' => ['technical_personel_id' => 'id']],
            [['technical_pic_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\TechnicalPic::className(), 'targetAttribute' => ['technical_pic_id' => 'id']],
        ];
    }

}
