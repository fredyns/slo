<?php

namespace app\dictionaries;

/**
 * Description of OwnershipStatus
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class OwnershipStatus
{
    const OWNED_BY_STATE_ENTERPRISE = 1;
    const OWNED_BY_PRIVATE = 2;
    const RENT_FROM_STATE_ENTERPRISE = 3;
    const RENT_FROM_PRIVATE = 4;

    /**
     * @return array
     */
    public static function allMap()
    {
        return [
            static::RENT_FROM_STATE_ENTERPRISE => Yii::t('dictionaries', 'Rent From State Enterprise'),
            static::RENT_FROM_PRIVATE => Yii::t('dictionaries', 'Rent From Private Company'),
            static::OWNED_BY_STATE_ENTERPRISE => Yii::t('dictionaries', 'Owned By State Enterprise'),
            static::OWNED_BY_PRIVATE => Yii::t('dictionaries', 'Owned By Private Company'),
        ];
    }

    /**
     * @param int $value
     * @return string
     */
    public static function getLabel($value)
    {
        return ArrayHelper::getValue(static::allMap(), $value, $value);
    }

}