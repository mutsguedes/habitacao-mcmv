<?php


use yii\web\View;
use yii\widgets\Pjax;
use kartik\helpers\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\email\models\Email;

/* @var $this View */
/* @var $searchModel EmailRespostasSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $form ActiveForm */
/* @var $modelER EmailRespostas */
/* @var $idEma */
?>
<?php
$this->registerJs("$('#emailresposta-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'emailresposta-index',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
]);
?>
<div class="modal fade" id="emailresposta-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <button onClick='window.history.back(-1);' type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
                <div class="row d-flex justify-content-center" style="padding-top: 5px">
                    <h4>
                        <?=
                        'Email(s) da(o) Cidadã(o) - '
                            . Html::label(Email::findOne($idEma)->nm_nom_cid, null, ['style' => 'color:red']);
                        ?>
                    </h4>
                </div>
            </div> <!-- card-header -->
            <div class="card-body">
                <?php
                $gridColumns = [
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'width' => '250px',
                        'attribute' => 'cidadao',
                        'label' => 'Cidadã(o):',
                        'value' => 'emails.nm_nom_cid',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Email::find()->orderBy('nm_nom_cid')->asArray()->all(), 'nm_nom_cid', 'nm_nom_cid'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true, /* 'minimumInputLength' => 3, */]
                        ],
                        'filterInputOptions' => ['placeholder' => 'Sel. cidadão'],
                        'format' => 'raw',
                    ],
                    [
                        'class' => '\kartik\grid\DataColumn',
                        'width' => '250px',
                        'attribute' => 'cpf',
                        'label' => 'Cpf:',
                        'value' => 'emails.nu_num_cpf',
                        'contentOptions' => ['style' => 'width:200px; white-space: normal;'],
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Email::find()->orderBy('nu_num_cpf')->asArray()->all(), 'nu_num_cpf', 'nu_num_cpf'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true, /* 'minimumInputLength' => 3, */]
                        ],
                        'filterInputOptions' => ['placeholder' => 'Sel. cpf cidadão'],
                        'format' => 'raw',
                    ],
                    [
                        'class' => '\kartik\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $modelER) {
                                $url = Yii::$app->urlManager->createUrl([
                                    '/emares/email-respostas/view',
                                    'idER' => $modelER->id_res_ema
                                ]);
                                return Html::a('<span class="fas fa-eye"></span>', $url, [
                                    'class' => 'btncolorview',
                                    'title' => 'Exibir resposta emails.',
                                ]);
                            },
                            'update' => function ($url, $modelER) {
                                $url = Yii::$app->urlManager->createUrl([
                                    '/emares/email-respostas/update',
                                    'idER' => $modelER->id_res_ema
                                ]);
                                return Html::a('<span class="fas fa-edit"></span>', $url, [
                                    'class' => 'btncolorupdate',
                                    'title' => 'Editar resposta email.',
                                ]);
                            },
                            'delete' => function ($url, $modelER) {
                                $url = Yii::$app->urlManager->createUrl([
                                    '/dep/dependente/delete-fake',
                                    'idER' => $modelER->id_res_ema
                                ]);
                                return Html::a('<i class="fas fa-trash"></i>', $url, [
                                    'class' => 'btncolordelete',
                                    'data' => [
                                        'title' => 'Deletar dependente',
                                        'confirm' => 'Resposta deletar',
                                        'method' => 'post',
                                    ],
                                    'title' => 'Deletar resposta email.',
                                ]);
                            },
                        ],
                    ]
                ];
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
                        'toolbar' => [
                            ['content' =>
                            Html::a('<i class="fa fa-user-plus"></i>', [
                                '/emares/email-respostas/create-email-resp', 'idEma' => $idEma
                            ], [
                                'type' => 'button',
                                'class' => 'btn-success btn-sm',
                                'title' => 'Criar resposta email(s)',
                            ]) . '&nbsp;&nbsp;&nbsp;' .
                                Html::a('<i class="fas fa-redo-alt"></i>', [
                                    '/emares/email-respostas/lista-respostas-ema',
                                    'idEma' => $idEma
                                ], [
                                    'type' => 'button',
                                    'class' => 'btn-info btn-sm',
                                    'title' => 'Redefinir gride',
                                ]),],
                        ],
                        'panel' => [
                            'heading' => '<span><i class="fa fa-users"></i>&nbsp;&nbsp;Resposta email(s)</span>',
                            'type' => 'success',
                            'before' => (!isset($modelER->id_ema_res)) ? '' : Html::label($modelER->emaRes->nm_nom_cid, null, ['style' => 'color:red']),
                            'footer' => false
                        ],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    Yii::$app->session->setFlash($e->getTraceAsString());
                }
                Pjax::end();
                ?>
            </div> <!-- card-body -->
            <div class="card-footer d-flex justify-content-md-end" style="margin-top: 10px;">
                <?php
                $urlE = Yii::$app->urlManager->createUrl(['/email/emails/index']);
                echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Email</span>", [
                    'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlE . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar email',
                ]);
                ?>
            </div> <!-- card-footer -->
        </div> <!-- Modal content -->
    </div> <!-- Modal dialog -->
</div> <!-- The Modal -->
<?php ActiveForm::end(); ?>