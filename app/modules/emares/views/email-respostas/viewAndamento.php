<?php

use yii\web\View;
use kartik\helpers\Html;
use kartik\detail\DetailView;

/* @var $this View */
/* @var $modelER EmailRespostas */

$this->registerJs("$('#resma-view-modal').modal('show');", View::POS_READY);
?>

<div class="modal fade" id="resma-view-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content espacorow">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?=
                    'Email da(o) Cidadã(o) - '
                        . Html::label(Yii::$app->user->identity->name, null, ['style' => 'color:red']);
                    ?>
                </h4>
                <button onClick='window.history.back(-1);' type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
            </div> <!-- Modal Header -->
            <div class="modal-body">
                <div id="results">
                    <?php
                    $attributes = [
                        [
                            'group' => true,
                            'label' => 'Resposta',
                            'rowOptions' => [
                                'class' => 'info text-justify',
                                'style' => 'font-weight:bold;font-size:16px;color:green'
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'id_num_cri',
                                    'label' => 'Altor:',
                                    //                                    'value' => $modelER->numCri->name,
                                    'value' => 'SMHPS',
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                ],
                                [
                                    'attribute' => 'dt_tim_cri',
                                    'label' => 'Data:',
                                    'format' => 'datetime',
                                    'type' => DetailView::INPUT_DATETIME,
                                    'widgetOptions' => [
                                        //                                        'pluginOptions' => ['format' => 'd-m-Y H:i:s']
                                    ],
                                    'displayOnly' => true,
                                ],
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'nm_nom_resp',
                                    'label' => 'Detalhes:',
                                    'value' => $modelER->nm_nom_resp,
                                    'format' => 'raw',
                                    'displayOnly' => true,
                                    'valueColOptions' => ['class' => 'text-justify']
                                ]
                            ]
                        ]
                    ];

                    // View file rendering the widget
                    try {
                        echo DetailView::widget([
                            'model' => $modelER,
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
                </div> <!-- Modal result -->
            </div> <!-- Modal body -->
            <div class="modal-footer">
                <?php
                $urlER = Yii::$app->urlManager->createUrl(['/emares/email-respostas/view-historico', 'idEma' => $modelER->id_num_ema]);
                echo Html::Button(
                    "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar histórico</span>",
                    [
                        'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'onclick' => "window.location.href = '" . $urlER . "';",
                        'value' => 'voltar',
                        'title' => 'Voltar histórico email',
                        'name' => 'btn'
                    ]
                );
                ?>
            </div> <!-- Modal footer -->
        </div> <!-- Modal content -->
    </div> <!-- Modal dialog -->
</div> <!-- The Modal -->