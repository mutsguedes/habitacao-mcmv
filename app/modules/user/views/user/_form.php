<?php

use yii\web\View;
use yii\bootstrap5\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use yii\bootstrap5\ActiveForm;
use app\modules\user\models\User;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerTabUniCbo;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model User */
?>
<?php
$this->registerJs("$('#signup-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'signup-form',
]);
?>

<div class="modal fade" id="signup-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
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
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>Inscrever-se</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px;">
                    <?php
                    if (Yii::$app->session->get('signup') === 'CIDADAO') {
                    ?>
                        <p>Preencha os campos para se inscrever:</p>
                        <div class="row">
                            <div class="col-sm-8">
                                <?=
                                $form->field($model, 'name')->textInput([
                                    'autofocus' => true, 'maxlength' => true,
                                    'class' => 'form-control form-control-sm material-design',
                                    'style' => ['text-transform' => 'uppercase']
                                ]); ?>
                            </div> <!-- col -->
                            <div class="col-sm-4">
                                <?=
                                $form->field($model, 'username')->textInput([
                                    'autofocus' => true, 'maxlength' => true,
                                    'class' => 'form-control form-control-sm material-design',
                                ]); ?>
                            </div> <!-- col -->
                        </div> <!-- row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?=
                                $form->field($model, 'nu_num_cpf')->widget(MaskedInput::class, [
                                    'id' => 'nu_cpf_use', 'mask' => '999.999.999-99',
                                    'clientOptions' => ['removeMaskOnSubmit' => true]
                                ])
                                    ->textInput([
                                        'maxlength' => true,
                                        'class' => 'form-control form-control-sm material-design',
                                    ])
                                ?>
                            </div> <!-- col -->
                            <div class="col-sm-4">
                                <?=
                                $form->field($model, 'email')->widget(MaskedInput::class, [
                                    'clientOptions' => ['alias' => 'email',]
                                ])
                                    ->textInput([
                                        'maxlength' => true,
                                        'class' => 'form-control form-control-sm material-design',
                                    ]); ?>
                            </div> <!-- col -->
                            <div class="col-sm-4">
                                <?=
                                $form->field($model, 'nu_num_tel')->widget(
                                    MaskedInput::class,
                                    [
                                        'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                                        'clientOptions' => ['removeMaskOnSubmit' => true,]
                                    ]
                                )
                                    ->textInput(['class' => 'form-control form-control-sm material-design',]); ?>
                            </div> <!-- col -->
                        </div> <!-- row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-sm']); ?>
                            </div> <!-- col -->
                            <div class="col-sm-6">
                                <?= $form->field($model, 'passwordRepeat')->passwordInput(['class' => 'form-control form-control-sm']); ?>
                            </div> <!-- col -->
                        </div> <!-- row -->
                    <?php
                    } else if (Yii::$app->session->get('signup') === 'FUNCIONARIO') { ?>
                        <p>Preencha os campos para se inscrever:</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <?=
                                $form->field($model, 'name')->textInput([
                                    'autofocus' => true, 'maxlength' => true,
                                    'class' => 'form-control form-control-sm material-design',
                                    'style' => ['text-transform' => 'uppercase']
                                ]); ?>
                            </div> <!-- col -->
                            <div class="col-sm-4">
                                <?=
                                $form->field($model, 'username')->textInput([
                                    'autofocus' => true, 'maxlength' => true,
                                    'class' => 'form-control form-control-sm material-design',
                                ]); ?>
                            </div> <!-- col -->
                            <div class="col-sm-2">
                                <?=
                                $form->field($model, 'nu_num_mat')->widget(MaskedInput::class, [
                                    'id' => 'nu_num_ide', 'mask' => '######',
                                    'clientOptions' => ['removeMaskOnSubmit' => true]
                                ])
                                    ->textInput([
                                        'maxlength' => true,
                                        'class' => 'form-control form-control-sm material-design',
                                    ]) ?>
                            </div> <!-- col -->
                        </div> <!-- row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <?=
                                $form->field($model, 'nu_num_cpf')->widget(MaskedInput::class, [
                                    'id' => 'nu_cpf_use', 'mask' => '999.999.999-99',
                                    'clientOptions' => ['removeMaskOnSubmit' => true]
                                ])
                                    ->textInput([
                                        'maxlength' => true,
                                        'class' => 'form-control form-control-sm material-design',
                                    ])
                                ?>
                            </div> <!-- col -->
                            <div class="col-sm-3">
                                <?=
                                $form->field($model, 'nu_num_ide')->widget(MaskedInput::class, [
                                    'id' => 'nu_num_ide', 'mask' => MarArtHelpers::masEdId(),
                                    'clientOptions' => ['removeMaskOnSubmit' => true]
                                ])
                                    ->textInput([
                                        'maxlength' => true,
                                        'class' => 'form-control form-control-sm material-design',
                                    ])
                                ?>
                            </div> <!-- col -->
                            <div class="col-sm-3">
                                <?=
                                $form->field($model, 'email')->widget(MaskedInput::class, [
                                    'clientOptions' => ['alias' => 'email',]
                                ])
                                    ->textInput([
                                        'maxlength' => true,
                                        'class' => 'form-control form-control-sm material-design',
                                    ]); ?>
                            </div> <!-- col -->
                            <div class="col-sm-3">
                                <?=
                                $form->field($model, 'nu_num_tel')->widget(
                                    MaskedInput::class,
                                    [
                                        'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                                        'clientOptions' => ['removeMaskOnSubmit' => true,]
                                    ]
                                )
                                    ->textInput(['class' => 'form-control form-control-sm material-design',]); ?>
                            </div> <!-- col -->
                        </div> <!-- row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <?=
                                $form->field($model, 'id_num_cbo')->widget(Select2::class, [
                                    'size' => Select2::SMALL,
                                    'theme' => Select2::THEME_KRAJEE_BS5,
                                    'options' => [
                                        'prompt' => '-- Sel. profissão --',
                                    ],
                                    'pluginOptions' => [
                                        'class' => 'form-horizontal',
                                        'language' => 'pt-BR',
                                        'allowClear' => true,
                                        'dropdownParent' => '#signup-modal',
                                    ],
                                    'data' => ArrayHelper::map(GerTabUniCbo::find()->orderBy('id_num_cbo')
                                        ->asArray()->all(), 'id_num_cbo', 'nm_des_cbo'),
                                ])
                                ?>
                            </div> <!-- col -->
                            <div class="col-sm-4">
                                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-sm']); ?>
                            </div> <!-- col -->
                            <div class="col-sm-4">
                                <?= $form->field($model, 'passwordRepeat')->passwordInput(['class' => 'form-control form-control-sm']); ?>
                            </div> <!-- col -->
                        </div> <!-- row -->
                </div> <!-- border -->
                <div class="border border-warning" style="margin-top: 15px; padding: 10px;">
                    Já tenho uma <?= Html::a('assinatura', ['/site/login']) ?>.
                </div>
            </div> <!-- modal-body -->
        <?php } ?>
        <div class="modal-footer d-flex justify-content-md-end">
            <?php
            echo Html::submitButton(
                "<span class='fas fa-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Inscrever</span>",
                [
                    'class' => 'btn btn-sm btn-outline-success mr-sm-2', 'id' => 'btn_enviar',
                    'value' => 'inscrever', 'name' => 'btn'
                ]
            );

            echo '&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;';
            echo Html::resetButton(
                "<span class='fas fa-times' aria-hidden='true'></span><span>&nbsp;&nbsp;Cancelar</span>",
                ['class' => 'btn btn-sm btn-outline-secondary mr-sm-2', 'id' => 'btn_redefinir_login']
            );

            $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
            echo Html::Button(
                "<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                [
                    'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlv . "';",
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