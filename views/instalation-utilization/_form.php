<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\InstalationUtilizationForm  */
?>

<div class="instalation-utilization-form">

    <!-- attribute subtype_id -->
    <?=
        $form
        ->field($model, 'subtype_id')
        ->dropDownList(\app\models\InstalationSubtype::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
    ?>

    <!-- attribute medium_voltage_connecting_panel_quantity -->
    <?= $form->field($model, 'medium_voltage_connecting_panel_quantity')->textInput() ?>

    <!-- attribute low_voltage_connecting_panel_quantity -->
    <?= $form->field($model, 'low_voltage_connecting_panel_quantity')->textInput() ?>

    <!-- attribute substation_transformer_kva -->
    <?= $form->field($model, 'substation_transformer_kva')->textInput(['maxlength' => true]) ?>

    <!-- attribute connected_power_kva -->
    <?= $form->field($model, 'connected_power_kva')->textInput(['maxlength' => true]) ?>

    <!-- attribute electricity_provider -->
    <?= $form->field($model, 'electricity_provider')->textInput(['maxlength' => true]) ?>

</div>

