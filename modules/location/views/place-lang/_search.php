<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\location\models\search\PlaceLangSearch */
/* @var $form yii\widgets\ActiveForm  */
?>

<div class="place-lang-search">

    <?php
    $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'place_id') ?>

    <?= $form->field($model, 'language') ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group field-place-submit">
        <label class="control-label col-sm-3" for="save-place">&nbsp;</label>
        <div class="col-sm-6">
            <?= Html::submitButton(Module::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Module::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
