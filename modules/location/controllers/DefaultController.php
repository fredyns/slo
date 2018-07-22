<?php

namespace app\modules\location\controllers;

use yii\web\Controller;

/**
 * Default controller for the `location` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
