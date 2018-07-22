<?php

namespace app\modules\location\models;

use Yii;
use \app\modules\location\models\base\LocationType as BaseLocationType;

/**
 * This is the model class for table "location_type".
 */
class LocationType extends BaseLocationType
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_type}}';
    }

}
