<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;
?>
<?php
$this->registerJs(
    "$('#age-view-modal').modal('show');",
    View::POS_READY
);
?>

<?php
$form = ActiveForm::begin([
    'id' => 'age-view',
    'enableAjaxValidation' => true,
    'action' => ['/imprel/relatorios/relatorio'],
    'options' => ['target' => '_blank']
]);
?>
<div class="modal fade" id="age-view-modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
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