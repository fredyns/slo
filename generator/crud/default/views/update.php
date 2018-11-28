<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View  */
/* @var $generator yii\gii\generators\crud\Generator  */

$tableSchema = $generator->getTableSchema();
$urlParams = $generator->generateUrlParams();
$model = new $generator->modelClass();
$model->setScenario('crud');
$className = $model::className();
$modelName = Inflector::camel2words(StringHelper::basename($model::className()));
$haveID=($tableSchema->getColumn('id') !== null);
echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View  */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?>  */

$this->title = Yii::t('cruds', 'Edit').' '.$model->aliasModel;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model-><?= $haveID ? 'id' : $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Edit') ?>;
?>
<div class="giiant-crud <?= Inflector::camel2id(StringHelper::basename($generator->modelClass), '-', true) ?>-update">

    <h1>
        <?='<?= '?> $model->aliasModel ?>

        <small>
<?php            
if($haveID) {
    echo '            #<?= Html::encode($model->id) ?>\n';
}else{
    $label = StringHelper::basename($generator->modelClass);
    echo '            <?= Html::encode($model->'.$generator->getModelNameAttribute($generator->modelClass).") ?>\n";
}
?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-right">
            <?= '<?= ' ?> Html::a('<span class="glyphicon glyphicon-file"></span> '.Yii::t('cruds', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            <?= '<?= ' ?> Html::a('<span class="glyphicon glyphicon-remove"></span> '.Yii::t('cruds', 'Cancel'), Url::previous(), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <?= '<?= ' ?> $this->render('_form', ['model' => $model]); ?>

</div>
