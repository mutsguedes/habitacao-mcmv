<?php

use yii\web\View;
use kartik\helpers\Html;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use app\components\MarArtHelpers;
use kartik\datecontrol\DateControl;
use app\modules\auxiliar\models\GerState;
use app\modules\auxiliar\models\GerAssunto;

/* @var $this View */
/* @var $modelA */
/* @var $datesValidate [] */
/* @var $form ActiveForm */
?>

<?php
$this->registerJs(
    "$('#app-modal').modal('show');",
    View::POS_READY
);
?>

<?php
$form = ActiveForm::begin([
    'id' => 'app',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'options' => [
        'class' => 'form',
    ],
    'method' => "POST",
]);
//$modelA->dt_age_dat = date('d-m-Y', strtotime($dt));

$enbMonth = ArrayHelper::getColumn(Yii::$app->session->get('all_month'), 'nu_num_mes');
//$desMonth = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-enable-month'), 'nu_num_mes');

$dt = date('Y' . '-' . reset($enbMonth) . '-' . 'd');

$dateFast = date_create($dt);
//$dateFast = date($dt);
//$dateFast = new DateTime($dt);
$dateStar = $dateFast->format('d-m-Y');

$dateEnd = $dateFast->format('t' . '-' . end($enbMonth) . '-' . 'Y');
/* $dateDay = date_diff(new DateTime($dateStar), new DateTime('31-05-2022'));
$dateEnd = date("d-m-Y",  strtotime($dateDay->format('%R%a days'), strtotime(date('d-m-Y'))));  */

$timesDay = [];
$date = '';

?>
<div class="modal fade" id="app-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <input type="hidden" id="idAge" value="<?php echo $modelA->dt_age_dat; ?>">
                    <div class="row d-flex justify-content-end">
                        <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-calendar-alt fa-4x"></span>
                        </div>
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4>Selecionar Dia da Agenda</h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px;">
                    <div id="rowleft" class="row d-flex">
                        <div class=" col-sm-4 d-flex">
                            <?php
                            echo '<div class="well border border-secondary rounded p-1" style="width:285px">';
                            echo DatePicker::widget([
                                'name' => 'calendar',
                                'type' => DatePicker::TYPE_INLINE,
                                'id' => 'calendar',
                                'size' => 'md',
                                'type' => DatePicker::TYPE_INLINE,
                                'pluginOptions' => [
                                    'daysOfWeekDisabled' => [0, 6],
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'todayBtn' => true,
                                    'startDate' => $dateStar,
                                    'endDate' => $dateEnd,
                                    'weekStart' => 0,
                                    'datesDisabled' => $datesValidate,
                                    'format' => 'dd-mm-yyyy'
                                ],
                                'options' => [
                                    'style' => ['margin' => '0px'],
                                    // you can hide the input by setting the following
                                    //'style' => 'display:none'
                                ]
                            ]);
                            echo '</div>';
                            ?>
                        </div> <!-- col left -->
                        <div id="colrigth" class="col-sm d-flex flex-wrap align-content-center border border-secondary rounded" style="margin-right: 10px;">
                            <div class="border border-warning" style="padding: 10px;">
                                <p class="text-justify h-100" style="font-size: x-large; margin: 0px;">
                                    <strong>Selecione ao lado a data desejada para iniciar cadastro da agenda.</strong>
                                </p>
                            </div> <!-- border -->
                        </div> <!-- col right -->
                    </div><!-- row -->
                </div> <!-- border -->
            </div> <!-- modal-body -->
            <div class="modal-footer d-flex justify-content-md-end">
                <?=
                Html::Button(
                    "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                    [
                        'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
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
<?php
if (!$modelA->isNewRecord) {
    $script = <<< JS
    $('#app-modal').ready(function() {
        $('#idAge').val($modelA->id_num_age);
        console.log($('#idAge').val());
     })
    JS;
    $this->registerJs($script);
}
?>