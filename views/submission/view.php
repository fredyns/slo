<?php

use app\dictionaries\InstalationType;
use app\dictionaries\SubmissionProgressStatus;
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

    <?php $this->beginBlock('submisson'); ?>

    <p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'agenda_number',
                [
                    'attribute' => 'progress_status',
                    'format' => 'html',
                    'value' => SubmissionProgressStatus::getLabel($model->progress_status),
                ],
            ],
        ]);
        ?>

    </p>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('owner'); ?>

    <p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                // generated by app\generator\crud\providers\RelationProvider::attributeFormat
                [
                    'attribute' => 'owner_id',
                    'format' => 'html',
                    'value' => ArrayHelper::getValue($model, 'owner.name', '<span class="label label-warning">?</span>'),
                ],
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
            ],
        ]);
        ?>

    </p>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('instalation'); ?>

    <p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'instalation_name',
                [
                    'attribute' => 'instalation_type',
                    'format' => 'html',
                    'value' => InstalationType::getLabel($model->instalation_type),
                ],
                'instalation_location:ntext',
                [
                    'attribute' => 'instalation_regency_id',
                    'format' => 'html',
                    'value' => ArrayHelper::getValue($model, 'instalationRegency.label', '<span class="label label-warning">?</span>'),
                ],
                [
                    'attribute' => 'instalation_province_id',
                    'format' => 'html',
                    'value' => ArrayHelper::getValue($model, 'instalationProvince.label', '<span class="label label-warning">?</span>'),
                ],
                [
                    'attribute' => 'instalation_country_id',
                    'format' => 'html',
                    'value' => ArrayHelper::getValue($model, 'instalationCountry.label', '<span class="label label-warning">?</span>'),
                ],
                'instalation_latitude',
                'instalation_longitude',
            ],
        ]);
        ?>

    </p>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('examination'); ?>

    <p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'examination_date',
                    'format' => [
                        'date',
                        'format' => 'long',
                    ],
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
            ],
        ]);
        ?>

    </p>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('report'); ?>

    <p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'report_number',
                [
                    'label' => Yii::t('app', "Report File"),
                    'format' => 'raw',
                    'value' => ($model->report_file_id ? Html::a('download', ['/file', 'id' => $model->report_file_id], ['target' => '_blank']) : '<span class="label label-warning">?</span>'),
                ],
            ],
        ]);
        ?>

    </p>

    <?php $this->endBlock(); ?>

    <?=
    Tabs::widget([
        'encodeLabels' => false,
        'items' => [
            [
                'label' => $model->aliasModel,
                'content' => $this->blocks['submisson'],
                'active' => true,
            ],
            [
                'label' => Yii::t('models', 'Instalation'),
                'content' => $this->blocks['instalation'],
            ],
            [
                'label' => Yii::t('models', 'Owner'),
                'content' => $this->blocks['owner'],
            ],
            [
                'label' => Yii::t('models', 'Examination'),
                'content' => $this->blocks['examination'],
            ],
            [
                'label' => Yii::t('models', 'Report'),
                'content' => $this->blocks['report'],
            ],
        ],
    ]);
    ?>


    <hr/>


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
