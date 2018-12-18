<?php

namespace app\models;

use Yii;
use app\models\InstalationDistribution;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "instalation_distribution".
 */
class InstalationDistributionForm extends InstalationDistribution
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
            # type
            [['subtype_id', 'ownership_status', 'voltage_id', 'substation_quantity', 'panel_quantity'], 'integer'],
            [['jtm_length_kms', 'sktm_length_ms', 'sutm_length_ms', 'jtr_length_kms', 'sktr_length_ms', 'sutr_length_ms', 'substation_capacity_kva', 'short_circuit_capacity_a'], 'number'],
            [['distribution_region'], 'string', 'max' => 4],
            # format
            # restriction
            # constraint
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