<?php

namespace app\controllers;

use Yii;
use app\models\Submission;
use app\models\SubmissionForm;
use app\models\SubmissionSearch;
use yii\web\Controller;
use dmstr\bootstrap\Tabs;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\HttpException;

/**
 * This is the class for controller "SubmissionController".
 */
class SubmissionController extends \app\controllers\base\SubmissionController
{

    public function actionApplyRequest($id = NULL)
    {
        if (is_numeric($id)){
            $model = $this->findForm($id);
        } else {
            $model = new SubmissionForm(['is_deleted' => FALSE]);
        }

        if ($model->applyRequest()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('apply-request', [
                    'model' => $model,
            ]);
        }
    }

}