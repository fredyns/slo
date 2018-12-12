<?php

namespace app\models;

use Yii;
use app\dictionaries\SubmissionProgressStatus;
use app\models\base\Submission as BaseSubmission;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "submission".
 *
 * @property string $aliasModel
 */
class Submission extends BaseSubmission
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
                parent::behaviors(), [
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
            /* //
              'string_filter' => [
              ['name'],
              'filter',
              'filter' => function($value){
              return StringCleaner::forPlaintext($value);
              },
              ],
              // */
            # default
            # required
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

    /**
     * Alias name of table for crud views Lists all models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return Yii::t('models', 'Submissions');
        } else{
            return Yii::t('models', 'Submission');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'created_at' => Yii::t('models', 'Created At'),
            'created_by' => Yii::t('models', 'Created By'),
            'updated_at' => Yii::t('models', 'Updated At'),
            'updated_by' => Yii::t('models', 'Updated By'),
            'is_deleted' => Yii::t('models', 'Is Deleted'),
            'deleted_at' => Yii::t('models', 'Deleted At'),
            'deleted_by' => Yii::t('models', 'Deleted By'),
            'agenda_number' => Yii::t('models', 'Agenda Number'),
            'progress_status' => Yii::t('models', 'Progress Status'),
            'examination_date' => Yii::t('models', 'Examination Date'),
            'owner_id' => Yii::t('models', 'Owner'),
            'instalation_name' => Yii::t('models', 'Instalation Name'),
            'instalation_location' => Yii::t('models', 'Instalation Location'),
            'instalation_country_id' => Yii::t('models', 'Instalation Country'),
            'instalation_province_id' => Yii::t('models', 'Instalation Province'),
            'instalation_regency_id' => Yii::t('models', 'Instalation Regency'),
            'instalation_latitude' => Yii::t('models', 'Instalation Latitude'),
            'instalation_longitude' => Yii::t('models', 'Instalation Longitude'),
            'bussiness_type_id' => Yii::t('models', 'Bussiness Type'),
            'sbu_id' => Yii::t('models', 'SBU'),
            'technical_pic_id' => Yii::t('models', 'Technical PIC'),
            'technical_personel_id' => Yii::t('models', 'Technical Personel'),
            'report_number' => Yii::t('models', 'Report Number'),
            'report_file_id' => Yii::t('models', 'Report File'),
            'requested_at' => Yii::t('models', 'Requested At'),
            'requested_by' => Yii::t('models', 'Requested By'),
            'registering_at' => Yii::t('models', 'Registering At'),
            'registering_by' => Yii::t('models', 'Registering By'),
            'registered_at' => Yii::t('models', 'Registered At'),
            'registered_by' => Yii::t('models', 'Registered By'),
        ];
    }

}