<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\SbuForm  */
?>

<div class="sbu-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'Sbu',
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


			<!-- attribute address -->
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

			<!-- attribute country_id -->
            <?= $form->field($model, 'country_id')->textInput(['maxlength' => true]) ?>

			<!-- attribute province_id -->
            <?= $form->field($model, 'province_id')->textInput(['maxlength' => true]) ?>

			<!-- attribute regency_id -->
            <?= $form->field($model, 'regency_id')->textInput(['maxlength' => true]) ?>

			<!-- attribute name -->
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
        </p>

        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('models', 'Sbu'),
                        'content' => $this->blocks['main'],
                        'active' => true,
                    ],
                ]
            ]
        );
        ?>

        <hr/>

        <?=  $form->errorSummary($model); ?>

        <?=
        Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' .
            ($model->isNewRecord ? Yii::t('cruds', 'Create') : Yii::t('cruds', 'Save')),
            [
            'id' => 'save-' . $model->formName(),
            'class' => 'btn btn-success'
            ]
        );
        ?>

        </div>

    <?php ActiveForm::end(); ?>

</div>

