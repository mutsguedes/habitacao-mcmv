<?php


use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\SwitchInput;
use kartik\number\NumberControl;
use app\components\MarArtHelpers;
use kartik\datecontrol\DateControl;
use app\modules\auxiliar\models\GerEtnia;
use app\modules\auxiliar\models\GerEstado;
use app\modules\auxiliar\models\GerGenero;
use app\modules\auxiliar\models\GerProjeto;
use app\modules\auxiliar\models\GerOriRenda;
use app\modules\auxiliar\models\GerTabUniCbo;
use app\modules\auxiliar\models\GerCorSituacao;
use app\modules\auxiliar\models\GerEstadoCivil;
use app\modules\auxiliar\models\GerNatOcupacao;
use app\modules\auxiliar\models\GerGrauInstrucao;

/* @var $this View */
/* @var $modelR Responsavel */
/* @var $form ActiveForm */

$dispOptions = ['maxlength' => true, 'class' => 'form-control form-control-sm kv-monospace'];
?>

<div class="responsaveis-form">
    <div class="row">
        <div class="col-sm-3">
            <?php
            if (Yii::$app->session->get('sistema') === 'MCMV') {
                $corSit = GerCorSituacao::find()
                    ->where(['not in', 'id_cor_sit', [16, 21]])
                    ->orderBy('id_cor_sit');
            } elseif (Yii::$app->session->get('sistema') === 'PAC') {
                $corSit = GerCorSituacao::find()
                    ->where(['id_cor_sit' => 16])
                    ->orderBy('id_cor_sit');
            } elseif (Yii::$app->session->get('sistema') === 'PHPMI') {
                $corSit = GerCorSituacao::find()
                    ->where(['id_cor_sit' => 21])
                    ->orderBy('id_cor_sit');
            }
            echo $form->field($modelR, 'id_cor_sit')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. situação --',
                ],
                'pluginOptions' => [
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map($corSit
                    ->asArray()->all(), 'id_cor_sit', 'nm_des_sit'),
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            if (Yii::$app->session->get('sistema') === 'MCMV') {
                $pro = GerProjeto::find()
                    ->where(['not in', 'id_num_proj', [3, 4, 5]])
                    ->orderBy('id_num_proj');
            } elseif (Yii::$app->session->get('sistema') === 'PAC') {
                $pro = GerProjeto::find()
                    ->where(['not in', 'id_num_proj', [2, 5]])
                    ->orderBy('id_num_proj');
            } elseif (Yii::$app->session->get('sistema') === 'PHPMI') {
                $pro = GerProjeto::find()
                    ->where(['not in', 'id_num_proj', [2, 3, 4]])
                    ->orderBy('id_num_proj');
            }
            echo   $form->field($modelR, 'id_num_proj')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. projeto --',
                    'options' => [
                        1 => ['disabled' => true],
                    ],
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map($pro
                    ->asArray()->all(), 'id_num_proj', 'nm_nom_proj'),
            ])
            ?>
        </div>
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'bo_cal_urg')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'bo_mem_def')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
                'pluginEvents' => [
                    "switchChange.bootstrapSwitch" => "function(event,state) { "
                        . "if (state) { "
                        . "$('#ade>a').removeClass('disabled'); "
                        . "} else { "
                        . "$('#ade>a').addClass('disabled'); "
                        . "} "
                        . "}",
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-2">
            <text for="rendaFam">Renda familiar:</text>
            <h4 id="rendaFam" style="color: green; text-align: left; margin: 0">R$ 0,00</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 ">
            <?=
            $form->field($modelR, 'nm_nom_res')
                ->textInput([
                    'class' => 'form-control form-control-sm material-design',
                    'maxlength' => true,
                    'style' => ['text-transform' => 'uppercase']
                ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'dt_nas_res')->widget(DateControl::class, [
                'type' => DateControl::FORMAT_DATE,
                'options' => ['id' => 'dt_nas_res'],
                'ajaxConversion' => false,
                'widgetOptions' => [
                    'size' => 'sm',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true
                    ]
                ],
                'locale' => 'pt-BR'
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_num_gen')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. genero --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerGenero::find()->orderBy('id_num_gen')
                    ->asArray()->all(), 'id_num_gen', 'nm_nom_gen'),
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_est_civ')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. estado cívil --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'pluginEvents' => [
                    "change" => "function() { "
                        . "$('#bo_cop_nas').hide(); "
                        . "$('#bo_cop_est_pos').hide(); "
                        . "$('#bo_cop_est_neg').hide(); "
                        . "$('#bo_cop_cas').hide(); "
                        . "$('#bo_cop_ave_des').hide(); "
                        . "$('#bo_cop_ave_div').hide(); "
                        . "$('#bo_cop_uni_est').hide(); "
                        . "$('#bo_cop_est_jud').hide(); "
                        . "$('#bo_cop_sep_jud').hide(); "
                        . "$('#bo_cop_obi').hide(); "
                        . "if (($(this).val()) == 2) { "
                        . "$('#bo_cop_nas').show(); "
                        . "$('#bo_cop_est_pos').show(); "
                        . "$('#bo_cop_est_neg').show(); "
                        . "} else if (($(this).val()) == 3) { "
                        . "$('#bo_cop_cas').show(); "
                        . "} else if (($(this).val()) == 4) { "
                        . "$('#bo_cop_ave_des').show(); "
                        . "$('#bo_cop_est_pos').show(); "
                        . "$('#bo_cop_est_neg').show(); "
                        . "} else if (($(this).val()) == 5) { "
                        . "$('#bo_cop_ave_div').show(); "
                        . "$('#bo_cop_est_pos').show(); "
                        . "$('#bo_cop_est_neg').show(); "
                        . "} else if (($(this).val()) == 6) { "
                        . "$('#bo_cop_uni_est').show(); "
                        . "$('#bo_cop_est_pos').show(); "
                        . "$('#bo_cop_est_neg').show(); "
                        . "} else if (($(this).val()) == 7) { "
                        . "$('#bo_cop_uni_est').show(); "
                        //  . "$('#bo_cop_est_pos').show(); "
                        . "} else if (($(this).val()) == 8) { "
                        . "$('#bo_cop_cas').show(); "
                        . "$('#bo_cop_obi').show(); "
                        . "$('#bo_cop_est_pos').show(); "
                        . "$('#bo_cop_est_neg').show(); "
                        . "}"
                        . "}",
                ],
                'data' => ArrayHelper::map(GerEstadoCivil::find()->orderBy('id_est_civ')
                    ->asArray()->all(), 'id_est_civ', 'nm_est_civ'),
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_gra_ins')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. grau instrução --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerGrauInstrucao::find()->orderBy('id_gra_ins')
                    ->asArray()->all(), 'id_gra_ins', 'nm_gra_ins'),
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_num_nat')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. naturalidade --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerEstado::find()->orderBy('id_num_est')
                    ->asArray()->all(), 'id_num_est', 'nm_nom_est'),
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_num_cbo')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. profissão --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerTabUniCbo::find()->orderBy('id_num_cbo')
                    ->asArray()->all(), 'id_num_cbo', 'nm_des_cbo'),
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_num_etn')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. etnia --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerEtnia::find()->orderBy('id_num_etn')
                    ->asArray()->all(), 'id_num_etn', 'nm_nom_etn'),
            ])
            ?>
        </div>
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'nu_num_nis')->widget(MaskedInput::class, [
                'id' => 'nu_num_nis', 'mask' => '999.99999.99-9',
                'clientOptions' => ['removeMaskOnSubmit' => true]
            ])
                ->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm',])
            ?>
        </div>
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'nu_num_cpf')->widget(MaskedInput::class, [
                'id' => 'nu_num_cpf', 'mask' => '999.999.999-99',
                'clientOptions' => ['removeMaskOnSubmit' => true]
            ])
                ->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm',])
            ?>
        </div>
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'nu_num_ide')->widget(MaskedInput::class, [
                'id' => 'nu_num_ide', 'mask' => MarArtHelpers::masEdId(),
                'clientOptions' => ['removeMaskOnSubmit' => true]
            ])
                ->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm',])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'nm_nom_ema')->widget(MaskedInput::class, [
                'clientOptions' => ['alias' => 'email',]
            ])
                ->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm',])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_nat_ocu')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. tipo ocupação --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerNatOcupacao::find()->orderBy('id_nat_ocu')
                    ->asArray()->all(), 'id_nat_ocu', 'nm_nat_ocu'),
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'id_ori_ren')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Selecione o. renda --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerOriRenda::find()->orderBy('id_ori_ren')
                    ->asArray()->all(), 'id_ori_ren', 'nm_ori_ren'),
            ])
            ?>
        </div>
        <div id="nu_ren_res" class="col-sm-2">
            <?=
            $form->field($modelR, 'nu_ren_res')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => 'R$ ',
                    'groupSeparator' => '.',
                    'radixPoint' => ','
                ],
                'displayOptions' => $dispOptions,
                'pluginEvents' => [
                    'change' => 'function() { '
                        . 'var tempo, data_tx, valor, valorF; '
                        . 'valor = 0; '
                        . 'valorF = 0;'
                        . 'data_tx = 0; '
                        . 'data_tx = $(this).val(); '
                        . 'var form_data = { '
                        . 'data:' . $idRes
                        . '};'
                        . 'valor = data_tx.split("."); '
                        . 'if ((data_tx !== "") && (data_tx !== 0)){ '
                        . '$("#rendaFam").show(); '
                        . '$.ajax({ '
                        . 'url:"get-renda-dep", '
                        . 'type: "POST", '
                        . 'data: {idRes: form_data} ,'
                        . 'dataType: "json", '
                        . 'success: function(data) { '
                        . 'if (data["totalrenda"] == null) { '
                        . 'data["totalrenda"] = 0; '
                        . '}; '
                        . 'valorR = (parseFloat(data["totalrenda"]) + parseFloat(valor.toString().replace(",","."))); '
                        . 'if ((valorR <= 1800.00) || (($("#responsaveis-bo_mem_def").prop("checked")) && (valorR <= 1800.00))){ '
                        . '$("#rendaFam").removeClass("text-danger"); '
                        . '$("#rendaFam").addClass("text-success"); '
                        . '$("#rendaFam").text(numberToReal(valorR)); '
                        . '} else { '
                        . '$("#rendaFam").removeClass("text-success"); '
                        . '$("#rendaFam").addClass("text-danger"); '
                        . '$("#rendaFam").text(numberToReal(valorR)); '
                        . '} '
                        . 'tempo = window.setInterval(function(){ '
                        . 'if($("#rendaFam").is(":hidden")){ '
                        . '$("#rendaFam").show(); '
                        . '} else { '
                        . '$("#rendaFam").hide(); '
                        . '}; '
                        . '}, 1000); '
                        . '$("#rendaFam").text(numberToReal(valorR)); '
                        . 'window.setTimeout(function() { '
                        . 'window.clearInterval(tempo); '
                        . '}, 10000);'
                        . '} '
                        . '}); '
                        . '}; '
                        . 'function numberToReal(numero) { '
                        . 'var numero = numero.toFixed(2).split("."); '
                        . 'numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join("."); '
                        . 'return numero.join(","); '
                        . '} '
                        . '}',
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?=
            $form->field($modelR, 'nm_nom_obs')
                ->textarea(['maxlength' => true, 'style' => ['text-transform' => 'uppercase']])
            ?>
        </div>
    </div>
</div>
<?php
if (!$modelR->isNewRecord) {
    $script = <<< JS
    $('#responsaveis-nu_ren_res-disp').ready(function() { 
        var tempo;
        var data_tx = $('#responsaveis-nu_ren_res-disp').val(); 
            var form_data = { 
                idRes: $modelR->id_num_res , 
            };
            if ($('#responsaveis-bo_mem_def').prop("checked")) {
                $("#ade").removeClass("disabled"); 
                $("a").attr("data-toggle", "tab"); 
            };
            $.ajax({ 
                url:"get-renda", 
                type: "POST", 
                data: {idRes: form_data} ,
                dataType: "json", 
                success: function(data) {  
                if ((parseInt(data["totalrenda"],10) <= 1800.00) || (($("#responsaveis-bo_mem_def").prop("checked")) && (parseInt(data["totalrenda"],10) <= 3500.00))){ 
                    $("#rendaFam").removeClass('text-danger');
                    $("#rendaFam").addClass('text-success');                    
                    $("#rendaFam").text(numberToReal(data["totalrenda"])); 
                } else {
                    $("#rendaFam").removeClass('text-success');
                    $("#rendaFam").addClass('text-danger');
                    tempo = window.setInterval(function(){
                        if($("#rendaFam").is(':hidden')){
                            $("#rendaFam").show();
                        } else {
                            $("#rendaFam").hide();
                        }
                    }, 1000);
                    window.setTimeout(function() { 
                        window.clearInterval(tempo); 
                    }, 10000);   
                    $("#rendaFam").text(numberToReal(data["totalrenda"])); 
                    }
                } 
            });
        function numberToReal(numero) { 
            var numero = numero.toFixed(2).split(".");
            numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join("."); 
            return numero.join(","); 
        };
    });
JS;
    $this->registerJs($script);
}
?>