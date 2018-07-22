<?php

namespace app\modules\location\models;

use Yii;
use \app\modules\location\models\base\LocationPlace as BaseLocationPlace;

/**
 * This is the model class for table "location_place".
 */
class LocationPlace extends BaseLocationPlace
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_place}}';
    }

}