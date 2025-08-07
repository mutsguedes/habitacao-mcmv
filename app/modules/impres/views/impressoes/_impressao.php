<?php


use yii\web\View;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
?>

<?php
$this->registerJs(
    "$('#imp-modal').modal('show');
            
    $('#checkedall').on('change', function() {     
        $('.form-check-input').prop('checked', $(this).prop('checked'));              
    })
    $('.form-check-input').change(function(){
        if($('.form-check-input:checked').length == $('.form-check-input').length){
            $('#checkedall').prop('checked',true)
        } else {
            $('#checkedall').prop('checked',false)
        }
    })",
    View::POS_READY
);
?>
<?php
$fmt = new IntlDateFormatter(
    "pt_BR",
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    'America/Sao_Paulo',
    IntlDateFormatter::GREGORIAN,
    "EEEE, dd 'de ' MMMM 'de ' yyyy"
);
//  echo  'Itaboraí, ' . strftime('%A, %d de %B de %Y', strtotime(date("Y-m-d"))) . '.';
$dtDoc = 'Itaboraí, ' . datefmt_format($fmt, date_create('now')) . '.';
$form = ActiveForm::begin([
    'id' => 'impressao-form',
    'enableAjaxValidation' => true,
    'action' => ['/impres/impressoes/imp-ficha', 'idRes' => $idRes, 'dtDoc' => $dtDoc],
    'options' => ['target' => '_blank']
]);
$res = Responsavel::findOne($idRes);
?>
<div class="modal fade" id="imp-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <h4>
                                <?=
                                'Responsável - '
                                    . Html::label($res->nm_nom_res, null, ['style' => 'color:red']);
                                ?>
                            </h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px">
                    <div class="border border-warning" style="padding: 10px">
                        <h5>Selecione fichas que deseja imprimir.</h5>
                        <?php
                        if ($modelR->id_num_proj == 2) {
                            if (($res->id_cor_sit !== 5) and ($res->id_cor_sit !== 12) and ($res->id_cor_sit !== 13) and ($res->id_cor_sit !== 14)) { ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="comins"><?= '&nbsp;'; ?>Comprovante inscrição
                                    </label>
                                </div>
                                <?php
                                ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="decben"><?= '&nbsp;'; ?>Declaração de benefciário(s)
                                    </label>
                                </div>
                                <?php
                                ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="declei"><?= '&nbsp;'; ?>Decreto lei 2.848
                                    </label>
                                </div>
                                <?php
                                ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="copdoc"><?= '&nbsp;'; ?>Cópia documento
                                    </label>
                                </div>
                                <?php
                                ?>
                            <?php } ?>
                            <?php
                            if ($res->id_cor_sit === 5) { ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="terdespro"><?= '&nbsp;'; ?>Termo de Desistência Programa
                                    </label>
                                </div>
                            <?php } ?>
                            <?php
                            if ($res->id_cor_sit === 12) { ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="terdescad"><?= '&nbsp;'; ?>Termo de Desistência Cadastro
                                    </label>
                                </div>
                            <?php } ?>
                            <?php
                            if ($res->id_cor_sit === 13) { ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="terdessor"><?= '&nbsp;'; ?>Termo de Desistência Sorteio
                                    </label>
                                </div>
                            <?php } ?>
                            <?php
                            if ($res->id_cor_sit === 14) { ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="terdescom"><?= '&nbsp;'; ?>Termo de Desistência Contemplação
                                    </label>
                                </div>
                            <?php } ?>
                            <?php
                            ?>
                            <?php
                            $resultD = Dependente::find()
                                ->where(['id_num_res' => $idRes])
                                ->andwhere(['id_num_par' => [4, 9, 15]])
                                ->count();
                            if (($resultD <> 0) and ($res->id_cor_sit !== 5) and ($res->id_cor_sit !== 14)) {
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="decaus"><?= '&nbsp;'; ?>Declaração Ausência
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="decposuni"><?= '&nbsp;'; ?>Declaração Positiva de União Estável
                                    </label>
                                </div>
                            <?php } ?>
                            <?php
                            $resultR = Responsavel::find()
                                ->where(['id_num_res' => $idRes])
                                ->andwhere(['id_est_civ' => [1, 2, 4, 5, 6, 8, 9]])
                                ->count();
                            if (($resultR <> 0) and ($res->id_cor_sit !== 5) and ($res->id_cor_sit !== 12) and ($res->id_cor_sit !== 13) and ($res->id_cor_sit !== 14)) {
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fichas[]" class="form-check-input" value="decneguni"><?= '&nbsp;'; ?>Declaração Negativa de União Estável
                                    </label>
                                </div>
                            <?php } ?>
                        <?php } elseif ($modelR->id_num_proj == 5) { ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fichas[]" class="form-check-input" value="comins"><?= '&nbsp;'; ?>Comprovante inscrição
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fichas[]" class="form-check-input" value="declei"><?= '&nbsp;'; ?>Decreto lei 2.848
                                </label>
                            </div>
                        <?php } ?>
                    </div> <!-- border -->
                    <?php
                    if ($res->id_cor_sit != 5) { ?>
                        <div class="border border-warning" style="padding: 10px">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fichas[]" id="checkedall" value="todos"><?= '&nbsp;'; ?>Todos
                                </label>
                            </div>
                        </div> <!-- border -->
                    <?php } ?>
                </div> <!-- border -->
            </div> <!-- Modal body -->
            <div class="modal-footer justify-content-md-end">
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
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlRes = Yii::$app->urlManager->createUrl([
                    '/res/responsaveis/index-responsavel',
                    'idRes' => $modelR->id_num_res
                ]);
                echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Responsável</span>", [
                    'class' => 'btn btn-sm btn-outline-info mr-sm-0',
                    'onclick' => "window.location.href = '" . $urlRes . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar responsável',
                ]);
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlIndex = Yii::$app->urlManager->createUrl(['/res/responsaveis/index']);
                echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                    'class' => 'btn btn-sm btn-outline-warning mr-sm-0',
                    'onclick' => "window.location.href = '" . $urlIndex . "';",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar lista responsáveis',
                ])
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div><!-- the modal -->
<?php ActiveForm::end(); ?>