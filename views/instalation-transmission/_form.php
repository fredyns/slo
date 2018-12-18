<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\InstalationTransmissionForm  */
?>

<div class="instalation-transmission-form">

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

    <!-- attribute network_id -->
    <?=
        $form
        ->field($model, 'network_id')
        ->dropDownList(\app\models\TransmissionNetwork::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
    ?>

    <!-- attribute voltage_id -->
    <?=
        $form
        ->field($model, 'voltage_id')
        ->dropDownList(\app\models\Voltage::allMap(), ['prompt' => Yii::t('cruds', 'Select'),]);
    ?>

    <!-- attribute jtet -->
    <?= $form->field($model, 'jtet')->textInput(['maxlength' => true]) ?>

    <!-- attribute jtt -->
    <?= $form->field($model, 'jtt')->textInput(['maxlength' => true]) ?>

    <!-- attribute power_house_capacity -->
    <?= $form->field($model, 'power_house_capacity')->textInput(['maxlength' => true]) ?>

    <!-- attribute tower -->
    <?= $form->field($model, 'tower')->textInput(['maxlength' => true]) ?>

    <!-- attribute line_bay -->
    <?= $form->field($model, 'line_bay')->textInput(['maxlength' => true]) ?>

    <!-- attribute bus_coupler_bay -->
    <?= $form->field($model, 'bus_coupler_bay')->textInput(['maxlength' => true]) ?>

    <!-- attribute transformer_bay -->
    <?= $form->field($model, 'transformer_bay')->textInput(['maxlength' => true]) ?>

    <!-- attribute power_breaker_capacity -->
    <?= $form->field($model, 'power_breaker_capacity')->textInput(['maxlength' => true]) ?>

    <!-- attribute power_transformer_capacity -->
    <?= $form->field($model, 'power_transformer_capacity')->textInput(['maxlength' => true]) ?>

</div>

