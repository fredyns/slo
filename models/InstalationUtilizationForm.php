<?php

namespace app\models;

use Yii;
use app\models\InstalationUtilization;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "instalation_utilization".
 */
class InstalationUtilizationForm extends InstalationUtilization
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

}
