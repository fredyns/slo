<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\location\models\Place */

$this->title = Module::t('cruds', 'View').' '.$model->aliasModel;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('cruds', 'View');
?>
<div class="giiant-crud place-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= $model->aliasModel ?>
        <small>
            #<?= Html::encode($model->id) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-right'>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-pencil"></span> '.Module::t('cruds', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-info'])
            ?>

        </div>

        <div class="pull-left">
            <?=
            Html::a('<span class="glyphicon glyphicon-list"></span> '
                .Module::t('cruds', 'Full list'), ['index'], ['class' => 'btn btn-default'])
            ?>
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> '.Module::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success'])
            ?>
        </div>

    </div>

    <hr/>

    <div>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'format' => 'html',
                    'attribute' => 'name',
                    'value' => ArrayHelper::getValue($model, 'type.name').' '.$model->name,
                ],
                [
                    'format' => 'html',
                    'attribute' => 'sublocation_of',
                    'value' => ArrayHelper::getValue($model, 'sublocationOf.type.name').' '.ArrayHelper::getValue($model, 'sublocationOf.name'),
                    'visible' => ($model->sublocation_of > 0),
                ],
                'latitude',
                'longitude',
            ],
        ]);
        ?>

    </div>

    <hr/>



    <?php $this->beginBlock('Sublocations'); ?>
    <div class="clearfix crud-navigation" style="margin-top: 2px;">
        <!-- sublocation buttons -->
        <div class='pull-right'>
            <?php
            $_label = '<span class="glyphicon glyphicon-plus"></span>'.Module::t('cruds', 'New').' '.Module::t('app', 'Sublocation');
            $_url = ['place/create', 'Place' => ['sublocation_of' => $model->id]];

            echo Html::a($_label, $_url, ['class' => 'btn btn-success btn-xs']);
            ?>
        </div>
    </div>
    <?php Pjax::begin(['id' => 'pjax-Sublocations', 'enableReplaceState' => false, 'linkSelector' => '#pjax-Sublocations ul.pagination a, th a']) ?>
    <?=
    '<div class="table-responsive">'
    .\yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getSublocations(),
            'pagination' => [
                'pageSize' => 50,
                'pageParam' => 'page-sublocations',
            ]
            ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Module::t('cruds', 'First'),
            'lastPageLabel' => Module::t('cruds', 'Last')
        ],
        'columns' => [
            [
                'label' => Module::t('models', 'Name'),
                'format' => 'raw',
                'value' => function ($model) {
                    $_label = ArrayHelper::getValue($model, 'type.name').' '.$model->name;

                    return Html::a($_label, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'place'.'/'.$action;
                    $params['Place'] = ['sublocation_of' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons' => [],
                'controller' => 'place'
            ],
        ]
    ])
    .'</div>'
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('SublocationCounters'); ?>
    <?php Pjax::begin(['id' => 'pjax-SublocationCounters', 'enableReplaceState' => false, 'linkSelector' => '#pjax-SublocationCounters ul.pagination a, th a']) ?>
    <?=
    '<div class="table-responsive">'
    .\yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getSublocationCounters(),
            'pagination' => [
                'pageSize' => 20,
                'pageParam' => 'page-sublocationcounters',
            ]
            ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Module::t('cruds', 'First'),
            'lastPageLabel' => Module::t('cruds', 'Last')
        ],
        'columns' => [
            [
                'label' => Module::t('models', 'Type'),
                'format' => 'raw',
                'value' => function ($model) {
                    return ArrayHelper::getValue($model, 'type.name');
                },
            ],
            'quantity',
        ]
    ])
    .'</div>'
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('Translations'); ?>
    <div class="clearfix crud-navigation" style="margin-top: 2px;">
        <!-- sublocation buttons -->
        <div class='pull-right'>
            <?php
            $_label = '<span class="glyphicon glyphicon-plus"></span>'.Module::t('cruds', 'New').' '.Module::t('app', 'Translation');
            $_url = ['place-lang/create', 'PlaceLang' => ['place_id' => $model->id]];

            echo Html::a($_label, $_url, ['class' => 'btn btn-success btn-xs']);
            ?>
        </div>
    </div>
    <?php Pjax::begin(['id' => 'pjax-Translations', 'enableReplaceState' => false, 'linkSelector' => '#pjax-Translations ul.pagination a, th a']) ?>
    <?=
    '<div class="table-responsive">'
    .\yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getTranslations(),
            'pagination' => [
                'pageSize' => 20,
                'pageParam' => 'page-translations',
            ]
            ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Module::t('cruds', 'First'),
            'lastPageLabel' => Module::t('cruds', 'Last')
        ],
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'place-lang'.'/'.$action;
                    $params['PlaceLang'] = ['place_id' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons' => [],
                'controller' => 'place-lang'
            ],
            'language',
            'name',
        ]
    ])
    .'</div>'
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?=
    Tabs::widget(
        [
            'id' => 'relation-tabs',
            'encodeLabels' => false,
            'items' => [
                [
                    'content' => $this->blocks['Sublocations'],
                    'label' => '<small>'.Module::t('models', 'Sublocations').' <span class="badge badge-default">'.$model->getSublocations()->count().'</span></small>',
                    'active' => false,
                ],
                [
                    'content' => $this->blocks['SublocationCounters'],
                    'label' => '<small>'.Module::t('models', 'Sublocations Counters').' <span class="badge badge-default">'.$model->getSublocationCounters()->count().'</span></small>',
                    'active' => false,
                ],
                [
                    'content' => $this->blocks['Translations'],
                    'label' => '<small>'.Module::t('models', 'Translations').' <span class="badge badge-default">'.$model->getTranslations()->count().'</span></small>',
                    'active' => false,
                ],
            ]
        ]
    );
    ?>

    <hr/>

    <?=
    Html::a('<span class="glyphicon glyphicon-trash"></span> '.Module::t('cruds', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data-confirm' => ''.Module::t('cruds', 'Are you sure to delete this item?').'',
        'data-method' => 'post',
    ]);
    ?>
</div>
