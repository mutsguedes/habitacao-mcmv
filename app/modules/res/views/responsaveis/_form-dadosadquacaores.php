<?php

use kartik\widgets\SwitchInput;

/* @var $this View */
/* @var $modelR Responsavel */
/* @var $form ActiveForm */
?>
<div class="adquacaoes-form">
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelR, 'bo_ade_aud')->widget(SwitchInput::class, [
                'id' => 'bo_ade_aud',
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
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', true); "
                    . "} else { "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', true); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', true); "
                    . "$('#responsavel-nu_cod_cid').val(''); "
                    . "$('#responsavel-nm_des_cid').val(''); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', false); "
                    . "}"
                    . "}",
                ]
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelR, 'bo_ade_fis')->widget(SwitchInput::class, [
                'id' => 'bo_ade_fis',
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
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', true); "
                    . "} else { "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', true); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', true); "
                    . "$('#responsavel-nu_cod_cid').val(''); "
                    . "$('#responsavel-nm_des_cid').val(''); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', false); "
                    . "}"
                    . "}",
                ]
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelR, 'bo_ade_int')->widget(SwitchInput::class, [
                'id' => 'bo_ade_int',
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
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', true); "
                    . "} else { "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', true); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', true); "
                    . "$('#responsavel-nu_cod_cid').val(''); "
                    . "$('#responsavel-nm_des_cid').val(''); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', false); "
                    . "}"
                    . "}",
                ]
            ])
            ?>
        </div>

        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelR, 'bo_ade_nan')->widget(SwitchInput::class, [
                'id' => 'bo_ade_nan',
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
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', true); "
                    . "} else { "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', true); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', true); "
                    . "$('#responsavel-nu_cod_cid').val(''); "
                    . "$('#responsavel-nm_des_cid').val(''); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', false); "
                    . "}"
                    . "}",
                ]
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelR, 'bo_ade_vis')->widget(SwitchInput::class, [
                'id' => 'bo_ade_vis',
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
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', true); "
                    . "} else { "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', true); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', true); "
                    . "$('#responsavel-nu_cod_cid').val(''); "
                    . "$('#responsavel-nm_des_cid').val(''); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_mul').bootstrapSwitch('disabled', false); "
                    . "}"
                    . "}",
                ]
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelR, 'bo_ade_mul')->widget(SwitchInput::class, [
                'id' => 'bo_ade_mul',
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
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', false); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', true); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('state', false, false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', true); "
                    . "} else { "
                    . "$('#responsavel-nu_cod_cid').prop('readonly', true); "
                    . "$('#responsavel-nm_des_cid').prop('readonly', true); "
                    . "$('#responsavel-nu_cod_cid').val(''); "
                    . "$('#responsavel-nm_des_cid').val(''); "
                    . "$('#responsavel-bo_ade_aud').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_fis').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_int').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_nan').bootstrapSwitch('disabled', false); "
                    . "$('#responsavel-bo_ade_vis').bootstrapSwitch('disabled', false); "
                    . "}"
                    . "}",
                ]
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?=
                    $form->field($modelR, 'nu_cod_cid')
                    ->textInput([
                        'maxlength' => true,
                        'readOnly' => !$modelR->bo_mem_def,
                        'class' => 'form-control form-control-sm',
                        'style' => ['text-transform' => 'uppercase']
                    ])
            ?>
        </div>
        <div class="col-xs-12 col-md-8">
            <?=
                    $form->field($modelR, 'nm_des_cid')
                    ->textInput([
                        'maxlength' => true,
                        'readOnly' => !$modelR->bo_mem_def,
                        'class' => 'form-control form-control-sm',
                        'style' => ['text-transform' => 'uppercase']
                    ])
            ?>
        </div>
    </div>
</div>