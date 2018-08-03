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
/* @var $model app\modules\location\models\PlaceLang */

$this->title = Module::t('cruds', 'View').' '.$model->aliasModel;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('cruds', 'View');
?>
<div class="giiant-crud place-lang-view">

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
                '<span class="glyphicon glyphicon-plus"></span> '.Module::t('cruds', 'New'), ['create', 'PlaceLang' => ['place_id' => $model->place_id]], ['class' => 'btn btn-success'])
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
                    'attribute' => 'place_id',
                    'label' => 'Place ID',
                ],
                [
                    'label' => 'Place Label',
                    'value' => ArrayHelper::getValue($model, 'place.name')
                ],
            ],
        ]);
        ?>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'language',
                'name',
            ],
        ]);
        ?>

    </div>

    <hr/>

    <?=
    Html::a('<span class="glyphicon glyphicon-trash"></span> '.Module::t('cruds', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data-confirm' => ''.Module::t('cruds', 'Are you sure to delete this item?').'',
        'data-method' => 'post',
    ]);
    ?>
</div>
