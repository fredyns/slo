<?php

namespace app\modules\location\models;

use Yii;

/**
 * This is the base-model class for table "location_place_lang".
 *
 * @property string $id
 * @property string $place_id
 * @property string $language
 * @property string $name
 *
 * @property \app\modules\location\models\Place $place
 * @property string $aliasModel
 */
abstract class PlaceLang extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_place_lang}}';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return Yii::t('location-model', 'Place').' '.Yii::t('location-model', 'Langs');
        } else{
            return Yii::t('location-model', 'Place').' '.Yii::t('location-model', 'Lang');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 1024],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('location-model', 'ID'),
            'place_id' => Yii::t('location-model', 'Place'),
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
            'place_id' => Yii::t('location-model', 'Place'),
            'language' => Yii::t('location-model', 'Language'),
            'name' => Yii::t('location-model', 'Name'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(\app\modules\location\models\Place::className(), ['id' => 'place_id']);
    }

}