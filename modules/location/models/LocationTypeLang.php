<?php

namespace app\modules\location\models;

use Yii;
use \app\modules\location\models\base\LocationTypeLang as BaseLocationTypeLang;

/**
 * This is the model class for table "location_type_lang".
 */
class LocationTypeLang extends BaseLocationTypeLang
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_type_lang}}';
    }

}