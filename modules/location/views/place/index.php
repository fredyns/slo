<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\location\models\search\PlaceSearch */

$this->title = $searchModel->getAliasModel(TRUE);
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .item {
        margin: 10px 15px;
        font-size: 1.2em;
    }
</style>

<div class="giiant-crud place-index">

    <h1>
        <?= $searchModel->getAliasModel(TRUE) ?>
        <small>
            List
        </small>
    </h1>

    <br />

    <?= $this->render('_search', ['searchModel' => $searchModel]); ?>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Module::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <hr />

    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return '<span class="glyphicon glyphicon-chevron-right"></span> '.Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        },
    ]);
    ?>

</div>
