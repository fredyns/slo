<?php

namespace app\models;

use Yii;
use app\models\InstalationGenerator;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "instalation_generator".
 */
class InstalationGeneratorForm extends InstalationGenerator
{
    public $calorific_value_file;
    public $fuel_consumption_rate_file;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
                parent::behaviors(), [
                # custom behaviors
                'upload_calorific_value_file' => [
                    'class' => 'mdm\upload\UploadBehavior',
                    'attribute' => 'calorific_value_file', // required, use to receive input file
                    'savedAttribute' => 'calorific_value_file_id', // optional, use to link model with saved file.
                    'uploadPath' => '@app/content/slo'.DIRECTORY_SEPARATOR.$this->submission_id, // saved directory. default to '@runtime/upload'
                    'autoSave' => true, // when true then uploaded file will be save before ActiveRecord::save()
                    'autoDelete' => true, // when true then uploaded file will deleted before ActiveRecord::delete()
                ],
                'upload_fuel_consumption_rate_file' => [
                    'class' => 'mdm\upload\UploadBehavior',
                    'attribute' => 'fuel_consumption_rate_file', // required, use to receive input file
                    'savedAttribute' => 'fuel_consumption_rate_file_id', // optional, use to link model with saved file.
                    'uploadPath' => '@app/content/slo'.DIRECTORY_SEPARATOR.$this->submission_id, // saved directory. default to '@runtime/upload'
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
                [
                    'capacity_unit', 'test_capacity_unit',
                    'unit_number',
                    'turbine_serial_number', 'generator_serial_number',
                    'each_module_capacity', 'each_inverter_capacity',
                    'calorific_value', 'fuel_consumption_hhv', 'fuel_consumption_lhv', 'sfc',
                ],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
              },
            ],
            # default
            # required
            [['submission_id'], 'required'],
            # type
            [['submission_id', 'subtype_id', 'fuel_id', 'module_quantity', 'inverter_quantity', 'calorific_value_file_id', 'fuel_consumption_rate_file_id'], 'integer'],
            [['capacity', 'test_capacity'], 'number'],
            [['capacity_unit', 'test_capacity_unit'], 'string', 'max' => 8],
            [['unit_number'], 'string', 'max' => 32],
            [['turbine_serial_number', 'generator_serial_number', 'each_module_capacity', 'each_inverter_capacity', 'calorific_value', 'fuel_consumption_hhv', 'fuel_consumption_lhv', 'sfc'], 'string', 'max' => 64],
            [['unit'], 'string', 'max' => 128],
            # format
            # restriction
            [['submission_id'], 'unique'],
            # constraint
            [
                ['fuel_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\Fuel::className(),
                'targetAttribute' => ['fuel_id' => 'id'],
            ],
            [
                ['submission_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\Submission::className(),
                'targetAttribute' => ['submission_id' => 'id'],
            ],
            [
                ['subtype_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\InstalationSubtype::className(),
                'targetAttribute' => ['subtype_id' => 'id'],
            ],
            # safe   
        ];
    }

}