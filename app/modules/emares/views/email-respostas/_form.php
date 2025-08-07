<?php


use yii\web\View;
use kartik\helpers\Html;
use kartik\form\ActiveForm;

/* @var $form ActiveForm */
/* @var $modelE Email */
/* @var $modelER EmailResposta */
/* @var $idEma */
?>

<?php
$this->registerJs("$('#resema-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'resema',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
]);
?>
<div class="modal fade" id="resema-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content espacorow">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?=
                    'Email da(o) Cidadã(o) - '
                        . Html::label($modelE['nm_nom_cid'], null, ['style' => 'color:#d9534f']);
                    ?>
                </h5>
                <button onClick='window.history.back(-1);' type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
            </div> <!-- Modal Header -->
            <div class="modal-body">
                <div id="results">
                    <div class="resposta-form">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <?=
                                $form->field($modelER, 'nm_nom_resp')
                                    ->textarea([
                                        'class' => 'form-control md-textarea text-justify', 'rows' => 10,
                                        'maxlength' => true,
                                        'style' => ['text-transform' => 'uppercase']
                                    ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div> <!-- Modal result -->
            </div> <!-- Modal body -->
            <div class="modal-footer">
                <?php
                if ($modelER->isNewRecord) {
                    echo Html::submitButton(
                        '<span class="fas fa-check" aria-hidden="true"></span><span>&nbsp;&nbsp;Salvar</span>',
                        [
                            'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                            'id' => 'btn_criar',
                            'data-toggle' => 'tooltip',
                            'title' => 'Criar resposta',
                            'data-confirm' => 'Resposta criar',
                            'value' => 'criar',
                            'name' => 'btn',
                        ]
                    );
                } else {
                    echo Html::submitButton(
                        '<span class="fas fa-check" aria-hidden="true"></span><span>&nbsp;&nbsp;Salvar</span>',
                        [
                            'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                            'id' => 'btn_editar',
                            'data-toggle' => 'tooltip',
                            'title' => 'Criar resposta',
                            'data-confirm' => 'Resposta editar',
                            'value' => 'criar',
                            'name' => 'btn',
                        ]
                    );
                }
                ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?php
                echo Html::resetButton(
                    "<span class='fas fa-times' aria-hidden='true'></span><span>&nbsp;&nbsp;Cancelar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-dark mr-sm-0',
                        'id' => 'btn_redefinir'
                    ]
                );
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                if (Yii::$app->user->can('administrativo')) {
                    $urlE = Yii::$app->urlManager->createUrl(['/email/emails/index-email']);
                } elseif (Yii::$app->user->can('visitante')) {
                    $urlE = Yii::$app->urlManager->createUrl(['/email/emails/index']);
                }
                echo Html::Button(
                    '<span class="fas fa-arrow-left" aria-hidden="true"></span><span>&nbsp;&nbsp;Voltar</span>',
                    [
                        'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'id' => 'btn_voltar',
                        'title' => 'Voltar protocolo',
                        'onclick' => "window.location.href = '" . $urlE . "';",
                        'value' => 'voltar',
                        'name' => 'btn'
                    ]
                );
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlER = Yii::$app->urlManager->createUrl([
                    '/emares/email-respostas/view-historico',
                    'idEma' => $idEma
                ]);
                echo Html::button(
                    '<span class="fas fa-arrow-left" aria-hidden="true"></span><span>&nbsp;&nbsp;Voltar histórico</span>',
                    [
                        'class' => 'btn btn-sm btn-outline-primary mr-sm-2',
                        'id' => 'btn_voltar',
                        'title' => 'Voltar histórico',
                        'onclick' => "window.location.href = '" . $urlER . "';",
                        'value' => 'voltar',
                        'name' => 'btn'
                    ]
                );
                ?>
            </div> <!-- Modal footer -->
        </div> <!-- Modal content -->
    </div> <!-- Modal dialog -->
</div> <!-- The Modal -->
<div class="form-group" id="process" style="display:none;">
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Favor aguarde...</div>
    </div> <!-- progress -->
</div> <!-- form-group -->
<?php ActiveForm::end(); ?>