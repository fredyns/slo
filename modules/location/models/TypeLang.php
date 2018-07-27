<?php

namespace app\modules\location\models;

use Yii;

/**
 * This is the base-model class for table "location_type_lang".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $language
 * @property string $name
 * @property string $abbreviation
 *
 * @property \app\modules\location\models\Type $type
 * @property string $aliasModel
 */
class TypeLang extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location_type_lang}}';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural = false)
    {
        if ($plural){
            return Yii::t('modules/location/model', 'Type').' '.Yii::t('modules/location/model', 'Langs');
        } else{
            return Yii::t('modules/location/model', 'Type').' '.Yii::t('modules/location/model', 'Lang');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 1024],
            [['abbreviation'], 'string', 'max' => 32],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('modules/location/model', 'ID'),
            'type_id' => Yii::t('modules/location/model', 'Type'),
            'language' => Yii::t('modules/location/model', 'Language'),
            'name' => Yii::t('modules/location/model', 'Name'),
            'abbreviation' => Yii::t('modules/location/model', 'Abbreviation'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(), [
            'id' => Yii::t('modules/location/model', 'ID'),
            'type_id' => Yii::t('modules/location/model', 'Type'),
            'language' => Yii::t('modules/location/model', 'Language'),
            'name' => Yii::t('modules/location/model', 'Name'),
            'abbreviation' => Yii::t('modules/location/model', 'Abbreviation'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(\app\modules\location\models\Type::className(), ['id' => 'type_id']);
    }

}