<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dmstr\bootstrap\Tabs;
use kartik\select2\Select2;
use yii\helpers\StringHelper;
use app\modules\location\Module;
use app\modules\location\models\Type;

/* @var $this yii\web\View */
/* @var $model app\modules\location\models\Place */
/* @var yii\widgets\ActiveForm $form */
?>

<div class="place-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'Place',
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

    <!-- hidden attributes -->
    <div style="display: none;">

        <!-- attribute sublocation_of -->
        <?= $form->field($model, 'sublocation_of')->hiddenInput() ?>

    </div>

    <div class="">

        <!-- attribute name -->
        <?= $form->field($model, 'name')->textInput() ?>

        <!-- attribute type_id -->
        <?=
            $form
            ->field($model, 'type_id')
            ->widget(Select2::classname(), [
                'data' => Type::asOptions(),
                'options' => [
                    'placeholder' => Module::t('app', 'Select'),
                ],
                'pluginOptions' => [
                    'allowClear' => false,
                    'tags' => true,
                ],
        ]);
        ?>

        <!-- display label for attribute sublocation_of -->
        <div class="form-group field-place-sublocation_of">
            <label class="control-label col-sm-2" for="place-sublocation_of-label"><?= Module::t('models', 'Sublocation Of') ?></label>
            <div class="col-sm-8">
                <?php
                $superlocation_name = ArrayHelper::getValue($model, 'sublocationOf.name', '-');
                $superlocation_options = [
                    'id' => "place-sublocation_of-label",
                    'class' => "form-control",
                    'aria-invalid' => "false",
                    'disabled' => "disabled",
                    'readonly' => "readonly",
                ];

                echo Html::textInput('superlocation_name', $superlocation_name, $superlocation_options);
                ?>
                <p class="help-block help-block-error "></p>
            </div>
        </div>

        <hr/>

        <!-- attribute region_code -->
        <?= $form->field($model, 'region_code')->textInput() ?>

        <!-- attribute latitude -->
        <?= $form->field($model, 'latitude')->textInput() ?>

        <!-- attribute longitude -->
        <?= $form->field($model, 'longitude')->textInput() ?>

        <hr/>

        <?= $form->errorSummary($model); ?>

        <!-- display label for attribute sublocation_of -->
        <div class="form-group field-place-submit">
            <label class="control-label col-sm-2" for="save-place">&nbsp;</label>
            <div class="col-sm-8">
                <?=
                Html::submitButton(
                    '<span class="glyphicon glyphicon-floppy-disk"></span> '.
                    ($model->isNewRecord ? Module::t('cruds', 'Create') : Module::t('cruds', 'Save')), [
                    'id' => 'save-place',
                    'class' => 'btn btn-success'
                    ]
                );
                ?>

            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

