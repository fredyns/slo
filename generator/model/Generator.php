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
    public $tableName = '*';
    public $useBlameableBehavior = true;
    public $generateModelClass = true;
    public $generateHintsFromComments = false;
    public $useTranslatableBehavior = false;

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
    public function getTableNames()
    {
        parent::getTableNames();

        if ($this->tableName == '*') {
            $skipTables = [
                // Yii tables
                'migration', 'yii_session',
                // uploaded file
                'uploaded_file',
                // user extension
                'user', 'profile', 'social_account', 'token',
                // rbac
                'auth_assignment', 'auth_item', 'auth_item_child', 'auth_rule',
                // menu table
                'menu',
            ];

            foreach ($skipTables as $skipTable) {
                $k = array_search($skipTable, $this->tableNames);
                if ($k !== FALSE) {
                    unset($this->tableNames[$k]);
                }
            }
        }

        return $this->tableNames;
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

        $rules = parent::generateRules($source);

        foreach ($rules as $k => $rule) {
            $rules[$k] = str_replace('self::', 'static::', $rule);

            if (strpos("'exist',", $rule) !== FALSE) {
                $rules[$k] = $this->formatFKRule($rule);
            }
        }

        return $rules;
    }

    /**
     * @param string $rule
     * @return string
     */
    public function formatFKRule($rule)
    {
        $tab3 = "\n            ";
        $tab4 = "\n                ";
        $rule = str_replace("[['", "[{$tab4}['", $rule);
        $rule = str_replace("'exist', 'skipOnError' => true, ", "{$tab4}'exist', {$tab4}'skipOnError' => true, {$tab4}", $rule);
        $rule = str_replace("'targetAttribute'", "{$tab4}'targetAttribute'", $rule);
        $rule = str_replace("]],", "],{$tab3}],", $rule);
        return $rule;
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
            /*
             * create gii/[name]GiiantModel.json with actual form data
             */
            $suffix = str_replace(' ', '', $this->getName());
            $formDataDir = Yii::getAlias('@'.str_replace('\\', '/', $this->ns));
            $formDataFile = StringHelper::dirname($formDataDir)
                .'/gii'
                .'/'.$tableName.$suffix.'.json';

            $formData = json_encode(SaveForm::getFormAttributesValues($this, $this->formAttributes()), JSON_PRETTY_PRINT);
            $files[] = new CodeFile($formDataFile, $formData);
            /**
             * fredyns: end
             */
        }

        return $files;
    }

}