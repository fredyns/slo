<?php

namespace app\models;

use Yii;
use app\models\base\InstalationDistribution as BaseInstalationDistribution;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "instalation_distribution".
 *
 * @property string $aliasModel
 */
class InstalationDistribution extends BaseInstalationDistribution
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
            'string_filter' => [
                ['distribution_region'],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
                },
            ],
            # default
            # required
            [['submission_id'], 'required'],
            # type
            [['submission_id', 'subtype_id', 'ownership_status', 'voltage_id', 'substation_quantity', 'panel_quantity'], 'integer'],
            [['jtm_length_kms', 'sktm_length_ms', 'sutm_length_ms', 'jtr_length_kms', 'sktr_length_ms', 'sutr_length_ms', 'substation_capacity_kva', 'short_circuit_capacity_a'], 'number'],
            [['distribution_region'], 'string', 'max' => 4],
            # format
            # restriction
            [['submission_id'], 'unique'],
            # constraint
            [['submission_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Submission::className(), 'targetAttribute' => ['submission_id' => 'id']],
            [['subtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\InstalationSubtype::className(), 'targetAttribute' => ['subtype_id' => 'id']],
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
            return Yii::t('models', 'Instalation Distributions');
        } else{
            return Yii::t('models', 'Instalation Distribution');
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
            'distribution_region' => Yii::t('models', 'Distribution Region'),
            'jtm_length_kms' => Yii::t('models', 'JTM Length (kms)'),
            'sktm_length_ms' => Yii::t('models', 'SKTM Length (ms)'),
            'sutm_length_ms' => Yii::t('models', 'SUTM Length (ms)'),
            'jtr_length_kms' => Yii::t('models', 'JTR Length (ms)'),
            'sktr_length_ms' => Yii::t('models', 'SKTR Length (ms)'),
            'sutr_length_ms' => Yii::t('models', 'SUTR Length (ms)'),
            'substation_capacity_kva' => Yii::t('models', 'Substation Capacity (kVA)'),
            'voltage_id' => Yii::t('models', 'Voltage'),
            'substation_quantity' => Yii::t('models', 'Substation Quantity'),
            'panel_quantity' => Yii::t('models', 'Panel Quantity'),
            'short_circuit_capacity_a' => Yii::t('models', 'Short Circuit Capacity (A)'),
        ];
    }

}