<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\location\models\search\PlaceSearch */
?>

<div class="place-search">

    <form action="" method="get">
        <div class="row">
            <div class="col-lg-6 col-md-offset-3">
                <div class="input-group">
                    <input name="search_name" type="text" class="form-control input-lg" placeholder="<?= Module::t('app', 'Type any place') ?>" value="<?= $searchModel->search_name ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <span class="glyphicon glyphicon-file"></span><?= Module::t('app', 'Search') ?>
                        </button>
                    </span>          
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </form>

</div>
