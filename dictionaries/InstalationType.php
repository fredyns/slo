<?php

namespace app\dictionaries;

/**
 * Description of InstalationType
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class InstalationType
{
    const GENERATOR = 10;
    const TRANSMISSION = 20;
    const DISTRIBUTION = 30;
    const UTILIZATION = 40;

    /**
     * @return array
     */
    public static function all()
    {
        return [
            static::GENERATOR => Yii::t('dictionaries', 'Generator'),
            static::TRANSMISSION => Yii::t('dictionaries', 'Transmission'),
            static::DISTRIBUTION => Yii::t('dictionaries', 'Distribution'),
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