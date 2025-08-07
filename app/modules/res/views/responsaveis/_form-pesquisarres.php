<?php


use yii\web\View;
use kartik\helpers\Html;
use yii\widgets\MaskedInput;
use kartik\form\ActiveForm;
use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelR ResponsaveisSearch */
/* @var $form ActiveForm */
?>

<?php
$this->registerJs(
    "$('#pes-modal').modal('show');",
    View::POS_READY
);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'pesquisa-form',
    'action' => ['resultado'],
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'options' => array(
        'class' => 'form',
    ),
    'method' => 'get',
]);
?>

<div class="modal fade" id="pes-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-search fa-4x"></span>
                        </div>
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>Pesquisa - Responsável</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px;">
                    <div class="row">
                        <div class="checkbox col-sm-2">
                            <label>
                                <input type="checkbox" name="elementos[]" class="form-check-input" value="nome" onclick='pesbloqueio()'>
                                <?= '&nbsp;'; ?>Nome
                            </label>
                        </div> <!-- checkbox -->
                        <div class="col-sm-8" id="nome" style="display: none;">
                            <?php
                            echo $form->field($modelR, 'nm_nom_res')
                                ->textInput([
                                    'id' => 'nm_nom_res',
                                    'class' => 'form-control form-control-sm',
                                    'maxlength' => true,
                                    'style' => ['text-transform' => 'uppercase']
                                ])->label(false)
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="checkbox col-sm-2">
                            <label>
                                <input type="checkbox" name="elementos[]" class="form-check-input" value="cpf" onclick='pesbloqueio()'>
                                <?= '&nbsp;'; ?>CPF
                            </label>
                        </div> <!-- checkbox -->
                        <div class="col-sm-5" id="cpf" style="display: none;">
                            <?php
                            echo $form->field($modelR, 'nu_num_cpf')
                                ->widget(MaskedInput::class, [
                                    'id' => 'nu_num_cpf',
                                    'mask' => '999.999.999-99',
                                    'clientOptions' => ['removeMaskOnSubmit' => true]
                                ])
                                ->textInput([
                                    'class' => 'form-control form-control-sm',
                                    'maxlength' => true,
                                ])->label(false)
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="checkbox col-sm-3">
                            <label>
                                <input type="checkbox" name="elementos[]" class="form-check-input" value="ide" onclick='pesbloqueio()'>
                                <?= '&nbsp;'; ?>Identidade
                            </label>
                        </div> <!-- checkbox -->
                        <div class="col-sm-5" id="ide" style="display: none;">
                            <?php
                            echo $form->field($modelR, 'nu_num_ide')
                                ->widget(MaskedInput::class, [
                                    'id' => 'nu_num_ide',
                                    'mask' => MarArtHelpers::masEdId(),
                                    'clientOptions' => ['removeMaskOnSubmit' => true, 'options' => ['style' => 'width:49px;'],]
                                ])
                                ->textInput([
                                    'class' => 'form-control form-control-sm',
                                    'maxlength' => true,
                                ])->label(false)
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- border -->
                <div class="border border-warning" style="margin-top: 15px; padding: 10px;">
                    <label><input type="checkbox" name="elementos[]" id="checkedall" value="todos" onclick='pesbloqueio()'>
                        Todos
                    </label>
                </div> <!-- border -->
            </div> <!-- modal-body -->
            <div class="modal-footer d-flex justify-content-md-end">
                <?=
                Html::submitButton(
                    "<span class='fas fa-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Pesquisar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_pesquisar',
                        'value' => 'pesquisar',
                        'title' => 'Pesquisar responsável',
                        'style' => 'display: none;',
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
                        'name' => 'btn',
                        'id' => 'btn_cancelar',
                        'value' => 'cancelar',
                        'title' => 'Cancelar',
                        'style' => 'display: none;',
                    ]
                );
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
                echo Html::button(
                    "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_voltar',
                        'value' => 'voltar',
                        'title' => 'Voltar',
                        'onclick' => 'history.go(-1);',
                    ]
                );
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- Modal content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal -->
<?php ActiveForm::end(); ?>