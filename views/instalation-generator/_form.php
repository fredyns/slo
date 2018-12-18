<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\InstalationGeneratorForm  */
?>

<div class="instalation-generator-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'InstalationGenerator',
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
    ]);
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <!-- attribute subtype_id -->
            <?=
                $form
                ->field($model, 'subtype_id')
                ->dropDownList(\app\models\InstalationSubtype::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
            ?>

            <!-- attribute fuel_id -->
            <?=
                $form
                ->field($model, 'fuel_id')
                ->dropDownList(\app\models\Fuel::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
            ?>

            <!-- attribute module_quantity -->
            <?= $form->field($model, 'module_quantity')->textInput() ?>

            <!-- attribute inverter_quantity -->
            <?= $form->field($model, 'inverter_quantity')->textInput() ?>

            <!-- attribute calorific_value_file_id -->
            <?= $form->field($model, 'calorific_value_file_id')->textInput() ?>

            <!-- attribute capacity -->
            <?= $form->field($model, 'capacity')->textInput(['maxlength' => true]) ?>

            <!-- attribute test_capacity -->
            <?= $form->field($model, 'test_capacity')->textInput(['maxlength' => true]) ?>

            <!-- attribute capacity_unit -->
            <?= $form->field($model, 'capacity_unit')->textInput(['maxlength' => true]) ?>

            <!-- attribute test_capacity_unit -->
            <?= $form->field($model, 'test_capacity_unit')->textInput(['maxlength' => true]) ?>

            <!-- attribute unit_number -->
            <?= $form->field($model, 'unit_number')->textInput(['maxlength' => true]) ?>

            <!-- attribute turbine_serial_number -->
            <?= $form->field($model, 'turbine_serial_number')->textInput(['maxlength' => true]) ?>

            <!-- attribute generator_serial_number -->
            <?= $form->field($model, 'generator_serial_number')->textInput(['maxlength' => true]) ?>

            <!-- attribute each_module_capacity -->
            <?= $form->field($model, 'each_module_capacity')->textInput(['maxlength' => true]) ?>

            <!-- attribute each_inverter_capacity -->
            <?= $form->field($model, 'each_inverter_capacity')->textInput(['maxlength' => true]) ?>

            <!-- attribute calorific_value -->
            <?= $form->field($model, 'calorific_value')->textInput(['maxlength' => true]) ?>

            <!-- attribute fuel_consumption_hhv -->
            <?= $form->field($model, 'fuel_consumption_hhv')->textInput(['maxlength' => true]) ?>

            <!-- attribute fuel_consumption_lhv -->
            <?= $form->field($model, 'fuel_consumption_lhv')->textInput(['maxlength' => true]) ?>

            <!-- attribute sfc -->
            <?= $form->field($model, 'sfc')->textInput(['maxlength' => true]) ?>

            <!-- attribute unit -->
            <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

        </p>

        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => $model->aliasModel,
                    'content' => $this->blocks['main'],
                    'active' => true,
                ],
            ],
        ]);
        ?>

        <hr/>

        <?= $form->errorSummary($model); ?>

        <?=
        Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> '.
            ($model->isNewRecord ? Yii::t('cruds', 'Create') : Yii::t('cruds', 'Save')), [
            'id' => 'save-'.$model->formName(),
            'class' => 'btn btn-success'
            ]
        );
        ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

