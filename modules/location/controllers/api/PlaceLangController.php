<?php

namespace app\modules\location\controllers\api;

/**
* This is the class for REST controller "PlaceLangController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PlaceLangController extends \yii\rest\ActiveController
{
public $modelClass = 'app\modules\location\models\PlaceLang';
}
