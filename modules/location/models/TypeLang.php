<?php

namespace app\modules\location\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\location\Module;
use app\modules\location\models\base\TypeLang as BaseTypeLang;

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
class TypeLang extends BaseTypeLang
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
            return Module::t('models', 'Type Translations');
        } else{
            return Module::t('models', 'Type Translation');
        }
    }

    /**
     * get type abbreviation
     * display full name when abbreviation is empty
     * 
     * @return string
     */
    public function getAbbreviation()
    {
        $value = $this->getAttribute('abbreviation');

        return $value ? $value : $this->name;
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
            'id' => Module::t('models', 'ID'),
            'type_id' => Module::t('models', 'Type'),
            'language' => Module::t('models', 'Language'),
            'name' => Module::t('models', 'Name'),
            'abbreviation' => Module::t('models', 'Abbreviation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(\app\modules\location\models\Type::className(), ['id' => 'type_id']);
    }

}