<?php

use app\models\Owner;
use dmstr\bootstrap\Tabs;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model Owner */

$this->title = $model->aliasModel.' | '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud owner-view">

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
                    'address:ntext',
                    'country_id',
                    'province_id',
                    'regency_id',
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
                '<span class="glyphicon glyphicon-list"></span> '.Yii::t('cruds', 'List All').' Submissions',
                ['submission/index'],
                ['class'=>'btn text-muted btn-xs']
            );
            ?>

        
            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New').' Submission',
                ['submission/create', 'Submission' => ['owner_id' => $model->id]],
                ['class'=>'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>

    <?php 
        Pjax::begin([
            'id'=>'pjax-Submissions',
            'enableReplaceState'=> false,
            'linkSelector'=>'#pjax-Submissions ul.pagination a, th a',
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
                'pageParam'=>'page-submissions',
            ]
        ]),
        'pager'        => [
            'class'          => yii\widgets\LinkPager::className(),
            'firstPageLabel' => Yii::t('cruds', 'First'),
            'lastPageLabel'  => Yii::t('cruds', 'Last')
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'submission/' . $action;
                    $params['Submission'] = ['owner_id' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons'    => [

                ],
                'controller' => 'submission'
            ],

        ],
    ])
    . '</div>'

    ?>
    <?php Pjax::end(); ?>
    <?php $this->endBlock() ?>



    <?=
    Tabs::widget([
        'id' => 'relation-tabs',
        'encodeLabels' => false,
        'items' => [
            [
                'content' => $this->blocks['Submissions'],
                'label'   => '<small>Submissions <span class="badge badge-default">'. $model->getSubmissions()->count() . '</span></small>',
                #'active'  => false,
            ],

        ],
    ]);
    ?>


    <hr/><br/>

</div>
