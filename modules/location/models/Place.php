<?php

namespace app\modules\location\models;

use Yii;
use dosamigos\translateable\TranslateableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base-model class for table "location_place".
 *
 * @property string $id
 * @property integer $type_id
 * @property string $sublocation_of
 * @property double $latitude
 * @property double $longitude
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * 
 * @property string $language
 * @property string $name
 *
 * @property \app\modules\location\models\Place $sublocationOf
 * @property \app\modules\location\models\Place[] $sublocations
 * @property \app\modules\location\models\Type $type
 * @property \app\modules\location\models\SublocationCounter[] $sublocationCounters
 * @property string $aliasModel
 */
class Place extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_place}}';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return Yii::t('location-model', 'Places');
        } else{
            return Yii::t('location-model', 'Place');
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
                    'name'
                ]
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
            [['type_id', 'sublocation_of'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['sublocation_of'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['sublocation_of' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 1024],
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
            'type_id' => Yii::t('location-model', 'Type'),
            'sublocation_of' => Yii::t('location-model', 'Sublocation Of'),
            'latitude' => Yii::t('location-model', 'Latitude'),
            'longitude' => Yii::t('location-model', 'Longitude'),
            'created_at' => Yii::t('location-model', 'Created At'),
            'created_by' => Yii::t('location-model', 'Created By'),
            'updated_at' => Yii::t('location-model', 'Updated At'),
            'updated_by' => Yii::t('location-model', 'Updated By'),
            'language' => Yii::t('location-model', 'Language'),
            'name' => Yii::t('location-model', 'Name'),
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
            'type_id' => Yii::t('location-model', 'Type'),
            'sublocation_of' => Yii::t('location-model', 'Sublocation Of'),
            'latitude' => Yii::t('location-model', 'Latitude'),
            'longitude' => Yii::t('location-model', 'Longitude'),
            'created_at' => Yii::t('location-model', 'Created At'),
            'created_by' => Yii::t('location-model', 'Created By'),
            'updated_at' => Yii::t('location-model', 'Updated At'),
            'updated_by' => Yii::t('location-model', 'Updated By'),
            'language' => Yii::t('location-model', 'Language'),
            'name' => Yii::t('location-model', 'Name'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSublocationOf()
    {
        return $this->hasOne(\app\modules\location\models\Place::className(), ['id' => 'sublocation_of']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSublocations()
    {
        return $this->hasMany(\app\modules\location\models\Place::className(), ['sublocation_of' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(\app\modules\location\models\Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSublocationCounters()
    {
        return $this->hasMany(\app\modules\location\models\SublocationCounter::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(\app\modules\location\models\PlaceLang::className(), ['place_id' => 'id']);
    }

}