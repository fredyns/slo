<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $searchModel app\models\SubmissionSearch */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm  */
?>

<div class="submission-search">

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

        <?php // echo $form->field($model, 'agenda_number') ?>

        <?php // echo $form->field($model, 'progress_status') ?>

        <?php // echo $form->field($model, 'examination_date') ?>

        <?php // echo $form->field($model, 'owner_id') ?>

        <?php // echo $form->field($model, 'instalation_name') ?>

        <?php // echo $form->field($model, 'instalation_location') ?>

        <?php // echo $form->field($model, 'instalation_country_id') ?>

        <?php // echo $form->field($model, 'instalation_province_id') ?>

        <?php // echo $form->field($model, 'instalation_regency_id') ?>

        <?php // echo $form->field($model, 'instalation_latitude') ?>

        <?php // echo $form->field($model, 'instalation_longitude') ?>

        <?php // echo $form->field($model, 'bussiness_type_id') ?>

        <?php // echo $form->field($model, 'sbu_id') ?>

        <?php // echo $form->field($model, 'technical_pic_id') ?>

        <?php // echo $form->field($model, 'technical_personel_id') ?>

        <?php // echo $form->field($model, 'report_number') ?>

        <?php // echo $form->field($model, 'report_file_id') ?>

        <?php // echo $form->field($model, 'requested_at') ?>

        <?php // echo $form->field($model, 'requested_by') ?>

        <?php // echo $form->field($model, 'registering_at') ?>

        <?php // echo $form->field($model, 'registering_by') ?>

        <?php // echo $form->field($model, 'registered_at') ?>

        <?php // echo $form->field($model, 'registered_by') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
