<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\JsExpression;
use dmstr\bootstrap\Tabs;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use fredyns\region\Module;
use fredyns\region\models\Area;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\TechnicalPersonelForm  */

// default is indonesia
if (!$model->country_id) {
    $model->country_id = 1;
}
?>

<div class="technical-personel-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'TechnicalPersonel',
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

			<!-- attribute name -->
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			<!-- attribute phone -->
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

			<!-- attribute email -->
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

			<!-- attribute address -->
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

            <!-- attribute regency_id -->
            <?=
                $form
                ->field($model, 'regency_id')
                ->widget(DepDrop::classname(), [
                    'data' => [],
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => [
                        'pluginOptions' => [
                            'multiple' => FALSE,
                            'allowClear' => TRUE,
                        //'tags' => TRUE,
                        //'maximumInputLength' => 255,
                        ],
                    ],
                    'pluginOptions' => [
                        'initialize' => (bool) $model->province_id,
                        'placeholder' => Yii::t('label', "Select city or regency"),
                        'depends' => [strtolower($model->formName()).'-province_id'],
                        'url' => Url::to([
                            "/region/api/area/subregion",
                            'selected' => $model->regency_id,
                        ]),
                        'loadingText' => Yii::t('label', "loading city and regencies..."),
                    ],
            ]);
            ?>

            <!-- attribute province_id -->
            <?=
                $form
                ->field($model, 'province_id')
                ->widget(DepDrop::classname(), [
                    'data' => [],
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => [
                        'pluginOptions' => [
                            'multiple' => FALSE,
                            'allowClear' => TRUE,
                        //'tags' => TRUE,
                        //'maximumInputLength' => 255,
                        ],
                    ],
                    'pluginOptions' => [
                        'initialize' => (bool) $model->country_id,
                        'placeholder' => Yii::t('label', "Select province"),
                        'depends' => [strtolower($model->formName()).'-country_id'],
                        'url' => Url::to([
                            "/region/api/area/subregion",
                            'selected' => $model->province_id,
                        ]),
                        'loadingText' => Yii::t('label', "loading provinces..."),
                    ],
            ]);
            ?>

            <!-- attribute country_id -->
            <?=
                $form
                ->field($model, 'country_id')
                ->widget(Select2::classname(), [
                    'data' => Area::asOptionRoot(),
                    'pluginOptions' =>
                    [
                        'placeholder' => Yii::t('label', "Select country"),
                        'multiple' => FALSE,
                        'allowClear' => TRUE,
                    //'tags' => TRUE,
                    //'maximumInputLength' => 255,
                    ],
            ]);
            ?>

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
            '<span class="glyphicon glyphicon-check"></span> ' .
            ($model->isNewRecord ? Yii::t('cruds', 'Create') : Yii::t('cruds', 'Save')),
            [
            'id' => 'save-'.$model->formName(),
            'class' => 'btn btn-success'
            ]
        );
        ?>

        </div>

    <?php ActiveForm::end(); ?>

</div>

