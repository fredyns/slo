<?php

namespace app\models;

use Yii;
use app\dictionaries\InstalationType;
use app\dictionaries\SubmissionProgressStatus;
use app\models\Submission;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "submission".
 * 
 * @property InstalationDistributionForm $distribution
 * @property InstalationGeneratorForm $generator
 * @property InstalationTransmissionForm $transmission
 * @property InstalationUtilizationForm $utilization
 * @property InstalationDistributionForm $instalationDistribution
 * @property InstalationGeneratorForm $instalationGenerator
 * @property InstalationTransmissionForm $instalationTransmission
 * @property InstalationUtilizationForm $instalationUtilization
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
            [['progress_status'], 'default', 'value' => SubmissionProgressStatus::REQUEST],
            # required
            [['instalation_name'], 'required'],
            # type
            [['progress_status', 'owner_id', 'instalation_type', 'instalation_country_id', 'instalation_province_id', 'instalation_regency_id', 'bussiness_type_id', 'sbu_id', 'technical_pic_id', 'technical_personel_id'], 'integer'],
            [['instalation_location'], 'string'],
            [['instalation_latitude', 'instalation_longitude'], 'number'],
            [['agenda_number', 'report_number'], 'string', 'max' => 64],
            [['instalation_name'], 'string', 'max' => 128],
            # format
            [['examination_date'], 'date', 'format' => 'yyyy-MM-dd'],
            # option
            [
                ['progress_status'],
                'in', 'range' => [
                    SubmissionProgressStatus::REQUEST,
                    SubmissionProgressStatus::REGISTRATION,
                    SubmissionProgressStatus::REGISTERED,
                ],
            ],
            [
                ['instalation_type'],
                'in', 'range' => [
                    InstalationType::GENERATOR,
                    InstalationType::TRANSMISSION,
                    InstalationType::DISTRIBUTION,
                    InstalationType::UTILIZATION,
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
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationDistribution()
    {
        return $this->hasOne(InstalationDistributionForm::className(), ['submission_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationGenerator()
    {
        return $this->hasOne(InstalationGeneratorForm::className(), ['submission_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationTransmission()
    {
        return $this->hasOne(InstalationTransmissionForm::className(), ['submission_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationUtilization()
    {
        return $this->hasOne(InstalationUtilizationForm::className(), ['submission_id' => 'id']);
    }

    /**
     * @return InstalationDistributionForm
     */
    public function getDistribution()
    {
        if ($this->instalationDistribution) {
            return $this->instalationDistribution;
        } else  {
            return new InstalationDistributionForm(['submission_id' => $this->id]);
        }
    }

    /**
     * @return InstalationGeneratorForm
     */
    public function getGenerator()
    {
        if ($this->instalationGenerator) {
            return $this->instalationGenerator;
        } else  {
            return new InstalationGeneratorForm(['submission_id' => $this->id]);
        }
    }

    /**
     * @return InstalationTransmissionForm
     */
    public function getTransmission()
    {
        if ($this->instalationTransmission) {
            return $this->instalationTransmission;
        } else  {
            return new InstalationTransmissionForm(['submission_id' => $this->id]);
        }
    }

    /**
     * @return InstalationUtilizationForm
     */
    public function getUtilization()
    {
        if ($this->instalationUtilization) {
            return $this->instalationUtilization;
        } else  {
            return new InstalationUtilizationForm(['submission_id' => $this->id]);
        }
    }

}