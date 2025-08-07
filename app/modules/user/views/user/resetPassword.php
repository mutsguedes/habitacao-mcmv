<?php

use app\modules\user\models\ResetPasswordForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model ResetPasswordForm */
?>
<?php
$this->registerJs("$('#reset-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'reset-password-form',
]);
?>
<div class="modal fade" id="reset-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='location.href = "/site/index";' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-user-circle fa-4x"></span>
                        </div>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>Redefinir Senha</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <p>Por favor, defina sua nova senha:</p>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?= $form->field($model, 'password')->passwordInput(); ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?= $form->field($model, 'passwordRepeat')->passwordInput();
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
                        'id' => 'btn_conectar_reset',
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
                <?=
                Html::Button(
                    "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                    [
                        'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_voltar',
                        'value' => 'voltar',
                        'title' => 'Voltar',
                        'onclick' => 'history.go(-1);',
                    ]
                );
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div><!-- the modal -->
<?php ActiveForm::end(); ?>