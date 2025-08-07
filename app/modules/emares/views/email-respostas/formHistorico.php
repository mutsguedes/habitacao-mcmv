<?php


use yii\widgets\Pjax;
use kartik\helpers\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $form ActiveForm */
/* @var $modelE Emails */
/* @var $modelER EmailRespostas */
/* @var $dataProvider ActiveDataProvider */
?>

<?php
$form = ActiveForm::begin([
    'id' => 'resema',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
]);
?>
<div class="card">
    <div class="card-header">
        <h5 class="modal-title">
            <?=
            'Email da(o) Cidadã(o) - '
                . Html::label($modelE['nm_nom_cid'], null, ['style' => 'color:#d9534f']);
            ?>
        </h5>
    </div> <!-- card header -->
    <div class="card border-success mb-3">
        <div class="card-header" style="padding-top: 35px">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title">
                        <?=
                        'Número Email - ' . Html::label($modelE['numEmail'], null, ['style' => 'color:#5cb85c']);
                        ?>
                    </h4>
                </div> <!-- col-sm-6 -->
                <div class="col-sm-6">
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?=
                        'Assunto Email - ' . Html::label($modelE['nm_nom_sub'], null, ['style' => 'color:#5cb85c']);
                        ?>
                        <br>
                        <?=
                        'Data Email - ' . Html::label($modelE['dataEmail'], null, ['style' => 'color:#5bc0de']);
                        ?>
                    </h6>
                </div> <!-- col-sm-6 -->
            </div> <!-- row -->
        </div> <!-- card header -->
        <div class="row" style="margin: 25px 0px 25px 0px; padding-top: 10px; background-color: #ffff99">
            <div class="col-sm-6">
                <?=
                'Situação do Pedido - ' . Html::label($modelE['nm_ema_sit'], null, ['style' => 'color:#5bc0de']);
                ?>
            </div> <!-- col-sm-6 -->
            <div class="col-sm-6">
                <?=
                'Data Situação - ' . Html::label($modelE['dt_tim_mod'], null, ['style' => 'color:#5bc0de']);
                ?>
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
    </div> <!-- card -->
    <div class="card border-success mb-3">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Descrição do Email</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#history" role="tab" aria-controls="history" aria-selected="false">Informações adicionais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#deals" role="tab" aria-controls="deals" aria-selected="false">Andamento</a>
                </li>
            </ul>
        </div> <!-- card header -->
        <div class="card-body">
            <div class="tab-content mt-3">
                <div class="tab-pane active text-justify" id="description" role="tabpanel">
                    <?=
                    Html::label($modelE['nm_nom_bod'], null, ['style' => 'color:#0275d8']);
                    ?>
                </div> <!-- tab-pane active -->
                <div class="tab-pane text-justify" id="history" role="tabpanel" aria-labelledby="history-tab">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cpf</td>
                                <td><?= Html::label($modelE['nu_num_cpf'], null, ['style' => 'color:#5cb85c']); ?></td>
                            </tr>
                            <tr>
                                <td>Telefone</td>
                                <td><?= Html::label($modelE['nu_num_tel'], null, ['style' => 'color:#5cb85c']); ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= Html::label($modelE['nm_nom_ema'], null, ['style' => 'color:#5cb85c']); ?></td>
                        </tbody>
                    </table>
                </div> <!-- tab-pane active -->
                <div class="tab-pane" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                    <?php
                    $gridColumns = [
                        [
                            'class' => 'yii\grid\DataColumn',
                            'contentOptions' => ['style' => 'width:150px; white-space: normal;'],
                            'attribute' => 'dt_tim_cri',
                            'format' => 'date',
                            'label' => 'Data:',
                            'value' => 'dt_tim_cri',
                            //                            'format' => ['date', 'php:d-m-Y']
                        ],
                        [
                            'class' => 'yii\grid\DataColumn',
                            'contentOptions' => ['style' => 'width:200px; white-space: normal;'],
                            'attribute' => 'descricao',
                            'value' => 'emaAnd.nm_ema_and',
                        ],
                        [
                            'class' => 'yii\grid\DataColumn',
                            'contentOptions' => ['style' => 'width:250px; white-space: normal;'],
                            'attribute' => 'autor',
                            'label' => 'Autor:',
                            'value' => function ($modelER) {
                                if (in_array($modelER->id_ema_and, [2, 3])) {
                                    return 'SMHPS';
                                } else if (in_array($modelER->id_ema_and, [1, 4, 7])) {
                                    return $modelER->numCri->name;
                                } else if (in_array($modelER->id_ema_and, [5, 6])) {
                                    return 'SISTEMA';
                                }
                            }
                        ],
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'template' => '{view}{finalizar}',
                            'buttons' => [
                                'view' => function ($url, $modelER) {
                                    $url = Yii::$app->urlManager->createUrl([
                                        '/emares/email-respostas/view-andamento',
                                        'idER' => $modelER->id_ema_res
                                    ]);
                                    if (!in_array($modelER->id_ema_and, [1, 2, 5, 6])) {
                                        if (($modelER->id_ema_and == 7) && ($modelER->numEma->id_ema_sit == 4)) {
                                            return;
                                        } else {
                                            if ($modelER->id_ema_and == 7) {
                                                $url = Yii::$app->urlManager->createUrl([
                                                    '/ava/email-avaliacoes/view-avaliacao',
                                                    'idEA' => $modelER->id_ema_res
                                                ]);
                                                return Html::a('<span class="fas fa-eye"></span>', $url, [
                                                    'class' => 'btncolorview',
                                                    'title' => 'Exibir avaliação',
                                                ]);
                                            } else {
                                                return Html::a('<span class="fas fa-eye"></span>', $url, [
                                                    'class' => 'btncolorview',
                                                    'title' => 'Exibir complmento',
                                                ]);
                                            }
                                        }
                                        //                                        } else if ($modelER->numEma->id_ema_sit = 5) {
                                        //                                            return ;
                                        //                                        }
                                    }
                                },
                                'finalizar' => function ($url, $modelER, $key) {
                                    $url = Yii::$app->urlManager->createUrl([
                                        '/ava/email-avaliacoes/create',
                                        'idEma' => $modelER->numEma->id_num_ema
                                    ]);
                                    if (Yii::$app->user->can('visitante')) {
                                        $conut = $modelER::find()->count();
                                        //if (($modelER->id_ema_and == 3) and ($key == $conut)) {
                                        return Html::a('<span class="fas fa-check-double" style="margin-left: 10px"></span>', $url, [
                                            'class' => 'btncolorfinalizar',
                                            'title' => 'Finalizar demanda',
                                        ]);
                                        // }
                                    }
                                },
                            ],
                        ]
                    ];
                    $andamento = ArrayHelper::getColumn($modelER, 'id_ema_and');
                    if (in_array(end($andamento), [3, 4])) {
                        $toolbar = ['content' =>
                        Html::a('<i class="fas fa-mail-bulk"></i>', [
                            '/emares/email-respostas/create-email-resp', 'idEma' => $idEma
                        ], [
                            'type' => 'button',
                            'class' => 'btn-success btn-sm',
                            'title' => 'Criar complemento',
                        ]) . '&nbsp;&nbsp;' .
                            Html::a('<i class="fas fa-redo-alt"></i>', [
                                '/emares/email-respostas/view-historico',
                                'idEma' => $idEma
                            ], [
                                'type' => 'button',
                                'class' => 'btn-info btn-sm',
                                'title' => 'Redefinir gride',
                            ])];
                    } else {
                        $toolbar = ['content' =>
                        Html::a('<i class="fas fa-redo-alt"></i>', [
                            '/emares/email-respostas/view-historico',
                            'idEma' => $idEma
                        ], [
                            'type' => 'button',
                            'class' => 'btn-info btn-sm',
                            'title' => 'Redefinir gride',
                        ])];
                    }
                    ?>
                    <?php
                    Pjax::begin(['id' => 'pjax-emaRes']);
                    try {
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumns,
                            'pager' => [
                                'options' => ['class' => 'pagination pagination-sm'], // set clas name used in ui list of pagination
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
                                return ['class' => 'table-success', 'size' => 'sm', 'style' => 'overflow-x: scroll;'];
                            },
                            'pjax' => false,
                            'striped' => true,
                            'hover' => true,
                            'condensed' => true,
                            'responsive' => true,
                            //'showFooter' => false,
                            'footerRowOptions' => ['style' => 'font-weight:bold;text-decoration: underline;'],
                            'filterSelector' => 'select[name="per-page"]',
                            'toolbar' => $toolbar,
                            'panel' => [
                                'heading' => '<span><i class="fas fa-network-wired"></i>&nbsp;&nbsp;Andamento email(s)</span>',
                                'type' => 'success',
                                'before' => (!isset($modelER->id_ema_res)) ? '' : Html::label(Yii::$app->user->identity->name, null, ['style' => 'color:red']),
                                //'footer' => false
                            ],
                        ]);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        Yii::$app->session->setFlash($e->getTraceAsString());
                    }
                    Pjax::end();
                    ?>
                </div> <!-- tab-pane active -->
            </div> <!-- tab-content -->
        </div> <!-- card body -->
    </div> <!-- card -->
    <div class="card-footer d-flex justify-content-md-end">
        <?php
        if (Yii::$app->user->can('administrativo')) {
            $urlE = Yii::$app->urlManager->createUrl(['/email/emails/index-email']);
        } else if (Yii::$app->user->can('visitante')) {
            $urlE = Yii::$app->urlManager->createUrl(['/email/emails/index']);
        }
        echo Html::button(
            "<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Protocolo</span>",
            [
                'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                'id' => 'btn_voltar',
                'title' => 'Voltar ao(s) protocolo(s)',
                'onclick' => "window.location.href = '" . $urlE . "';",
                'value' => 'voltar',
                'name' => 'btn'
            ]
        );
        ?>
    </div> <!-- card footer -->
</div> <!-- card -->
<?php ActiveForm::end(); ?>