<?php

namespace app\modules\location\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\location\Module;
use app\modules\location\models\base\Place as BasePlace;

/**
 * This is the base-model class for table "location_place".
 *
 * @property string $id
 * @property integer $type_id
 * @property string $search_name
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
 * @property \app\modules\location\models\PlaceLang[] $translations
 * @property string $aliasModel
 */
class Place extends BasePlace
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
            return Module::t('models', 'Places');
        } else{
            return Module::t('models', 'Place');
        }
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
            [['name'], 'string', 'max' => 1024],
            [['search_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // native
            'id' => Module::t('models', 'ID'),
            'type_id' => Module::t('models', 'Type'),
            'search_name' => Module::t('models', 'Search Name'),
            'sublocation_of' => Module::t('models', 'Sublocation Of'),
            'latitude' => Module::t('models', 'Latitude'),
            'longitude' => Module::t('models', 'Longitude'),
            'created_at' => Module::t('models', 'Created At'),
            'created_by' => Module::t('models', 'Created By'),
            'updated_at' => Module::t('models', 'Updated At'),
            'updated_by' => Module::t('models', 'Updated By'),
            'language' => Module::t('models', 'Language'),
            // translatable
            'name' => Module::t('models', 'Name'),
        ];
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