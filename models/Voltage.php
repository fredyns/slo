<?php

namespace app\models;

use Yii;
use app\models\base\Voltage as BaseVoltage;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "voltage".
 *
 * @property string $aliasModel
 */
class Voltage extends BaseVoltage
{

    /**
     * get all record maps
     * 
     * @return array
     */
    public static function allMap()
    {
        return ArrayHelper::map(static::findAll(['is_deleted' => FALSE]), 'id', 'name');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
                parent::behaviors(), [
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
            /* //
              'string_filter' => [
              ['name'],
              'filter',
              'filter' => function($value){
              return StringCleaner::forPlaintext($value);
              },
              ],
              // */
            # default
            # required
            # type
            # format
            # option
            # constraint
            # safe
            [['name'], 'string', 'max' => 512],
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
            return Yii::t('models', 'Voltages');
        } else{
            return Yii::t('models', 'Voltage');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'created_at' => Yii::t('models', 'Created At'),
            'created_by' => Yii::t('models', 'Created By'),
            'updated_at' => Yii::t('models', 'Updated At'),
            'updated_by' => Yii::t('models', 'Updated By'),
            'is_deleted' => Yii::t('models', 'Is Deleted'),
            'deleted_at' => Yii::t('models', 'Deleted At'),
            'deleted_by' => Yii::t('models', 'Deleted By'),
            'name' => Yii::t('models', 'Name'),
        ];
    }

}