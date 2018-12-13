<?php

use app\models\Submission;
use dmstr\bootstrap\Tabs;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model Submission */

$this->title = $model->aliasModel.' | '.$model->id;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud submission-view">

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
            'progress_status',
            // generated by app\generator\crud\providers\RelationProvider::attributeFormat
            [
                'attribute' => 'owner_id',
                'format' => 'html',
                'value' => ArrayHelper::getValue($model, 'owner.name', '<span class="label label-warning">?</span>'),
            ],
            'instalation_country_id',
            'instalation_province_id',
            'instalation_regency_id',
            // generated by app\generator\crud\providers\RelationProvider::attributeFormat
            [
                'attribute' => 'bussiness_type_id',
                'format' => 'html',
                'value' => ArrayHelper::getValue($model, 'bussinessType.name', '<span class="label label-warning">?</span>'),
            ],
            // generated by app\generator\crud\providers\RelationProvider::attributeFormat
            [
                'attribute' => 'sbu_id',
                'format' => 'html',
                'value' => ArrayHelper::getValue($model, 'sbu.name', '<span class="label label-warning">?</span>'),
            ],
            // generated by app\generator\crud\providers\RelationProvider::attributeFormat
            [
                'attribute' => 'technical_pic_id',
                'format' => 'html',
                'value' => ArrayHelper::getValue($model, 'technicalPic.name', '<span class="label label-warning">?</span>'),
            ],
            // generated by app\generator\crud\providers\RelationProvider::attributeFormat
            [
                'attribute' => 'technical_personel_id',
                'format' => 'html',
                'value' => ArrayHelper::getValue($model, 'technicalPersonel.name', '<span class="label label-warning">?</span>'),
            ],
            'instalation_location:ntext',
            'instalation_latitude',
            'instalation_longitude',
            'agenda_number',
            'report_number',
            'instalation_name',
            'examination_date',
        ],
    ]);
    ?>

    
    <hr/>
    

    <hr/><br/>

</div>
