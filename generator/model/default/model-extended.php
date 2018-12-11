<?php
/**
 * This is the template for generating the model class of a specified table.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\model\Generator $generator
 * @var string $tableName full table name
 * @var string $className class name
 * @var yii\db\TableSchema $tableSchema
 * @var string[] $labels list of attribute labels (name => label)
 * @var string[] $rules list of validation rules
 * @var array $relations list of relations (name => relation declaration)
 */

$modelName = \yii\helpers\Inflector::camel2words($className);
$softdelete = ($tableSchema->getColumn('is_deleted') !== null) && ($tableSchema->getColumn('deleted_at') !== null) && ($tableSchema->getColumn('deleted_by') !== null);

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;
use <?= $generator->ns ?>\base\<?= $className ?> as Base<?= $className ?>;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "<?= $tableName ?>".
 *
 * @property string $aliasModel
 */
class <?= $className ?> extends Base<?= $className . "\n" ?>
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            # filter
            /*//
            'string_filter' => [
                ['name'],
                'filter',
                'filter' => function($value){
                    return StringCleaner::forPlaintext($value);
                },
            ],
            //*/
            # default
            # required
            # type
            # format
            # option
            # constraint
            # safe
            <?= implode(",\n            ", $rules) . ",\n" ?>
        ];
    }
    
    /**
     * Alias name of table for crud views Lists all models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return <?= $generator->generateString(\yii\helpers\Inflector::pluralize($modelName)) ?>;
        } else{
            return <?= $generator->generateString($modelName) ?>;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
<?php 
foreach ($labels as $name => $label) {
    $label = $generator->generateString($label);
    $label = str_replace(" ID'", "'", $label);    
    echo "            '{$name}' => {$label},\n";
}
?>
        ];
    }
}
