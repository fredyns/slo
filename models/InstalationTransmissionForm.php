<?php

namespace app\models;

use Yii;
use app\models\InstalationTransmission;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "instalation_transmission".
 */
class InstalationTransmissionForm extends InstalationTransmission
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
                [
                    'jtet', 'jtt',
                    'power_house_capacity', 'tower',
                    'line_bay', 'bus_coupler_bay', 'transformer_bay', 'power_breaker_capacity', 'power_transformer_capacity',
                ],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
              },
            ],
            # default
            # required
            # type
            [['subtype_id', 'ownership_status', 'network_id', 'voltage_id'], 'integer'],
            [['jtet', 'jtt'], 'string', 'max' => 128],
            [['power_house_capacity'], 'string', 'max' => 32],
            [['tower', 'line_bay', 'bus_coupler_bay', 'transformer_bay', 'power_breaker_capacity', 'power_transformer_capacity'], 'string', 'max' => 64],
            # format
            # option
            # constraint
            [
                ['network_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\TransmissionNetwork::className(),
                'targetAttribute' => ['network_id' => 'id'],
            ],
            [
                ['subtype_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\InstalationSubtype::className(),
                'targetAttribute' => ['subtype_id' => 'id'],
            ],
            [
                ['voltage_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => \app\models\Voltage::className(),
                'targetAttribute' => ['voltage_id' => 'id'],
            ],
            # safe
        ];
    }

}