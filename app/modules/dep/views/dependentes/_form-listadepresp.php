<?php


use yii\web\View;
use yii\widgets\Pjax;
use kartik\helpers\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerParentesco;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\tecsoc\models\TecsocDocumento;

/* @var $this View */
/* @var $searchModel DependenteSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $form ActiveForm */
/* @var $modelD Dependente */
/* @var idRes */
?>
<?php
$this->registerJs("$('#dependente-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'dependente-index',
]);
?>
<div class="modal fade" id="dependente-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    . Html::label(Responsavel::findOne($idRes)->nm_nom_res, null, ['style' => 'color:red']);
                                ?>
                            </h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <?php
                    $gridColumns = [
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'nm_ide_pes',
                            'label' => 'Id:',
                            'contentOptions' => ['style' => 'width:50px; white-space: normal;',],
                            'hAlign' => 'center',
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'nm_nom_pes',
                            'label' => 'Nome:',
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'nu_num_cpf',
                            'label' => 'CPF:',
                            'value' => function ($modelD) {
                                return MarArtHelpers::mascaraString('###.###.###-##', $modelD['nu_num_cpf'],);
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'dt_nas_pes',
                            'label' => 'D.N.:',
                            'format' => 'date',
                            'value' => function ($modelD) {
                                return $modelD['dt_nas_pes'];
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'nm_nom_par',
                            'label' => 'Parentesco:',
                            'value' => function ($modelD) {
                                // $idPar = Dependente::find(intval($modelD['id_num_pes']))->one();
                                $parentesco = Dependente::findOne(intval($modelD['id_num_pes']));
                                // $pkCount = (is_array($parentesco) ? count($parentesco) : 0);
                                if ($modelD['id_num_par'] == 'n') {
                                    $par = 'RESPONSÁVEL';
                                } else {
                                    $par = $parentesco->numPar->nm_nom_par;
                                }
                                return $par;
                            },
                        ],
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'options' => ['style' => 'width:10%'],
                            'template' => '{view} {update} {delete} {document}',
                            'buttons' => [
                                'view' => function ($url, $modelD) {
                                    if ($modelD['nm_ide_pes'] == 'R') {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/res/responsaveis/view',
                                            'idRes' => $modelD['id_num_pes'],
                                        ]);
                                    } elseif ($modelD['nm_ide_pes'] == 'D') {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/dep/dependentes/view',
                                            'idDep' => $modelD['id_num_pes'],
                                        ]);
                                    }
                                    return Html::a('<span class="fas fa-eye"></span>', $url, [
                                        'class' => 'btncolorview',
                                        'title' => 'Exibir membro familiar.',
                                    ]);
                                },
                                'update' => function ($url, $modelD) {
                                    if ($modelD['nm_ide_pes'] == 'R') {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/res/responsaveis/update',
                                            'idRes' => $modelD['id_num_pes'],
                                        ]);
                                    } elseif ($modelD['nm_ide_pes'] == 'D') {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/dep/dependentes/update',
                                            'idDep' => $modelD['id_num_pes'],
                                        ]);
                                    }
                                    return Html::a('<span class="fas fa-user-edit"></span>', $url, [
                                        'class' => 'btncolorupdate',
                                        'title' => 'Editar membro familiar.',
                                    ]);
                                },
                                'delete' => function ($url, $modelD) {
                                    if ($modelD['nm_ide_pes'] == 'R') {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/res/responsaveis/delete-fake',
                                            'idRes' => $modelD['id_num_pes'],
                                        ]);
                                    } elseif ($modelD['nm_ide_pes'] == 'D') {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/dep/dependentes/delete-fake',
                                            'idDep' => $modelD['id_num_pes'],
                                        ]);
                                    }
                                    return Html::a('<i class="fas fa-trash"></i>', $url, [
                                        'class' => 'btncolordelete',
                                        'data' => [
                                            'title' => 'Deletar membro familiar.',
                                            'confirm' => 'Membro deletar',
                                            'method' => 'post',
                                        ],
                                        'title' => 'Deletar membro familiar.',
                                    ]);
                                },
                                'document' => function ($url, $modelD) {
                                    if ($modelD['nm_ide_pes'] == 'R') {
                                        $idRes = str_pad($modelD['id_num_pes'], 11, '0', STR_PAD_LEFT);
                                        $idDep = '00000000000';
                                    } else {
                                        $idDep = str_pad($modelD['id_num_pes'], 11, '0', STR_PAD_LEFT);
                                        $idRes = str_pad(Dependente::findOne(['id_num_dep' => $modelD['id_num_pes']])->id_num_res, 11, '0', STR_PAD_LEFT);
                                    }
                                    $pes = $idRes . '-' . $idDep;
                                    $isDoc = TecsocDocumento::findAll(['id_num_pes' => $pes, 'bo_reg_exc' => 0]);
                                    if (count($isDoc) == 0) {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/tecsoc/tecnico-social/create-tecsoc-document',
                                            'idPes' => $modelD['id_num_pes'],
                                            'idTip' => $modelD['nm_ide_pes'],
                                        ]);
                                        return Html::a('<span class="fas fa-file-contract"></span>', $url, [
                                            'class' => 'btncolorcreate',
                                            'title' => 'Criar doc. membro familiar.',
                                        ]);
                                    } else {
                                        $url = Yii::$app->urlManager->createUrl([
                                            '/tecsoc/tecnico-social/update-tecsoc-document',
                                            'idPes' => $modelD['id_num_pes'],
                                            'idTip' => $modelD['nm_ide_pes'],
                                        ]);
                                        return Html::a('<span class="fas fa-file-signature"></span>', $url, [
                                            'class' => 'btncolorupdate',
                                            'title' => 'Editar doc. membro familiar.',
                                        ]);
                                    }
                                },
                            ],
                        ]
                    ];
                    ?>
                    <?php
                    Pjax::begin(['id' => 'pjax-depRes']);
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
                            'rowOptions' => ['class' => 'table-danger', 'size' => 'sm', 'style' => 'overflow-x: scroll;'],
                            'pjax' => false,
                            'striped' => true,
                            'hover' => true,
                            'condensed' => true,
                            'responsive' => true,
                            //'showFooter' => false,
                            'footerRowOptions' => ['style' => 'font-weight:bold;text-decoration: underline;'],
                            'filterSelector' => 'select[name="per-page"]',
                            'toolbar' => [
                                [
                                    'content' =>
                                    Html::a('<i class="fa fa-user-plus"></i>', [
                                        '/dep/dependentes/create', 'idRes' => $idRes
                                    ], [
                                        'type' => 'button',
                                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                                        'title' => 'Criar dependente(s)',
                                    ]) . '&nbsp;&nbsp;&nbsp;' .
                                        Html::a('<i class="fas fa-redo-alt"></i>', [
                                            '/dep/dependentes/lista-dependentes-resp',
                                            'idRes' => $idRes
                                        ], [
                                            'type' => 'button',
                                            'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                                            'title' => 'Redefinir gride',
                                        ]),
                                    'options' => ['class' => 'btn-group mr-2 me-2']
                                ],
                            ],
                            'panel' => [
                                'heading' => '<span><i class="fas fa-users"></i>&nbsp;&nbsp;Família</span>',
                                'type' => 'success',
                                'before' => Html::label(Responsavel::findOne($idRes)->nm_nom_res, null, ['style' => 'color:red']),
                                'footer' => false
                            ],
                        ]);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        Yii::$app->session->setFlash($e->getTraceAsString());
                    }
                    Pjax::end();
                    ?>
                </div> <!-- border -->
            </div> <!-- Modal body -->
            <div class="modal-footer justify-content-md-end">
                <?php
                $urlRes = Yii::$app->urlManager->createUrl([
                    '/res/responsaveis/index-responsavel',
                    'idRes' => $idRes
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
                ])
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div><!-- the modal -->
<?php ActiveForm::end(); ?>