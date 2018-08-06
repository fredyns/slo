<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;
use app\modules\location\Module;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\location\models\TypeLang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-lang-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'TypeLang',
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

        <!-- attribute type_id -->
        <?= $form->field($model, 'type_id')->textInput(['readonly' => "readonly"])->label(Module::t('models', 'Type ID')) ?>

        <!-- current label for attribute type_id -->
        <div class="form-group field-type-label">
            <label class="control-label col-sm-2" for="type_name"><?= Module::t('models', 'Type Label') ?></label>
            <div class="col-sm-8">
                <?php
                $type_name = ArrayHelper::getValue($model, 'type.name');
                $type_options = [
                    'id' => "type-label",
                    'class' => "form-control",
                    'aria-invalid' => "false",
                    'disabled' => "disabled",
                    'readonly' => "readonly",
                ];

                echo Html::textInput('type_name', $type_name, $type_options);
                ?>
            </div>
        </div>

        <!-- attribute language -->
        <?=
            $form
            ->field($model, 'language')
            ->widget(Select2::classname(), [
                'data' => Yii::$app->getModule('location')->locales,
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

        <!-- attribute abbreviation -->
        <?= $form->field($model, 'abbreviation')->textInput(['maxlength' => true]) ?>

        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-group field-type-lang-submit">
            <label class="control-label col-sm-2" for="save-type-lang">&nbsp;</label>
            <div class="col-sm-8">
                <?=
                Html::submitButton(
                    '<span class="glyphicon glyphicon-floppy-disk"></span> '.
                    ($model->isNewRecord ? Module::t('cruds', 'Create') : Module::t('cruds', 'Save')), [
                    'id' => 'save-type-lang',
                    'class' => 'btn btn-success'
                    ]
                );
                ?>

            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

