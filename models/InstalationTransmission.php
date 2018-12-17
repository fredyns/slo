<?php

namespace app\models;

use Yii;
use app\models\base\InstalationTransmission as BaseInstalationTransmission;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "instalation_transmission".
 *
 * @property string $aliasModel
 */
class InstalationTransmission extends BaseInstalationTransmission
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
            [['submission_id'], 'required'],
            [['submission_id', 'subtype_id', 'ownership_status', 'network_id', 'voltage_id'], 'integer'],
            [['jtet', 'jtt'], 'string', 'max' => 128],
            [['power_house_capacity'], 'string', 'max' => 32],
            [['tower', 'line_bay', 'bus_coupler_bay', 'transformer_bay', 'power_breaker_capacity', 'power_transformer_capacity'], 'string', 'max' => 64],
            [['submission_id'], 'unique'],
            [['network_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\TransmissionNetwork::className(), 'targetAttribute' => ['network_id' => 'id']],
            [['submission_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Submission::className(), 'targetAttribute' => ['submission_id' => 'id']],
            [['subtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\InstalationSubtype::className(), 'targetAttribute' => ['subtype_id' => 'id']],
            [['voltage_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Voltage::className(), 'targetAttribute' => ['voltage_id' => 'id']],
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
            return Yii::t('models', 'Instalation Transmissions');
        } else{
            return Yii::t('models', 'Instalation Transmission');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'submission_id' => Yii::t('models', 'Submission'),
            'subtype_id' => Yii::t('models', 'Subtype'),
            'ownership_status' => Yii::t('models', 'Ownership Status'),
            'network_id' => Yii::t('models', 'Network'),
            'jtet' => Yii::t('models', 'Jtet'),
            'jtt' => Yii::t('models', 'Jtt'),
            'voltage_id' => Yii::t('models', 'Voltage'),
            'power_house_capacity' => Yii::t('models', 'Power House Capacity'),
            'tower' => Yii::t('models', 'Tower'),
            'line_bay' => Yii::t('models', 'Line Bay'),
            'bus_coupler_bay' => Yii::t('models', 'Bus Coupler Bay'),
            'transformer_bay' => Yii::t('models', 'Transformer Bay'),
            'power_breaker_capacity' => Yii::t('models', 'Power Breaker Capacity'),
            'power_transformer_capacity' => Yii::t('models', 'Power Transformer Capacity'),
        ];
    }
}
