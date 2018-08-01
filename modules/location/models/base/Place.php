<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\modules\location\models\base;

use Yii;
use dosamigos\translateable\TranslateableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

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
 * @property \app\modules\location\models\LocationPlace $sublocationOf
 * @property \app\modules\location\models\LocationPlace[] $locationPlaces
 * @property \app\modules\location\models\LocationType $type
 * @property \app\modules\location\models\LocationSublocationCounter[] $locationSublocationCounters
 * @property string $aliasModel
 */
abstract class Place extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location_place';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
            'translatable' => [
                'class' => TranslateableBehavior::className(),
                // in case you renamed your relation, you can setup its name
                // 'relation' => 'translations',
                'translationAttributes' => [
                    'name'
                ],
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
            [['search_name'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['sublocation_of'], 'exist', 'skipOnError' => true, 'targetClass' => \app\modules\location\models\LocationPlace::className(), 'targetAttribute' => ['sublocation_of' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\modules\location\models\LocationType::className(), 'targetAttribute' => ['type_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('modules/location/models', 'ID'),
            'type_id' => Yii::t('modules/location/models', 'Type ID'),
            'search_name' => Yii::t('modules/location/models', 'Search Name'),
            'sublocation_of' => Yii::t('modules/location/models', 'Sublocation Of'),
            'latitude' => Yii::t('modules/location/models', 'Latitude'),
            'longitude' => Yii::t('modules/location/models', 'Longitude'),
            'created_at' => Yii::t('modules/location/models', 'Created At'),
            'created_by' => Yii::t('modules/location/models', 'Created By'),
            'updated_at' => Yii::t('modules/location/models', 'Updated At'),
            'updated_by' => Yii::t('modules/location/models', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSublocationOf()
    {
        return $this->hasOne(\app\modules\location\models\LocationPlace::className(), ['id' => 'sublocation_of']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationPlaces()
    {
        return $this->hasMany(\app\modules\location\models\LocationPlace::className(), ['sublocation_of' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(\app\modules\location\models\LocationType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationSublocationCounters()
    {
        return $this->hasMany(\app\modules\location\models\LocationSublocationCounter::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(\app\modules\location\models\LocationPlaceLang::className(), ['place_id' => 'id']);
    }



}
