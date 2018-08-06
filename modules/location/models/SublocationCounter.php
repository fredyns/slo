<?php

namespace app\modules\location\models;

use Yii;
use app\modules\location\Module;

/**
 * This is the base-model class for table "location_sublocation_counter".
 *
 * @property string $id
 * @property string $sublocation_of
 * @property integer $type_id
 * @property integer $quantity
 *
 * @property \app\modules\location\models\Place $sublocationOf
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
            return Module::t('models', 'Sublocation').' '.Module::t('models', 'Counters');
        } else{
            return Module::t('models', 'Sublocation').' '.Module::t('models', 'Counter');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sublocation_of', 'type_id', 'quantity'], 'integer'],
            [['sublocation_of'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['sublocation_of' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']]
        ];
    }

    /**
     * recount sublocations for any place
     * 
     * @param array $params container list of pair to define which place-type in a superlocation to count. 
     * Every pair consist of 'sublocation_of` and 'type_id' key
     */
    public static function recount($params)
    {
        foreach ($params as $_pair) {
            if (!is_array($_pair)) {
                continue;
            }
            $sublocationCounter = static::findOne($_pair);
            if (empty($sublocationCounter)) {
                $sublocationCounter = new static($_pair);
            }
            $sublocationCounter->quantity = Place::find()->where($_pair)->count();
            $sublocationCounter->save(FALSE);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('models', 'ID'),
            'sublocation_of' => Module::t('models', 'Place'),
            'type_id' => Module::t('models', 'Type'),
            'quantity' => Module::t('models', 'Quantity'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(), [
            'id' => Module::t('models', 'ID'),
            'sublocation_of' => Module::t('models', 'Place'),
            'type_id' => Module::t('models', 'Type'),
            'quantity' => Module::t('models', 'Quantity'),
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
    public function getType()
    {
        return $this->hasOne(\app\modules\location\models\Type::className(), ['id' => 'type_id']);
    }

}