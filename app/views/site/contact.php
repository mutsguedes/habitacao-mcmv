<?php


use yii\web\View;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model \commom\modules\sistemas\models\ContactForm */
?>
<?php
$this->registerJs(
    "$('#contact-modal').modal('show');",
    View::POS_READY
);
?>
<?php
if (!empty(Yii::$app->user->identity->bi_arq_ava)) {
    //$avalar = base64_encode(stream_get_contents(Yii::$app->user->identity->bi_arq_ava));
    $avalar = base64_encode(Yii::$app->user->identity->bi_arq_ava);
}
?>
<?php
$form = ActiveForm::begin([
    'id' => 'contact-form',
]);
?>

<div class="modal fade" id="contact-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='location.href = "/site/index";' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <?php if (!empty($avalar)) { ?>
                            <img class="roundedcirclecabimg" src="data:image/jpeg;base64,
                        <?= $avalar ?> " alt="Imagem do Usuário">
                        <?php } else { ?>
                            <img src="/img/defaultAvatar.png" class="roundedcirclecabicon" alt="Imagem do Usuário">
                        <?php } ?>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4 class="modal-title">Contato</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <p class="hint-text">Se você tiver perguntas comerciais ou outras questões, preencha o seguinte formulário para contatar-nos. Obrigado.</p>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <?= $form->field($model, 'name')->textInput(); ?>
                        </div> <!-- col -->
                        <div class="col-sm-6 col-md-6">
                            <?= $form->field($model, 'email'); ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?= $form->field($model, 'subject')->label('Assunto:'); ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <?= $form->field($model, 'body')->textarea(['rows' => 3])->label('Menssagem:'); ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <?=
                            $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                'template' => '<div class="row">
                                    <div class="col-xs-4">{image}</div>
                                    <div class="col-xs-4">{input}</div>
                                </div>',
                            ])->label('Código de Verificação:');
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- border -->
            </div> <!-- Modal body -->
            <div class="modal-footer d-flex justify-content-md-end">
                <br>
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
                echo
                Html::Button(
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