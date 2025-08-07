<?php

use yii\web\View;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

?>

<?php
$this->registerJs(
    "$('#rel-modal').modal('show');",
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
<div class="modal fade" id="rel-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-print fa-4x"></span>
                        </div>
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>Relatório</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <div class="border border-warning" style="padding: 10px">
                        <span style="font-size: 18px; font-style: italic; color: green">
                            Selecione tipo de conteúdo que deseja imprimir.</span>
                        <div class="radio">
                            <label><input type="radio" name="conteudos" value="princi" checked>&nbsp;Principal</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="conteudos" value="pricon">&nbsp;Principal/Conjuge</label>
                        </div>
                    </div> <!-- card-body border -->
                    <div class="border border-warning" style="padding: 10px">
                        <span style="font-size: 18px; font-style: italic; color: green">
                            Selecione tipo de relatório que deseja imprimir.</span>
                        <div class="radio">
                            <label><input type="radio" name="tipos" value="fampri">&nbsp;Prioridade</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="tipos" value="famger">&nbsp;Geral</label>
                        </div>
                        <hr style="margin: 1px">
                        <div class="radio">
                            <label><input type="radio" name="tipos" value="todoscont" checked>&nbsp;Todos</label>
                        </div>
                    </div> <!-- card-body border -->
                    <div class="border border-warning" style="padding: 10px">
                        <span style="font-size: 18px; font-style: italic; color: green">
                            Selecione situação que deseja imprimir.</span>
                        <div class="radio">
                            <label><input type="radio" name="situacoes" value="aptsor" onclick='relbloqueio()'>&nbsp;Apto Sorteio</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="situacoes" value="sortea" onclick='relbloqueio()'>&nbsp;Sorteados</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="situacoes" value="penden" onclick='relbloqueio()'>&nbsp;Pendência</label>
                        </div>
                        <!--  <div class="radio">
                        <label><input type="radio" name="situacoes" value="restod" onclick='relbloqueio()'>&nbsp;Todos</label>
                    </div> -->
                    </div> <!-- card-body border -->
                    <div class="border border-warning" id="lispen" style="display: none; padding: 10px">
                        <span style="font-size: 18px; font-style: italic; color: green">Selecione tipo de listagem que deseja imprimir.</span>
                        <div class="radio">
                            <label><input type="radio" name="listapen" value="lispub">&nbsp;Lista com CPF p/ publicar</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listapen" value="lisass">&nbsp;Lista assinaturas presença</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listapen" value="liscra">&nbsp;Lista por CRAS</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listapen" value="liscrm">&nbsp;Lista por CRAS mural</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listapen" value="listel">&nbsp;Lista telefone</label>
                        </div>
                        <hr style="margin: 1px">
                        <div class="radio">
                            <label><input type="radio" name="listapen" value="todospen">&nbsp;Todos</label>
                        </div>
                    </div> <!-- card-body border -->
                    <div class="border border-warning" id="lisapto" style="display: none; padding: 10px">
                        <span style="font-size: 18px; font-style: italic; color: green">Selecione tipo de listagem que deseja imprimir.</span>
                        <div class="radio">
                            <label><input type="radio" name="listaapto" value="liscpf">&nbsp;Lista com CPF</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listaapto" value="lispub">&nbsp;Lista com CPF p/ publicar</label>
                        </div>
                        <!-- <div class="radio">
                        <label><input type="radio" name="listaapto" value="lisass">&nbsp;Lista assinaturas sorteio presença</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="listaapto" value="lisurn">&nbsp;Lista nomes urnas</label>
                    </div> -->
                        <div class="radio">
                            <label><input type="radio" name="listaapto" value="lisuas">&nbsp;Lista assinaturas nomes urnas</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listaapto" value="liscra">&nbsp;Lista por CRAS</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listaapto" value="liscrm">&nbsp;Lista por CRAS mural</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listaapto" value="listel">&nbsp;Lista telefone</label>
                        </div>
                        <hr style="margin: 1px">
                        <div class="radio">
                            <label><input type="radio" name="listaapto" value="todosapto">&nbsp;Todos</label>
                        </div>
                    </div> <!-- card-body border -->
                    <div class="border border-warning" id="lissort" style="display: none; padding: 10px">
                        <span style="font-size: 18px; font-style: italic; color: green">Selecione tipo de listagem que deseja imprimir.</span>
                        <div class="radio">
                            <label><input type="radio" name="listasorte" value="lisalf">&nbsp;Lista assinaturas CONTRATO</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listasorte" value="lisblo" onclick='relbloqueio()'>&nbsp;Lista assinaturas VISTORIA</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listasorte" value="lissin" onclick='relbloqueio()'>&nbsp;Lista assinaturas SÍNDICO</label>
                        </div>
                        <hr style="margin: 1px">
                        <div class="radio">
                            <label><input type="radio" name="listasorte" value="todossorte" onclick='relbloqueio()'>&nbsp;Todos</label>
                        </div>
                    </div> <!-- card-body border -->
                    <div class="border border-warning" id="lisdata" style="display: none; padding: 10px">
                        <span style="font-size: 18px; font-style: italic; color: green">Selecione data da contemplação.</span>
                        <div class="radio">
                            <label><input type="radio" name="listadata" value="2019-08-03">&nbsp;03-08-2019 -> 300 unidades</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listadata" value="2019-09-20" onclick='relbloqueio()'>&nbsp;20-09-2019 -> 600 unidades</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listadata" value="2021-12-22" onclick='relbloqueio()'>&nbsp;22-12-2021 -> 900 unidades</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="listadata" value="2023-02-15" onclick='relbloqueio()'>&nbsp;15-02-2023 -> 600 unidades</label>
                        </div>
                        <hr style="margin: 1px">
                        <div class="radio">
                            <label><input type="radio" name="listadata" value="todosdata" onclick='relbloqueio()'>&nbsp;Todas</label>
                        </div>
                    </div> <!-- border -->
                </div> <!-- border -->
            </div> <!-- Modal body -->
            <div class="modal-footer justify-content-md-end">
                <?=
                Html::submitButton(
                    "<span class='fas fa-print' aria-hidden='true'></span><span>&nbsp;&nbsp;Imprimir</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-primary mr-sm-0',
                        'id' => 'btn_enviar',
                        //'id' => 'btn_imprimir',
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
            </div> <!-- modal-footer -->
        </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div><!-- the modal -->
<?php ActiveForm::end(); ?>