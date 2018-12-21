<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\InstalationGeneratorForm  */

$unit_options = [
    "kVA" => "kVA",
    "kW" => "kW",
    "MW" => "MW",
    "MVA" => "MVA",
    "kWp" => "kWp",
    "MWp" => "MWp",
];
?>

<div class="instalation-generator-form">

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
    <?= $form->field($model, 'calorific_value_file')->fileInput() ?>

    <!-- attribute capacity -->
    <?= $form->field($model, 'capacity')->textInput(['maxlength' => true]) ?>

    <!-- attribute test_capacity -->
    <?= $form->field($model, 'test_capacity')->textInput(['maxlength' => true]) ?>

    <!-- attribute capacity_unit -->
    <?=
        $form
        ->field($model, 'capacity_unit')
        ->dropDownList($unit_options, ['prompt' => Yii::t('cruds', 'Select')]);
    ?>

    <!-- attribute test_capacity_unit -->
    <?=
        $form
        ->field($model, 'test_capacity_unit')
        ->dropDownList($unit_options, ['prompt' => Yii::t('cruds', 'Select')]);
    ?>

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

    <!-- attribute fuel_consumption_rate_file_id -->
    <?= $form->field($model, 'fuel_consumption_rate_file')->fileInput() ?>

    <!-- attribute sfc -->
    <?= $form->field($model, 'sfc')->textInput(['maxlength' => true]) ?>

    <!-- attribute unit -->
    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

</div>
