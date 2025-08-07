<?php

use app\modules\auxiliar\models\Funcoes;
use app\modules\auxiliar\models\Regimes;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\datecontrol\DateControl;
use app\modules\auxiliar\models\Unidades;


/* @var $this View */
/* @var $modelF Funcionarios */
/* @var $form ActiveForm */
?>

<div class="funcionarios-form">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?=
            $form->field($modelF, 'nm_nom_fun')
                ->textInput(['maxlength' => true, 'style' => ['text-transform' => 'uppercase']])
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelF, 'nm_nom_mae')
                ->textInput(['maxlength' => true, 'style' => ['text-transform' => 'uppercase']])
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelF, 'nm_nom_pai')
                ->textInput(['maxlength' => true, 'style' => ['text-transform' => 'uppercase']])
            ?>
        </div>
        <div class="col-sm-2">
            <?=
            $form->field($modelF, 'dt_nas_fun')->widget(DateControl::class, [
                'type' => DateControl::FORMAT_DATE,
                'options' => ['id' => 'dt_nas_fun'],
                'language' => 'pt-BR',
                'widgetOptions' => [
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelF, 'nu_cpf_fun')
                ->widget(MaskedInput::class, [
                    'id' => 'nu_cpf_fun', 'mask' => '999.999.999-99',
                    'clientOptions' => ['removeMaskOnSubmit' => true]
                ])
                ->textInput(['maxlength' => true,])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelF, 'nu_ide_fun')->widget(MaskedInput::class, [
                'id' => 'nu_ide_fun', 'mask' => '99.999.999-9',
                'clientOptions' => ['removeMaskOnSubmit' => true]
            ])
                ->textInput(['maxlength' => true,])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelF, 'nu_mat_fun')->textInput()
            ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelF, 'id_num_uni')->widget(Select2::class, [
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Selecione Unidade --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(Unidades::find()->orderBy('nm_nom_uni')
                    ->asArray()->all(), 'id_num_uni', 'nm_nom_uni'),
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelF, 'id_num_car')->widget(Select2::class, [
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Selecione Cargo --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                /* 'data' => ArrayHelper::map(Cargos::find()->orderBy('nm_des_car')
                        ->asArray()->all(), 'id_num_car', 'nm_des_car'), */
            ]);
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelF, 'id_num_fuc')->widget(Select2::class, [
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Selecione Função --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(Funcoes::find()->orderBy('nm_des_fuc')
                    ->asArray()->all(), 'id_num_fuc', 'nm_des_fuc'),
            ]);
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelF, 'id_num_reg')->widget(Select2::class, [
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Selecione Regime --.',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(Regimes::find()->orderBy('nm_des_reg')
                    ->asArray()->all(), 'id_num_reg', 'nm_des_reg'),
            ]);
            ?>
        </div>
        <div class="col-xs-12 col-md-1">
            <?=
            $form->field($modelF, 'id_car_hor')->widget(Select2::class, [
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Selecione C.H. --.',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                /* 'data' => ArrayHelper::map(CargaHorarias::find()->orderBy('id_car_hor')
                        ->asArray()->all(), 'id_car_hor', 'nu_car_hor'), */
            ]);
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelF, 'nm_nom_ema')->widget(MaskedInput::class, [
                'clientOptions' => ['alias' => 'email',]
            ])
            ?>
        </div>
    </div>
</div>
<?php

$script = <<< JS
jQuery("#idDesOrg").change(function(){
    $("#desOrg").text('');
    $.ajax({           
            type: "POST",
            url:"?r=fun/funcionarios/get-des-org",
            data:$(this).serialize(),
            dataType: "json",
            success: function(data) { 
             $.each(data,function (index, item) {
                 $("#desOrg").text(item);
                 });
            } 
    })
});
JS;
$this->registerJs($script);
?>