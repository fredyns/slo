<?php

namespace app\modules\location;

use Yii;
use yii\base\InvalidConfigException;

/**
 * location module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\location\controllers';

    /**
     * {@inheritdoc}
     */
    public $defaultRoute = 'place';

    /**
     * locales used for translation
     *
     * @var array
     */
    public $locales = [
        'en-US' => 'English (US)',
        'id-ID' => 'Indonesia',
        'ru-RU' => 'Russian',
    ];

    /**
     * i18n configuration
     *
     * @var array 
     */
    public $translations = [
        'class' => 'yii\i18n\PhpMessageSource',
        'basePath' => '@app/modules/location/messages',
        'fileMap' => [
            'modules/location/app' => 'app.php',
            'modules/location/cruds' => 'cruds.php',
            'modules/location/models' => 'models.php',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // registering translation
        $this->registerTranslations();
    }

    /**
     * register module translation
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/location/*'] = $this->translations;
    }

    /**
     * Translates a message to the specified language.
     *
     * This is a shortcut method of [[\yii\i18n\I18N::translate()]].
     *
     * The translation will be conducted according to the message category and the target language will be used.
     *
     * You can add parameters to a translation message that will be substituted with the corresponding value after
     * translation. The format for this is to use curly brackets around the parameter name as you can see in the following example:
     *
     * ```php
     * $username = 'Alexander';
     * echo \Yii::t('app', 'Hello, {username}!', ['username' => $username]);
     * ```
     *
     * Further formatting of message parameters is supported using the [PHP intl extensions](http://www.php.net/manual/en/intro.intl.php)
     * message formatter. See [[\yii\i18n\I18N::translate()]] for more details.
     *
     * @param string $category the message category.
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     * @return string the translated message.
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/location/'.$category, $message, $params, $language);
    }

    /**
     * getting locales  available
     * 
     * @return array
     * @throws InvalidConfigException
     */
    public function getLocales()
    {
        $locales = $this->locales;

        if (is_array($locales)) {
            return $locales;
        } elseif ($locales instanceof \Closure) {
            return call_user_func($locales);
        } else {
            throw new InvalidConfigException("Locales config should be an array or closure.");
        }
    }

}