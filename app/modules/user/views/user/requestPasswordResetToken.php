<?php

use app\modules\user\models\PasswordResetRequestForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model PasswordResetRequestForm */
?>
<?php
$this->registerJs("$('#request-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'request-password-reset-form',
]);
?>
<div class="modal fade" id="request-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='location.href = "/site/index";' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-user-circle fa-4x">
                        </div>
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>Pedido Alterar Senha</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <p>Por favor, preencha o seu email. Um link para redefinir a senha será enviado para lá.</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <?=
                            $form->field($model, 'email')->widget(MaskedInput::class, [
                                'clientOptions' => ['alias' => 'email',]
                            ])
                                ->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control form-control-sm',
                                ]);
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- border -->
            </div> <!-- Modal body -->
            <div class="modal-footer d-flex justify-content-md-end">
                <?=
                Html::submitButton(
                    "<span class='fas fa-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Enviar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_enviar',
                        'value' => 'enviar',
                        'title' => 'Enviar',
                    ]
                );
                ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?=
                Html::resetButton(
                    "<span class='fas fa-times' aria-hidden='true'></span><span>&nbsp;&nbsp;Cancelar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-secondary mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_cancelar',
                        'value' => 'cancelar',
                        'title' => 'Cancelar',
                    ]
                );
                ?>
                <?php
                $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
                echo Html::Button(
                    "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                    [
                        'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_voltar',
                        'value' => 'voltar',
                        'title' => 'Voltar',
                        'onclick' => "window.location.href = '" . $urlv . "';",
                    ]
                );
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div><!-- the modal -->
<?php ActiveForm::end(); ?>