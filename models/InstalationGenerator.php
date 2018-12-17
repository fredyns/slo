<?php

namespace app\models;

use Yii;
use app\models\base\InstalationGenerator as BaseInstalationGenerator;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "instalation_generator".
 *
 * @property string $aliasModel
 */
class InstalationGenerator extends BaseInstalationGenerator
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
            [['submission_id', 'subtype_id', 'fuel_id', 'module_quantity', 'inverter_quantity', 'calorific_value_file_id', 'fuel_consumption_rate_file_id'], 'integer'],
            [['capacity', 'test_capacity'], 'number'],
            [['capacity_unit', 'test_capacity_unit'], 'string', 'max' => 8],
            [['unit_number'], 'string', 'max' => 32],
            [['turbine_serial_number', 'generator_serial_number', 'each_module_capacity', 'each_inverter_capacity', 'calorific_value', 'fuel_consumption_hhv', 'fuel_consumption_lhv', 'sfc'], 'string', 'max' => 64],
            [['unit'], 'string', 'max' => 128],
            [['submission_id'], 'unique'],
            [['fuel_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Fuel::className(), 'targetAttribute' => ['fuel_id' => 'id']],
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
            return Yii::t('models', 'Instalation Generators');
        } else{
            return Yii::t('models', 'Instalation Generator');
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
            'capacity' => Yii::t('models', 'Capacity'),
            'capacity_unit' => Yii::t('models', 'Capacity Unit'),
            'test_capacity' => Yii::t('models', 'Test Capacity'),
            'test_capacity_unit' => Yii::t('models', 'Test Capacity Unit'),
            'unit_number' => Yii::t('models', 'Unit Number'),
            'turbine_serial_number' => Yii::t('models', 'Turbine Serial Number'),
            'generator_serial_number' => Yii::t('models', 'Generator Serial Number'),
            'unit' => Yii::t('models', 'Unit'),
            'fuel_id' => Yii::t('models', 'Fuel'),
            'module_quantity' => Yii::t('models', 'Module Quantity'),
            'each_module_capacity' => Yii::t('models', 'Each Module Capacity'),
            'inverter_quantity' => Yii::t('models', 'Inverter Quantity'),
            'each_inverter_capacity' => Yii::t('models', 'Each Inverter Capacity'),
            'calorific_value' => Yii::t('models', 'Calorific Value'),
            'calorific_value_file_id' => Yii::t('models', 'Calorific Value File'),
            'fuel_consumption_hhv' => Yii::t('models', 'Fuel Consumption Hhv'),
            'fuel_consumption_lhv' => Yii::t('models', 'Fuel Consumption Lhv'),
            'fuel_consumption_rate_file_id' => Yii::t('models', 'Fuel Consumption Rate File'),
            'sfc' => Yii::t('models', 'Sfc'),
        ];
    }
}
