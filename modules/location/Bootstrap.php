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
        /* @var $locationModule \app\modules\location\Module */
        $locationModule = $app->getModule('location');
        $locationModule->registerTranslations();
    }

}