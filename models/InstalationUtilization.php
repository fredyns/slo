<?php

namespace app\models;

use Yii;
use app\models\base\InstalationUtilization as BaseInstalationUtilization;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "instalation_utilization".
 *
 * @property string $aliasModel
 */
class InstalationUtilization extends BaseInstalationUtilization
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
            [['submission_id', 'subtype_id', 'medium_voltage_connecting_panel_quantity', 'low_voltage_connecting_panel_quantity'], 'integer'],
            [['substation_transformer_kva', 'connected_power_kva'], 'number'],
            [['electricity_provider'], 'string', 'max' => 512],
            [['submission_id'], 'unique'],
            [['submission_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Submission::className(), 'targetAttribute' => ['submission_id' => 'id']],
            [['subtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\InstalationSubtype::className(), 'targetAttribute' => ['subtype_id' => 'id']],
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
            return Yii::t('models', 'Instalation Utilizations');
        } else{
            return Yii::t('models', 'Instalation Utilization');
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
            'substation_transformer_kva' => Yii::t('models', 'Substation Transformer Kva'),
            'connected_power_kva' => Yii::t('models', 'Connected Power Kva'),
            'medium_voltage_connecting_panel_quantity' => Yii::t('models', 'Medium Voltage Connecting Panel Quantity'),
            'low_voltage_connecting_panel_quantity' => Yii::t('models', 'Low Voltage Connecting Panel Quantity'),
            'electricity_provider' => Yii::t('models', 'Electricity Provider'),
        ];
    }
}
