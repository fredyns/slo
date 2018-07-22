<?php

namespace app\modules\location\models;

use Yii;
use \app\modules\location\models\base\LocationSublocationCounter as BaseLocationSublocationCounter;

/**
 * This is the model class for table "location_sublocation_counter".
 */
class LocationSublocationCounter extends BaseLocationSublocationCounter
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_sublocation_counter}}';
    }

}
