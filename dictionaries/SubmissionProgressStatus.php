<?php

namespace app\dictionaries;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of SubmissionProgressStatus
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
abstract class SubmissionProgressStatus
{
    const REQUEST = 0;
    const REGISTRATION = 50;
    const REGISTERED = 100;

    /**
     * @return array
     */
    public static function all()
    {
        return [
            static::REQUEST => Yii::t('dictionaries', 'Request'),
            static::REGISTRATION => Yii::t('dictionaries', 'Registration'),
            static::REGISTERED => Yii::t('dictionaries', 'Registered'),
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