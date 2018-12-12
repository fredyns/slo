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
$skipCols = ['created_at', 'created_by', 'updated_at', 'updated_by', 'is_deleted', 'deleted_at', 'deleted_by'];
foreach ($generator->getTableSchema()->getColumnNames() as $attribute) {
    if ($count < 6 && !in_array($attribute, $skipCols)) {
        echo "        <?= ".$generator->generateActiveSearchField($attribute)." ?>\n\n";
        $count++;
    } else {
        echo "        <?php //= ".$generator->generateActiveSearchField($attribute)." ?>\n\n";
    }
}
?>
        <div class="form-group">
            <?= '<?= ' ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
            <?= '<?= ' ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-default']) ?>
        </div>

    <?= '<?php ' ?>ActiveForm::end(); ?>

</div>
