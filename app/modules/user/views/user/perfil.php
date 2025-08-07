<?php

use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerTabUniCbo;
use app\modules\user\models\PasswordResetRequestForm;

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

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
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='location.href = "/site/index";' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <?php if (!empty((Yii::$app->user->identity->bi_arq_ava))) { ?>
                            <img src="data:image/jpeg;base64,
                             <?= base64_encode(Yii::$app->user->identity->bi_arq_ava); ?>" class="roundedcircleperimg" alt="Imagem do Usuário">
                        <?php } else { ?>
                            <img src="/img/defaultAvatar.png" class="roundedcircleperimg" alt="Avatar">
                        <?php } ?>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4><?= Yii::$app->user->identity->name ?></h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <h3 class="text-center">
                        <?php
                        $mod = GerTabUniCbo::findOne(['id_num_cbo' => Yii::$app->user->identity->id_num_cbo])->nm_des_cbo;
                        echo MarArtHelpers::titleCase($mod);
                        ?>
                    </h3>
                    <div class="text-center mt-3" style="font-size: 40px;">
                        <i class='fab fa-facebook-square'></i>
                        <i class='fab fa-twitter-square'></i>
                        <i class="fab fa-google-plus-square"></i>
                        <i class='fab fa-linkedin'></i>
                    </div>
                </div> <!-- border -->
            </div> <!-- modal-body -->
            <div class="modal-footer d-flex justify-content-md-end">
                <?php
                $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
                echo Html::Button(
                    "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_voltar',
                        'value' => 'voltar',
                        'title' => 'Voltar',
                        'onclick' => "window.location.href = '" . $urlv . "';",
                    ]
                );
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- Modal content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal -->
<?php ActiveForm::end(); ?>