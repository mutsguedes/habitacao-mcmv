<?php


use yii\web\View;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use kartik\rating\StarRating;

/* @var $this View */
/* @var $modelEA EmailAvaliacao */
/* @var $form ActiveForm */
/* @var $idEma */
?>
<?php
$this->registerJs("$('#avaliacao-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'avaliacao-form',
]);
?>
<div class="modal fade" id="avaliacao-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header">
                <button onClick='window.history.back(-1);' type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
                <div class="row d-flex justify-content-center">
                    <img src="/img/rating.png" alt="Avaliação" style="width: 85px; height: 85px; 
                         border-radius: 50%; margin-top: -2px; border: 3px solid; border-color:#999;">

                </div>
                <div class="row d-flex justify-content-center" style="padding-top: 5px">
                    <h4>Avaliação Cidadão</h4>
                </div>
            </div> <!-- card-header -->
            <div class="modal-body" tabindex="-1">
                <p class="text-justify">Favor fornecer o número de estrela(s) que nosso atendimento merece na sua percepção:</p>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?=
                        StarRating::widget([
                            'model' => $modelEA, 'attribute' => 'nu_ava_est',
                            'pluginOptions' => [
                                'theme' => 'krajee-uni',
                                'min' => 0,
                                'max' => 10,
                                'step' => 1,
                                'stars' => 10,
                                'size' => 'sm',
                                'language' => 'pt-BR',
                                'starCaptions' => [
                                    0 => 'Zero Estrla',
                                    1 => 'Uma Estrla',
                                    2 => 'Duas Estrlas',
                                    3 => 'Três Estrlas',
                                    4 => 'Quatro Estrlas',
                                    5 => 'Cinco Estrlas',
                                    6 => 'Seis Estrlas',
                                    7 => 'Sete Estrlas',
                                    8 => 'Oito Estrlas',
                                    9 => 'Nove Estrlas',
                                    10 => 'Dez Estrlas',
                                ],
                                'starCaptionClasses' => [
                                    1 => 'label badge-danger',
                                    2 => 'label badge-danger',
                                    3 => 'label badge-warning',
                                    4 => 'label badge-warning',
                                    5 => 'label badge-info',
                                    6 => 'label badge-info',
                                    7 => 'label badge-primary',
                                    8 => 'label badge-primary',
                                    9 => 'label badge-success',
                                    10 => 'label badge-success'
                                ],
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?=
                        $form->field($modelEA, 'nm_ava_com')->textarea([
                            'class' => 'form-control form-control-sm md-textarea text-justify', 'rows' => 6,
                            'maxlength' => true, 'style' => ['text-transform' => 'uppercase']
                        ])
                        ?>
                    </div>
                </div>
                <div class="d-flex justify-content-md-end">
                    <br>
                    <?=
                    Html::submitButton("<span class='fas fa-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Enviar</span>", [
                        'id' => 'btn_enviar',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'title' => 'Enviar avaliação',
                        'data-toggle' => 'tooltip',
                        'value' => 'enviar',
                        'name' => 'btn_enviar'
                    ]);
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
                    $urlv = Yii::$app->urlManager->createUrl([
                        '/ava/email-avaliacoes/cancel-create',
                        'idEma' => $idEma
                    ]);
                    $urlv = Yii::$app->urlManager->createUrl(['/emares/email-respostas/view-historico', 'idEma' => $idEma]);
                    echo Html::button(
                        "<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar histórico</span>",
                        [
                            'id' => 'btn_voltar',
                            'class' => 'btn btn-sm btn-outline-info mr-sm-0',
                            'onclick' => "window.location.href = '" . $urlv . "';",
                            'title' => 'Voltar histórico email',
                            'value' => 'voltar',
                            'name' => 'btn_voltar'
                        ]
                    );
                    ?>
                </div> <!-- text-rigth -->
            </div> <!-- modal-body -->
            <div class="card-footer text-center">
                <?= Html::a('SMHSS -Secretaria Municipal de Habitação e Serviços Sociais', ['/site/index']) ?>
            </div> <!-- modal-footer -->
        </div>
        <!--modal-content -->
    </div> <!-- modal-dialog -->
</div><!-- modal -->
<?php ActiveForm::end(); ?>
<?php

$script = <<< JS
$("#btn_cancelar").click('.remove', function (e) {
    e.preventDefault();
    swal({
            title: 'Sua Avaliação!!!',
            html: '<p class = "text-justify">Cancelar sua Avaliação? Se confirmar o cancelamento <b>não será possível</b> fazer novamente sua avaliação para esse quistionamento.</i>',
            type: "warning",
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-sm btn-outline-success mr-sm-2',
            cancelButtonClass: 'btn btn-sm btn-outline-danger mr-sm-2',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Sim, cancelar",
            cancelButtonText: "Não, voltar",
            animation: false,
            customClass: "animated wobble",
            backdrop: 'rgba(255,255,0,0.4)',
            allowOutsideClick: false,
        }).then((result) => {
            idEma = $idEma; 
            if (result.value) {
            window.location.replace('/emares/email-respostas/view-historico?idEma=' + idEma);
            } else {
               window.location.replace('/ava/email-avaliacoes/create?idEma=' + idEma);
            }
        });
});
JS;
$this->registerJs($script);
?>