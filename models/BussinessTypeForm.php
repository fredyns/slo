<?php

namespace app\models;

use Yii;
use app\models\BussinessType;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "bussiness_type".
 */
class BussinessTypeForm extends BussinessType
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
            [['name'], 'string', 'max' => 128],
        ];
    }

}
