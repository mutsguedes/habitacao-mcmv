<?php

use kartik\widgets\Select2;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;
?>

<?php
$this->registerJs(
    "$('#rel-modal').modal('show');
            
        $('#checkedallapto').on('change', function() {     
                $('.checkitemapto').prop('checked', $(this).prop('checked'));              
        })
        $('#checkapto').change(function(){            
            if($('.checkitemapto:checked').length == $('.checkitemapto').length){
                $('#checkedallapto').prop('checked',true)
            } else {
                $('#checkedallapto').prop('checked',false)
            }
        });
        
        $('#checkedallsort').on('change', function() {     
                $('.checkitemsort').prop('checked', $(this).prop('checked'));              
        })
        $('#checksort').change(function(){            
            if($('.checkitemsort:checked').length == $('.checkitemsort').length){
                $('#checkedallsort').prop('checked',true)
            } else {
                $('#checkedallsort').prop('checked',false)
            }
        });",
    View::POS_READY
);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'relatorio-form',
    'enableAjaxValidation' => true,
    'action' => ['/imprel/relatorios/relatorio'],
    'options' => ['target' => '_blank']
]);
?>
<div class="modal fade" id="rel-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header">
                <button onClick="window.history.back(-1);" type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
                <div class="row d-flex justify-content-center">
                    <span class="fas fa-print fa-4x rounded-circle" style="padding: 5px; border: 3px solid; border-color:#999;">
                </div>
                <div class="row d-flex justify-content-center" style="padding-top: 5px">
                    <h4><?= 'Relatório' ?></h4>
                </div>
            </div> <!-- card-header -->
            <div class="card-body">
                <div class="card-body border border-warning" style="padding-left: 25px;">
                    <span style="font-size: 18px; font-style: italic; color: green">
                        Selecione tipo de conteúdo que deseja imprimir.</span>
                    <div class="radio">
                        <label><input type="radio" name="conteudos" value="princi" checked>&nbsp;Principal</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="conteudos" value="pricon">&nbsp;Principal/Conjuge</label>
                    </div>
                </div> <!-- card-body border -->
                <div class="card-body border border-warning" style="padding-left: 25px;">
                    <span style="font-size: 18px; font-style: italic; color: green">
                        Selecione tipo de relatório que deseja imprimir.</span>
                    <div class="radio">
                        <label><input type="radio" name="tipos" value="calurg">&nbsp;Calamidade/Emergência</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="tipos" value="famdef">&nbsp;Membro familiar deficiente</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="tipos" value="famido">&nbsp;Membro familiar idoso</label>
                    </div>
                    <hr style="margin: 1px">
                    <div class="radio">
                        <label><input type="radio" name="tipos" value="todoscont" checked>&nbsp;Todos</label>
                    </div>
                </div> <!-- card-body border -->
                <div class="card-body border border-warning" style="padding-left: 25px;">
                    <span style="font-size: 18px; font-style: italic; color: green">
                        Selecione situação que deseja imprimir.</span>
                    <div class="radio">
                        <label><input type="radio" name="situacoes" value="penden" onclick='relbloqueio()'>&nbsp;Pendência</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="situacoes" value="aptsor" onclick='relbloqueio()'>&nbsp;Apto Sorteio</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="situacoes" value="sertea" onclick='relbloqueio()'>&nbsp;Sorteados</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="situacoes" value="restod" onclick='relbloqueio()'>&nbsp;Todos</label>
                    </div>
                </div> <!-- card-body border -->
                <div class="card-body border border-warning" id="lisapto" style="display: none; padding-left: 25px;">
                    <span style="font-size: 18px; font-style: italic; color: green">Selecione tipo de listagem que deseja imprimir.</span>
                    <div class="radio">
                        <label><input id="lapto" type="radio" name="listaapto" value="liscpf">&nbsp;Lista com CPF</label>
                    </div>
                    <div class="radio">
                        <label><input id="lapto" type="radio" name="listaapto" value="lispub">&nbsp;Lista com CPF p/ publicar</label>
                    </div>
                    <div class="radio">
                        <label><input id="lapto" type="radio" name="listaapto" value="lisass">&nbsp;Lista assinaturas sorteio presença</label>
                    </div>
                    <div class="radio">
                        <label><input id="lapto" type="radio" name="listaapto" value="lisurn">&nbsp;Lista nomes urnas</label>
                    </div>
                    <div class="radio">
                        <label><input id="lapto" type="radio" name="listaapto" value="liscra">&nbsp;Lista por CRAS</label>
                    </div>
                    <hr style="margin: 1px">
                    <div class="radio">
                        <label><input id="lapto" type="radio" name="listaapto" value="todosapto">Todos</label>
                    </div>
                </div> <!-- card-body border -->
                <div class="card-body border border-warning" id="lissort" style="display: none; padding-left: 25px;">
                    <span style="font-size: 18px; font-style: italic; color: green">Selecione tipo de listagem que deseja imprimir.</span>
                    <div class="radio">
                        <label><input id="lsorte" type="radio" name="listasorte" value="lisblo">&nbsp;Lista assinaturas blocos presença</label>
                    </div>
                    <div class="radio">
                        <label><input id="lsorte" type="radio" name="listasorte" value="lissin">&nbsp;Lista assinaturas blocos síndico</label>
                    </div>
                    <hr style="margin: 1px">
                    <div class="radio">
                        <label><input id="lsorte" type="radio" name="listasorte" value="todossorte">&nbsp;Todos</label>
                    </div>
                </div> <!-- card-body border -->
                <div class="card-body border border-warning" id="ocup" style="display: none; padding-left: 25px;">
                    <span style="font-size: 18px; font-style: italic; color: green">Selecione a ocupação.</span>
                    <div class="row">
                        <div class="col">
                            <?php
                            echo '<label class="control-label">Quadra:</label>';
                            echo Select2::widget([
                                'name' => 'quadra',
                                'id' => 'qua',
                                'data' => [1 => "Quadra - 01", 2 => "Quadra - 02", 4 => "Quadra - 04", 5 => "Quadra - 05", 6 => "Quadra - 06"],
                                'maintainOrder' => true,
                                'options' => [
                                    'placeholder' => '-- Sel. o quadra --',
                                    'multiple' => true,
                                ],
                                'pluginOptions' => [
                                    'tags' => true,
                                    'maximumInputLength' => 20
                                ],
                                'pluginEvents' => [
                                    //    'select2:select' => 'function(e) { $("#lot").prop("disabled", false) }',
                                ],
                            ]);
                            ?>
                        </div> <!-- col -->
                        <div class="col">
                            <?php
                            echo '<label class="control-label">Lote:</label>';
                            echo Select2::widget([
                                'name' => 'lote',
                                'id' => 'lot',
                                'disabled' => true,
                                'maintainOrder' => true,
                                'options' => [
                                    'placeholder' => "-- Sel. o lote --",
                                    'multiple' => true
                                ],
                                'pluginOptions' => [
                                    'tags' => true,
                                    'maximumInputLength' => 20,
                                    'tokenSeparators' => [',', ' '],
                                ],
                                'pluginEvents' => [
                                    'select2:select' => 'function(e) { $("#blo").prop("disabled", false) }',
                                ],
                            ]);
                            ?>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col">
                            <div style="width: 50%">
                                <?php
                                echo '<label class="control-label">Bloco:</label>';
                                echo Select2::widget([
                                    'name' => 'bloco',
                                    'id' => 'blo',
                                    'data' => [
                                        1 => "Bloco - 01", 2 => "Bloco - 02", 3 => "Bloco - 03", 4 => "Bloco - 04", 5 => "Bloco - 05", 6 => "Bloco - 06",
                                        7 => "Bloco - 07", 8 => "Bloco - 08", 9 => "Bloco - 09", 10 => "Bloco - 10", 11 => "Bloco - 11", 12 => "Bloco - 12", 13 => "Bloco - 13",
                                        14 => "Bloco - 14", 15 => "Bloco - 15"
                                    ],
                                    'disabled' => true,
                                    'maintainOrder' => true,
                                    'options' => [
                                        'placeholder' => "-- Sel. o bloco --",
                                        'multiple' => true,
                                    ],
                                    'pluginOptions' => [
                                        'tags' => true,
                                        'maximumInputLength' => 20,
                                        'tokenSeparators' => [',', ' '],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- card-body border -->
            </div> <!-- card-body -->
            <div class="card-footer d-flex justify-content-md-end">
                <?=
                Html::submitButton(
                    "<span class='fas fa-print' aria-hidden='true'></span><span>&nbsp;&nbsp;Imprimir</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-primary mr-sm-0',
                        'id' => 'btn_imprimir',
                        'value' => 'imprimir',
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
                ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?=
                Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                    'class' => 'btn btn-sm btn-outline-warning mr-sm-0',
                    'onclick' => 'history.go(-1);',
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar página anterior',
                ])
                ?>
            </div> <!-- card-footer -->
        </div> <!-- modal-content -->
    </div> <!-- The Modal -->
</div>
<?php ActiveForm::end(); ?>