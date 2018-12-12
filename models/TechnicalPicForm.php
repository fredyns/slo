<?php

namespace app\models;

use Yii;
use app\models\TechnicalPic;
use fredyns\region\models\Area;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the form model class for table "technical_pic".
 */
class TechnicalPicForm extends TechnicalPic
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
                ['name', 'address', 'phone', 'email'],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
                },
            ],
            # default
            [['country_id'], 'default', 'value' => 1],
            # required
            [['name'], 'required'],
            # type
            [['address'], 'string'],
            [['country_id', 'province_id', 'regency_id'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['phone', 'email'], 'string', 'max' => 64],
            # format
            [['email'], 'email'],
            # option
            # constraint
            [
                ['country_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Area::className(),
                'targetAttribute' => ['country_id' => 'id'],
            ],
            [
                ['province_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Area::className(),
                'targetAttribute' => ['province_id' => 'id'],
            ],
            [
                ['regency_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Area::className(),
                'targetAttribute' => ['regency_id' => 'id'],
            ],
            # safe
        ];
    }

}