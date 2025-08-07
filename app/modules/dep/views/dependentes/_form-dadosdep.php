<?php


use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\number\NumberControl;
use app\components\MarArtHelpers;
use kartik\datecontrol\DateControl;
use kartik\switchinput\SwitchInput;
use app\modules\auxiliar\models\GerEtnia;
use app\modules\auxiliar\models\GerEstado;
use app\modules\auxiliar\models\GerGenero;
use app\modules\auxiliar\models\GerOriRenda;
use app\modules\auxiliar\models\GerTabUniCbo;
use app\modules\auxiliar\models\GerParentesco;
use app\modules\auxiliar\models\GerEstadoCivil;
use app\modules\auxiliar\models\GerNatOcupacao;
use app\modules\auxiliar\models\GerGrauInstrucao;

/* @var $this View */

/* @var $form ActiveForm */
/* @var $modelD Dependente */
/* @var $idRes */

$dispOptions = ['maxlength' => true, 'class' => 'form-control form-control-sm kv-monospace'];
?>
<div class="dependente-form">
    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($modelD, 'nm_nom_dep')
                ->textInput([
                    'maxlength' => true,
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase']
                ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelD, 'dt_nas_dep')->widget(DateControl::class, [
                'type' => DateControl::FORMAT_DATE,
                'options' => ['id' => 'dt_nas_dep'],
                'ajaxConversion' => false,
                'widgetOptions' => [
                    'size' => 'sm',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true
                    ]
                ],
                'language' => 'pt-BR'
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelD, 'id_num_par')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. parentesco --',
                ],
                'pluginOptions' => [
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'pluginEvents' => [
                    "change" => "function() { "
                        . "$('#bo_cop_cpf').hide(); "
                        . "$('#bo_cop_ide').hide(); "
                        . "$('#bo_cop_nas').hide(); "
                        . "$('#bo_cop_ave_des').hide(); "
                        . "$('#bo_cop_ave_div').hide(); "
                        . "$('#bo_cop_sep_jud').hide(); "
                        . "$('#bo_cop_est_jud').hide(); "
                        . "$('#bo_cop_obi').hide(); "
                        . "if ((($(this).val()) == 4) || (($(this).val()) == 9)){ "
                        . "$('#bo_cop_cpf').show(); "
                        . "$('#bo_cop_ide').show(); "
                        . "$('#bo_cop_nas').show(); "
                        . "$('#bo_cop_ave_des').show(); "
                        . "$('#bo_cop_ave_div').show(); "
                        . "$('#bo_cop_sep_jud').show(); "
                        . "$('#bo_cop_est_jud').show(); "
                        . "$('#bo_cop_obi').show(); "
                        . "}"
                        . "}",
                    "select2:opening" => "function() { console.log('opening '+$(this).val()); }",
                    "select2:open" => "function() { console.log('open '+$(this).val()); }",
                    "select2:selecting" => "function() { console.log('selecting '+$(this).val()); }",
                    "select:select" => "function() { console.log('select '+$(this).val()); }",
                ],
                'data' => ArrayHelper::map(GerParentesco::find()->orderBy('id_num_par')
                    ->asArray()->all(), 'id_num_par', 'nm_nom_par'),
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?=
            $form->field($modelD, 'bo_mem_def')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger',
                ],
                'pluginEvents' => [
                    "switchChange.bootstrapSwitch" => "function(event,state) { "
                        . "if (state) { "
                        . "$('#ade>a').removeClass('disabled'); "
                        . "} else { "
                        . "$('#ade>a').addClass('disabled','disabled'); "
                        . "} "
                        . "}",
                ],
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <label for="rendaFam">Renda familiar:</label>
            <h4 id="rendaFam" style="color: green; text-align: left; margin: 0">R$ 0,00</h4>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelD, 'nu_num_cpf')->widget(MaskedInput::class, [
                'id' => 'nu_num_cpf',
                'mask' => '999.999.999-99',
                'clientOptions' => ['removeMaskOnSubmit' => true]
            ])
                ->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm',])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelD, 'nu_num_ide')->widget(MaskedInput::class, [
                'id' => 'nu_num_ide', 'mask' => MarArtHelpers::masEdId(),
                'clientOptions' => ['removeMaskOnSubmit' => true]
            ])
                ->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm',])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?=
            $form->field($modelD, 'id_num_gen')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. genero --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'data' => ArrayHelper::map(GerGenero::find()->orderBy('id_num_gen')
                    ->asArray()->all(), 'id_num_gen', 'nm_nom_gen'),
            ])
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($modelD, 'id_num_etn')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. etnia --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'data' => ArrayHelper::map(GerEtnia::find()->orderBy('id_num_etn')
                    ->asArray()->all(), 'id_num_etn', 'nm_nom_etn'),
            ])
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($modelD, 'id_est_civ')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. e. cívil --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'data' => ArrayHelper::map(GerEstadoCivil::find()->orderBy('id_est_civ')
                    ->asArray()->all(), 'id_est_civ', 'nm_est_civ'),
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?=
            $form->field($modelD, 'id_gra_ins')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. g. instrução --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'data' => ArrayHelper::map(GerGrauInstrucao::find()->orderBy('id_gra_ins')
                    ->asArray()->all(), 'id_gra_ins', 'nm_gra_ins'),
            ])
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($modelD, 'id_num_nat')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. naturalidade --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'data' => ArrayHelper::map(GerEstado::find()->orderBy('id_num_est')
                    ->asArray()->all(), 'id_num_est', 'nm_nom_est'),
            ])
            ?>
        </div>
        <div class="col-sm-4">
            <?=
            $form->field($modelD, 'id_num_cbo')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. profissão --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
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
            $form->field($modelD, 'id_nat_ocu')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'id' => 'id_nat_ocu',
                    'prompt' => '-- Sel. tipo ocupação --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'data' => ArrayHelper::map(GerNatOcupacao::find()->orderBy('id_nat_ocu')
                    ->asArray()->all(), 'id_nat_ocu', 'nm_nat_ocu'),
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelD, 'id_ori_ren')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. o. renda --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                    'dropdownParent' => '#dep-modal',
                ],
                'data' => ArrayHelper::map(GerOriRenda::find()->orderBy('id_ori_ren')
                    ->asArray()->all(), 'id_ori_ren', 'nm_ori_ren'),
            ])
            ?>
        </div>
        <div id="nu_ren_dep" class="col-xs-12 col-md-2">
            <?=
            $form->field($modelD, 'nu_ren_dep')->widget(NumberControl::class, [
                'class' => '',
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
                        . 'if ((data_tx !== "") || (data_tx !== 0)){ '
                        . '$("#rendaFam").show(); '
                        . '$.ajax({ '
                        . 'url:"/res/responsaveis/get-renda", '
                        . 'type: "POST", '
                        . 'data: {idRes: form_data}, '
                        . 'dataType: "json", '
                        . 'success: function(data) { '
                        . 'if (data["totalrenda"] == null) { '
                        . 'data["totalrenda"] = 0; '
                        . '}; '
                        . 'valorR = ((parseFloat(data["totalrenda"]) - parseFloat(' . $oldVar . ')) + parseFloat(valor.toString().replace(",","."))); '
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
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <?=
            $form->field($modelD, 'nm_nom_obs')
                ->textarea(['maxlength' => true, 'style' => ['text-transform' => 'uppercase']])
            ?>
        </div>
    </div>
</div>

<?php
$script = <<< JS
    $('#dependente-nu_ren_dep-disp').ready(function() { 
        var tempo = 0;
        var data_ocu = $("#id_nat_ocu").val();
        /* if ((data_ocu == 1) || (data_ocu == 4)){ 
            $("#dependente-nu_ren_dep-disp").hide(); 
        } else {
            $("#dependente-nu_ren_dep-disp").show(); 
        };  */
        $("#dependente-nu_ren_dep-disp").show(); 
        var data_tx = $("#dependente-nu_ren_dep-disp").val(); 
            var form_data = { 
                idRes: $idRes , 
            };
            oldVar = $("#dependente-nu_ren_dep-disp").val(); 
            if ($('#dependente-bo_mem_def').prop("checked")) {
                $("#ade").removeClass("disabled"); 
                $("a").attr("data-toggle", "tab"); 
            };
            $.ajax({ 
                url:"/web/res/responsaveis/get-renda", 
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
                            $("#rendaFam").show();;
                        } else {
                            $("#rendaFam").hide();
                        }
                    }, 1000);
                    window.setTimeout(function() { 
                        window.clearInterval(tempo); 
                    }, 10000);   
                    $("#rendaFam").text(numberToReal(data["totalrenda"])); 
                }                    
                console.log(data); 
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
?>