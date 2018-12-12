<?php

use app\models\Owner;
use dmstr\bootstrap\Tabs;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model Owner */

$this->title = $model->aliasModel.' | '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(TRUE), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud owner-view">

    <h1>
        <?=  $model->aliasModel ?>
        <small>            
            #<?=  $model->id ?>
            
            <?php if ($model->is_deleted): ?>
                <span class="badge">deleted</span>
            <?php endif; ?>  
            
        </small>
    </h1>

    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-right'>
            <?=
            ButtonDropdown::widget([
                'label' => Yii::t('cruds', 'Edit'),
                'tagName' => 'a',
                'split' => true,
                'options' => [
                    'href' => ['update', 'id' => $model->id],
                    'class' => 'btn btn-info',
                ],
                'dropdown' => [
                    'encodeLabels' => FALSE,
                    'items' => [
                        '<li role="presentation" class="divider"></li>',
                        [
                            'label' => '<span class="glyphicon glyphicon-list"></span> '.Yii::t('cruds', 'Full list'),
                            'url' => ['index'],
                        ],
                        [
                            'label' => '<span class="glyphicon glyphicon-plus"></span> '.Yii::t('cruds', 'New'),
                            'url' => ['create'],
                        ],
                        '<li role="presentation" class="divider"></li>',
                        [
                            'label' => '<span class="glyphicon glyphicon-trash"></span> '.Yii::t('cruds', 'Delete'),
                            'url' => ['delete', 'id' => $model->id],
                            'linkOptions' => [
                                'data-confirm' => Yii::t('cruds', 'Are you sure to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => FALSE,
                                'class' => 'label label-danger',
                            ],
                            'visible' => ($model->is_deleted == FALSE),
                        ],
                        [
                            'label' => '<span class="glyphicon glyphicon-floppy-open"></span> '.Yii::t('cruds', 'Restore'),
                            'url' => ['delete', 'id' => $model->id],
                            'linkOptions' => [
                                'data-confirm' => Yii::t('cruds', 'Are you sure to restore this item?'),
                                'data-method' => 'post',
                                'data-pjax' => FALSE,
                                'class' => 'label label-info',
                            ],
                            'visible' => ($model->is_deleted),
            
                        ],
                    ],
                ],
            ]);
            ?>
        </div>

    </div>

    <hr/>

    
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
                    'address:ntext',
                    'country_id',
                    'province_id',
                    'regency_id',
                    'name',
        ],
    ]);
    ?>

    
    <hr/>
    
