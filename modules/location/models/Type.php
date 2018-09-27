<?php

namespace app\modules\location\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\location\Module;
use app\modules\location\models\base\Type as BaseType;

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
 *
 * @property \app\modules\location\models\Place[] $places
 * @property \app\modules\location\models\SublocationCounter[] $sublocationCounters
 * @property string $aliasModel
 */
class Type extends BaseType
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
            return Module::t('models', 'Types');
        } else{
            return Module::t('models', 'Type');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 1024],
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
            'created_at' => Module::t('models', 'Created At'),
            'created_by' => Module::t('models', 'Created By'),
            'updated_at' => Module::t('models', 'Updated At'),
            'updated_by' => Module::t('models', 'Updated By'),
            // translatable
            'language' => Module::t('models', 'Language'),
            'name' => Module::t('models', 'Name'),
        ];
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

    /**
     * get type options
     * 
     * @param array $condition
     * @param string|array $order
     * @return array
     */
    public static function asOptions($condition = null, $order = null)
    {
        $query = static::find()->with('translations');

        if ($condition) {
            $query->where($condition);
        }

        if ($order) {
            $query->orderBy($order);
        }

        $items = $query->all();

        return ArrayHelper::map($items, 'id', 'name');
    }

}