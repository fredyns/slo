<?php

namespace app\dictionaries;

/**
 * Description of InstalationType
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class InstalationType
{
    const GENERATOR = 1;
    const TRANSMISSION = 2;
    const UTILIZATION = 3;

    /**
     * @return array
     */
    public static function all()
    {
        return [
            static::GENERATOR => Yii::t('dictionaries', 'Generator'),
            static::TRANSMISSION => Yii::t('dictionaries', 'Transmission'),
            static::UTILIZATION => Yii::t('dictionaries', 'Utilization'),
        ];
    }

    /**
     * @param int $value
     * @return string
     */
    public static function getLabel($value)
    {
        return ArrayHelper::getValue(static::all(), $value, $value);
    }

}