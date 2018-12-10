<?php

namespace app\models;

use Yii;
use app\models\base\TechnicalPic as BaseTechnicalPic;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "technical_pic".
 *
 * @property string $aliasModel
 */
class TechnicalPic extends BaseTechnicalPic
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
            [['is_deleted', 'country_id', 'province_id', 'regency_id'], 'integer'],
          [['address'], 'string'],
          [['name'], 'string', 'max' => 512],
          [['phone', 'email'], 'string', 'max' => 64],
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
            return Yii::t('models', 'Technical Pics');
        } else{
            return Yii::t('models', 'Technical Pic');
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
            'phone' => Yii::t('models', 'Phone'),
            'email' => Yii::t('models', 'Email'),
            'address' => Yii::t('models', 'Address'),
            'country_id' => Yii::t('models', 'Country ID'),
            'province_id' => Yii::t('models', 'Province ID'),
            'regency_id' => Yii::t('models', 'Regency ID'),
        ];
    }
}
