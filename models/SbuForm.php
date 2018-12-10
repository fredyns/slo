<?php

namespace app\models;

use Yii;
use app\models\Sbu;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "sbu".
 */
class SbuForm extends Sbu
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
            [['is_deleted', 'country_id', 'province_id', 'regency_id'], 'integer'],
          [['address'], 'string'],
          [['name'], 'string', 'max' => 512],
        ];
    }

}
