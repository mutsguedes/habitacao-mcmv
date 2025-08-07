<?php


use yii\bootstrap5\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha2;
use app\modules\email\models\EmailAssunto;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $modelE Emails */
/* @var $modelEA EmailAssuntos */



$this->title = 'MarArt - Habitação Pública - Contato';
?>
<div class="card espacorow">
    <?php
    $form = ActiveForm::begin(['id' => 'contato-form',]);
    ?>
    <!--Section: Contact v.2-->
    <!--<section class="mb-4">-->
    <div class="card-header">
        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Contate-nos</h2>
        <!--Section description-->
    </div>
    <div class="card-body">
        <p class="text-justify w-responsive mx-auto mb-5">Você tem alguma pergunta? Por favor, não hesite em nos contatar diretamente. Nossa equipe entrará em contato com você em horário comercial para ajudá-lo.</p>
        <div class="row">
            <div class="col-sm-9 mb-sm-0 mb-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="sm-form mb-0">
                            <?php
                            echo $form->field($modelE, 'id_ema_ass')->widget(Select2::class, [
                                'options' => [
                                    'prompt' => '--- Sel. assunto email--',
                                ],
                                'pluginOptions' => [
                                    'class' => 'form-horizontal',
                                    'language' => 'pt-BR',
                                    'allowClear' => true,
                                ],
                                'data' => ArrayHelper::map(EmailAssunto::find()->orderBy('id_ema_ass')
                                    ->asArray()->all(), 'id_ema_ass', 'nm_ema_ass'),
                                'size' => Select2::SMALL,
                            ])
                            ?>
                        </div>
                    </div> <!-- col -->
                </div> <!-- row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="sm-form">
                            <?=
                            $form->field($modelE, 'nm_men_ema')->textarea([
                                'class' => 'form-control form-control-sm sm-textarea text-justify', 'rows' => 6,
                                'maxlength' => true, 'style' => ['text-transform' => 'uppercase']
                            ])
                            ?>
                        </div>
                    </div> <!-- col -->
                </div> <!-- row -->
                <div class="row">
                    <div class="col-sm-6">
                        <?=
                        $form->field($modelE, 'reCaptcha')->widget(
                            ReCaptcha2::class,
                            [
                                'class' => 'form-control form-control-sm g-recaptcha text-center text-sm-center',
                                'siteKey' => '6LdAT-gUAAAAAMuO85XV5bmH0GPrtOLc30FPH-fQ', // unnecessary is reCaptcha component was set up
                            ]
                        )
                        ?>
                    </div> <!-- col -->
                </div> <!-- row -->
                <div class="status"></div>
            </div> <!-- col -->
            <div class="col-sm-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-map-marker-alt m-4 fa-2x"></i>
                        <p>Dr. Mendonça Sobrinho, 129 - Centro - Itaboraí - RJ CEP: 24800-109</p>
                    </li>
                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+55 (21)2635-4276</p>
                    </li>
                    <li><i class="fas fa-at mt-4 fa-2x"></i>
                        <p style="font-size: 15px">habitacao.mcmv@itaborai.rj.gov.br</p>
                    </li>
                </ul>
            </div> <!-- col -->
        </div> <!-- row -->
    </div>
    <div class="card-footer d-flex justify-content-md-end">
        <?=
        Html::submitButton(
            '<span class="fas fa-check" aria-hidden="true"></span><span>&nbsp;&nbsp;Enviar</span>',
            [
                'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                'id' => 'btn_enviar',
                'title' => 'Enviar email',
                'data-confirm' => 'Enviar email',
                'value' => 'criar',
                'name' => 'btn'
            ]
        );
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
        echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar protocolo(s)</span>", [
            'class' => 'btn btn-sm btn-outline-info mr-sm-2',
            'onclick' => "window.location.href = '" . $urlE . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Voltar lista protocolo(s)',
        ]);
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
        echo Html::Button(
            "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
            [
                'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                'id' => 'btn_voltar',
                'title' => 'Voltar início',
                'onclick' => "window.location.href = '" . $urlv . "';",
                'value' => 'voltar',
                'name' => 'btn'
            ]
        );
        ?>
    </div> <!-- car footer -->
    <!--</section>  section -->
    <div class="form-group" id="process" style="display:none;">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Favor aguarde...</div>
        </div> <!-- progress -->
    </div> <!-- form-group -->
    <?php ActiveForm::end(); ?>
</div> <!-- card -->