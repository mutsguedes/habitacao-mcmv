<?php

use yii\web\View;
use kartik\helpers\Html;
use kartik\detail\DetailView;
use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelER EmailRespostas */

$this->registerJs("$('#resma-view-modal').modal('show');", View::POS_READY);
?>

<div class="modal fade" id="resma-view-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content espacorow">
            <div class="card-header">
                <button onClick='window.history.back(-1);' type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
                <div class="row d-flex justify-content-center" style="padding-top: 5px">
                    <h4>
                        <?=
                        'Email da(o) Cidadã(o) - '
                            . Html::label(Yii::$app->user->identity->name, null, ['style' => 'color:red']);
                        ?>
                    </h4>
                </div>
            </div> <!-- card-header -->
            <div class="card-body">
                <?php
                $attributes = [
                    [
                        'group' => true,
                        'label' => 'Resposta',
                        'rowOptions' => [
                            'class' => 'info',
                            'style' => 'font-weight:bold;font-size:16px;color:green'
                        ]
                    ],
                    [
                        'columns' => [
                            [
                                'attribute' => 'id_num_ema',
                                'label' => 'Nome:',
                                'value' => Yii::$app->user->identity->name,
                                'format' => 'raw',
                                'displayOnly' => true,
                            ],
                            [
                                'attribute' => 'id_num_ema',
                                'label' => 'Cpf:',
                                'value' => MarArtHelpers::mascaraString('###.###.###-##', Yii::$app->user->identity->nu_num_cpf),
                                'format' => 'raw',
                                'displayOnly' => true,
                            ],
                        ]
                    ],
                    [
                        'columns' => [
                            [
                                'attribute' => 'nm_nom_cid',
                                'label' => 'Sua resposta:',
                                'value' => $modelER->nm_nom_resp,
                                'format' => 'raw',
                                'displayOnly' => true,
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
            </div> <!-- card-body -->
            <div class="card-footer d-flex justify-content-md-end">
                <?=
                Html::Button("<span class='fas fa-user-edit' aria-hidden='true'></span><span>&nbsp;&nbsp;Editar</span>", [
                    'id' => 'btn_editar',
                    'class' => 'btn btn-sm btn-outline-primary mr-sm-2',
                    'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/email/emails/update', 'idER' => $modelER->id_ema_res]) . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Editar email',
                    'value' => 'editar',
                    'name' => 'btn'
                ])
                ?>
                <?php
                echo '&nbsp;&nbsp;&nbsp;';
                ?>
                <?=
                Html::Button("<span class='fas fa-user-plus' aria-hidden='true'></span><span>&nbsp;&nbsp;Criar resposta</span>", [
                    'id' => 'btn_editar',
                    'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                    'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/email/emails/s/create', 'idEma' => $modelER->id_num_ema]) . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Criar resposta email',
                    'value' => 'editar',
                    'name' => 'btn'
                ])
                ?>
                <?php
                echo '&nbsp;&nbsp;&nbsp;';
                ?>
                <?=
                Html::Button("<span class='fas fa-user-minus' aria-hidden='true'></span><span>&nbsp;&nbsp;Deletar</span>", [
                    'id' => 'btn_deletar',
                    'class' => 'btn btn-sm btn-outline-danger mr-sm-2',
                    'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/email/emails/delete-fake', 'idER' => $modelER->id_ema_res]) . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Deletar email',
                    'value' => 'deletar',
                    'name' => 'btn'
                ])
                ?>
                <?php
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlEma = Yii::$app->urlManager->createUrl([
                    '/email/emails/index-email',
                    'idEma' => $modelER->id_num_ema
                ]);
                echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Email</span>", [
                    'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlEma . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar email',
                ]);
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlIndex = Yii::$app->urlManager->createUrl([
                    '/emares/email-respostas/lista-respostas-ema',
                    'idEma' => $modelER->id_num_ema
                ]);
                echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                    'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlIndex . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar lista resposta',
                ])
                ?>
            </div> <!-- Modal footer -->
        </div> <!-- Modal content -->
    </div> <!-- Modal dialog -->
</div> <!-- The Modal -->