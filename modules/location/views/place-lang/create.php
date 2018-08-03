<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\location\models\PlaceLang */

$this->title = Module::t('cruds', 'New Place Translation');
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = Module::t('cruds', 'New');
?>
<div class="giiant-crud place-lang-create">

    <h1>
        <?= $model->aliasModel ?>
        <small>
            <?= Module::t('cruds', 'New') ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-remove"></span> '.Module::t('cruds', 'Cancel'), Url::previous(), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= $this->render('_form', ['model' => $model]); ?>

</div>
