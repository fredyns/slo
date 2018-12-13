<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $searchModel app\models\BussinessTypeSearch */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm  */
?>

<div class="bussiness-type-search">

    <?php     $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); 
    ?>

        <?= $form->field($model, 'id') ?>

        <?php //= $form->field($model, 'created_at') ?>

        <?php //= $form->field($model, 'created_by') ?>

        <?php //= $form->field($model, 'updated_at') ?>

        <?php //= $form->field($model, 'updated_by') ?>

        <?php //= $form->field($model, 'is_deleted') ?>

        <?php //= $form->field($model, 'deleted_at') ?>

        <?php //= $form->field($model, 'deleted_by') ?>

        <?= $form->field($model, 'name') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
