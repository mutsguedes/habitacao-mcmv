<?php


use yii\widgets\Pjax;
use yii\base\Exception;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\Apartamento;
use app\modules\auxiliar\models\Apartamentos;

/* @var $this View */
/* @var $searchModel OcupacoesSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $modelO Ocupacoes */
?>
<div class="grid-form">
    <?php
    $gridColumns = [
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'responsavel',
            'label' => 'Responsável:',
            'value' => 'numRes.nm_nom_res',
            'contentOptions' => ['style' => 'width:400px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Responsavel::find()->groupBy('nm_nom_res')->asArray()->all(), 'nm_nom_res', 'nm_nom_res'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. responsável'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'quadra',
            'label' => 'Quadra:',
            'value' => 'numApa.nu_num_qua',
            'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Apartamento::find()->orderBy('nu_num_qua')->asArray()->all(), 'nu_num_qua', 'nu_num_qua'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 1,]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. quadra'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'lote',
            'label' => 'Lote:',
            'value' => 'numApa.nu_num_lot',
            'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Apartamento::find()->orderBy('nu_num_lot')->asArray()->all(), 'nu_num_lot', 'nu_num_lot'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 1,]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. lote'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'bloco',
            'label' => 'Bloco:',
            'value' => 'numApa.nu_num_blo',
            'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Apartamento::find()->orderBy('nu_num_blo')->asArray()->all(), 'nu_num_blo', 'nu_num_blo'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 1,]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. bloco'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'apartamento',
            'label' => 'Apartamento:',
            'value' => 'numApa.nu_num_apa',
            'contentOptions' => ['style' => 'width:150px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Apartamento::find()->orderBy('nu_num_apa')->asArray()->all(), 'nu_num_apa', 'nu_num_apa'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 1,]
            ],
            'filterInputOptions' => ['placeholder' => 'Sel. apartamento'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'template' => '{view} {update} {delete} {printer}',
            'buttons' => [
                'view' => function ($url, $modelO) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/ocu/ocupacoes/view',
                        'idOcu' => $modelO->id_num_ocu
                    ]);
                    return Html::a('<span class="fas fa-eye"></span>', $url, [
                        'class' => 'btncolorview',
                        'title' => 'Exibir agenda',
                    ]);
                },
                'update' => function ($url, $modelO) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/ocu/ocupacoes/update',
                        'idOcu' => $modelO->id_num_ocu
                    ]);
                    return Html::a('<span class="fas fa-edit"></span>', $url, [
                        'class' => 'btncolorupdate',
                        'title' => 'Editar agenda',
                    ]);
                },
                'delete' => function ($url, $modelO) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/ocu/ocupacoes/delete-fake',
                        'idOcu' => $modelO->id_num_ocu
                    ]);
                    return Html::a('<i class="fas fa-trash"></i>', $url, [
                        'class' => 'btncolordelete',
                        'data' => [
                            'title' => 'Deletar agenda',
                            'confirm' => 'Responsável deletar',
                            'method' => 'post',
                        ],
                        'title' => 'Deletar agendda',
                    ]);
                },
                'printer' => function ($url, $modelO) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/impres/impressoes/imp-view',
                        'idOcu' => $modelO->id_num_ocu
                    ]);
                    return Html::a('<i class="fas fa-print"></i>', $url, [
                        'class' => 'btncolorprinter',
                        'title' => 'Imprimir agendamento dia',
                    ]);
                },
            ],
        ]
    ];

    Pjax::begin(['id' => 'pjax-ocu']);
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            //'options' => ['data-pjax' => true, 'enablePushState' => false ],
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
                'maxButtonCount' => 5, // Set maximum number of page buttons that can be displayed
            ],
            'resizableColumns' => false,
            'responsive' => false,
            'pjax' => true,
            'striped' => true,
            'hover' => true,
            'condensed' => true,
            'responsiveWrap' => true,
            'toolbar' => [
                ['content' =>
                Html::a('<i class="fas fa-plus"></i>', ['/ocu/ocupacoes/create'], [
                    'type' => 'button',
                    'class' => 'btn-success btn-sm',
                    'title' => 'Criar ocupacão',
                ]) . '&nbsp;&nbsp;&nbsp;' .
                    Html::a('<i class="fas fa-redo-alt"></i>', ['/ocu/ocupacoes/index'], [
                        'type' => 'button',
                        // 'data-pjax' => 0,
                        'class' => 'btn-info btn-sm',
                        'title' => 'Redefinir gride',
                    ]),],
            ],
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="fas fa-building  fa-lg"></i>&nbsp;&nbsp;Ocupações</h3>',
                'type' => 'success',
                // 'footer' => false
            ],
        ]);
    } catch (Exception $e) {
        Yii::$app->session->setFlash('error', $e->getMessage());
    }
    Pjax::end();
    ?>
    <?php if (($dataProvider->count) == 1) { ?>
        <div class="card-footer d-flex justify-content-md-end" style="margin-top: 10px;">
            <br>
            <?php
            $urlRes = Yii::$app->urlManager->createUrl('');
            echo Html::button('Voltar', [
                'class' => 'btn-warning btn-mini',
                'onclick' => "window.location.href = '" . $urlRes . "';",
                'data-toggle' => 'tooltip',
                'title' => 'Voltar pág. inicial',
            ]);
            ?>
        </div> <!-- Modal footer -->
    <?php } ?>
</div>