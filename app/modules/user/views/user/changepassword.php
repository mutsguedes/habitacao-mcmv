<?php

use app\modules\user\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model User */
?>
<?php
$this->registerJs("$('#change-password').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'change-form',
]);
?>
<div class="modal fade" id="change-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='location.href = "/site/index";' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="row d-flex justify-content-center">
                            <?php if (!empty((Yii::$app->user->identity->bi_arq_ava))) { ?>
                                <img src="data:image/jpeg;base64,
                             <?= base64_encode(Yii::$app->user->identity->bi_arq_ava); ?>" class="roundedcirclecabimg" alt="Imagem do Usuário">
                            <?php } else { ?>
                                <img src="/img/defaultAvatar.png" class="roundedcirclecabimg" alt="Avatar">
                            <?php } ?>
                        </div> <!-- row -->
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>Alterar Senha</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px;">
                    <p>Por favor, preencha os seguintes campos para alterar a senha:</p>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?=
                            $form->field($model, 'old_password')->passwordInput();
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?=
                            $form->field($model, 'new_password')->passwordInput();
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?= $form->field($model, 'repeat_password')->passwordInput();
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- border -->
            </div> <!-- modal-body -->
            <div class="modal-footer d-flex justify-content-md-end">
                <?=
                Html::submitButton(
                    '<span class="fas fa-check" aria-hidden="true"></span><span>&nbsp;&nbsp;Salvar</span>',
                    [
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'id' => 'btn_salvar',
                        'value' => 'trocar',
                        'name' => 'btn'
                    ]
                )
                ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?=
                Html::resetButton(
                    "<span class='fas fa-times' aria-hidden='true'></span><span>&nbsp;&nbsp;Cancelar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-secondary mr-sm-2',
                        'id' => 'btn_redefinir',
                        'title' => 'Cancelar',
                    ]
                )
                ?>
                <?php
                $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
                echo Html::Button(
                    "<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                    [
                        'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'onclick' => "window.location.href = '" . $urlv . "';",
                        'title' => 'Voltar início',
                        'value' => 'voltar',
                        'name' => 'btn'
                    ]
                );
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- Modal content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal -->
<?php ActiveForm::end(); ?>