<?php $this->beginBlock('CreatedBy'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>

            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Created By',
                ['user/index'],
                ['class'=>'btn text-muted btn-xs']
            );
            ?>

          
            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Created By',
                ['user/create', 'User' => ['created_by' => $model->id]],
                ['class'=>'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
<?php Pjax::begin(['id'=>'pjax-CreatedBy', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-CreatedBy ul.pagination a, th a']) ?>
<?=
 '<div class="table-responsive">'
 . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getCreatedBy(),
        'pagination' => [
            'pageSize' => 20,
            'pageParam'=>'page-createdby',
        ]
    ]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('cruds', 'First'),
        'lastPageLabel'  => Yii::t('cruds', 'Last')
    ],
    'columns' => [
 [
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'user' . '/' . $action;
        $params['User'] = ['created_by' => $model->primaryKey()[0]];
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'user'
],
// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'id',
    'value' => function ($model) {
        if ($rel = $model->id0) {
            return Html::a($rel->name, ['profile/view', 'user_id' => $rel->user_id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
        'username',
        'email:email',
        'password_hash',
        'auth_key',
        'confirmed_at',
        'unconfirmed_email:email',
        'blocked_at',
        'registration_ip',
]
])
 . '</div>' 
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('UpdatedBy'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>

            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Updated By',
                ['user/index'],
                ['class'=>'btn text-muted btn-xs']
            );
            ?>

          
            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Updated By',
                ['user/create', 'User' => ['updated_by' => $model->id]],
                ['class'=>'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
<?php Pjax::begin(['id'=>'pjax-UpdatedBy', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-UpdatedBy ul.pagination a, th a']) ?>
<?=
 '<div class="table-responsive">'
 . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getUpdatedBy(),
        'pagination' => [
            'pageSize' => 20,
            'pageParam'=>'page-updatedby',
        ]
    ]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('cruds', 'First'),
        'lastPageLabel'  => Yii::t('cruds', 'Last')
    ],
    'columns' => [
 [
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'user' . '/' . $action;
        $params['User'] = ['updated_by' => $model->primaryKey()[0]];
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'user'
],
// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'id',
    'value' => function ($model) {
        if ($rel = $model->id0) {
            return Html::a($rel->name, ['profile/view', 'user_id' => $rel->user_id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
        'username',
        'email:email',
        'password_hash',
        'auth_key',
        'confirmed_at',
        'unconfirmed_email:email',
        'blocked_at',
        'registration_ip',
]
])
 . '</div>' 
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('DeletedBy'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>

            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Deleted By',
                ['user/index'],
                ['class'=>'btn text-muted btn-xs']
            );
            ?>

          
            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Deleted By',
                ['user/create', 'User' => ['deleted_by' => $model->id]],
                ['class'=>'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
<?php Pjax::begin(['id'=>'pjax-DeletedBy', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-DeletedBy ul.pagination a, th a']) ?>
<?=
 '<div class="table-responsive">'
 . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getDeletedBy(),
        'pagination' => [
            'pageSize' => 20,
            'pageParam'=>'page-deletedby',
        ]
    ]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('cruds', 'First'),
        'lastPageLabel'  => Yii::t('cruds', 'Last')
    ],
    'columns' => [
 [
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'user' . '/' . $action;
        $params['User'] = ['deleted_by' => $model->primaryKey()[0]];
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'user'
],
// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'id',
    'value' => function ($model) {
        if ($rel = $model->id0) {
            return Html::a($rel->name, ['profile/view', 'user_id' => $rel->user_id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
        'username',
        'email:email',
        'password_hash',
        'auth_key',
        'confirmed_at',
        'unconfirmed_email:email',
        'blocked_at',
        'registration_ip',
]
])
 . '</div>' 
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('Submissions'); ?>
    <div style='position: relative'>
        <div style='position:absolute; right: 0px; top: 0px;'>

            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Submissions',
                ['submission/index'],
                ['class'=>'btn text-muted btn-xs']
            );
            ?>

          
            <?= 
            Html::a(
                '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Submission',
                ['submission/create', 'Submission' => ['owner_id' => $model->id]],
                ['class'=>'btn btn-success btn-xs']
            );
            ?>
        </div>
    </div>
<?php Pjax::begin(['id'=>'pjax-Submissions', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Submissions ul.pagination a, th a']) ?>
<?=
 '<div class="table-responsive">'
 . \yii\grid\GridView::widget([
    'layout' => '{summary}{pager}<br/>{items}{pager}',
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getSubmissions(),
        'pagination' => [
            'pageSize' => 20,
            'pageParam'=>'page-submissions',
        ]
    ]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('cruds', 'First'),
        'lastPageLabel'  => Yii::t('cruds', 'Last')
    ],
    'columns' => [
 [
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'submission' . '/' . $action;
        $params['Submission'] = ['owner_id' => $model->primaryKey()[0]];
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => 'submission'
],
        'id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
        'deleted_at',
        'deleted_by',
        'agenda_number',
]
])
 . '</div>' 
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>



    <?= 
    Tabs::widget([
        'id' => 'relation-tabs',
        'encodeLabels' => false,
        'items' => [
                [
                    'content' => $this->blocks['CreatedBy'],
                    'label'   => '<small>Created By <span class="badge badge-default">'. $model->getCreatedBy()->count() . '</span></small>',
                    #'active'  => false,
                ],
                [
                    'content' => $this->blocks['UpdatedBy'],
                    'label'   => '<small>Updated By <span class="badge badge-default">'. $model->getUpdatedBy()->count() . '</span></small>',
                    #'active'  => false,
                ],
                [
                    'content' => $this->blocks['DeletedBy'],
                    'label'   => '<small>Deleted By <span class="badge badge-default">'. $model->getDeletedBy()->count() . '</span></small>',
                    #'active'  => false,
                ],
                [
                    'content' => $this->blocks['Submissions'],
                    'label'   => '<small>Submissions <span class="badge badge-default">'. $model->getSubmissions()->count() . '</span></small>',
                    #'active'  => false,
                ],

        ],
    ]);
    ?>


    <hr/><br/>

</div>
