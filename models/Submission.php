<?php

namespace app\models;

use Yii;
use app\dictionaries\SubmissionProgressStatus;
use app\models\base\Submission as BaseSubmission;
use fredyns\region\models\Area;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "submission".
 *
 * @property string $aliasModel
 * @property Area $instalationCountry
 * @property Area $instalationProvince
 * @property Area $instalationRegency
 * @property InstalationDistribution $distribution
 * @property InstalationGenerator $generator
 * @property InstalationTransmission $transmission
 * @property InstalationUtilization $utilization
 * @property InstalationDistribution $instalationDistribution
 * @property InstalationGenerator $instalationGenerator
 * @property InstalationTransmission $instalationTransmission
 * @property InstalationUtilization $instalationUtilization
 */
class Submission extends BaseSubmission
{
    const ALIAS_INSTALATIONCOUNTRY = 'instalationCountry';
    const ALIAS_INSTALATIONPROVINCE = 'instalationProvince';
    const ALIAS_INSTALATIONREGENCY = 'instalationRegency';

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
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationCountry()
    {
        return $this->hasOne(Area::className(), ['id' => 'instalation_country_id'])->alias(static::ALIAS_INSTALATIONCOUNTRY);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationProvince()
    {
        return $this->hasOne(Area::className(), ['id' => 'instalation_province_id'])->alias(static::ALIAS_INSTALATIONPROVINCE);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationRegency()
    {
        return $this->hasOne(Area::className(), ['id' => 'instalation_regency_id'])->alias(static::ALIAS_INSTALATIONREGENCY);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationDistribution()
    {
        return $this->hasOne(InstalationDistribution::className(), ['submission_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationGenerator()
    {
        return $this->hasOne(InstalationGenerator::className(), ['submission_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationTransmission()
    {
        return $this->hasOne(InstalationTransmission::className(), ['submission_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstalationUtilization()
    {
        return $this->hasOne(InstalationUtilization::className(), ['submission_id' => 'id']);
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
            'instalation_type' => Yii::t('models', 'Type'),
            'instalation_location' => Yii::t('models', 'Location'),
            'instalation_country_id' => Yii::t('models', 'Country'),
            'instalation_province_id' => Yii::t('models', 'Province'),
            'instalation_regency_id' => Yii::t('models', 'Regency'),
            'instalation_latitude' => Yii::t('models', 'Latitude'),
            'instalation_longitude' => Yii::t('models', 'Longitude'),
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