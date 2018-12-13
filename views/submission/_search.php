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

        <?php //= $form->field($model, 'created_at') ?>

        <?php //= $form->field($model, 'created_by') ?>

        <?php //= $form->field($model, 'updated_at') ?>

        <?php //= $form->field($model, 'updated_by') ?>

        <?php //= $form->field($model, 'is_deleted') ?>

        <?php //= $form->field($model, 'deleted_at') ?>

        <?php //= $form->field($model, 'deleted_by') ?>

        <?= $form->field($model, 'agenda_number') ?>

        <?= $form->field($model, 'progress_status') ?>

        <?= $form->field($model, 'examination_date') ?>

        <?= $form->field($model, 'owner_id') ?>

        <?= $form->field($model, 'instalation_name') ?>

        <?php //= $form->field($model, 'instalation_location') ?>

        <?php //= $form->field($model, 'instalation_country_id') ?>

        <?php //= $form->field($model, 'instalation_province_id') ?>

        <?php //= $form->field($model, 'instalation_regency_id') ?>

        <?php //= $form->field($model, 'instalation_latitude') ?>

        <?php //= $form->field($model, 'instalation_longitude') ?>

        <?php //= $form->field($model, 'bussiness_type_id') ?>

        <?php //= $form->field($model, 'sbu_id') ?>

        <?php //= $form->field($model, 'technical_pic_id') ?>

        <?php //= $form->field($model, 'technical_personel_id') ?>

        <?php //= $form->field($model, 'report_number') ?>

        <?php //= $form->field($model, 'report_file_id') ?>

        <?php //= $form->field($model, 'requested_at') ?>

        <?php //= $form->field($model, 'requested_by') ?>

        <?php //= $form->field($model, 'registering_at') ?>

        <?php //= $form->field($model, 'registering_by') ?>

        <?php //= $form->field($model, 'registered_at') ?>

        <?php //= $form->field($model, 'registered_by') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
