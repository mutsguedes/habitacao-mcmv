<?php

use app\modules\user\models\User;
use app\modules\user\models\UserSearch;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this View */
/* @var $searchModel UserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Usuário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php
    // $pagesize = PageSize::widget(['label' => 'Procedimento', 'defaultPageSize' => 5, 'options' => ['class' => 'form-control']]);
    $gridColumns = [
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'username',
            'label' => 'Login Usuário',
            'contentOptions' => ['style' => 'width:250px; white-space: normal;'],
            'value' => function ($model) {
                return $model->username;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'username', 'username'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione login usuário'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'name',
            'label' => 'Nome Usuário',
            'value' => function ($model) {
                return $model->name;
            },
            'contentOptions' => ['style' => 'width:320px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(User::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione paciente'],
            // 'onChange' => ['javascript:description(this.selectedIndex)'],
            'group' => true, // enable grouping,
            'subGroupOf' => 2 // supplier column index is the parent group
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            //'header' => $pagesize,
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => 'Deletar',
                        'data-confirm' => 'Usuário deletar',
                        'data-method' => 'POST'
                    ]);
                }
            ]
        ],
    ];
    //Pjax::begin(['id' => 'pjax-gridview']);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        'pager' => [
            'options' => ['class' => 'pagination'], // set clas name used in ui list of pagination
            'prevPageLabel' => Yii::t('app', 'Previous'), // Set the label for the "previous" page button
            'nextPageLabel' => Yii::t('app', 'Next'), // Set the label for the "next" page button
            'firstPageLabel' => Yii::t('app', 'First'), // Set the label for the "first" page button
            'lastPageLabel' => Yii::t('app', 'Last'), // Set the label for the "last" page button
            'nextPageCssClass' => Yii::t('app', 'next'), // Set CSS class for the "next" page button
            'prevPageCssClass' => Yii::t('app', 'prev'), // Set CSS class for the "previous" page button
            'firstPageCssClass' => Yii::t('app', 'first'), // Set CSS class for the "first" page button
            'lastPageCssClass' => Yii::t('app', 'last'), // Set CSS class for the "last" page button
            'maxButtonCount' => 20, // Set maximum number of page buttons that can be displayed
        ],
        /* 'pjax' => true,
          'striped' => true,
          'hover' => true, */
        'columns' => $gridColumns,
        'toolbar' => [
            '{toggleData}',
            [
                'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => Yii::t('app', 'Novo Usuário')]) . '&nbsp;&nbsp;&nbsp;' .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('app', 'Reset Grid')]),
            ],
        ],
        // 'floatHeader' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => 'Usuários',
        ],
    ]);
    //Pjax::end();
    ?>
</div>