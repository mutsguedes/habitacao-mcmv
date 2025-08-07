<?php


use kartik\helpers\Html;
use kartik\form\ActiveForm;
use yii\widgets\MaskedInput;



/* @var $this View */
/* @var $form ActiveForm */
/* @var $modelCF ConsultaForm */



$this->title = 'MarArt - Habitação Pública - Consulta';
?>
<div class="site-consulta">
    <?php
    $form = ActiveForm::begin([
        'id' => 'consulta-form',
    ]);
    ?>
    <section class="mb-4 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6 ">
                <div id="jb" class="jumbotron my-auto">
                    <i class="far fa-address-card fa-3x"></i>
                </div>
            </div> <!-- col -->
        </div> <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6" style="padding: 10px">
                <h1 class="display-5">Verifique sua situação</h1>
            </div> <!-- col -->
        </div> <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6">
                <p class="lead">Se você é cadastrado no programs MCMV - Minha Casa Minha
                    Vida do município de Itaboraí, informe o seu CPF para saber a situação de seu cadastro no
                    programa.</p>
            </div> <!-- col -->
        </div> <!-- row -->
        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-md-6 col-xl-3">
                <div class="md-form mb-0">
                    <?=
                    $form->field($modelCF, 'cpfcid')->widget(
                        MaskedInput::class,
                        [
                            'id' => 'cpfcid', 'mask' => '999.999.999-99',
                            'clientOptions' => ['removeMaskOnSubmit' => true]
                        ]
                    )
                        ->textInput(['maxlength' => true,])
                    ?>
                </div>
            </div> <!-- col -->
        </div> <!-- row -->
        <div class="card-footer d-flex justify-content-md-end" style="padding: 10px">
            <?=
            Html::submitButton(
                "<span class='fas fa-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Enviar</span>",
                [
                    'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                    'id' => 'btn_enviar',
                    'value' => 'conectar',
                    'name' => 'btn',
                    'title' => 'Envia consulta',
                ]
            )
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
            $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
            echo Html::Button(
                "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                [
                    'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlv . "';",
                    'value' => 'voltar',
                    'name' => 'btn',
                    'title' => 'Voltar página inicial',
                ]
            );
            ?>
        </div> <!-- Text-rigth -->
        <div class="row justify-content-center" style="padding: 10px">
            <div class="col-lg-4 col-md-6 col-xl-3">
                <div class="form-group" id="process" style="display:none;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div> <!-- col -->
        </div> <!-- row -->
    </section> <!-- section -->
    <?php ActiveForm::end(); ?>
</div>