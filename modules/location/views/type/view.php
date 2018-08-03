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
/* @var $model app\modules\location\models\Type */

$this->title = Module::t('cruds', 'View').' '.$model->aliasModel;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('cruds', 'View');
?>
<div class="giiant-crud type-view">

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
                'name',
                'abbreviation',
            ],
        ]);
        ?>

    </div>

    <?php $this->beginBlock('Translations'); ?>
    <div class="clearfix crud-navigation" style="margin-top: 2px;">
        <!-- sublocation buttons -->
        <div class='pull-right'>
            <?php
            $_label = '<span class="glyphicon glyphicon-plus"></span>'.Module::t('cruds', 'New').' '.Module::t('app', 'Translation');
            $_url = ['location/type-lang/create', 'TypeLang' => ['type_id' => $model->id]];

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
                'pageSize' => 50,
                'pageParam' => 'page-translations',
            ]
            ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Module::t('cruds', 'First'),
            'lastPageLabel' => Module::t('cruds', 'Last')
        ],
        'columns' => [
            'language',
            'name',
            'abbreviation',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'type-lang'.'/'.$action;
                    $params['TypeLang'] = ['type_id' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons' => [],
                'controller' => 'type-lang'
            ],
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
                    'content' => $this->blocks['Translations'],
                    'label' => '<small>'.Module::t('models', 'Translations').' <span class="badge badge-default">'.$model->getTranslations()->count().'</span></small>',
                    'active' => true,
                ],
            ]
        ]
    );
    ?>

    <hr/>

    <?=
    Html::a('<span class="glyphicon glyphicon-trash"></span> '.Module::t('cruds', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data-confirm' => Module::t('cruds', 'Are you sure to delete this item?').'',
        'data-method' => 'post',
    ]);
    ?>
</div>
