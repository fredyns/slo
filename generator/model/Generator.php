<?php

namespace app\generator\model;

use Yii;
use yii\gii\CodeFile;
use yii\helpers\StringHelper;
use schmunk42\giiant\helpers\SaveForm;

/**
 * This generator will generate one or multiple ActiveRecord classes for the specified database table.
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class Generator extends \schmunk42\giiant\generators\model\Generator
{
    #public $generateRelationsFromCurrentSchema = false;
    #public $useSchemaName = false;
    #public $useSoftDeleteBehavior = true;
    #public $deletedStateColumn = 'is_deleted';
    #public $deletedAtColumn = 'deleted_at';
    #public $deletedByColumn = 'deleted_by';
    public $generateHintsFromComments = false;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'My Model';
    }

    /**
     * {@inheritdoc}
     */
    public function requiredTemplates()
    {
        $templates = parent::requiredTemplates();
        $templates[] = 'model-form.php';

        Return $templates;
    }

    /**
     * {@inheritdoc}
     */
    public function generateRules($table)
    {
        $source = clone $table;
        $softdeleteCols = ['is_deleted', 'deleted_at', 'deleted_by'];

        foreach ($source->columns as $index => $column) {
            $isSoftdelete = in_array($column->name, $softdeleteCols);

            if ($isSoftdelete) {
                unset($source->columns[$index]);
            }
        }

        return parent::generateRules($source);
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $files = parent::generate();
        $relations = $this->generateRelations();
        $db = $this->getDbConnection();

        foreach ($this->getTableNames() as $tableName) {
            $className = (php_sapi_name() === 'cli' OR empty($this->modelClass)) ? $this->generateClassName($tableName) : $this->modelClass;
            $queryClassName = ($this->generateQuery) ? $this->generateQueryClassName($className) : false;
            $tableSchema = $db->getTableSchema($tableName);

            $params = [
                'tableName' => $tableName,
                'className' => $className,
                'queryClassName' => $queryClassName,
                'tableSchema' => $tableSchema,
                'labels' => $this->generateLabels($tableSchema),
                'hints' => $this->generateHints($tableSchema),
                'rules' => $this->generateRules($tableSchema),
                'relations' => isset($relations[$tableName]) ? $relations[$tableName] : [],
                'ns' => $this->ns,
                'enum' => $this->getEnum($tableSchema->columns),
            ];

            /**
             * fredyns: start
             *
             * add form model
             */
            $formFilepath = Yii::getAlias('@'.str_replace('\\', '/', $this->ns)).'/'.$className.'Form.php';

            $files[] = new CodeFile(
                $formFilepath, $this->render('model-form.php', $params)
            );
            /**
             * fredyns: end
             */
        }

        return $files;
    }

}