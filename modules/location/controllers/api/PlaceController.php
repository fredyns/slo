<?php

namespace app\modules\location\controllers\api;

/**
 * This is the class for REST controller "PlaceController".
 */
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PlaceController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\modules\location\models\Place';

}