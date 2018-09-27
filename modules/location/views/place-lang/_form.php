<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;
use app\modules\location\Module;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\location\models\PlaceLang */
/* @var $form yii\widgets\ActiveForm */
/* @var $locales array */
?>

<div class="place-lang-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'PlaceLang',
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

        <!-- attribute place_id -->
        <?= $form->field($model, 'place_id')->textInput(['readonly' => "readonly"])->label(Module::t('models', 'Place ID')) ?>

        <!-- current label for attribute place_id -->
        <div class="form-group field-place-label">
            <label class="control-label col-sm-2" for="place_name"><?= Module::t('models', 'Place Label') ?></label>
            <div class="col-sm-8">
                <?php
                $place_name = ArrayHelper::getValue($model, 'place.name');
                $place_options = [
                    'id' => "place-label",
                    'class' => "form-control",
                    'aria-invalid' => "false",
                    'disabled' => "disabled",
                    'readonly' => "readonly",
                ];

                echo Html::textInput('place_name', $place_name, $place_options);
                ?>
            </div>
        </div>


        <!-- attribute language -->
        <?=
            $form
            ->field($model, 'language')
            ->widget(Select2::classname(), [
                'data' => $locales,
                'options' => [
                    'placeholder' => Module::t('app', 'Select'),
                ],
                'pluginOptions' => [
                    'allowClear' => false,
                    'tags' => true,
                ],
        ]);
        ?>
        <!-- attribute name -->
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-group field-place-lang-submit">
            <label class="control-label col-sm-2" for="save-place-lang">&nbsp;</label>
            <div class="col-sm-8">
                <?=
                Html::submitButton(
                    '<span class="glyphicon glyphicon-floppy-disk"></span> '.
                    ($model->isNewRecord ? Module::t('cruds', 'Create') : Module::t('cruds', 'Save')), [
                    'id' => 'save-place-lang',
                    'class' => 'btn btn-success'
                    ]
                );
                ?>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>

