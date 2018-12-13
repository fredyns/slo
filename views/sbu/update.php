<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View  */
/* @var $model app\models\Sbu  */

$this->title = Yii::t('cruds', 'Edit').' '.$model->aliasModel;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>
<div class="giiant-crud sbu-update">

    <h1>
        <?= $model->aliasModel ?>

        <small>
            #<?= $model->id ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-file"></span> '.Yii::t('cruds', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-remove"></span> '.Yii::t('cruds', 'Cancel'), Url::previous(), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', ['model' => $model]); ?>

</div>
