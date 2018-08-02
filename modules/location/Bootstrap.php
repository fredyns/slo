<?php

namespace app\modules\location;

use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Description of Bootstrap
 *
 * @author Fredy Nurman Saleh <email@fredyns.net>
 */
class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/location/app'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/modules/location/messages',
        ];
        $app->i18n->translations['modules/location/models'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/modules/location/messages',
        ];
        $app->i18n->translations['modules/location/cruds'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/modules/location/messages',
        ];
    }

}