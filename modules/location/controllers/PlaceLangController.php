<?php

namespace app\modules\location\controllers;

use Yii;
use app\modules\location\models\PlaceLang;
use app\modules\location\models\search\PlaceLangSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use app\modules\location\Module;

/**
 * PlaceLangController implements the CRUD actions for PlaceLang model.
 */
class PlaceLangController extends Controller
{
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

    /**
     * Lists all PlaceLang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlaceLangSearch;
        $dataProvider = $searchModel->search($_GET);

        if (empty($searchModel->type_id)) {
            return $this->redirect(['/'.$this->module->id.'/place']);
        }

        Tabs::clearLocalStorage();

        Url::remember();
        Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single PlaceLang model.
     * @param string $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PlaceLang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /* @var $module Module */
        $module = $this->module;
        $model = new PlaceLang;

        try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['place/view', 'id' => $model->place_id]);
            } elseif (!Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', [
                'model' => $model,
                'locales' => $module->getLocales(),
        ]);
    }

    /**
     * Updates an existing PlaceLang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /* @var $module Module */
        $module = $this->module;
        $model = $this->findModel($id);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['place/view', 'id' => $model->place_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'locales' => $module->getLocales(),
            ]);
        }
    }

    /**
     * Deletes an existing PlaceLang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $model = $this->findModel($id);
            $place_id = $model->place_id;
            $model->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            Yii::$app->getSession()->addFlash('error', $msg);
        } finally {
            return $this->redirect(['place/view', 'id' => $place_id]);
        }
    }

    /**
     * Finds the PlaceLang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PlaceLang the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlaceLang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}