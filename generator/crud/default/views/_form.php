<?php

use yii\helpers\StringHelper;

/* @var $this yii\web\View  */
/* @var $generator yii\gii\generators\crud\Generator  */

/** @var \yii\db\ActiveRecord $model */
## TODO: move to generator (?); cleanup
$model = new $generator->modelClass();
$model->setScenario('crud');
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $model->setScenario('default');
    $safeAttributes = $model->safeAttributes();
}
if (empty($safeAttributes)) {
    $safeAttributes = $model->getTableSchema()->columnNames;
}

echo "<?php\n";
?>

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?>Form  */
?>

<div class="<?= \yii\helpers\Inflector::camel2id(StringHelper::basename($generator->modelClass), '-', true) ?>-form">

    <?= "<?php\n" ?>
    $form = ActiveForm::begin([
            'id' => '<?= $model->formName() ?>',
            'layout' => '<?= $generator->formLayout ?>',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-danger',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    #'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
    ]);
    ?>

    <div class="">
        <?= "<?php \$this->beginBlock('main'); ?>\n"; ?>

        <p>
<?php
foreach ($safeAttributes as $attribute) {
    echo "\n\n			<!-- attribute {$attribute} -->";
    $prepend = $generator->prependActiveField($attribute, $model);
    $field = $generator->activeField($attribute, $model);
    $append = $generator->appendActiveField($attribute, $model);

    if ($prepend) {
        echo "\n            ".$prepend;
    }
    if ($field) {
        echo "\n            <?= ".$field.' ?>';
    }
    if ($append) {
        echo "\n            ".$append;
    }
}

echo "\n";
?>
            
        </p>

        <?= "<?php \$this->endBlock(); ?>\n"; ?>

<?="        <?=\n"?>
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => $model->aliasModel,
                        'content' => $this->blocks['main'],
                        'active' => true,
                    ],
                ]
            ]
        );
        ?>

        <hr/>

        <?= '<?= ' ?>$form->errorSummary($model); ?>

        <?= "<?=\n" ?>
        Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' .
            ($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Save') ?>),
            [
            'id' => 'save-'.$model->formName(),
            'class' => 'btn btn-success'
            ]
        );
        ?>

        </div>

    <?= '<?php ' ?>ActiveForm::end(); ?>

</div>

