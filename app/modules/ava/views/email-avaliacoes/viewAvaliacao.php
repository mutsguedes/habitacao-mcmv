<?php

use yii\web\View;
use kartik\form\ActiveForm;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $modelEA EmailAvaliacao */
?>
<?php
$this->registerJs("$('#viewAvaliacaoHis-modal').modal('show');", View::POS_READY);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'viewAvaliacaoHis-form',
]);
?>
<div class="modal fade" tabindex="-1" id="viewAvaliacaoHis-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-md">
        <div class="card">
            <div class="card-header">
                <button onClick='window.history.back(-1);' type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
                <div class="row d-flex justify-content-center">
                    <img src="/img/rating1.png" alt=" Obrigado!!!" style="width: 85px; height: 85px; 
                         border-radius: 50%; margin-top: -2px; border: 3px solid; border-color:#999;">

                </div>
                <div class="row d-flex justify-content-center" style="padding-top: 5px">
                    <h4>Avaliação Cidadão</h4>
                </div>
            </div> <!-- card-header -->
            <div class=card-body>


            </div> <!-- card-body -->
            <div class="card-footer text-center">

            </div> <!-- modal-footer -->
        </div> <!-- card -->
    </div> <!-- modal-dialog -->
</div><!-- modal -->
<?php ActiveForm::end(); ?>