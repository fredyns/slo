<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;
use app\modules\location\Module;
use app\modules\location\models\Type;

/* @var $this yii\web\View */
/* @var $model app\modules\location\models\Type */
/* @var yii\widgets\ActiveForm $form */
?>

<div class="type-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'Type',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-danger',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    #'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
            ]
    );
    ?>

    <div class="">

        <!-- attribute name -->
        <?= $form->field($model, 'name')->textInput() ?>

        <!-- attribute abbreviation -->
        <?= $form->field($model, 'abbreviation')->textInput() ?>


        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <!-- display label for attribute sublocation_of -->
        <div class="form-group field-type-submit">
            <label class="control-label col-sm-2" for="save-type">&nbsp;</label>
            <div class="col-sm-8">
                <?=
                Html::submitButton(
                    '<span class="glyphicon glyphicon-floppy-disk"></span> '.
                    ($model->isNewRecord ? Module::t('cruds', 'Create') : Module::t('cruds', 'Save')), [
                    'id' => 'save-type',
                    'class' => 'btn btn-success'
                    ]
                );
                ?>

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

