<?php

namespace app\modules\location\models;

use Yii;
use app\modules\location\Module;

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
            return Module::t('model', 'Sublocation').' '.Module::t('model', 'Counters');
        } else{
            return Module::t('model', 'Sublocation').' '.Module::t('model', 'Counter');
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
            'id' => Module::t('model', 'ID'),
            'place_id' => Module::t('model', 'Place'),
            'type_id' => Module::t('model', 'Type'),
            'quantity' => Module::t('model', 'Quantity'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(), [
            'id' => Module::t('model', 'ID'),
            'place_id' => Module::t('model', 'Place'),
            'type_id' => Module::t('model', 'Type'),
            'quantity' => Module::t('model', 'Quantity'),
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