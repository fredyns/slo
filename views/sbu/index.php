<?php

use app\models\Sbu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\SbuSearch */

$this->title = $searchModel->getAliasModel(TRUE);
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success']);
$actionColumnTemplateString = "{view} {update}";

$actionColumnTemplateString = '<div class="action-buttons">'.$actionColumnTemplateString.'</div>';
?>
<div class="giiant-crud sbu-index">

    <h1>
        <?= $searchModel->getAliasModel(TRUE) ?>
        <small>
            <?= Yii::t('cruds', 'List') ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php // $this->render('_search', ['model' =>$searchModel]); ?>

    <hr />

    <?php
    \yii\widgets\Pjax::begin([
        'id' => 'pjax-main',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-main ul.pagination a, th a',
        'clientOptions' => [
            'pjax:success' => 'function(){alert("yo")}',
        ],
    ]);
    ?>

    <div class="table-responsive">
        <?= 
        GridView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => yii\widgets\LinkPager::className(),
                'firstPageLabel' => Yii::t('cruds', 'First'),
                'lastPageLabel' => Yii::t('cruds', 'Last'),
            ],
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'headerRowOptions' => ['class' => 'x'],
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                'address:ntext',
                // generated by app\generator\crud\providers\RelationProvider::columnFormat
                [
                    'attribute' => 'country_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Sbu */
                        return ArrayHelper::getValue($model, 'country.label');
                    },
                ],
                // generated by app\generator\crud\providers\RelationProvider::columnFormat
                [
                    'attribute' => 'province_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Sbu */
                        return ArrayHelper::getValue($model, 'province.label');
                    },
                ],
                // generated by app\generator\crud\providers\RelationProvider::columnFormat
                [
                    'attribute' => 'regency_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Sbu */
                        return ArrayHelper::getValue($model, 'regency.label');
                    },
                ],
                'name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $actionColumnTemplateString,
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            $options = [
                                'title' => Yii::t('cruds', 'View'),
                                'aria-label' => Yii::t('cruds', 'View'),
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, $options);
                        }
                    ],
                    'urlCreator' => function($action, $model, $key, $index) {
                        // using the column name as key, not mapping to 'id' like the standard generator
                        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                        $params[0] = Yii::$app->controller->id ? Yii::$app->controller->id.'/'.$action : $action;
                        return Url::toRoute($params);
                    },
                    'contentOptions' => ['nowrap' => 'nowrap']
                ],
            ],
        ]);
        ?>
    </div>

    <?php \yii\widgets\Pjax::end() ?>

</div>

