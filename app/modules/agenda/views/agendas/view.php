<?php


use yii\web\View;
use yii\helpers\Url;
use Da\QrCode\QrCode;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use kartik\detail\DetailView;
use app\components\MarArtHelpers;
use Da\QrCode\Format\MeCardFormat;

/* @var $this View */
/* @var $modelA Agenda */


/* $format = new MeCardFormat();
$format->firstName = 'Antonio';
$format->lastName = 'Ramirez';
$format->sound = 'docomotaro';
$format->phone = '657657XXX';
$format->videoPhone = '657657XXX';
$format->email = 'hola@2amigos.us';
$format->note = 'test-note';
$format->birthday = '19791201';
$format->address = 'test-address';
$format->url = 'http://2amigos.us';
$format->nickName = 'tonydspaniard';

$qrCode = new QrCode($format);

header('Content-Type: ' . $qrCode->getContentType());
//echo $qrCode->writeString();

$qCode = base64_encode($qrCode->writeString()); */

$this->registerJs(
    "$('#age-view-modal').modal('show');",
    View::POS_READY,
);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'age-view',
]);
?>
<div class="modal fade" id="age-view-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <?=
                            'Agenda da(o) Cidadã(o) - '
                                . Html::label($modelA->nm_nom_cid, null, ['style' => 'color:red']);
                            ?>
                            </h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px;">
                    <?php
                    $attributes = [
                        [
                            'group' => true,
                            'label' => 'Cidadão',
                            'rowOptions' => [
                                'class' => 'info',
                                'style' => 'font-weight:bold;font-size:16px;color:green'
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'nu_num_cpf',
                                    'label' => 'Cpf:',
                                    'value' => MarArtHelpers::mascaraString('###.###.###-##', $modelA->nu_num_cpf),
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 1%'],
                                    'valueColOptions' => ['style' => 'width:25%'],
                                    'displayOnly' => true,
                                ],
                                [
                                    'attribute' => 'nm_nom_cid',
                                    'label' => 'Nome:',
                                    'value' => $modelA->nm_nom_cid,
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 1%'],
                                    'displayOnly' => true,
                                ],
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'nu_num_tel',
                                    'label' => 'Telefone:',
                                    'value' => (strlen($modelA->nu_num_tel) == 11) ?
                                        MarArtHelpers::mascaraString('(##) #####-####', $modelA->nu_num_tel) :
                                        MarArtHelpers::mascaraString('(##) ####-####', $modelA->nu_num_tel),
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 1%'],
                                    'valueColOptions' => ['style' => 'width:20%'],
                                    'displayOnly' => true,
                                ],
                                [
                                    'attribute' => 'id_num_ass',
                                    'label' => 'Assunto:',
                                    'value' => $modelA->numAss->nm_nom_ass,
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 1%'],
                                    'displayOnly' => true,
                                ],
                                [
                                    'attribute' => 'id_num_sta',
                                    'label' => 'Status:',
                                    'value' => $modelA->numSta->nm_des_sta,
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 1%'],
                                    'displayOnly' => true,
                                ],
                            ]
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute' => 'dt_age_dat',
                                    'label' => 'Data:',
                                    'value' => $modelA->dt_age_dat,
                                    'format' => 'date',
                                    'labelColOptions' => ['style' => 'width: 1%'],
                                    'valueColOptions' => ['style' => 'width:24%'],
                                    'displayOnly' => true,
                                ],
                                [
                                    'attribute' => 'ti_age_hor',
                                    'label' => 'Horário:',
                                    'value' => $modelA->ti_age_hor,
                                    'format' => 'raw',
                                    'labelColOptions' => ['style' => 'width: 1%'],
                                    'displayOnly' => true,
                                ],
                            ]
                        ],
                    ];
                    ?>
                    <div class="row align-items-center">
                        <div class="col-2 text-center" style="padding: 0px;">
                            <img src="<?= Url::to(['/agenda/agendas/qrcode', 'idAge' => $modelA->id_num_age]) ?>" />
                        </div>
                        <div class="col-10" style="padding-left: 0px;">
                            <?php
                            // View file rendering the widget
                            try {
                                echo DetailView::widget([
                                    'krajeeDialogSettings' => [
                                        'overrideYiiConfirm' => false,
                                        'useNative' => true,
                                    ],
                                    'model' => $modelA,
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
                                Yii::$app()->session->setFlash($e->getTraceAsString());
                            }
                            ?>
                        </div>
                    </div>
                </div> <!-- border -->
            </div> <!-- modal-body -->

            <?php $urlDel = Yii::$app->urlManager->createUrl(['/age/agendas/delete-fake', 'idAge' => $modelA->id_num_age]); ?>

            <div class="modal-footer d-flex justify-content-md-end">
                <?=
                Html::button("<span class='far fa-edit' aria-hidden='true'></span><span>&nbsp;&nbsp;Editar</span>", [
                    'id' => 'btn_editar',
                    'class' => 'btn btn-sm btn-outline-primary mr-sm-2',
                    'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl([
                        "/agenda/agendas/update",
                        "idAge" => $modelA->id_num_age,
                        "date" => "",
                        "time" => ""
                    ]) . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Editar agenda',
                    'value' => 'editar',
                    'name' => 'btn'
                ])
                ?>
                <?php
                echo '&nbsp;&nbsp;&nbsp;';
                ?>
                <?=
                Html::Button("<span class='fas fa-calendar-plus' aria-hidden='true'></span><span>&nbsp;&nbsp;Criar agenda</span>", [
                    'id' => 'btn_criar',
                    'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                    'onClick' => "window.location.href = '" . Yii::$app->urlManager->createUrl('/agenda/agendas/pre-create') . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Criar nova agenda',
                    'value' => 'criar',
                    'name' => 'btn'
                ])
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
                        'title' => 'Deletar agenda',
                        'confirm' => 'Você não será capaz de recuperar este(a) ',
                        'module' => 'Agenda',
                        'value' => 'delete',
                        'name' => 'b_delete',
                    ],
                ]);
                ?>
                <?php
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlAge = Yii::$app->urlManager->createUrl([
                    '/agenda/agendas/index-cidadao',
                    'cpfCid' => $modelA->nu_num_cpf
                ]);
                echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Agenda</span>", [
                    'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlAge . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar agenda',
                ]);
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlIndex = Yii::$app->urlManager->createUrl(['/agenda/agendas/index']);
                echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                    'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlIndex . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar lista agendas',
                ]);
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- Modal content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal -->
<?php ActiveForm::end(); ?>