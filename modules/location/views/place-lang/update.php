<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\location\models\PlaceLang */

$this->title = Module::t('cruds', 'Edit').' '.$model->aliasModel;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('cruds', 'Edit');
?>
<div class="giiant-crud place-lang-update">

    <h1>
        <?= $model->aliasModel ?>
        <small>
            #<?= Html::encode($model->id) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-file"></span> '.Module::t('cruds', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-remove"></span> '.Module::t('cruds', 'Cancel'), Url::previous(), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', ['model' => $model]); ?>

</div>
