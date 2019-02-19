<?php

use app\dictionaries\InstalationType;
use app\dictionaries\SubmissionProgressStatus;
use app\models\BussinessType;
use app\models\Owner;
use app\models\Sbu;
use app\models\Submission;
use app\models\TechnicalPersonel;
use app\models\TechnicalPic;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\DetailView;
use dmstr\bootstrap\Tabs;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use fredyns\region\Module;
use fredyns\region\models\Area;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\SubmissionForm  */

$this->title = Yii::t('label/submission', 'Apply New Request');
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];

if ($model->isNewRecord == FALSE){
    $this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud submission-request">

    <h1>
        <?= $this->title ?>

        <small>
            <?= $model->isNewRecord ? Yii::t('models', 'New') : '#'.$model->id ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-file"></span> '.Yii::t('cruds', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-remove"></span> '.Yii::t('cruds', 'Cancel'), Url::previous(), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr />

    <div class="submission-form">

        <?php
        $form = ActiveForm::begin([
                'id' => 'Submission',
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

        <!-- attribute examination_date -->
        <?=
            $form
            ->field($model, 'examination_date')
            ->textInput()
            ->widget(
                DatePicker::className(), [
                'name' => 'examination_date',
                'class' => 'form-control',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ],
                ]
            )
        ;
        ?>

        <!-- attribute instalation_type -->
        <?=
            $form
            ->field($model, 'instalation_type')
            ->label(Yii::t('label/submission', 'Instalation Type'))
            ->dropDownList(InstalationType::all(), ['prompt' => Yii::t('cruds', 'Select')]);
        ?>

        <!-- attribute owner_id -->
        <?php
        $owner_label = $model->owner_id;

        if ($owner_label > 0) {
            if (($owner = Owner::findOne($owner_label)) !== null) {
                $owner_label = $owner->name;
                }
            }
        ?>

        <?=
            $form
            ->field($model, 'owner_id')
            ->label(Yii::t('label/submission', "Owner's Name"))
            ->widget(Select2::classname(), [
                'initValueText' => $owner_label,
                'options' => ['placeholder' => Yii::t('label', 'lookup owners...')],
                'pluginOptions' => [
                    //'tags' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return '".Yii::t('label', 'waiting results')."'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['/api/owner/list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(item) { return item.text; }'),
                    'templateSelection' => new JsExpression('function (item) { return item.text; }'),
                ],
        ]);
        ?>

        <!-- attribute instalation_name -->
        <?=
            $form
            ->field($model, 'instalation_name')
            ->label(Yii::t('label/submission', "Instalation Name"))
            ->textInput(['maxlength' => true])
        ?>

        <!-- attribute instalation_location -->
        <?=
            $form
            ->field($model, 'instalation_location')
            ->label(Yii::t('label/submission', "Instalation Location"))
            ->textarea(['rows' => 3])
        ?>

        <!-- attribute instalation_regency_id -->
        <?=
            $form
            ->field($model, 'instalation_regency_id')
            ->label(Yii::t('label/submission', "Instalation Regency"))
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
                    'initialize' => (bool) $model->instalation_province_id,
                    'placeholder' => Yii::t('label', "Select city or regency"),
                    'depends' => [strtolower($model->formName()).'-instalation_province_id'],
                    'url' => Url::to([
                        "/region/api/area/subregion",
                        'selected' => $model->instalation_regency_id,
                    ]),
                    'loadingText' => Yii::t('label', "loading city and regencies..."),
                ],
        ]);
        ?>

        <!-- attribute instalation_province_id -->
        <?=
            $form
            ->field($model, 'instalation_province_id')
            ->label(Yii::t('label/submission', "Instalation Province"))
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
                    'initialize' => (bool) $model->instalation_country_id,
                    'placeholder' => Yii::t('label', "Select province"),
                    'depends' => [strtolower($model->formName()).'-instalation_country_id'],
                    'url' => Url::to([
                        "/region/api/area/subregion",
                        'selected' => $model->instalation_province_id,
                    ]),
                    'loadingText' => Yii::t('label', "loading provinces..."),
                ],
        ]);
        ?>

        <!-- attribute instalation_country_id -->
        <?=
            $form
            ->field($model, 'instalation_country_id')
            ->label(Yii::t('label/submission', "Instalation Country"))
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
        
        <div class="form-group field-submit">
            <label class="control-label col-sm-2">&nbsp;</label>
            <div class="col-sm-8">
                <?=
                Html::submitButton(
                    '<span class="glyphicon glyphicon-check"></span> '.
                    ($model->isNewRecord ? Yii::t('label/submission', 'Submit') : Yii::t('cruds', 'Save')), [
                    'id' => 'save-'.$model->formName(),
                    'class' => 'btn btn-success'
                    ]
                );
                ?>

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
