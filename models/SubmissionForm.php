<?php

namespace app\models;

use Yii;
use app\dictionaries\SubmissionProgressStatus;
use app\models\Submission;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "submission".
 */
class SubmissionForm extends Submission
{
    public $report_file;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
                parent::behaviors(), [
                # custom behaviors
                'file_upload' => [
                    'class' => 'mdm\upload\UploadBehavior',
                    'attribute' => 'report_file', // required, use to receive input file
                    'savedAttribute' => 'report_file_id', // optional, use to link model with saved file.
                    'uploadPath' => '@app/content/slo'.DIRECTORY_SEPARATOR.$this->id, // saved directory. default to '@runtime/upload'
                    'autoSave' => true, // when true then uploaded file will be save before ActiveRecord::save()
                    'autoDelete' => true, // when true then uploaded file will deleted before ActiveRecord::delete()
                ],
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
            'string_filter' => [
                ['instalation_location', 'agenda_number', 'report_number', 'instalation_name'],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
                },
            ],
            # default
            # required
            [['instalation_name'], 'required'],
            # type
            [['progress_status', 'owner_id', 'instalation_country_id', 'instalation_province_id', 'instalation_regency_id', 'bussiness_type_id', 'sbu_id', 'technical_pic_id', 'technical_personel_id'], 'integer'],
            [['instalation_location'], 'string'],
            [['instalation_latitude', 'instalation_longitude'], 'number'],
            [['agenda_number', 'report_number'], 'string', 'max' => 64],
            [['instalation_name'], 'string', 'max' => 128],
            # format
            [['examination_date'], 'date'],
            # option
            [
                ['progress_status'],
                'in', 'range' => [
                    SubmissionProgressStatus::REQUEST,
                    SubmissionProgressStatus::REGISTRATION,
                    SubmissionProgressStatus::REGISTERED,
                ],
            ],
            # constraint
            [
                ['bussiness_type_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\BussinessType::className(),
                'targetAttribute' => ['bussiness_type_id' => 'id'],
            ],
            [
                ['owner_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\Owner::className(),
                'targetAttribute' => ['owner_id' => 'id'],
            ],
            [
                ['sbu_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\Sbu::className(),
                'targetAttribute' => ['sbu_id' => 'id'],
            ],
            [
                ['technical_personel_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\TechnicalPersonel::className(),
                'targetAttribute' => ['technical_personel_id' => 'id'],
            ],
            [
                ['technical_pic_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\TechnicalPic::className(),
                'targetAttribute' => ['technical_pic_id' => 'id'],
            ],
            # safe
        ];
    }

}