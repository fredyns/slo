<?php

namespace app\models;

use Yii;
use app\models\TechnicalPersonel;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "technical_personel".
 */
class TechnicalPersonelForm extends TechnicalPersonel
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
            [['address'], 'string'],
            [['country_id', 'province_id', 'regency_id'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['phone', 'email'], 'string', 'max' => 64],
        ];
    }

}
