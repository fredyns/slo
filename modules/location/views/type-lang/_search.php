<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\location\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\location\models\search\TypeLangSearch */
/* @var $form yii\widgets\ActiveForm  */
?>

<div class="type-lang-search">

    <?php
    $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'action' => ['index'],
            'method' => 'get',
    ]);
    ?>

    <?= $form->field($searchModel, 'type_id') ?>

    <?= $form->field($searchModel, 'language') ?>

    <?= $form->field($searchModel, 'name') ?>

    <?= $form->field($searchModel, 'abbreviation') ?>

    <div class="form-group field-type-submit">
        <label class="control-label col-sm-3" for="save-place">&nbsp;</label>
        <div class="col-sm-6">
            <?= Html::submitButton(Module::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Module::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
