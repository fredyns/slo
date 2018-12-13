<?php

use app\models\BussinessType;
use dmstr\bootstrap\Tabs;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model BussinessType */

$this->title = $model->aliasModel.' | '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud bussiness-type-view">

    <h1>
        <?= $model->aliasModel ?>
        <small>
            #<?= $model->id ?>
            <?php if ($model->is_deleted): ?>
                <span class="badge">deleted</span>
            <?php endif; ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-right'>
            <?=
            ButtonDropdown::widget([
                'label' => Yii::t('cruds', 'Edit'),
                'tagName' => 'a',
                'split' => true,
                'options' => [
                    'href' => ['update', 'id' => $model->id],
                    'class' => 'btn btn-info',
                ],
                'dropdown' => [
                    'encodeLabels' => FALSE,
                    'options' => [
                        'class' => 'dropdown-menu-right',
                    ],
                    'items' => [
                        '<li role="presentation" class="divider"></li>',
                        [
                            'label' => '<span class="glyphicon glyphicon-list"></span> '.Yii::t('cruds', 'Full list'),
                            'url' => ['index'],
                        ],
                        [
                            'label' => '<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New'),
                            'url' => ['create'],
                        ],
                        '<li role="presentation" class="divider"></li>',
                        [
                            'label' => '<span class="glyphicon glyphicon-trash"></span> '.Yii::t('cruds', 'Delete'),
                            'url' => ['delete', 'id' => $model->id],
                            'linkOptions' => [
                                'data-confirm' => Yii::t('cruds', 'Are you sure to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => FALSE,
                                'class' => 'label label-danger',
                            ],
                            'visible' => ($model->is_deleted == FALSE),
                        ],
                        [
                            'label' => '<span class="glyphicon glyphicon-floppy-open"></span> '.Yii::t('cruds', 'Restore'),
                            'url' => ['delete', 'id' => $model->id],
                            'linkOptions' => [
                                'data-confirm' => Yii::t('cruds', 'Are you sure to restore this item?'),
                                'data-method' => 'post',
                                'data-pjax' => FALSE,
                                'class' => 'label label-info',
                            ],
                            'visible' => ($model->is_deleted),
                        ],
                    ],
                ],
            ]);
            ?>
        </div>

    </div>

    <hr/>

    
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
        ],
    ]);
    ?>

    
    <hr/>
    
    <?php $this->beginBlock('Submissions'); ?>

    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>

            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> '.Yii::t('cruds', 'List All').' '.Yii::t('cruds', 'Submissions'),
                ['submission/index'],
                ['class' => 'btn text-muted btn-xs']
            );
            ?>


            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New Submission'),
                ['submission/create', 'Submission' => ['bussiness_type_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            );
            ?>

            

        </div>
    </div>

    <?php
        Pjax::begin([
            'id' => 'pjax-Submissions',
            'enableReplaceState'=> false,
            'linkSelector' => '#pjax-Submissions ul.pagination a, th a',
        ]);
    ?>
    <?=
    '<div class=\"table-responsive\">'
    .\yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getSubmissions()->andWhere(['is_deleted' => FALSE]),
            'pagination' => [
                'pageSize' => 20,
                'pageParam' => 'page-submissions',
            ]
        ]),
        'pager' => [
            'class' => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('cruds', 'First'),
            'lastPageLabel' => Yii::t('cruds', 'Last')
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            /* columns: progress_status,owner_id,instalation_country_id,instalation_province_id,instalation_regency_id,bussiness_type_id,sbu_id,technical_pic_id,technical_personel_id,instalation_location,instalation_latitude,instalation_longitude,agenda_number,report_number,instalation_name,examination_date */
            'progress_status',
            // generated by app\generator\crud\providers\RelationProvider::columnFormat
[
    'attribute' => 'owner_id',
    'format' => 'html',
    'value' => function ($model) {
        /* @var $model \app\models\Submission */
        return ArrayHelper::getValue($model, 'owner.name');
    },
]
,
            'instalation_country_id',
            'instalation_province_id',
            'instalation_regency_id',
            // generated by app\generator\crud\providers\RelationProvider::columnFormat
[
    'attribute' => 'sbu_id',
    'format' => 'html',
    'value' => function ($model) {
        /* @var $model \app\models\Submission */
        return ArrayHelper::getValue($model, 'sbu.name');
    },
]
,
            // generated by app\generator\crud\providers\RelationProvider::columnFormat
[
    'attribute' => 'technical_pic_id',
    'format' => 'html',
    'value' => function ($model) {
        /* @var $model \app\models\Submission */
        return ArrayHelper::getValue($model, 'technicalPic.name');
    },
]
,
            // generated by app\generator\crud\providers\RelationProvider::columnFormat
[
    'attribute' => 'technical_personel_id',
    'format' => 'html',
    'value' => function ($model) {
        /* @var $model \app\models\Submission */
        return ArrayHelper::getValue($model, 'technicalPersonel.name');
    },
]
,
            'instalation_location:ntext',
            //'instalation_latitude',
            //'instalation_longitude',
            //'agenda_number',
            //'report_number',
            //'instalation_name',
            //'examination_date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'submission/'.$action;
                    $params['Submission'] = ['bussiness_type_id' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons' => [

                ],
                'controller' => 'submission'
            ],

        ],
    ])
    .'</div>'

    ?>
    <?php Pjax::end(); ?>
    <?php $this->endBlock() ?>



    <?=
    Tabs::widget([
        'id' => 'relation-tabs',
        'encodeLabels' => false,
        'items' => [
            [
                //'active' => false,
                'content' => $this->blocks['Submissions'],
                'label' => '<small>'.Yii::t('cruds', 'Submissions').' <span class="badge badge-default">'. $model->getSubmissions()->count().'</span></small>',
            ],

        ],
    ]);
    ?>


    <hr/><br/>

</div>
