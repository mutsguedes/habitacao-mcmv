<?php


use yii\web\View;
use kartik\tabs\TabsX;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use app\modules\res\models\Responsavel;

/* @var $this View */

/* @var $form ActiveForm */
/* @var $modelD Dependente */
/* @var $idRes */
?>
<?php
$this->registerJs("$('#dep-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'dep',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'options' => [
        'validateOnSubmit' => true,
        'class' => 'form'
    ],
]);
?>
<div class="modal fade" id="dep-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    if ($modelD->isNewRecord) {
                        $idresdep = $idRes;
                        $rendaDepOld = 0;
                    } else {
                        $idresdep = $modelD->numRes->id_num_res;
                        $rendaDepOld = $modelD->nu_ren_dep;
                    };
                    $items = [
                        [
                            'label' => '<i class="fa fa-user"></i> Dependente',
                            'content' => $this->render('_form-dadosdep', ["modelD" => $modelD, 'idRes' => $idresdep, 'oldVar' => $rendaDepOld, 'form' => $form]),
                        ],
                        [
                            'label' => '<i class="fa fa-wheelchair"></i> Adquação',
                            'linkOptions' => ['class' => !$modelD->bo_mem_def ? 'disabled' : ''],
                            'headerOptions' => ['id' => 'ade'],
                            'content' => $this->render('_form-dadosadquacaodep', ["modelD" => $modelD, 'idRes' => $idresdep, 'form' => $form]),
                        ],
                    ];
                    try {
                        echo TabsX::widget([
                            'items' => $items,
                            'position' => TabsX::POS_ABOVE,
                            'bordered' => true,
                            'encodeLabels' => false,
                            'pluginEvents' => [
                                "tabsX.click" => "function() { console.log('tabsX.click'); }",
                                "tabsX.beforeSend" => "function() { console.log('tabsX.beforeSend'); }",
                                "tabsX.success" => "function() { console.log('tabsX.success'); }",
                                "tabsX.error" => "function() { console.log('tabsX.error'); }",
                            ]
                        ]);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        Yii::$app->session->setFlash($e->getTraceAsString());
                    };
                    ?>
                </div> <!-- border -->
            </div> <!-- Modal body -->
            <div class="modal-footer justify-content-md-end">
                <?php
                if ($modelD->isNewRecord) {
                    echo Html::submitButton("<span class='fas fa-user-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>", [
                        'id' => 'btn_save',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'data' => [
                            'title' => 'Criar dependente',
                            'confirm' => 'Dependente ' . $modelD->nm_nom_dep . ' ADICIONADO com sussesso',
                            'module' => 'Dependente',
                            'value' => Yii::$app->controller->action->id,
                            'name' => 'b_save',
                        ],
                    ]);
                } else {
                    echo Html::submitButton("<span class='fas fa-user-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>", [
                        'id' => 'btn_update',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'data' => [
                            'title' => 'Criar dependente',
                            'confirm' => 'Dependente ' . $modelD->nm_nom_dep . ' EDITADO com sussesso',
                            'module' => 'Dependente',
                            'value' => Yii::$app->controller->action->id,
                            'name' => 'b_update',
                        ],
                    ]);
                }
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
                        'idRes' => $idRes
                    ]);
                } else if (Yii::$app->session->get('sistema') === 'PAC') {
                    $urlIndex = Yii::$app->urlManager->createUrl([
                        '/dep/dependentes/lista-dependentes-resp',
                        'idRes' => $idRes
                    ]);
                }
                echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Dependente(s)</span>", [
                    'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlIndex . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar lista dependente(s)',
                ]);
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlRes = Yii::$app->urlManager->createUrl([
                    '/res/responsaveis/index-responsavel',
                    'idRes' => $idRes
                ]);
                echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                    'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlRes . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar responsável',
                ]);
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div><!-- the modal -->
<?php ActiveForm::end(); ?>