<?php

use kartik\helpers\Html;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $modelR Responsavel */
/* @var $form ActiveForm */
?>

<div class="enderecos-form">
    <p id="crasRes" style="color: green; font-size: x-large; text-align: left; margin: 0"></p>
    <div class="row">
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'nu_num_cep')->widget(MaskedInput::class, [
                'options' => ['id' => 'nu_num_cep', 'class' => 'form-control form-control-sm'], 'mask' => '99.999-999',
                'clientOptions' => ['removeMaskOnSubmit' => true],
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?=
             $form->field($modelR, 'nm_nom_log')
                ->textInput([
                    'id' => 'nm_nom_log',
                    'class' => 'form-control form-control-sm',
                   // 'disabled' => true,
                    'style' => ['text-transform' => 'uppercase',]
                ]); 
              //  Html::activeTextInput($modelR, 'nm_nom_log', ['id' => 'nm_nom_log','disabled' => true,]);
            ?>
        </div>
        <div class="col-sm-1">
            <?=
            $form->field($modelR, 'nu_num_cas')
                ->textInput([
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase',]
                ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($modelR, 'nm_nom_com')
                ->textInput([
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase',]
                ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <?=
            $form->field($modelR, 'nm_nom_bai', ['inputOptions' => ['id' => 'nm_nom_bai']])
                ->textInput([
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase',]
                ])
            ?>
        </div>
        <div class="col-sm-5">
            <?=
            $form->field($modelR, 'nm_nom_mun', ['inputOptions' => ['id' => 'nm_nom_mun']])
                ->textInput([
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase',]
                ])
            ?>
        </div>
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'nm_nom_est', ['inputOptions' => ['id' => 'nm_nom_est']])
                ->textInput([
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase',]
                ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?=
            $form->field($modelR, 'nu_num_tel')
                ->widget(MaskedInput::class, [
                    'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                    'clientOptions' => ['removeMaskOnSubmit' => true,]
                ])
                ->textInput([
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase',]
                ])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelR, 'nu_num_tel_1')
                ->widget(MaskedInput::class, [
                    'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                    'clientOptions' => ['removeMaskOnSubmit' => true,]
                ])
                ->textInput([
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase',]
                ])
            ?>
        </div>
    </div>
</div>

<?php
$script = <<< JS
$('#nm_nom_bai').ready(function() { 
    $.ajax({ 
        url:"get-cras",
        type: "POST", 
        data: {nmCra: $('#nm_nom_bai').val()} ,
        dataType: "json", 
        success: function(data) { 
            var str = 'Centro de Referência da Assistência Social - CRAS  -  ';
        var cra = data["nomeCras"];
  var result = cra.fontcolor("red");
            document.getElementById("crasRes").innerHTML = str + result;
        }
    });
});        
JS;
$this->registerJs($script);
?>