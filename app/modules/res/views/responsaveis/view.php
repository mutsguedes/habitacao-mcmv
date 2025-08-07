<?php

use app\components\MarArtHelpers;
use kartik\detail\DetailView;

use yii\helpers\Html;

/* @var $this View */
/* @var $modelR Responsavel */


$this->title = $modelR->nm_nom_res;
$this->params['breadcrumbs'][] = ['label' => 'Responsavel', 'url' => ['/res/responsaveis/index']];
$this->params['breadcrumbs'][] = ucwords(strtolower($this->title));
?>
<div class="responsaveis-view">
    <?php
    $attributes = [
        [
            'group' => true,
            'label' => 'Projeto',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'wdth font-weight:bold;font-size:16px;color:green'
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'id_num_proj',
                    'value' => $modelR->numProj->nm_nom_proj,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%'],
                    'valueColOptions' => ['style' => 'width:31%'],
                    'displayOnly' => true
                ],
            ],
        ],
        [
            'group' => true,
            'group' => true,
            'label' => 'Responsavel',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nm_nom_res',
                    'value' => $modelR->nm_nom_res,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'dt_nas_res',
                    'value' => $modelR->dt_nas_res,
                    'type' => DetailView::INPUT_DATE,
                    'format' => 'date',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
                [
                    'attribute' => 'bo_cal_urg',
                    'format' => 'raw',
                    'value' => $modelR->bo_cal_urg ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'valueColOptions' => ['style' => 'width:3%; font-size:12px;'],
                    'displayOnly' => true,
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'id_cro_sit',
                    'label' => 'Situação:',
                    'value' => $modelR->corSit->nm_des_sit,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'valueColOptions' => ['style' => 'background-color:' . $modelR->corSit->nm_cor_sit . ';'],
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'nu_num_cpf',
                    //'label' => 'CPF',
                    'value' => MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf),
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
                [
                    'attribute' => 'nu_num_ide',
                    'value' => MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide),
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%;font-size:14px;'],
                ],
                [
                    'attribute' => 'nu_num_nis',
                    'value' => MarArtHelpers::mascaraString('###.####.###-#', $modelR->nu_num_nis),
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'id_num_gen',
                    'value' => $modelR->numGen->nm_nom_gen,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
                [
                    'attribute' => 'id_num_etn',
                    'value' => $modelR->numEtn->nm_nom_etn,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
                [
                    'attribute' => 'id_est_civ',
                    'value' => $modelR->estCiv->nm_est_civ,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 7%; font-size:14px;'],
                ],
                [
                    'attribute' => 'id_gra_ins',
                    'value' => $modelR->graIns->nm_gra_ins,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 10%; font-size:14px;'],
                ],
                [
                    'attribute' => 'id_num_nat',
                    'value' => $modelR->numNat->nm_nom_est,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'id_num_cbo',
                    'value' => $modelR->numCbo->nm_des_cbo,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
                [
                    'attribute' => 'id_nat_ocu',
                    'value' => $modelR->natOcu->nm_nat_ocu,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                ],
                [
                    'attribute' => 'id_ori_ren',
                    'value' => $modelR->oriRen->nm_ori_ren,
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 10%; font-size:14px;'],
                ],
                [
                    'attribute' => 'nu_ren_res',
                    'value' => $modelR->nu_ren_res,
                    'label' => 'R. resp.(R$):',
                    'format' => ['decimal', 2],
                    'labelColOptions' => ['style' => 'width: 13%; font-size:14px;'],
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
                    'value' => $modelR->bo_ade_fis ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'bo_ade_vis',
                    'format' => 'raw',
                    'value' => $modelR->bo_ade_vis ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'bo_ade_int',
                    'format' => 'raw',
                    'value' => $modelR->bo_ade_int ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'bo_ade_aud',
                    'format' => 'raw',
                    'value' => $modelR->bo_ade_aud ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'bo_ade_nan',
                    'format' => 'raw',
                    'value' => $modelR->bo_ade_nan ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'bo_ade_mul',
                    'format' => 'raw',
                    'value' => $modelR->bo_ade_mul ? '<span class="badge" style="background-color:#5cb85c">Sim</span>' : '<span class="badge" style="background-color:#d9534f">Não</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
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
                    'value' => $modelR->nu_cod_cid,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 7%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nm_des_cid',
                    'value' => $modelR->nm_des_cid,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 7%; font-size:14px;'],
                    'displayOnly' => true,
                ],
            ]
        ],
        [
            'group' => true,
            'label' => 'Endereço',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nu_num_cep',
                    'value' => MarArtHelpers::mascaraString('##.###-###', $modelR->nu_num_cep),
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nm_nom_log',
                    'value' => $modelR->nm_nom_log,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nu_num_cas',
                    'value' => $modelR->nu_num_cas,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nm_nom_com',
                    'value' => $modelR->nm_nom_com,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nm_nom_bai',
                    'id' => 'nm_nom_bai',
                    'value' => $modelR->nm_nom_bai,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nm_nom_mun',
                    'value' => $modelR->nm_nom_mun,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nm_nom_est',
                    'value' => $modelR->nm_nom_est,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
            ],
        ],
        [
            'group' => true,
            'label' => 'Contato',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nu_num_tel',
                    'label' => 'Telefone:',
                    'value' => (strlen($modelR->nu_num_tel) == 11) ?
                        MarArtHelpers::mascaraString('(##) #####-####', $modelR->nu_num_tel) :
                        MarArtHelpers::mascaraString('(##) ####-####', $modelR->nu_num_tel),
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nu_num_tel_1',
                    'label' => 'T. Contato:',
                    'value' => (strlen($modelR->nu_num_tel_1) == 11) ?
                        MarArtHelpers::mascaraString('(##) #####-####', $modelR->nu_num_tel_1) :
                        MarArtHelpers::mascaraString('(##) ####-####', $modelR->nu_num_tel_1),
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 12%; font-size:14px;'],
                    'displayOnly' => true,
                ],
                [
                    'attribute' => 'nm_nom_ema',
                    'value' => $modelR->nm_nom_ema,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
            ],
        ],
        [
            'group' => true,
            'label' => 'Observações',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nm_nom_obs',
                    'value' => $modelR->nm_nom_obs,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 1%; font-size:14px;'],
                    'displayOnly' => true,
                ],
            ],
        ],
    ];
    ?>


    <p id="crasRes" style="color: green; font-size: x-large; text-align: left; margin: 0"></p>


    <?php
    // View file rendering the widget
    echo DetailView::widget([
        'krajeeDialogSettings' => [
            'overrideYiiConfirm' => false,
            'useNative' => true,
        ],
        'model' => $modelR,
        'attributes' => $attributes,
        'mode' => 'view',
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
    ]);
    ?>
    <p>
    <div class="card-footer d-flex justify-content-md-end">
        <?php
        echo Html::button("<span class='fas fa-user-edit' aria-hidden='true'></span><span>&nbsp;&nbsp;Editar</span>", [
            'id' => 'btn_editar',
            'class' => 'btn btn-sm btn-outline-primary mr-sm-2',
            'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/res/responsaveis/update', 'idRes' => $modelR->id_num_res, 'isDel' => false]) . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Editar responsável',
            'value' => 'editar',
            'name' => 'btn'
        ]);
        echo '&nbsp;&nbsp;&nbsp;';
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
        $urlDel = Yii::$app->urlManager->createUrl(['/res/responsaveis/delete-fake', 'idRes' => $modelR->id_num_res]);

        echo Html::button("<span class='fas fa-user-plus' aria-hidden='true'></span><span>&nbsp;&nbsp;Criar dependente(s)</span>", [
            'id' => 'btn_create',
            'class' => 'btn btn-sm btn-outline-success mr-sm-2',
            'onclick' => "window.location.href = '" . $url . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Criar dependente(s) para responsável',
            'value' => 'criar',
            'name' => 'btn_create',
        ]);
        echo '&nbsp;&nbsp;&nbsp;';
        /*  echo Html::button("<span class='fas fa-user-minus' aria-hidden='true'></span><span>&nbsp;&nbsp;Deletar</span>", [
                'id' => 'btn_delete',
                'class' => 'btn btn-sm btn-outline-danger mr-sm-2',
                'data' => [
                    'url' => "'" . Yii::$app->urlManager->createUrl(['/res/responsaveis/delete-fake', 'idRes' => $modelR->id_num_res]) . "';",
                    'urlReturn' => Yii::$app->request->url,
                    'title' => 'Deletar responsável',
                    'confirm' => 'Você não será capaz de recuperar este(a) ',
                    'module' => 'Responsável',
                    'value' => 'delete',
                    'method' => 'post',
                    'pjax' => 0,
                    'name' => 'b_delete',
                ],
            ]); */
        echo Html::a("<span class='fas fa-user-minus' aria-hidden='true'></span><span>&nbsp;&nbsp;Deletar</span>", null, [
            'id' => 'lnk_delete',
            'class' => 'btn btn-sm btn-outline-danger mr-sm-2',
            'data' => [
                'url' => $urlDel,
                'urlReturn' => Yii::$app->urlManager->createUrl(['/res/responsaveis/index']),
                'title' => 'Deletar responsável',
                'confirm' => 'Você não será capaz de recuperar este(a) ',
                'module' => 'Responsável',
                'value' => 'delete',
                'name' => 'l_delete',
            ],
        ]);
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        $urlRes = Yii::$app->urlManager->createUrl([
            '/res/responsaveis/index-responsavel',
            'idRes' => $modelR->id_num_res
        ]);
        echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Responsável</span>", [
            'class' => 'btn btn-sm btn-outline-info mr-sm-2',
            'onclick' => "window.location.href = '" . $urlRes . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Voltar responsável',
        ]);
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        $urlIndex = Yii::$app->urlManager->createUrl(['/res/responsaveis/index']);
        echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
            'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
            'onclick' => "window.location.href = '" . $urlIndex . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Voltar lista responsáveis',
        ]);
        ?>
    </div>
</div>

<?php
$script = <<< JS
$('#crasRes').ready(function() { 
    $.ajax({ 
        url:"get-cras",
        type: "POST", 
        data: {nmCra: '$modelR->nm_nom_bai'} ,
        dataType: "json", 
        success: function(data) { 
        var str = 'Centro de Referência da Assistência Social - CRAS  -  ';
        var cra = data["nomeCras"];
        var result = cra.fontcolor("blue");
        document.getElementById("crasRes").innerHTML = str + result;           
        }
    })
});        
JS;
$this->registerJs($script);
?>