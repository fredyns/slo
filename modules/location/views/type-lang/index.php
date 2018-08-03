<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\location\models\search\TypeLangSearch */

$this->title = $searchModel->getAliasModel(TRUE);
$this->params['breadcrumbs'][] = $this->title;

$actionColumnTemplateString = '<div class="action-buttons">{view} {update} {delete}</div>';
?>
<div class="giiant-crud type-lang-index">

    <h1>
        <?= $searchModel->getAliasModel(TRUE) ?>
        <small>
            List
        </small>
    </h1>

    <br/>

    <?= $this->render('_search', ['searchModel' => $searchModel]); ?>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Module::t('cruds', 'New'), ['create', 'TypeLang' => ['type_id' => $searchModel->type_id]], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <hr />

    <?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

    <div class="table-responsive">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => yii\widgets\LinkPager::className(),
                'firstPageLabel' => Module::t('cruds', 'First'),
                'lastPageLabel' => Module::t('cruds', 'Last'),
            ],
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'headerRowOptions' => ['class' => 'x'],
            'columns' => [
                'language',
                'name',
                'abbreviation',
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
                        $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id.'/'.$action : $action;
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




