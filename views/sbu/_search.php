<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $searchModel app\models\SbuSearch */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm  */
?>

<div class="sbu-search">

    <?php     $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); 
    ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'created_at') ?>

        <?= $form->field($model, 'created_by') ?>

        <?= $form->field($model, 'updated_at') ?>

        <?= $form->field($model, 'updated_by') ?>

        <?php // echo $form->field($model, 'is_deleted') ?>

        <?php // echo $form->field($model, 'deleted_at') ?>

        <?php // echo $form->field($model, 'deleted_by') ?>

        <?php // echo $form->field($model, 'name') ?>

        <?php // echo $form->field($model, 'address') ?>

        <?php // echo $form->field($model, 'country_id') ?>

        <?php // echo $form->field($model, 'province_id') ?>

        <?php // echo $form->field($model, 'regency_id') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>