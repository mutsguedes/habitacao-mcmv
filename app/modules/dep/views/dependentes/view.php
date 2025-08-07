<?php


use yii\web\View;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use kartik\detail\DetailView;
use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelD Dependente */
?>

<?php
$this->registerJs(
    "$('#dep-view-modal').modal('show');",
    View::POS_READY,
);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'dep-view',
]);
?>
<div class="modal fade" id="dep-view-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-user-circle fa-4x">
                        </div>
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>
                                <?=
                                'Dependente do(a) Responsável - '
                                    . Html::label($modelD->numRes->nm_nom_res, null, ['style' => 'color:red']);
                                ?>
                            </h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <?php
                    $attributes = [
                        [
                            'group' => true,
                            'label' => 'Dependente',
                            'rowOptions' => [
                                'class' => 'info',
                                'style' => 'font-weight:bold;font-size:16px;color:green'
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'nm_nom_dep',
                                    'value' => $modelD->nm_nom_dep,
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'displayOnly' => true
                                ],
                                [
                                    'attribute' => 'dt_nas_dep',
                                    'value' => $modelD->dt_nas_dep,
                                    'type' => DetailView::INPUT_DATE,
                                    'format' => 'date',
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'displayOnly' => true
                                ],
                                [
                                    'attribute' => 'nu_num_cpf',
                                    'value' => MarArtHelpers::mascaraString('###.###.###-##', $modelD->nu_num_cpf),
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                ],
                            ],
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'nu_num_ide',
                                    'value' => MarArtHelpers::mascaraString(MarArtHelpers::masId($modelD->nu_num_ide), $modelD->nu_num_ide),
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                ],
                                [
                                    'attribute' => 'bo_mem_def',
                                    'format' => 'raw',
                                    'value' => $modelD->bo_mem_def ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                                    'type' => DetailView::INPUT_SWITCH,
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'onText' => 'Sim',
                                            'offText' => 'Não',
                                            'onColor' => 'success',
                                            'offColor' => 'danger',
                                        ]
                                    ],
                                    'labelColOptions' => ['style' => 'width: 20%'],
                                    //  'valueColOptions' => ['style' => 'width:5%']
                                ],
                                [
                                    'attribute' => 'id_num_gen',
                                    'value' => $modelD->numGen->nm_nom_gen,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                ],
                                [
                                    'attribute' => 'id_num_etn',
                                    'value' => $modelD->numEtn->nm_nom_etn,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                ],
                            ],
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'id_est_civ',
                                    'value' => $modelD->estCiv->nm_est_civ,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 9%'],
                                ],
                                [
                                    'attribute' => 'id_gra_ins',
                                    'value' => $modelD->graIns->nm_gra_ins,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 14%'],
                                ],
                                [
                                    'attribute' => 'id_num_nat',
                                    'value' => $modelD->numNat->nm_nom_est,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                ],
                            ],
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'id_num_cbo',
                                    'value' => $modelD->numCbo->nm_des_cbo,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                ],
                                [
                                    'attribute' => 'id_nat_ocu',
                                    'value' => $modelD->natOcu->nm_nat_ocu,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 14%'],
                                ],
                            ],
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'id_ori_ren',
                                    'value' => $modelD->oriRen->nm_ori_ren,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 18%'],
                                ],
                                [
                                    'attribute' => 'nu_ren_dep',
                                    'value' => $modelD->nu_ren_dep,
                                    'attribute' => 'sale_amount',
                                    'label' => 'R. dependente(R$):',
                                    'format' => ['decimal', 2],
                                    'displayOnly' => true,
                                    'labelColOptions' => ['style' => 'width: 19%'],
                                ],
                            ]
                        ],
                        [
                            'group' => true,
                            'label' => 'Deficiência',
                            'rowOptions' => ['class' => 'info', 'style' => 'font-weight:bold;font-size:16px;color:green']
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'bo_ade_fis',
                                    'format' => 'raw',
                                    'value' => $modelD->bo_ade_fis ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                                    'type' => DetailView::INPUT_SWITCH,
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'onText' => 'Sim',
                                            'offText' => 'Não',
                                        ]
                                    ],
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'valueColOptions' => ['style' => 'width:3%']
                                ],
                                [
                                    'attribute' => 'bo_ade_vis',
                                    'format' => 'raw',
                                    'value' => $modelD->bo_ade_vis ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                                    'type' => DetailView::INPUT_SWITCH,
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'onText' => 'Sim',
                                            'offText' => 'Não',
                                        ]
                                    ],
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'valueColOptions' => ['style' => 'width:3%']
                                ],
                                [
                                    'attribute' => 'bo_ade_int',
                                    'format' => 'raw',
                                    'value' => $modelD->bo_ade_int ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                                    'type' => DetailView::INPUT_SWITCH,
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'onText' => 'Sim',
                                            'offText' => 'Não',
                                        ]
                                    ],
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'valueColOptions' => ['style' => 'width:3%']
                                ],
                                [
                                    'attribute' => 'bo_ade_aud',
                                    'format' => 'raw',
                                    'value' => $modelD->bo_ade_aud ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                                    'type' => DetailView::INPUT_SWITCH,
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'onText' => 'Sim',
                                            'offText' => 'Não',
                                        ]
                                    ],
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'valueColOptions' => ['style' => 'width:3%']
                                ],
                                [
                                    'attribute' => 'bo_ade_nan',
                                    'format' => 'raw',
                                    'value' => $modelD->bo_ade_nan ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                                    'type' => DetailView::INPUT_SWITCH,
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'onText' => 'Sim',
                                            'offText' => 'Não',
                                        ]
                                    ],
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'valueColOptions' => ['style' => 'width:3%']
                                ],
                                [
                                    'attribute' => 'bo_ade_mul',
                                    'format' => 'raw',
                                    'value' => $modelD->bo_ade_mul ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                                    'type' => DetailView::INPUT_SWITCH,
                                    'widgetOptions' => [
                                        'pluginOptions' => [
                                            'onText' => 'Sim',
                                            'offText' => 'Não',
                                        ]
                                    ],
                                    'labelColOptions' => ['style' => 'width: 5%'],
                                    'valueColOptions' => ['style' => 'width:3%']
                                ],
                            ],
                        ],
                        [
                            'group' => true,
                            'label' => 'CID',
                            'rowOptions' => [
                                'class' => 'info',
                                'style' => 'font-weight:bold;font-size:16px;color:green'
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'nu_cod_cid',
                                    'value' => $modelD->nu_cod_cid,
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 10%'],
                                    'displayOnly' => true
                                ],
                                [
                                    'attribute' => 'nm_des_cid',
                                    'value' => $modelD->nm_des_cid,
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 10%'],
                                    'displayOnly' => true
                                ],
                            ]
                        ],
                    ];

                    // View file rendering the widget
                    try {
                        echo DetailView::widget([
                            'krajeeDialogSettings' => [
                                'overrideYiiConfirm' => false,
                                'useNative' => true,
                            ],
                            'model' => $modelD,
                            'attributes' => $attributes,
                            'mode' => 'view',
                            //'bordered' => $bordered,
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,
                            // 'hover' => $hover,
                            //  'hAlign' => $hAlign,
                            //  'vAlign' => $vAlign,
                            //  'fadeDelay' => $fadeDelay,
                        ]);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        Yii::$app->session->setFlash($e->getTraceAsString());
                    }
                    ?>
                </div> <!-- border -->
            </div> <!-- Modal body -->

            <?php $urlDel = Yii::$app->urlManager->createUrl(['/res/dependentes/delete-fake', 'idDep' => $modelD->id_num_dep]); ?>

            <div class="modal-footer justify-content-md-end">
                <?=
                Html::Button(
                    "<span class='fas fa-user-edit' aria-hidden='true'></span><span>&nbsp;&nbsp;Editar</span>",
                    [
                        'id' => 'btn_editar',
                        'class' => 'btn btn-sm btn-outline-primary mr-sm-2',
                        'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/dep/dependentes/update', 'idDep' => $modelD->id_num_dep]) . "';",
                        'data-toggle' => 'tooltip',
                        'title' => 'Editar dependente',
                        'value' => 'editar',
                        'name' => 'btn'
                    ]
                )
                ?>
                <?php
                echo '&nbsp;&nbsp;&nbsp;';
                ?>
                <?=
                Html::Button(
                    "<span class='fas fa-user-plus' aria-hidden='true'></span><span>&nbsp;&nbsp;Criar Dependente</span>",
                    [
                        'id' => 'btn_editar',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/dep/dependentes/create', 'idRes' => $modelD->id_num_res]) . "';",
                        'data-toggle' => 'tooltip',
                        'title' => 'Criar dependente',
                        'value' => 'editar',
                        'name' => 'btn'
                    ]
                )
                ?>
                <?php
                echo '&nbsp;&nbsp;&nbsp;';

                echo Html::a("<span class='fas fa-user-minus' aria-hidden='true'></span><span>&nbsp;&nbsp;Deletar</span>", null, [
                    'id' => 'lnk_delete',
                    'class' => 'btn btn-sm btn-outline-danger mr-sm-2',
                    'data' => [
                        'url' => $urlDel,
                        'urlReturn' => Yii::$app->urlManager->createUrl(['/res/dependentes/index']),
                        'toggle' => 'tooltip',
                        'title' => 'Deletar dependente',
                        'confirm' => 'Você não será capaz de recuperar este(a) ',
                        'module' => 'Dependente',
                        'value' => 'delete',
                        'name' => 'b_delete',
                    ],
                ]);
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                if ((Yii::$app->session->get('sistema') === 'MCMV') ||
                    (Yii::$app->session->get('sistema') === 'PHPMI')
                ) {
                    $urlIndex = Yii::$app->urlManager->createUrl([
                        '/dep/dependentes/lista-dependentes',
                        'idRes' => $modelD->id_num_res
                    ]);
                } else if (Yii::$app->session->get('sistema') === 'PAC') {
                    $urlIndex = Yii::$app->urlManager->createUrl([
                        '/dep/dependentes/lista-dependentes-resp',
                        'idRes' => $modelD->id_num_res
                    ]);
                };
                /*  $urlIndex = Yii::$app->urlManager->createUrl([
                    '/dep/dependentes/lista-dependentes-resp',
                    'idRes' => $modelD->id_num_res
                ]); */
                echo Html::button(
                    "<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Dependente(s)</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                        'onclick' => "window.location.href = '" . $urlIndex . "';",
                        'data-toggle' => 'tooltip',
                        'title' => 'Voltar lista dependente(s)',
                    ]
                );
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlRes = Yii::$app->urlManager->createUrl([
                    '/res/responsaveis/index-responsavel',
                    'idRes' => $modelD->id_num_res
                ]);
                echo Html::button(
                    "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'onclick' => "window.location.href = '" . $urlRes . "';",
                        'data-toggle' => 'tooltip',
                        'title' => 'Voltar responsável',
                    ]
                );
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div><!-- the modal -->
<?php ActiveForm::end(); ?>