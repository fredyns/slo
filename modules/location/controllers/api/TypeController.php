<?php

namespace app\modules\location\controllers\api;

/**
* This is the class for REST controller "TypeController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TypeController extends \yii\rest\ActiveController
{
public $modelClass = 'app\modules\location\models\Type';
}
