<?php


use Yii;
use yii\web\View;
use yii\widgets\Pjax;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\MarArtHelpers;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerParentesco;






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
<div class="modal fade" id="dependente-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="0" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    $pessoas = $dataProvider->getModels();
                    $gridColumns = [
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'nm_nom_dep',
                            'label' => 'Nome:',
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'nu_num_cpf',
                            'label' => 'CPF:',
                            'value' => function ($pessoas) {
                                return MarArtHelpers::mascaraString('###.###.###-##', $pessoas['nu_num_cpf'],);
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'dt_nas_dep',
                            'label' => 'D.N.:',
                            'format' => 'date',
                            'value' => function ($pessoas) {
                                return $pessoas['dt_nas_dep'];
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'parentesco',
                            'label' => 'Parentesco:',
                            'value' => 'numPar.nm_nom_par',
                            'contentOptions' => ['style' => 'width:170px; white-space: normal;'],
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => ArrayHelper::map(GerParentesco::find()->orderBy('nm_nom_par')->asArray()->all(), 'nm_nom_par', 'nm_nom_par'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true, /* 'minimumInputLength' => 3, */]
                            ],
                            'filterInputOptions' => ['placeholder' => 'Sel. parentesco'],
                            'format' => 'raw',
                        ],
                        [
                            'class' => 'kartik\grid\BooleanColumn',
                            'attribute' => 'bo_mem_def',
                            'vAlign' => 'middle',
                            'label' => 'Deficiênte',
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => [
                                'true' => 1, 'false' => 0
                            ],
                            'filterWidgetOptions' => [
                                'theme' => 'classic',
                                'hideSearch' => true,
                                'pluginOptions' => ['allowClear' => true, 'placeholder' => ''],
                            ],
                            'width' => '90px',
                            'trueIcon' => '<span class="badge" style="background-color:#5cb85c">Sim</span>',
                            'falseIcon' => '<span class="badge" style="background-color:#d9534f">Não</span>',
                            'trueLabel' => "Sim",
                            'falseLabel' => 'Não',
                            'vAlign' => 'middle'
                        ],
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'options' => ['style' => 'width:10%'],
                            'template' => '{view} {update} {delete} {document}',
                            'buttons' => [
                                'view' => function ($url, $pessoas) {
                                    $url = Yii::$app->urlManager->createUrl([
                                        '/dep/dependentes/view',
                                        'idDep' => $pessoas['id_num_dep'],
                                    ]);
                                    return Html::a('<span class="fas fa-eye"></span>', $url, [
                                        'class' => 'btncolorview',
                                        'title' => 'Exibir dependente.',
                                    ]);
                                },
                                'update' => function ($url, $pessoas) {
                                    $url = Yii::$app->urlManager->createUrl([
                                        '/dep/dependentes/update',
                                        'idDep' => $pessoas['id_num_dep'],
                                    ]);
                                    return Html::a('<span class="fas fa-user-edit"></span>', $url, [
                                        'class' => 'btncolorupdate',
                                        'title' => 'Editar dependente.',
                                    ]);
                                },
                                'delete' => function ($url, $pessoas) {
                                    $url = Yii::$app->urlManager->createUrl([
                                        '/dep/dependentes/delete-fake',
                                        'idDep' => $pessoas['id_num_dep'],
                                    ]);
                                    /* return Html::a('<i class="fas fa-trash"></i>', null, [
                                        'class' => 'btncolordelete',
                                        'data' => [
                                            'title' => 'Deletar dependente! Você tem certeza?',
                                            'confirm' =>
                                            "Você não será capaz de recuperar este Dependente!",
                                            'model' => 'Dependente',
                                            'action' => 'deletar',
                                            'url' => $url,
                                            'url-return' => Yii::$app->request->url,
                                            'method' => 'post',
                                            //'data-pjax' => 0,
                                        ],
                                        'title' => 'Deletar dependente.',
                                    ]); */
                                    return Html::a('<i class="fas fa-trash"></i>', $url, [
                                        'id' => 'lnk_delete',
                                        'class' => 'btncolordelete',
                                        'data' => [
                                            'url' => $url,
                                            'urlReturn' => Yii::$app->request->url,
                                            'title' => 'Deletar dependente',
                                            'confirm' => 'Você não será capaz de recuperar este(a) ',
                                            'module' => 'Dependente',
                                            'value' => 'delete',
                                            'name' => 'l_delete',
                                        ],
                                        'data-pjax' => 0
                                    ]);
                                },
                            ],
                        ]
                    ];
                    ?>
                    <?php
                    Pjax::begin(['id' => 'pjax-depRes']);
                    try {
                        echo GridView::widget([
                            'krajeeDialogSettings' => [
                                'overrideYiiConfirm' => false,
                                'useNative' => true,
                            ],
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
                                            '/dep/dependentes/lista-dependentes',
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
                                'heading' => '<span><i class="fas fa-users"></i>&nbsp;&nbsp;Dependente(s)</span>',
                                'type' => 'success',
                                // 'before' => Html::label(Responsavel::findOne($idRes)->nm_nom_res, null, ['style' => 'color:red']),
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