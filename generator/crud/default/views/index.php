<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/*
 * @var yii\web\View $this
 * @var schmunk42\giiant\generators\crud\Generator $generator
 */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

/** @var \yii\db\ActiveRecord $model */
$model = new $generator->modelClass();
$model->setScenario('crud');

$modelName = Inflector::camel2words(Inflector::pluralize(StringHelper::basename($model::className())));

$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    /** @var \yii\db\ActiveRecord $model */
    $model = new $generator->modelClass();
    $safeAttributes = $model->safeAttributes();
    if (empty($safeAttributes)) {
        $safeAttributes = $model->getTableSchema()->columnNames;
    }
}

echo "<?php\n";
?>

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use <?= $generator->indexWidgetType === 'grid' ? $generator->indexGridClass : 'yii\\widgets\\ListView' ?>;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
<?php if ($generator->searchModelClass !== ''): ?>
/* @var $searchModel <?= ltrim($generator->searchModelClass, '\\') ?> */
<?php endif; ?>

$this->title = $searchModel->getAliasModel(TRUE);
$this->params['breadcrumbs'][] = $this->title;

<?php if($generator->accessFilter): ?>
/**
 * create action column template depending access rights
 */
$actionColumnTemplates = [];

if (Yii::$app->user->can('<?=$permisions['view']['name']?>', ['route' => true])) {
    $actionColumnTemplates[] = '{view}';
}

if (Yii::$app->user->can('<?=$permisions['update']['name']?>', ['route' => true])) {
    $actionColumnTemplates[] = '{update}';
}

if (Yii::$app->user->can('<?=$permisions['delete']['name']?>', ['route' => true])) {
    $actionColumnTemplates[] = '{delete}';
}

$actionColumnTemplate = implode(' ', $actionColumnTemplates);
$actionColumnTemplateString = $actionColumnTemplate;
<?php else: ?>
Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> '.<?= $generator->generateString('New') ?>, ['create'], ['class' => 'btn btn-success']);
$actionColumnTemplateString = "{view} {update}";
<?php endif; ?>

$actionColumnTemplateString = '<div class="action-buttons">'.$actionColumnTemplateString.'</div>';
<?= '?>'; ?>

<div class="giiant-crud <?= Inflector::camel2id(StringHelper::basename($generator->modelClass), '-', true) ?>-index">

    <h1>
        <?= '<?= ' ?>$searchModel->getAliasModel(TRUE) ?>
        <small>
            <?= '<?= ' ?>$generator->generateString('List') ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
        </div>

        <div class="pull-right">
            <?= '<?= ' ?>Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?= '<?php ' ?>// $this->render('_search', ['model' =>$searchModel]); ?>

    <hr />

<?php if ($generator->indexWidgetType === 'grid'): ?>
<?= "    <?php\n" ?>
    \yii\widgets\Pjax::begin([
        'id' => 'pjax-main',
        'enableReplaceState' => false,
        'linkSelector' => '#pjax-main ul.pagination a, th a',
        'clientOptions' => [
            'pjax:success' => 'function(){alert("yo")}',
        ],
    ]);
    ?>

    <div class="table-responsive">
<?= '        <?= ' ?>

        GridView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => yii\widgets\LinkPager::className(),
                'firstPageLabel' => <?= $generator->generateString('First') ?>,
                'lastPageLabel' => <?= $generator->generateString('Last').",\n" ?>
            ],
<?php if ($generator->searchModelClass !== ''): ?>
            'filterModel' => $searchModel,
<?php endif; ?>
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'headerRowOptions' => ['class'=>'x'],
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
<?php
        $count = 0;
        foreach ($safeAttributes as $attribute) {
            $format = trim($generator->columnFormat($attribute, $model));
            if ($format == false) {
                continue;
            }

            ++$count;

            if ($count >= $generator->gridMaxColumns) {
                echo "                //".str_replace("\n", "\n                //", $format).",\n"; 
            } else {
                echo "                ".str_replace("\n", "\n                ", $format).",\n";                
            }
        }
?>
                [
                    'class' => '<?= $generator->actionButtonClass ?>',
                    'template' => $actionColumnTemplateString,
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            $options = [
                                'title' => Yii::t('<?=$generator->messageCategory?>', 'View'),
                                'aria-label' => Yii::t('<?=$generator->messageCategory?>', 'View'),
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, $options);
                        }
                    ],
                    'urlCreator' => function($action, $model, $key, $index) {
                        // using the column name as key, not mapping to 'id' like the standard generator
                        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                        $params[0] = Yii::$app->controller->id ? Yii::$app->controller->id.'/'.$action : $action;
                        return Url::toRoute($params);
                    },
                    'contentOptions' => ['nowrap'=>'nowrap']
                ],
            ],
        ]);
        ?>
    </div>

    <?= "<?php "; ?>\yii\widgets\Pjax::end() ?>
<?php else: ?>
    <?= '<?=\n' ?>
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]); ?>
<?php endif; ?>

</div>

