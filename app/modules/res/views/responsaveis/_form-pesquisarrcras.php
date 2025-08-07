<?php

use yii\web\View;
use yii\bootstrap5\Html;
use yii\widgets\MaskedInput;
use yii\bootstrap5\ActiveForm;

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
            </div> <!-- Modal Header -->
            <div class="modal-body">
                <div style="border-style: solid; border-width: 1px; text-align: left;  padding: 5px 5px 5px 5px">
                    <div class="row">
                        <div class="col-sm-12 col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="elementos[]" class="checkitem" value="nome" onclick='pesbloqueio()'>
                                    Nome
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7" id="nome" hidden>
                            <?=
                            $form->field($modelR, 'nm_nom_res')
                                ->textInput([
                                    'maxlength' => true,
                                    'style' => ['text-transform' => 'uppercase']
                                ])->label(false)
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="elementos[]" class="checkitem" value="cpf" onclick='pesbloqueio()'>
                                    CPF
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" id="cpf" hidden>
                            <?=
                            $form->field($modelR, 'nu_num_cpf')->widget(MaskedInput::class, [
                                'id' => 'nu_num_cpf', 'mask' => '999.999.999-99',
                                'clientOptions' => ['removeMaskOnSubmit' => true]
                            ])
                                ->textInput(['maxlength' => true,])->label(false)
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="elementos[]" class="checkitem" value="ide" onclick='pesbloqueio()'>
                                    Identidade
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" id="ide" hidden>
                            <?=
                            $form->field($modelR, 'nu_num_ide')->widget(MaskedInput::class, [
                                'id' => 'nu_num_ide', 'mask' => '99.999.999-9',
                                'clientOptions' => ['removeMaskOnSubmit' => true]
                            ])
                                ->textInput(['maxlength' => true,])->label(false)
                            ?>
                        </div>
                    </div>
                    <hr style="margin: 2px">
                    <div class="checkbox">
                        <label><input type="checkbox" name="elementos[]" id="checkedall" value="todos" onclick='pesbloqueio()'>
                            Todos
                        </label>
                    </div>
                </div>
                <?php
                /* $elementos = ['nome' => 'Nome', 'cpf' => 'CPF', 'ide' => 'Identidade'];
                  echo Html::label('Selecione um ou mais itens para a busca do Responsavel.', ['style' => ['font-size' => '16px', 'align' => 'justify']]);
                  echo Html::checkboxList('elementos', true, $elementos, ['onclick' => 'pesbloqueio()']); */
                ?>
            </div><!-- Modal body -->
            <div class="modal-footer">
                <?=
                Html::submitButton('Pesquisar', [
                    'class' => 'btn-primary btn-mini',
                    'style' => 'display: none;',
                    'id' => 'btn_pesquisar',
                    'value' => 'pesquisar',
                    'name' => 'btn',
                ]);
                ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= Html::resetButton('Redefinir', ['class' => 'btn-default btn-mini', 'id' => 'btn_redefinir']);
                ?>
                <?=
                Html::Button(
                    'Cancelar',
                    [
                        'id' => 'btn_cancelar',
                        'class' => 'btn-warning btn-mini',
                        'onclick' => 'history.go(-1);',
                        'value' => 'cancelar',
                        'name' => 'btn'
                    ]
                );
                ?>
            </div> <!-- Modal footer -->
        </div> <!-- Modal content -->
    </div> <!-- Modal dialog -->
</div> <!-- Modal dialog -->
<?php ActiveForm::end(); ?>