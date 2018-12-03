<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/*
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

<?php if ($generator->searchModelClass !== ''): ?>
/* @var $searchModel <?= ltrim($generator->searchModelClass, '\\') ?> */
<?php endif; ?>
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm  */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass), '-', true) ?>-search">

    <?= '<?php ' ?>
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); 
    ?>

<?php
$count = 0;
foreach ($generator->getTableSchema()->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "        <?= ".$generator->generateActiveSearchField($attribute)." ?>\n\n";
    } else {
        echo "        <?php // echo ".$generator->generateActiveSearchField($attribute)." ?>\n\n";
    }
}
?>
        <div class="form-group">
            <?= '<?= ' ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
            <?= '<?= ' ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-default']) ?>
        </div>

    <?= '<?php ' ?>ActiveForm::end(); ?>

</div>
