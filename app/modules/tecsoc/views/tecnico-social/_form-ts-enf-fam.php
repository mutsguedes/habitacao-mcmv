<?php

use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;



/* @var $this View */
/* @var $form ActiveForm */

/* @var $modelTSE TecsocEnfermidade */

/* @var $idRes  */
?>
<?php
$form = ActiveForm::begin([
    'id' => 'doc-ser',
    'enableClientValidation' => true,
    'options' => array(
        'class' => 'form',
    ),
]);
?>

<div class="card-header">
    <h4 style="color: red; text-align: left">Enfermidades</h4>
</div> <!-- card-header -->
<div class="card-body">
    <h5 class="card-title" style="color: blue; text-align: left;">Doenças Genéricas</h5>
    <div class="row">
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_nen')->widget(SwitchInput::class, [
                'id' => 'bo_ger_nen',
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
                        . "$('#tecsocenfermidade-bo_ger_chi').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_chi').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_col').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_col').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_den').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_den').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_dia').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_dia').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_dif').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_dif').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_hep').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_hep').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_lep').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_lep').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_mal').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_mal').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_res').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_res').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_tif').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_tif').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_ver').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_ver').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_ger_zic').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_ger_zic').bootstrapSwitch('disabled', true); "
                        . "$('#nm_ger_out').prop('value', ''); "
                        . "$('#nm_ger_out').prop('disabled', true); "
                        . "$('#nm_ger_pel').prop('value', ''); "
                        . "$('#nm_ger_pel').prop('disabled', true); "
                        . "} else { "
                        . "$('#tecsocenfermidade-bo_ger_chi').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_col').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_den').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_dia').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_dif').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_hep').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_lep').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_mal').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_res').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_tif').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_ver').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_ger_zic').bootstrapSwitch('disabled', false); "
                        . "$('#nm_ger_out').prop('disabled', false); "
                        . "$('#nm_ger_pel').prop('disabled', false); "
                        . "}"
                        . "}",
                ]
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_chi')->widget(SwitchInput::class, [
                'id' => 'bo_ger_chi',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ]
            ])
            ?>
        </div>

        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_col')->widget(SwitchInput::class, [
                'id' => 'bo_ger_col',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>

        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_den')->widget(SwitchInput::class, [
                'id' => 'bo_ger_den',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_dia')->widget(SwitchInput::class, [
                'id' => 'bo_ger_dia',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_dif')->widget(SwitchInput::class, [
                'id' => 'bo_ger_dif',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_hep')->widget(SwitchInput::class, [
                'id' => 'bo_ger_hep',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>

        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_lep')->widget(SwitchInput::class, [
                'id' => 'bo_ger_lep',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_mal')->widget(SwitchInput::class, [
                'id' => 'bo_ger_mal',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_res')->widget(SwitchInput::class, [
                'id' => 'bo_ger_res',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>

        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_tif')->widget(SwitchInput::class, [
                'id' => 'bo_ger_tif',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_ver')->widget(SwitchInput::class, [
                'id' => 'bo_ger_ver',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_ger_zic')->widget(SwitchInput::class, [
                'id' => 'bo_ger_zic',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-4" style="padding-top: 20px">
            <?=
            $form->field($modelTSE, 'nm_ger_out')->textInput([
                'maxlength' => true,
                'id' => 'nm_ger_out',
                'class' => 'form-control form-control-sm material-design',
                'style' => ['text-transform' => 'uppercase']
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-4" style="padding-top: 20px">
            <?=
            $form->field($modelTSE, 'nm_ger_pel')->textInput([
                'maxlength' => true,
                'id' => 'nm_ger_pel',
                'class' => 'form-control form-control-sm material-design',
                'style' => ['text-transform' => 'uppercase']
            ])
            ?>
        </div>
    </div>
</div> <!-- card-body -->
<div class="card-body">
    <h5 class="card-title" style="color: blue; text-align: left;">Doenças Crônicas</h5>
    <div class="row">
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_nen')->widget(SwitchInput::class, [
                'id' => 'bo_cro_nen',
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
                        . "$('#tecsocenfermidade-bo_cro_alc').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_alc').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_alz').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_alz').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_can').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_can').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_car').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_car').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_dep').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_dep').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_dia').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_dia').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_hip').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_hip').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_par').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_par').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_pul').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_pul').bootstrapSwitch('disabled', true); "
                        . "$('#tecsocenfermidade-bo_cro_ren').bootstrapSwitch('state', false, false); "
                        . "$('#tecsocenfermidade-bo_cro_ren').bootstrapSwitch('disabled', true); "
                        . "$('#nm_cro_out').prop('value', ''); "
                        . "$('#nm_cro_out').prop('disabled', true); "
                        . "} else { "
                        . "$('#tecsocenfermidade-bo_cro_alc').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_alz').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_can').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_car').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_dep').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_dia').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_hip').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_par').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_pul').bootstrapSwitch('disabled', false); "
                        . "$('#tecsocenfermidade-bo_cro_ren').bootstrapSwitch('disabled', false); "
                        . "$('#nm_cro_out').prop('disabled', false); "
                        . "}"
                        . "}",
                ]
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_alc')->widget(SwitchInput::class, [
                'id' => 'bo_cro_alc',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ]
            ])
            ?>
        </div>

        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_alz')->widget(SwitchInput::class, [
                'id' => 'bo_cro_alz',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>

        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_can')->widget(SwitchInput::class, [
                'id' => 'bo_cro_can',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_car')->widget(SwitchInput::class, [
                'id' => 'bo_cro_car',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_dep')->widget(SwitchInput::class, [
                'id' => 'bo_cro_dep',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_dia')->widget(SwitchInput::class, [
                'id' => 'bo_cro_dia',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>

        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_hip')->widget(SwitchInput::class, [
                'id' => 'bo_cro_hip',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_par')->widget(SwitchInput::class, [
                'id' => 'bo_cro_par',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_pul')->widget(SwitchInput::class, [
                'id' => 'bo_cro_pul',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSE, 'bo_cro_ren')->widget(SwitchInput::class, [
                'id' => 'bo_cro_ren',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6 ">
            <?=
            $form->field($modelTSE, 'nm_cro_out')->textInput([
                'maxlength' => true,
                'id' => 'nm_cro_out',
                'class' => 'form-control form-control-sm material-design',
                'style' => ['text-transform' => 'uppercase']
            ])
            ?>
        </div>
    </div>
</div> <!-- card-body -->
<?php ActiveForm::end(); ?>