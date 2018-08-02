<?php

namespace app\modules\location\helpers;

use yii\helpers\ArrayHelper;

/**
 * Description of LangHelper
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class LangHelper
{

    /**
     * default locale options from PHP
     * 
     * @return array
     */
    static function localesAvailable()
    {
        return (array) \ResourceBundle::getLocales('');
    }

    /**
     * basic locales options
     * 
     * @return array
     */
    static function basicOptions()
    {
        return [
            'en-US' => 'en-US',
            'id-ID' => 'id-ID',
        ];
    }

    /**
     * complete available locales options 
     * 
     * @return array
     */
    static function completeOptions()
    {
        $options = static::basicOptions();

        foreach (static::localesAvailable() as $_locale) {
            $_locale = str_replace('_', '-', $_locale);
            if (!in_array($_locale, $options)) {
                $options[$_locale] = $_locale;
            }
        }

        return $options;
    }

}