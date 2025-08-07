<?php


use yii\widgets\Pjax;
use yii\base\Exception;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\components\MarArtHelpers;
use app\modules\res\models\Responsavel;

/* @var $this View */
/* @var $form ActiveForm */

/* @var $searchModel ResponsaveisSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $modelR Responsavel */



$this->title = 'Resultado Pesquisa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsaveis-index">
    <?php
    $gridColumns = [
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nm_nom_res',
            'value' => function ($modelR) {
                return $modelR->nm_nom_res;
            },
            'contentOptions' => ['style' => 'width:360px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Responsavel::find()
                ->orderBy('nm_nom_res')->asArray()
                ->all(), 'nm_nom_res', 'nm_nom_res'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione responsaveis'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nu_num_cpf',
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'value' => function ($modelR) {
                return MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf);
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Responsavel::find()
                ->orderBy('nu_num_cpf')->asArray()
                ->all(), 'nu_num_cpf', 'nu_num_cpf'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione CPF'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nu_num_ide',
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'value' => function ($modelR) {
                return MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide);
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Responsavel::find()
                ->orderBy('nu_num_ide')->asArray()
                ->all(), 'nu_num_ide', 'nu_num_ide'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione identidade'],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nu_num_tel',
            'value' => function ($modelR) {
                return (strlen($modelR->nu_num_tel) == 11) ?
                    MarArtHelpers::mascaraString('(##) #####-####', $modelR->nu_num_tel) :
                    MarArtHelpers::mascaraString('(##) ####-####', $modelR->nu_num_tel);
            },
            'width' => '150px',
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'options' => ['style' => 'width:10%'],
            'template' => '{incDep}',
            'buttons' => [
                'incDep' => function ($url, $modelR) {
                    if ((Yii::$app->controller->id) === 'responsaveis') {
                        $url = Yii::$app->urlManager->createUrl([
                            '/dep/dependentes/create',
                            'idRes' => $modelR->id_num_res
                        ]);
                        $tit = 'Criar Dependente';
                    } elseif ((Yii::$app->controller->id) === 'tecnico-sociais') {
                        $url = Yii::$app->urlManager->createUrl([
                            '/tecsoc/tecnico-sociais/create',
                            'idRes' => 'R' . $modelR->id_num_res
                        ]);
                        $tit = 'Criar Pesquisa';
                    }
                    return Html::a('<i class="fas fa-plus-circle"></i>', $url, [
                        'title' => $tit,
                    ]);
                },
            ]
        ],
    ];
    Pjax::begin(['id' => 'pjax-gridview']);
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'pager' => [
                'options' => ['class' => 'pagination pagination-mini'], // set clas name used in ui list of pagination
                'prevPageLabel' => 'Anterior', // Set the label for the "previous" page button
                'nextPageLabel' => 'Próximo', // Set the label for the "next" page button
                'firstPageLabel' => 'Primeiro', // Set the label for the "first" page button
                'lastPageLabel' => 'Último', // Set the label for the "last" page button
                'nextPageCssClass' => 'next', // Set CSS class for the "next" page button
                'prevPageCssClass' => 'prev', // Set CSS class for the "previous" page button
                'firstPageCssClass' => 'first', // Set CSS class for the "first" page button
                'lastPageCssClass' => 'last', // Set CSS class for the "last" page button
                'maxButtonCount' => 20, // Set maximum number of page buttons that can be displayed
            ],
            'rowOptions' => function ($model, $index, $widget, $grid) {
                return ['size' => 'sm', 'style' => 'overflow-x: scroll;'];
            },
            'resizableColumns' => false,
            'responsive' => false,
            'pjax' => true,
            'striped' => true,
            'hover' => true,
            'condensed' => true,
            'responsiveWrap' => true,
            'toolbar' => [
                ['content' =>
                Html::a('<i class="fas fa-user-plus"></i>', ['/res/responsaveis/pesquisa'], [
                    'type' => 'button',
                    'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                    'title' => 'Criar responsável',
                ]) . ' ' .
                    Html::a('<i class="fas fa-redo-alt"></i>', ['/res/responsaveis/index'], [
                        'type' => 'button',
                        // 'data-pjax' => 0,
                        'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                        'title' => 'Redefinir gride',
                    ]),],
            ],
            'panel' => [
                'heading' => '<span><i class="fas fa-user-tie"></i>&nbsp;&nbsp;Responsáveis Encontrado(s)</span>',
                'type' => 'primary',
                // 'footer' => false
            ],
        ]);
    } catch (Exception $e) {
        Yii::$app->session->setFlash('error', $e);
    }
    Pjax::end();
    ?>
    <div class="card-footer d-flex justify-content-md-end" style="padding-top: 10px;">
        <p>
            <?php
            $urlIndex = Yii::$app->urlManager->createUrl(['/site/index']);
            echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                'onclick' => "window.location.href = '" . $urlIndex . "';",
                'data-toggle' => 'tooltip',
                'title' => 'Volta ao início',
            ])
            ?>
        </p>
    </div>
</div>