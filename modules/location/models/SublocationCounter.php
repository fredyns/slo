<?php

namespace app\modules\location\models;

use Yii;

/**
 * This is the base-model class for table "location_sublocation_counter".
 *
 * @property string $id
 * @property string $place_id
 * @property integer $type_id
 * @property integer $quantity
 *
 * @property \app\modules\location\models\Place $place
 * @property \app\modules\location\models\Type $type
 * @property string $aliasModel
 */
class SublocationCounter extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_sublocation_counter}}';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return Yii::t('location-model', 'Sublocation').' '.Yii::t('location-model', 'Counters');
        } else{
            return Yii::t('location-model', 'Sublocation').' '.Yii::t('location-model', 'Counter');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'type_id', 'quantity'], 'integer'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']]
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
            'type_id' => Yii::t('location-model', 'Type'),
            'quantity' => Yii::t('location-model', 'Quantity'),
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
            'type_id' => Yii::t('location-model', 'Type'),
            'quantity' => Yii::t('location-model', 'Quantity'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(\app\modules\location\models\Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(\app\modules\location\models\Type::className(), ['id' => 'type_id']);
    }

}