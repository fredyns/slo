<?php

namespace app\modules\location\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\location\Module;
use app\modules\location\models\base\Place as BasePlace;
use app\modules\location\behaviors\PlaceTypeBehavior;

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
    public $qty;

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
    public function behaviors()
    {
        $parent = parent::behaviors();
        $addition = [
            /* automatically add new place type */
            'place_type' => [
                'class' => PlaceTypeBehavior::className(),
            ],
        ];
        return ArrayHelper::merge($parent, $addition);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /* filter */
            /* defaults */
            /* required */
            [['name'], 'required'],
            /* safe */
            /* type */
            [['sublocation_of'], 'integer'],
            [['type_id'], 'string', 'max' => 1024],
            [['latitude', 'longitude'], 'number'],
            [['name'], 'string', 'max' => 1024],
            [['region_code'], 'string', 'max' => 32],
            /* limitations */
            /* references */
            [
                ['type_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Type::className(),
                'targetAttribute' => ['type_id' => 'id'],
                'when' => function ($model, $attribute) {
                    return (is_numeric($model->$attribute));
                },
                'whenClient' => '
                    function (attribute, value) {
                        type_value = $(\'#'.$this->formName().'-type_id\').val();

                        return (type_value && isNaN(type_value));
                    }',
            ],
            [
                ['sublocation_of'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Place::className(),
                'targetAttribute' => ['sublocation_of' => 'id'],
            ],
        ];
    }

    /**
     * recount all sublocation type
     * 
     * @param integer $sublocation_id
     */
    public function recountSublocations()
    {
        $prelistedType = [0];

        // recount all prelisted sublocation type
        foreach ($this->sublocationCounters as $_counter) {
            $prelistedType[] = $_counter->type_id;
            $_counter->quantity = static::find()
                ->where([
                    'sublocation_of' => $_counter->sublocation_of,
                    'type_id' => $_counter->type_id,
                ])
                ->count();
            $_counter->save(FALSE);

        }

        // search new types
        $sql = <<<SQL
            SELECT 
                type_id, 
                COUNT(*) as qty 
            
            FROM 
                location_place
            
            WHERE
                sublocation_of = :superlocation
            AND
                type_id > 0
            AND
                type_id NOT IN (:prelisted_types)
            
            GROUP BY 
                type_id
SQL;
        $params = [
            ':superlocation' => $this->id,
            ':prelisted_types' => implode(',', $prelistedType),
        ];
        $dbCommand = Yii::$app->db->createCommand($sql, $params);
        $newTypes = $dbCommand->queryAll();

        // recount new types
        if ($newTypes) {
            foreach ($newTypes as $_type) {
                $_counter = new SublocationCounter([
                    'sublocation_of' => $this->id,
                    'type_id' => $_type['type_id'],
                    'quantity' => $_type['qty'],
                ]);
                $_counter->save(FALSE);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        $oldSuperlocation = ArrayHelper::getValue($changedAttributes, 'sublocation_of');
        $oldType = ArrayHelper::getValue($changedAttributes, 'type_id');
        $newSuperlocation = $this->sublocation_of;
        $newType = $this->type_id;

        // when any update
        if ($oldSuperlocation OR $oldType) {

            // if both updated
            if ($oldSuperlocation && $oldType) {
                // recount old clasification
                SublocationCounter::recount([
                    'sublocation_of' => $oldSuperlocation,
                    'type_id' => $oldType,
                ]);
            }
            // if any update and both column filled
            if ($newSuperlocation && $newType) {
                // recount new classification
                SublocationCounter::recount([
                    'sublocation_of' => $newSuperlocation,
                    'type_id' => $newType,
                ]);
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        if ($this->sublocation_of > 0 && $this->type_id > 0) {
            SublocationCounter::recount([
                'sublocation_of' => $this->sublocation_of,
                'type_id' => $this->type_id,
            ]);
        }

        return parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // native
            'id' => Module::t('models', 'ID'),
            'region_code' => Module::t('models', 'Region Code'),
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
        return $this->hasMany(\app\modules\location\models\SublocationCounter::className(), ['sublocation_of' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(\app\modules\location\models\PlaceLang::className(), ['place_id' => 'id']);
    }

}