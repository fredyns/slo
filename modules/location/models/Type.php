<?php

namespace app\modules\location\models;

use Yii;
use dosamigos\translateable\TranslateableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base-model class for table "location_type".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * 
 * @property string $language
 * @property string $name
 * @property string $abbreviation
 *
 * @property \app\modules\location\models\Place[] $locationPlaces
 * @property \app\modules\location\models\SublocationCounter[] $locationSublocationCounters
 * @property string $aliasModel
 */
abstract class Type extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_type}}';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return Yii::t('location-model', 'Types');
        } else{
            return Yii::t('location-model', 'Type');
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'translatable' => [
                'class' => TranslateableBehavior::className(),
                // in case you renamed your relation, you can setup its name
                // 'relation' => 'translations',
                'translationAttributes' => [
                    'name',
                    'abbreviation'
                ],
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 1024],
            [['abbreviation'], 'string', 'max' => 32],
            ['language', 'in', 'range' => (array) ResourceBundle::getLocales('')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('location-model', 'ID'),
            'created_at' => Yii::t('location-model', 'Created At'),
            'created_by' => Yii::t('location-model', 'Created By'),
            'updated_at' => Yii::t('location-model', 'Updated At'),
            'updated_by' => Yii::t('location-model', 'Updated By'),
            'language' => Yii::t('location-model', 'Language'),
            'name' => Yii::t('location-model', 'Name'),
            'abbreviation' => Yii::t('location-model', 'Abbreviation'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(), [
            'id' => Yii::t('location-model', 'ID'),
            'created_at' => Yii::t('location-model', 'Created At'),
            'created_by' => Yii::t('location-model', 'Created By'),
            'updated_at' => Yii::t('location-model', 'Updated At'),
            'updated_by' => Yii::t('location-model', 'Updated By'),
            'language' => Yii::t('location-model', 'Language'),
            'name' => Yii::t('location-model', 'Name'),
            'abbreviation' => Yii::t('location-model', 'Abbreviation'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(\app\modules\location\models\Place::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSublocationCounters()
    {
        return $this->hasMany(\app\modules\location\models\SublocationCounter::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(\app\modules\location\models\TypeLang::className(), ['type_id' => 'id']);
    }

}