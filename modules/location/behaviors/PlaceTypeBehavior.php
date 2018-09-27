<?php

namespace app\modules\location\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use app\modules\location\models\Type;

/**
 * @author fredy
 * 
 * @property \app\modules\location\models\Place $owner
 */
class PlaceTypeBehavior extends AttributeBehavior
{
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => 'type_id',
                BaseActiveRecord::EVENT_BEFORE_UPDATE => 'type_id',
            ];
        }
    }

    /**
     * Evaluates the value of the user.
     * The return result of this method will be assigned to the current attribute(s).
     * @param Event $event
     * @return mixed the value of the user.
     */
    protected function getValue($event)
    {
        $value = $this->owner->type_id;

        if (is_numeric($value)) {
            return $value;
        } else if (empty($value)) {
            return NULL;
        } else {
            $model = new Type([
                'name' => $value,
            ]);

            $model->save(FALSE);

            return $model->id;
        }
    }
}