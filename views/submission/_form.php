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
use dmstr\bootstrap\Tabs;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use fredyns\region\Module;
use fredyns\region\models\Area;

/* @var $this yii\web\View  */
/* @var $form yii\widgets\ActiveForm  */
/* @var $model app\models\SubmissionForm  */
?>

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

    <div class="">

        <?php $this->beginBlock('main'); ?>

        <p>

            <!-- attribute progress_status -->
            <?=
                $form
                ->field($model, 'progress_status')
                ->dropDownList(SubmissionProgressStatus::all(), ['prompt' => Yii::t('cruds', 'Select')]);
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

            <!-- attribute instalation_country_id -->
            <?=
                $form
                ->field($model, 'instalation_country_id')
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

            <!-- attribute instalation_province_id -->
            <?=
                $form
                ->field($model, 'instalation_province_id')
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

            <!-- attribute instalation_regency_id -->
            <?=
                $form
                ->field($model, 'instalation_regency_id')
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

            <!-- attribute bussiness_type_id -->
            <?=
                $form
                ->field($model, 'bussiness_type_id')
                ->dropDownList(ArrayHelper::map(BussinessType::find()->all(), 'id', 'name'), ['prompt' => Yii::t('cruds', 'Select')]);
            ?>

            <!-- attribute sbu_id -->
            <?php
            $sbu_label = $model->sbu_id;

            if ($sbu_label > 0) {
                if (($sbu = Sbu::findOne($sbu_label)) !== null) {
                    $sbu_label = $sbu->name;
                }
            }
            ?>

            <?=
                $form
                ->field($model, 'sbu_id')
                ->widget(Select2::classname(), [
                    'initValueText' => $sbu_label,
                    'options' => ['placeholder' => Yii::t('label', 'lookup SBU...')],
                    'pluginOptions' => [
                        //'tags' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return '".Yii::t('label', 'waiting results')."'; }"),
                        ],
                        'ajax' => [
                            'url' => Url::to(['/api/sbu/list']),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(item) { return item.text; }'),
                        'templateSelection' => new JsExpression('function (item) { return item.text; }'),
                    ],
            ]);
            ?>


            <!-- attribute technical_pic_id -->
            <?=
                $form
                ->field($model, 'technical_pic_id')
                ->dropDownList(ArrayHelper::map(TechnicalPic::find()->all(), 'id', 'name'), ['prompt' => Yii::t('cruds', 'Select'),]);
            ?>

            <!-- attribute technical_personel_id -->
            <?=
                $form
                ->field($model, 'technical_personel_id')
                ->dropDownList(ArrayHelper::map(TechnicalPersonel::find()->all(), 'id', 'name'), ['prompt' => Yii::t('cruds', 'Select'),]);
            ?>

            <!-- attribute instalation_location -->
            <?= $form->field($model, 'instalation_location')->textarea(['rows' => 6]) ?>

            <!-- attribute instalation_latitude -->
            <?= $form->field($model, 'instalation_latitude')->textInput(['maxlength' => true]) ?>

            <!-- attribute instalation_longitude -->
            <?= $form->field($model, 'instalation_longitude')->textInput(['maxlength' => true]) ?>

            <!-- attribute agenda_number -->
            <?= $form->field($model, 'agenda_number')->textInput(['maxlength' => true]) ?>

            <!-- attribute report_number -->
            <?= $form->field($model, 'report_number')->textInput(['maxlength' => true]) ?>

            <!-- attribute instalation_name -->
            <?= $form->field($model, 'instalation_name')->textInput(['maxlength' => true]) ?>

            <!-- attribute examination_date -->
            <?= $form->field($model, 'examination_date')->textInput() ?>

        </p>

        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('submisson'); ?>

        <p>

            <!-- attribute agenda_number -->
            <?= $form->field($model, 'agenda_number')->textInput(['maxlength' => true]) ?>

            <!-- attribute progress_status -->
            <?=
                $form
                ->field($model, 'progress_status')
                ->dropDownList(SubmissionProgressStatus::all(), ['prompt' => Yii::t('cruds', 'Select')]);
            ?>

        </p>

        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('owner'); ?>

        <p>

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

            <!-- attribute bussiness_type_id -->
            <?=
                $form
                ->field($model, 'bussiness_type_id')
                ->dropDownList(ArrayHelper::map(BussinessType::find()->all(), 'id', 'name'), ['prompt' => Yii::t('cruds', 'Select')]);
            ?>

            <!-- attribute sbu_id -->
            <?php
            $sbu_label = $model->sbu_id;

            if ($sbu_label > 0) {
                if (($sbu = Sbu::findOne($sbu_label)) !== null) {
                    $sbu_label = $sbu->name;
                }
            }
            ?>

            <?=
                $form
                ->field($model, 'sbu_id')
                ->widget(Select2::classname(), [
                    'initValueText' => $sbu_label,
                    'options' => ['placeholder' => Yii::t('label', 'lookup SBU...')],
                    'pluginOptions' => [
                        //'tags' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return '".Yii::t('label', 'waiting results')."'; }"),
                        ],
                        'ajax' => [
                            'url' => Url::to(['/api/sbu/list']),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(item) { return item.text; }'),
                        'templateSelection' => new JsExpression('function (item) { return item.text; }'),
                    ],
            ]);
            ?>

        </p>

        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('instalation'); ?>

        <p>

            <!-- attribute instalation_name -->
            <?= $form->field($model, 'instalation_name')->textInput(['maxlength' => true]) ?>

            <!-- attribute instalation_type -->
            <?=
                $form
                ->field($model, 'instalation_type')
                ->dropDownList(InstalationType::all(), ['prompt' => Yii::t('cruds', 'Select')]);
            ?>

            <!-- attribute instalation_location -->
            <?= $form->field($model, 'instalation_location')->textarea(['rows' => 6]) ?>

            <!-- attribute instalation_regency_id -->
            <?=
                $form
                ->field($model, 'instalation_regency_id')
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

            <!-- attribute instalation_latitude -->
            <?= $form->field($model, 'instalation_latitude')->textInput(['maxlength' => true]) ?>

            <!-- attribute instalation_longitude -->
            <?= $form->field($model, 'instalation_longitude')->textInput(['maxlength' => true]) ?>

        </p>

        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('technical'); ?>

        <p>

        <div id="generator-form" class="technical-form">
            <?= $this->render('/instalation-generator/_form', ['model' => $model->generator, 'form' => $form,]); ?>
        </div>

        <div id="transmission-form" class="technical-form">
            <?= $this->render('/instalation-transmission/_form', ['model' => $model->transmission, 'form' => $form,]); ?>
        </div>

        <div id="distribution-form" class="technical-form">
            <?= $this->render('/instalation-distribution/_form', ['model' => $model->distribution, 'form' => $form,]); ?>
        </div>

        <div id="utilization-form" class="technical-form">
            <?= $this->render('/instalation-utilization/_form', ['model' => $model->utilization, 'form' => $form,]); ?>
        </div>

        <div id="no-technical-form" class="technical-form">
            <?= Yii::t('message', 'select instalation type first'); ?>
        </div>

        </p>

        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('examination'); ?>

        <p>

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
            );
            ?>

            <!-- attribute technical_pic_id -->
            <?=
                $form
                ->field($model, 'technical_pic_id')
                ->dropDownList(ArrayHelper::map(TechnicalPic::find()->all(), 'id', 'name'), ['prompt' => Yii::t('cruds', 'Select'),]);
            ?>

            <!-- attribute technical_personel_id -->
            <?=
                $form
                ->field($model, 'technical_personel_id')
                ->dropDownList(ArrayHelper::map(TechnicalPersonel::find()->all(), 'id', 'name'), ['prompt' => Yii::t('cruds', 'Select'),]);
            ?>

        </p>

        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('report'); ?>

        <p>

            <!-- attribute report_number -->
            <?= $form->field($model, 'report_number')->textInput(['maxlength' => true]) ?>

            <!-- attribute report_file -->
            <?= $form->field($model, 'report_file')->fileInput() ?>

        </p>

        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => $model->aliasModel,
                    'content' => $this->blocks['submisson'],
                    'active' => true,
                ],
                [
                    'label' => Yii::t('models', 'Instalation'),
                    'content' => $this->blocks['instalation'],
                ],
                [
                    'label' => Yii::t('models', 'Technical'),
                    'content' => $this->blocks['technical'],
                ],
                [
                    'label' => Yii::t('models', 'Owner'),
                    'content' => $this->blocks['owner'],
                ],
                [
                    'label' => Yii::t('models', 'Examination'),
                    'content' => $this->blocks['examination'],
                ],
                [
                    'label' => Yii::t('models', 'Report'),
                    'content' => $this->blocks['report'],
                ],
            ],
        ]);
        ?>

        <hr/>

        <?= $form->errorSummary($model); ?>

        <?=
        Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> '.
            ($model->isNewRecord ? Yii::t('cruds', 'Create') : Yii::t('cruds', 'Save')), [
            'id' => 'save-'.$model->formName(),
            'class' => 'btn btn-success'
            ]
        );
        ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    var technical_forms = {
        "<?= InstalationType::GENERATOR ?>": "generator-form",
        "<?= InstalationType::TRANSMISSION ?>": "transmission-form",
        "<?= InstalationType::DISTRIBUTION ?>": "distribution-form",
        "<?= InstalationType::UTILIZATION ?>": "utilization-form"
    };
</script>

<?php
$js = $this->render('_form.js');
$this->registerJs($js, \yii\web\View::POS_READY);
