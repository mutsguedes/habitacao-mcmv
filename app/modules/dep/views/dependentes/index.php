<?php


use yii\widgets\Pjax;
use kartik\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\components\MarArtHelpers;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerParentesco;



/* @var $this View */

/* @var $searchModel DependentesSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $modelD Dependente */
?>
<div class="grid-form">
    <?php
    $gridColumns = [
        /* [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'responsavel',
            'label' => 'Responsável:',
            'value' => 'numRes.nm_nom_res',
            'contentOptions' => [
                'style' => 'width:360px; white-space: normal;'
            ],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Responsavel::find()->orderBy('nm_nom_res')->asArray()->all(), 'nm_nom_res', 'nm_nom_res'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione responsável'],
            'format' => 'raw',
            'group' => true, // enable grouping,
            //'groupedRow' => true, // move grouped column to a single grouped row*
            'groupOddCssClass' => 'kv-grouped-row', // configure odd group cell css class
            'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class 
        ], */
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nm_nom_dep',
            'label' => 'Dependente(s):',
            'value' => function ($modelD) {
                return $modelD->nm_nom_dep;
            },
            'contentOptions' => ['style' => 'width:360px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Dependente::find()->orderBy('nm_nom_dep')->asArray()->all(), 'nm_nom_dep', 'nm_nom_dep'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione dependente'],
            'format' => 'raw',
            //'group' => true, // enable grouping
            //'subGroupOf' => 1 // supplier column index is the parent group
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'parentesco',
            'label' => 'Parentesco:',
            'value' => 'numPar.nm_nom_par',
            'contentOptions' => ['style' => 'width:170px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(GerParentesco::find()->orderBy('nm_nom_par')->asArray()->all(), 'nm_nom_par', 'nm_nom_par'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, /* 'minimumInputLength' => 3, */]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. parentesco'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nu_num_cpf',
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'value' => function ($modelD) {
                return MarArtHelpers::mascaraString('###.###.###-##', $modelD->nu_num_cpf);
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'dt_nas_dep',
            'format' => ['date', 'php:d/m/Y'],
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'value' => function ($modelD) {
                return $modelD->dt_nas_dep;
            },
            'filterType' => GridView::FILTER_DATE,
        ],
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'bo_mem_def',
            'vAlign' => 'middle',
            'label' => 'Deficiênte',
            //            'filterType' => GridView::FILTER_SELECT2,
            //            'filter' => [
            //                'true' => 1, 'false' => 0
            //            ],
            //            'filterWidgetOptions' => [
            //                'theme' => 'classic',
            //                'hideSearch' => true,
            //                'pluginOptions' => ['allowClear' => true, 'placeholder' => ''],
            //            ],
            'width' => '90px',
            'trueIcon' => '<span class="badge" style="background-color:#5cb85c">Sim</span>',
            'falseIcon' => '<span class="badge" style="background-color:#d9534f">Não</span>',
            'trueLabel' => "Sim",
            'falseLabel' => 'Não',
            'vAlign' => 'middle'
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => function ($url, $modelD) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/dep/dependentes/view',
                        'idDep' => $modelD->id_num_dep
                    ]);
                    return Html::a('<span class="fas fa-eye"></span>', $url, [
                        'class' => 'btncolorview',
                        'title' => 'Exibir dependente.',
                    ]);
                },
                'update' => function ($url, $modelD) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/dep/dependentes/update',
                        'idDep' => $modelD->id_num_dep
                    ]);
                    return Html::a('<span class="fas fa-user-edit"></span>', $url, [
                        'class' => 'btncolorupdate',
                        'title' => 'Editar dependente.',
                    ]);
                },
                'delete' => function ($url, $modelD) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/dep/dependentes/delete-fake',
                        'idDep' => $modelD->id_num_dep
                    ]);
                    return Html::a('<i class="fas fa-trash"></i>', $url, [
                        'class' => 'btncolordelete',
                        'data' => [
                            'title' => 'Deletar dependente',
                            'confirm' => 'Dependente deletar',
                            'method' => 'post',
                        ],
                        'data-pjax' => 0,
                        'title' => 'Deletar dependente.',
                    ]);
                },
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
                    Html::a('<i class="fas fa-user-plus"></i>', ['/res/dependentes/create', 'idDep' => $modelD->id_num_res], [
                        'type' => 'button',
                        'class' => 'btn-success btn-sm',
                        'title' => 'Criar dependente',
                    ]) . '&nbsp;&nbsp;&nbsp;' .
                        Html::a('<i class="fas fa-redo-alt"></i>', [''], [
                            'type' => 'button',
                            // 'data-pjax' => 0,
                            'class' => 'btn-info btn-sm',
                            'title' => 'Redefinir gride',
                        ]),
                    'options' => ['class' => 'btn-group mr-2 me-2']
                ],
            ],
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Dependente(s)</h3>',
                'type' => 'primary',
                // 'footer' => false
            ],
        ]);
    } catch (Exception $e) {
    }
    Pjax::end();
    ?>
</div>