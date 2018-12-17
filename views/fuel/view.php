<?php

use app\models\Fuel;
use dmstr\bootstrap\Tabs;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model Fuel */

$this->title = $model->aliasModel.' | '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud fuel-view">

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
    
    <?php $this->beginBlock('InstalationGenerators'); ?>

    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>

            <?=
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> '.Yii::t('cruds', 'List All').' '.Yii::t('cruds', 'Instalation Generators'),
                ['instalation-generator/index'],
                ['class' => 'btn text-muted btn-xs']
            );
            ?>


            <?=
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New Instalation Generator'),
                ['instalation-generator/create', 'InstalationGenerator' => ['fuel_id' => $model->id]],
                ['class' => 'btn btn-success btn-xs']
            );
            ?>

            

        </div>
    </div>

    <?php
        Pjax::begin([
            'id' => 'pjax-InstalationGenerators',
            'enableReplaceState' => false,
            'linkSelector' => '#pjax-InstalationGenerators ul.pagination a, th a',
        ]);
    ?>
    <?=
    '<div class=\"table-responsive\">'
    .\yii\grid\GridView::widget([
        'layout' => '{summary}{pager}<br/>{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getInstalationGenerators(),
            'pagination' => [
                'pageSize' => 20,
                'pageParam' => 'page-instalationgenerators',
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
            /* columns: submission_id,subtype_id,fuel_id,module_quantity,inverter_quantity,calorific_value_file_id,fuel_consumption_rate_file_id,capacity,test_capacity,capacity_unit,test_capacity_unit,unit_number,turbine_serial_number,generator_serial_number,each_module_capacity,each_inverter_capacity,calorific_value,fuel_consumption_hhv,fuel_consumption_lhv,sfc,unit */
            // generated by app\generator\crud\providers\RelationProvider::columnFormat
            [
                'attribute' => 'submission_id',
                'format' => 'html',
                'value' => function ($model) {
                    /* @var $model \app\models\InstalationGenerator */
                    return ArrayHelper::getValue($model, 'submission.id');
                },
            ],
            // generated by app\generator\crud\providers\RelationProvider::columnFormat
            [
                'attribute' => 'subtype_id',
                'format' => 'html',
                'value' => function ($model) {
                    /* @var $model \app\models\InstalationGenerator */
                    return ArrayHelper::getValue($model, 'subtype.name');
                },
            ],
            'module_quantity',
            'inverter_quantity',
            'calorific_value_file_id',
            'fuel_consumption_rate_file_id',
            'capacity',
            'test_capacity',
            'capacity_unit',
            //'test_capacity_unit',
            //'unit_number',
            //'turbine_serial_number',
            //'generator_serial_number',
            //'each_module_capacity',
            //'each_inverter_capacity',
            //'calorific_value',
            //'fuel_consumption_hhv',
            //'fuel_consumption_lhv',
            //'sfc',
            //'unit',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function ($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'instalation-generator/'.$action;
                    $params['InstalationGenerator'] = ['fuel_id' => $model->primaryKey()[0]];
                    return $params;
                },
                'buttons' => [

                ],
                'controller' => 'instalation-generator'
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
                'content' => $this->blocks['InstalationGenerators'],
                'label' => '<small>'.Yii::t('cruds', 'Instalation Generators').' <span class="badge badge-default">'. $model->getInstalationGenerators()->count().'</span></small>',
            ],

        ],
    ]);
    ?>


    <hr/>

    <div style="font-size: 75%; font-style: italic;">
        <?= Yii::t('timestamp', 'Created') ?>
        <?= Yii::$app->formatter->asDate($model->created_at, "d MMMM Y '".Yii::t('timestamp', 'at')."' HH:mm") ?>
        <?= Yii::t('timestamp', 'by') ?>
        <?= ArrayHelper::getValue($model, 'createdBy.username', '-') ?>
        <br/>
        <?= Yii::t('timestamp', 'Updated') ?>
        <?= Yii::$app->formatter->asDate($model->updated_at, "d MMMM Y '".Yii::t('timestamp', 'at')."' HH:mm") ?>
        <?= Yii::t('timestamp', 'by') ?>
        <?= ArrayHelper::getValue($model, 'updatedBy.username', '-') ?>
        <?php if ($model->is_deleted): ?>
            <br/>
            <?= Yii::t('timestamp', 'Deleted') ?>
            <?= Yii::$app->formatter->asDate($model->deleted_at, "d MMMM Y '".Yii::t('timestamp', 'at')."' HH:mm") ?>
            <?= Yii::t('timestamp', 'by') ?>
            <?= ArrayHelper::getValue($model, 'deletedBy.username', '-') ?>
        <?php endif; ?>
    </div>

</div>
