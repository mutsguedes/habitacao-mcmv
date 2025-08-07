<?php

use app\modules\agenda\models\Agenda;
use app\modules\auxiliar\models\GerAssunto;
use app\modules\auxiliar\models\GerState;

use yii\widgets\Pjax;
use kartik\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this View */

/* @var $searchModel AgendaSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $modelA Agenda */
?>
<div class="grid-form">
    <?php
    $gridColumns = [
        /* [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'dt_age_dat',
            'format' => ['date', 'php:d-m-Y'],
            'width' => '180px',
            'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
            'value' => function ($modelA) {
                return $modelA->dt_age_dat;
            },
            'filterType' => GridView::FILTER_DATE,
            'filterWidgetOptions' => ([
                'convertFormat' => true,
                'pluginOptions' => [
                    'daysOfWeekDisabled' => [0, 6],
                    'format' => 'php:d-m-Y',
                    'autoWidget' => true,
                    'autoclose' => true,
                    'todayBtn' => true,
                ],
            ]),
            'group' => true,  // enable grouping
        ], */
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'dt_age_dat',
            'width' => '180px',
            'contentOptions' =>  function ($modelA) {
                $datesDisableDate = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-full-date'), 'dt_age_dat');
                if (in_array(date('d-m-Y', strtotime($modelA->dt_age_dat)), $datesDisableDate)) {
                    return ['style' => 'width:100px; background-color:red; font-weight:bold; white-space: normal;'];
                } else {
                    return ['style' => 'width:100px; white-space: normal;'];
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'value' => function ($modelA) {
                return date('d-m-Y', strtotime($modelA->dt_age_dat));
            },
            'filter' => ArrayHelper::map(
                Agenda::find()
                    ->select(["DATE_FORMAT(dt_age_dat, '%d-%m-%Y') AS dt_age_dat"])
                    ->orderBy('dt_age_dat')
                    ->asArray()
                    ->all(),
                'dt_age_dat',
                'dt_age_dat'
            ),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true,  'minimumInputLength' => 2,]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. data'],
            'format' => 'raw',
            'group' => true,  // enable grouping
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'ti_age_hor',
            'width' => '180px',
            'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
            'value' => function ($modelA) {
                return $modelA->ti_age_hor;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(
                Agenda::find()
                    ->orderBy('ti_age_hor')
                    ->asArray()
                    ->all(),
                'ti_age_hor',
                'ti_age_hor'
            ),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true,  'minimumInputLength' => 2,]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. hora'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nm_nom_cid',
            'label' => 'Cidadão:',
            'width' => '380px',
            'value' =>  function ($modelA) {
                return $modelA->nm_nom_cid;
            },
            'contentOptions' => ['style' => 'width:270px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Agenda::find()->orderBy('nm_nom_cid')->asArray()->all(), 'nm_nom_cid', 'nm_nom_cid'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true,  'minimumInputLength' => 3,]
            ],
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'placeholder' => 'Sel. cidadão', 'minimumInputLength' => 3,]
            ],
            'format' => 'raw'
        ],
        /*[
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'bo_eve_sta',
            'vAlign' => 'middle',
            'label' => 'Ativo',
            'width' => '80px',
            'trueIcon' => '<span class="badge" style="background-color:#5cb85c">Sim</span>',
            'falseIcon' => '<span class="badge" style="background-color:#d9534f">Não</span>',
            'trueLabel' => "Sim",
            'falseLabel' => 'Não',
            'vAlign' => 'middle'
        ], */
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'assunto',
            'label' => 'Assunto:',
            'width' => '280px',
            'value' =>  function ($modelA) {
                return $modelA->numAss->nm_nom_ass;
            },
            'contentOptions' => ['style' => 'width:270px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(GerAssunto::find()->orderBy('id_num_ass')->asArray()->all(), 'nm_nom_ass', 'nm_nom_ass'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true,  /* 'minimumInputLength' => 3, */]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. assunto'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'state',
            'label' => 'Status:',
            'width' => '280px',
            'value' =>  function ($modelA) {
                return $modelA->numSta->nm_des_sta;
            },
            'contentOptions' => ['style' => 'width:270px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(GerState::find()->orderBy('id_num_sta')->asArray()->all(), 'nm_des_sta', 'nm_des_sta'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true,  /* 'minimumInputLength' => 3, */]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. status'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'options' => ['style' => 'width:10%'],
            'template' => '{view} {update} {delete} {printer}',
            'buttons' => [
                'view' => function ($url, $modelA) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/agenda/agendas/view',
                        'idAge' => $modelA->id_num_age
                    ]);
                    return Html::a('<span class="fas fa-eye"></span>', $url, [
                        'class' => 'btncolorview',
                        'title' => 'Exibir agenda.',
                    ]);
                },
                'update' => function ($url, $modelA) {
                    // if ((strtotime($modelA->dt_age_dat) > strtotime(date("Y-m-d"))) || (Yii::$app->user->can('administrativo'))) {
                    if ((strtotime($modelA->dt_age_dat) > strtotime(date("Y-m-d")))) {
                        $url = Yii::$app->urlManager->createUrl([
                            '/agenda/agendas/update',
                            'idAge' => $modelA->id_num_age,
                            'date' => '',
                            'time' => ''

                        ]);
                        return Html::a('<span class="fas fa-user-edit"></span>', $url, [
                            'class' => 'btncolorupdate',
                            'title' => 'Editar agenda.',
                        ]);
                    } else {
                        return Html::a('<span class="fas fa-user-edit"></span>', '#', [
                            'class' => 'btncolorlec',
                            'title' => 'Editar não permitido.',
                        ]);
                    }
                },
                'delete' => function ($url, $modelA) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/agenda/agendas/delete-fake',
                        'idAge' => $modelA->id_num_age
                    ]);
                    /* return Html::a('<i class="fas fa-trash"></i>', $url, [
                        'class' => 'btncolordelete',

                        'data' => [
                            'title' => 'Deletar agenda! Você tem certeza?',
                            'confirm' =>
                            "Você não será capaz de recuperar esta Agenda!",
                            'model' => 'Agenda',
                            'action' => 'deletar',
                            'url' => $url,
                            'url-return' => Yii::$app->request->url,
                            'method' => 'post',
                        ],
                        'data-pjax' => 0,
                        'title' => 'Deletar agenda.',
                    ]); */

                    return Html::a('<i class="fas fa-trash"></i>', null, [
                        'id' => 'lnk_delete',
                        'class' => 'btncolordelete',
                        'data' => [
                            'url' => $url,
                            'urlReturn' => Yii::$app->request->url,
                            'title' => 'Deletar Agenda',
                            'confirm' => 'Você não será capaz de recuperar este(a) ',
                            'module' => 'Agenda',
                            'value' => 'delete',
                            'name' => 'l_delete',
                        ],
                    ]);
                },
                /* 'printer' => function ($url, $modelA) {
                    if (strtotime($modelA->dt_age_dat) > strtotime(date("Y-m-d"))) {
                        $url = Yii::$app->urlManager->createUrl([
                            '/impres/impressoes/imp-view',
                            'idRes' => $modelA->id_num_age
                        ]);
                        return Html::a('<i class="fas fa-print"></i>', $url, [
                            'class' => 'btncolorprinter',
                            'title' => 'Imprimir comprovante agenda',
                        ]);
                    } else {
                        return Html::a('<i class="fas fa-print"></i>', '#', [
                            'class' => 'btncolorlec',
                            'title' => 'Imprimir não permitido',
                        ]);
                    }
                }, */
            ],
        ]
    ];

    Pjax::begin(['id' => 'pjax-dep']);
    try {
        echo GridView::widget([
            'krajeeDialogSettings' => [
                'overrideYiiConfirm' => false,
                'useNative' => true,
            ],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'pager' => [
                'options' => ['class' => 'pagination'], // set clas name used in ui list of pagination
                'prevPageLabel' => 'Anterior', // Set the label for the "previous" page button
                'nextPageLabel' => 'Próximo', // Set the label for the "next" page button
                'firstPageLabel' => 'Primeiro', // Set the label for the "first" page button
                'lastPageLabel' => 'Último', // Set the label for the "last" page button
                'nextPageCssClass' => 'next', // Set CSS class for the "next" page button
                'prevPageCssClass' => 'prev', // Set CSS class for the "previous" page button
                'firstPageCssClass' => 'first', // Set CSS class for the "first" page button
                'lastPageCssClass' => 'last', // Set CSS class for the "last" page button
                'maxButtonCount' => 10, // Set maximum number of page buttons that can be displayed
            ],
            'containerOptions' => [
                'style' => "height: 500px; overflow: auto"
            ],
            'resizableColumns' => false,
            'responsive' => false,
            'pjax' => true,
            'striped' => true,
            'hover' => true,
            'condensed' => true,
            'responsiveWrap' => true,
            'toolbar' => [
                [
                    'content' =>
                    Html::a('<i class="fas fa-calendar-plus"></i>', [''], [
                        'type' => 'button',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'title' => 'Criar agenda',
                        'options' => ['style' => ' margin-right:1000px;'],
                        'onClick' => 'snwNavLinkVacanciesMonth(event)'
                    ]) . '&nbsp;&nbsp;&nbsp;' .
                        Html::a(
                            '<i class="fas fa-redo-alt"></i>',
                            [''],
                            [
                                'type' => 'button',
                                // 'data-pjax' => 0,
                                'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                                'title' => 'Redefinir gride',
                            ]
                        ),
                    'options' => ['class' => 'btn-group mr-2 me-2']
                ],
            ],
            'panel' => [
                'heading' => '<span><i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;Agenda(s)</span>',
                'type' => 'primary',
                // 'footer' => false
            ],
        ]);
    } catch (Exception $e) {
        Yii::$app->session->setFlash('error', $e);
        // var_dump($e);
    }
    Pjax::end();
    ?>
</div>