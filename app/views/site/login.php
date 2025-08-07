<?php

use yii\web\View;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $modelU User */
?>
<?php
$this->registerJs("$('#login-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
]);
?>
<div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
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
                            <h4>Acesso Usuário</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <p>Preencha os campos para conectar:</p>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?=
                            $form->field($modelU, 'systemlog')
                                ->dropDownList(
                                    ['2' => 'MCMV', '3' => 'PAC', '5' => 'PHPMI'],
                                    ['prompt' => '-- Sel. sistema --']
                                );
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?=
                            $form->field($modelU, 'userlog')
                                ->textInput()
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <?=
                            $form->field($modelU, 'password')
                                ->passwordInput()
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <?php /* $form->field($modelU, 'rememberMe')->checkbox(['class' => 'checksize']); */ ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- border -->
                <div class="border border-warning" style="margin-top: 15px; padding: 10px;">
                    <div class="col-xs-12 col-md-12">
                        <p class="text-justify" style="margin: 0px;">
                            Esqueceu sua senha,<span>&nbsp;</span> <?= Html::a('redefinir-la', ['/user/user/request-password-reset']) ?>.<br />
                            Não tenho uma <?= Html::a('assinatura', '', ['id' => 'snwNavLinkSignUp2']) ?>.
                        </p>
                    </div> <!-- col -->
                </div> <!-- border -->
            </div> <!-- Modal body -->
            <div class="modal-footer justify-content-md-end">
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