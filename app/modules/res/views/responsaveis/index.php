<?php


use yii\widgets\Pjax;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use app\components\MarArtHelpers;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerCorSituacao;
use app\modules\auxiliar\models\GerEstadoCivil;





/* @var $this View */

/* @var $searchModel ResponsavelSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $modelR Responsavel */
?>
<div class="grid-form">
    <?php
    $gridColumns = [
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nm_nom_res',
            'vAlign' => 'middle',
            'value' => function ($modelR) {
                return $modelR->nm_nom_res;
            },
            'contentOptions' => function ($modelR) {
                if ((intval($modelR->getRenda()) > 1800) || (($modelR->bo_mem_def) && (intval($modelR->getRenda() > 3500)))) {
                    return ['style' => 'width:320px; background-color:red; font-weight:bold; white-space: normal;'];
                } else {
                    return ['style' => 'width:320px; background-color:' . $modelR->corSit->nm_cor_sit . '; font-weight:bold; white-space: normal;'];
                }
                if ($modelR->bo_cal_urg) {
                    return ['style' => 'width:320px; background-color:yellow; font-weight:bold; white-space: normal;'];
                } else {
                    return ['style' => 'width:320px; background-color:' . $modelR->corSit->nm_cor_sit . '; font-weight:bold; white-space: normal;'];
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Responsavel::find()->orderBy('nm_nom_res')->asArray()->all(), 'nm_nom_res', 'nm_nom_res'),
            'filterWidgetOptions' => [
                'theme' => 'classic',
                'pluginOptions' => [
                    'allowClear' => true, 'placeholder' => 'Sel. responsável', 'minimumInputLength' => 3, 'width' => '100%',
                ]
            ],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'corsituacao',
            'vAlign' => 'middle',
            'label' => 'Situação:',
            'value' => 'corSit.nm_des_sit',
            'contentOptions' => ['style' => 'width:160px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(GerCorSituacao::find()->orderBy('nm_des_sit')->asArray()->all(), 'nm_des_sit', 'nm_des_sit'),
            'filterWidgetOptions' => [
                'theme' => 'classic',
                'pluginOptions' => ['allowClear' => true, 'placeholder' => 'Sel. situação', 'width' => '100%',]
            ],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'estcivil',
            'vAlign' => 'middle',
            'label' => 'E. Civil:',
            'value' => function ($modelR) {
                return $modelR->estCiv->nm_est_civ;
            },
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(GerEstadoCivil::find()->orderBy('id_est_civ')->asArray()->all(), 'nm_est_civ', 'nm_est_civ'),
            'filterWidgetOptions' => [
                'theme' => 'classic',
                'pluginOptions' => ['allowClear' => true, 'placeholder' => 'Sel. estado civil', 'width' => '100%',/*'minimumInputLength' => 3,*/]
            ],
            'format' => 'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'vAlign' => 'middle',
            'hAlign' => 'right',
            'attribute' => 'nu_num_cpf',
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'value' => function ($modelR) {
                return MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf);
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Responsavel::find()->orderBy('nu_num_cpf')->asArray()->all(), 'nu_num_cpf', 'nu_num_cpf'),
            'filterWidgetOptions' => [
                'theme' => 'classic',
                'pluginOptions' => ['allowClear' => true, 'placeholder' => 'Sel. cpf', 'minimumInputLength' => 3, 'width' => '100%',],
            ],
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'attribute' => 'dt_tim_cri',
            'format' => ['date', 'php:d-m-Y'],
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'value' => function ($modelR) {
                return $modelR->dt_tim_cri;
            },
            'filterType' => GridView::FILTER_DATE,
            'filterWidgetOptions' => ([
                'attribute' => 'dt_tim_cri',
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy', 'width' => '100%',
                ],
            ]),
            'label' => 'D. Cadastro',
        ],
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'bo_cal_urg',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'label' => 'Urgência',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => [
                'true' => 1, 'false' => 0
            ],
            'filterWidgetOptions' => [
                'theme' => 'classic',
                'hideSearch' => true,
                'pluginOptions' => ['allowClear' => true, 'placeholder' => '', 'width' => '100%',],
            ],
            'width' => '90px',
            'trueIcon' => '<span class="badge" style="background-color:#5cb85c">Sim</span>',
            'falseIcon' => '<span class="badge" style="background-color:#d9534f">Não</span>',
            'trueLabel' => "Sim",
            'falseLabel' => 'Não',
        ],
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'bo_mem_def',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'label' => 'Deficiênte',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => [
                'true' => 1, 'false' => 0
            ],
            'filterWidgetOptions' => [
                'theme' => 'classic',
                'hideSearch' => true,
                'pluginOptions' => ['allowClear' => true, 'placeholder' => '', 'width' => '100%',],
            ],
            'width' => '90px',
            'trueIcon' => '<span class="badge" style="background-color:#5cb85c">Sim</span>',
            'falseIcon' => '<span class="badge" style="background-color:#d9534f">Não</span>',
            'trueLabel' => "Sim",
            'falseLabel' => 'Não',
        ],
        [
            'class' => 'kartik\grid\FormulaColumn',
            'header' => 'Idade',
            'mergeHeader' => true,
            //'attribute' => 'idade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            //'value' => 'nu_num_ida',
            /*             'filter'=>ArrayHelper::map(Responsavel::find()->asArray()->all(), 
                   'nu_num_ida', 'nu_num_ida'), */
            //'filterType' => GridView::FILTER_NUMBER,
            'value' => function ($modelR) {
                return $modelR->getIdade($modelR->dt_nas_res);
            },
            'contentOptions' => ['style' => 'width:50px; white-space: normal;'],
            'format' => 'raw',
        ],
        /* [
            'class' => '\kartik\grid\DataColumn',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'attribute' => 'dt_tim_mod',
            'format' => ['date', 'php:d/m/Y'],
            'contentOptions' => ['style' => 'width:130px; white-space: normal;'],
            'value' => function ($modelR) {
                return $modelR->dt_tim_mod;
            },
            'filterType' => GridView::FILTER_DATE,
            'label' => 'D. Atualização',
        ], */
        [
            'class' => '\kartik\grid\ActionColumn',
            'options' => ['style' => 'width:10%'],
            'template' => '{view} {update} {delete} {dep} {printer} {addpes} {document}',
            'buttons' => [
                'view' => function ($url, $modelR) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/res/responsaveis/view',
                        'idRes' => $modelR->id_num_res
                    ]);
                    return Html::a('<span class="fas fa-eye"></span>', $url, [
                        'class' => 'btncolorview',
                        'title' => 'Exibir responsável',
                    ]);
                },
                'update' => function ($url, $modelR) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/res/responsaveis/update',
                        'idRes' => $modelR->id_num_res
                    ]);
                    return Html::a('<span class="fas fa-user-edit"></span>', $url, [
                        'class' => 'btncolorupdate',
                        'title' => 'Editar responsável',
                    ]);
                },
                'delete' => function ($url, $modelR) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/res/responsaveis/delete-fake',
                        'idRes' => $modelR->id_num_res
                    ]);
                    return Html::a('<i class="fas fa-trash"></i>', null, [
                        'id' => 'lnk_delete',
                        'class' => 'btncolordelete',
                        'data' => [
                            'url' => $url,
                            'urlReturn' => Yii::$app->request->url,
                            'title' => 'Deletar responsável',
                            'confirm' => 'Você não será capaz de recuperar este(a) ',
                            'module' => 'Responsável',
                            'value' => 'delete',
                            'name' => 'l_delete',
                        ],
                    ]);
                },
                'dep' => function ($url, $modelR) {
                    if (($modelR->id_num_proj === 2) || ($modelR->id_num_proj === 5)) {
                        $url = Yii::$app->urlManager->createUrl([
                            '/dep/dependentes/lista-dependentes',
                            'idRes' => $modelR->id_num_res
                        ]);
                    } else if ($modelR->id_num_proj === 3) {
                        $url = Yii::$app->urlManager->createUrl([
                            '/dep/dependentes/lista-dependentes-resp',
                            'idRes' => $modelR->id_num_res
                        ]);
                    };
                    $isDep = Dependente::findAll(['id_num_res' => $modelR->id_num_res, 'bo_reg_exc' => 0]);
                    if (count($isDep) == 0) {
                        return Html::a('<i class="fas fa-user-plus"></i>', $url, [
                            'class' => 'btncolorusercircle',
                            'title' => (($modelR->id_num_proj === 2) || ($modelR->id_num_proj === 5)) ? 'Adicionar dependente' : 'Adicionar famíla',
                        ]);
                    } else {
                        return Html::a('<i class=" fas fa-users"></i>', $url, [
                            'class' => 'btncolorusercirclec',
                            'title' => (($modelR->id_num_proj === 2) || ($modelR->id_num_proj === 5)) ? 'Listar dependente(s)' : 'Listar família',
                        ]);
                    }
                },
                'printer' => function ($url, $modelR) {
                    if (($modelR->id_num_proj === 2) || ($modelR->id_num_proj === 5)) {
                        $url = Yii::$app->urlManager->createUrl([
                            '/impres/impressoes/imp-view',
                            'idRes' => $modelR->id_num_res
                        ]);
                        return Html::a('<i class="fas fa-print"></i>', $url, [
                            'class' => 'btncolorprinter',
                            'title' => 'Imprimir formulário(s) responsável',
                        ]);
                    };
                },
                'addpes' => function ($url, $modelR) {
                    if ($modelR->id_num_proj === 3) {
                        if ($modelR->bo_tec_soc) {
                            $url = Yii::$app->urlManager->createUrl(['/tecsoc/tecnico-social/update', 'idRes' => $modelR->id_num_res]);
                            return Html::a('<i class="fas fa-comment-dots"></i>', $url, [
                                'class' => 'btncolorupdate',
                                'title' => 'Editar Pesquisa',
                            ]);
                        } else {
                            $url = Yii::$app->urlManager->createUrl(['/tecsoc/tecnico-social/create', 'idRes' => $modelR->id_num_res]);
                            return Html::a('<i class="fas fa-comment-dots"></i>', $url, [
                                'class' => 'btncolorpesteccri',
                                'title' => 'Criar Pesquisa',
                            ]);
                        }
                    }
                },
            ],
        ]
    ];

    Pjax::begin(['id' => 'pjax-res']);
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
            'rowOptions' => function ($model, $index, $widget, $grid) {
                return ['size' => 'sm', 'style' => 'overflow-x: scroll;'];
            },
            'resizableColumns' => false,
            'responsive' => true,
            'pjax' => true,
            'striped' => true,
            'hover' => true,
            'condensed' => true,
            'responsiveWrap' => true,
            'toolbar' => [
                [
                    'content' =>
                    Html::a('<i class="fas fa-user-plus"></i>', ['/res/responsaveis/pesquisa'], [
                        'type' => 'button',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'title' => 'Criar responsável',
                    ]) . '&nbsp;&nbsp;&nbsp;' .
                        Html::a('<i class="fas fa-redo-alt"></i>', ['/res/responsaveis/index'], [
                            'type' => 'button',
                            // 'data-pjax' => 0,
                            'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                            'title' => 'Redefinir gride',
                        ],),
                    'options' => ['class' => 'btn-group mr-2 me-2']
                ],
            ],
            'panel' => [
                'heading' => '<span><i class="fas fa-user-tie"></i>&nbsp;&nbsp;Responsáveis</span>',
                'type' => 'primary',
                // 'footer' => false
            ],
        ]);
    } catch (Exception $e) {
        Yii::$app->session->setFlash('error', $e);
    }
    Pjax::end();
    ?>
    <?php if (($dataProvider->count) == 1) { ?>
        <div class="card-footer d-flex justify-content-md-end" style="margin-top: 10px;">
            <?php
            $urlIndex = Yii::$app->urlManager->createUrl(['/res/responsaveis/index']);
            echo Html::button(
                "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                [
                    'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlIndex . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar lista responsáveis',
                ]
            )
            ?>
        </div> <!-- Modal footer -->
    <?php } ?>
</div>
<?php
$script = <<< JS
   localStorage.setItem('selectedTab', 'tab0')
JS;
$this->registerJs($script);
?>