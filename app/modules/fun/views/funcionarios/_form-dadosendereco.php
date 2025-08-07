<?php

use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $modelF Funcionarios */
/* @var $form ActiveForm */
?>

<div class="enderecos-form">
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelF, 'nu_num_cep')->widget(MaskedInput::class, [
                'id' => 'nu_num_cep', 'mask' => '99.999-999',
                'clientOptions' => ['removeMaskOnSubmit' => true]
            ])
                ->textInput()
            ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelF, 'nm_nom_log')
                ->textInput(['style' => ['text-transform' => 'uppercase',]])
            ?>
        </div>
        <div class="col-xs-12 col-md-1">
            <?=
            $form->field($modelF, 'nu_num_cas')
                ->textInput()
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelF, 'nm_nom_com')
                ->textInput(['style' => ['text-transform' => 'uppercase',]])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?=
            $form->field($modelF, 'nm_nom_bai')
                ->textInput(['style' => ['text-transform' => 'uppercase',]])
            ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?=
            $form->field($modelF, 'nm_nom_mun')
                ->textInput(['style' => ['text-transform' => 'uppercase',]])
            ?>
        </div>
        <div class="col-xs-12 col-md-1">
            <?=
            $form->field($modelF, 'nm_nom_est')
                ->textInput(['style' => ['text-transform' => 'uppercase',]])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelF, 'nu_num_tel')->widget(MaskedInput::class, ['mask' => ['(99) 9999-9999', '(99) 99999-9999'], 'clientOptions' => ['removeMaskOnSubmit' => true,]])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelF, 'nu_num_tel_1')->widget(MaskedInput::class, ['mask' => ['(99) 9999-9999', '(99) 99999-9999'], 'clientOptions' => ['removeMaskOnSubmit' => true,]])
            ?>
        </div>
    </div>
</div>
<?php
$script = <<< JS
    $(document).ready(function() {
        function limpa_formulario_cep() {
            // Limpa valores do formulário de cep.
            $("#funcionarios-nm_nom_log").val("");
            $("#funcionarios-nm_nom_bai").val("");
            $("#funcionarios-nm_nom_mun").val("");
            $("#funcionarios-nm_nom_est").val("");
          //  $("#ibge").val("");
        }        
        //Quando o campo cep perde o foco.
        $("#funcionarios-nu_num_cep").blur(function() {
            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep !== "") {
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;
                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#funcionarios-nm_nom_log").val("...");
                    $("#funcionarios-nm_nom_bai").val("...");
                    $("#funcionarios-nm_nom_mun").val("...");
                    $("#funcionarios-nm_nom_est").val("...");
                   // $("#ibge").val("...");
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#funcionarios-nm_nom_log").val(dados.logradouro);
                            $("#funcionarios-nm_nom_bai").val(dados.bairro);
                            $("#funcionarios-nm_nom_mun").val(dados.localidade);
                            $("#funcionarios-nm_nom_est").val(dados.uf);
                            $("#funcionarios-nu_cas_fun").focus();
                           // $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulario_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulario_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulario_cep();
            }
        });
    });
JS;
$this->registerJs($script);
?>