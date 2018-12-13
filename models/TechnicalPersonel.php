<?php

namespace app\models;

use Yii;
use app\models\base\TechnicalPersonel as BaseTechnicalPersonel;
use fredyns\region\models\Area;
use fredyns\stringcleaner\StringCleaner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "technical_personel".
 *
 * @property string $aliasModel
 * @property Area $country
 * @property Area $province
 * @property Area $regency
 */
class TechnicalPersonel extends BaseTechnicalPersonel
{
    const ALIAS_COUNTRY = 'country';
    const ALIAS_PROVINCE = 'province';
    const ALIAS_REGENCY = 'regency';

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
            [['address'], 'string'],
            [['country_id', 'province_id', 'regency_id'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['phone', 'email'], 'string', 'max' => 64],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Area::className(), ['id' => 'country_id'])->alias(static::ALIAS_COUNTRY);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Area::className(), ['id' => 'province_id'])->alias(static::ALIAS_PROVINCE);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegency()
    {
        return $this->hasOne(Area::className(), ['id' => 'regency_id'])->alias(static::ALIAS_REGENCY);
    }

    /**
     * Alias name of table for crud views Lists all models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return Yii::t('models', 'Technical Personels');
        } else{
            return Yii::t('models', 'Technical Personel');
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
            'country_id' => Yii::t('models', 'Country'),
            'province_id' => Yii::t('models', 'Province'),
            'regency_id' => Yii::t('models', 'City').'/'.Yii::t('models', 'Regency'),
        ];
    }

}