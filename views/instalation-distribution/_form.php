<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\InstalationDistributionForm  */
?>

<div class="instalation-distribution-form">

    <!-- attribute subtype_id -->
    <?=
        $form
        ->field($model, 'subtype_id')
        ->dropDownList(\app\models\InstalationSubtype::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
    ?>

    <!-- attribute ownership_status -->
    <?=
        $form
        ->field($model, 'ownership_status')
        ->dropDownList(\app\dictionaries\OwnershipStatus::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
    ?>

    <!-- attribute voltage_id -->
    <?=
        $form
        ->field($model, 'voltage_id')
        ->dropDownList(\app\models\Voltage::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
    ?>

    <!-- attribute substation_quantity -->
    <?= $form->field($model, 'substation_quantity')->textInput() ?>

    <!-- attribute panel_quantity -->
    <?= $form->field($model, 'panel_quantity')->textInput() ?>

    <!-- attribute jtm_length_kms -->
    <?= $form->field($model, 'jtm_length_kms')->textInput(['maxlength' => true]) ?>

    <!-- attribute sktm_length_ms -->
    <?= $form->field($model, 'sktm_length_ms')->textInput(['maxlength' => true]) ?>

    <!-- attribute sutm_length_ms -->
    <?= $form->field($model, 'sutm_length_ms')->textInput(['maxlength' => true]) ?>

    <!-- attribute jtr_length_kms -->
    <?= $form->field($model, 'jtr_length_kms')->textInput(['maxlength' => true]) ?>

    <!-- attribute sktr_length_ms -->
    <?= $form->field($model, 'sktr_length_ms')->textInput(['maxlength' => true]) ?>

    <!-- attribute sutr_length_ms -->
    <?= $form->field($model, 'sutr_length_ms')->textInput(['maxlength' => true]) ?>

    <!-- attribute substation_capacity_kva -->
    <?= $form->field($model, 'substation_capacity_kva')->textInput(['maxlength' => true]) ?>

    <!-- attribute short_circuit_capacity_a -->
    <?= $form->field($model, 'short_circuit_capacity_a')->textInput(['maxlength' => true]) ?>

    <!-- attribute distribution_region -->
    <?=
        $form
        ->field($model, 'distribution_region')
        ->dropDownList(\app\dictionaries\DistributionRegion::map(), ['prompt' => Yii::t('cruds', 'Select'),]);
    ?>

</div>
