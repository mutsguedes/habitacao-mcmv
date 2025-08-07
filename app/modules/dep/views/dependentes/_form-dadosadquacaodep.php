<?php

use kartik\form\ActiveForm;
use kartik\widgets\SwitchInput;
use yii\web\View;

/* @var $this View */
/* @var $modelD dependente */
/* @var $form ActiveForm */
/* @var $idCli */
?>

<div class="row">
    <div class="col-sm-2">
        <?=
        $form->field($modelD, 'bo_ade_aud')->widget(SwitchInput::class, [
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
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', true); "
                . "} else { "
                . "$('#dependente-nu_cod_cid').prop('readonly', true); "
                . "$('#dependente-nm_des_cid').prop('readonly', true); "
                . "$('#dependente-nu_cod_cid').val(''); "
                . "$('#dependente-nm_des_cid').val(''); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', false); "
                . "}"
                . "}",
            ]
        ])
        ?>
    </div>
    <div class="col-sm-2">
        <?=
        $form->field($modelD, 'bo_ade_fis')->widget(SwitchInput::class, [
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
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', true); "
                . "} else { "
                . "$('#dependente-nu_cod_cid').prop('readonly', true); "
                . "$('#dependente-nm_des_cid').prop('readonly', true); "
                . "$('#dependente-nu_cod_cid').val(''); "
                . "$('#dependente-nm_des_cid').val(''); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', false); "
                . "}"
                . "}",
            ]
        ])
        ?>
    </div>
    <div class="col-sm-2">
        <?=
        $form->field($modelD, 'bo_ade_int')->widget(SwitchInput::class, [
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
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', true); "
                . "} else { "
                . "$('#dependente-nu_cod_cid').prop('readonly', true); "
                . "$('#dependente-nm_des_cid').prop('readonly', true); "
                . "$('#dependente-nu_cod_cid').val(''); "
                . "$('#dependente-nm_des_cid').val(''); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', false); "
                . "}"
                . "}",
            ]
        ])
        ?>
    </div>

    <div class="col-sm-2">
        <?=
        $form->field($modelD, 'bo_ade_nan')->widget(SwitchInput::class, [
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
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', true); "
                . "} else { "
                . "$('#dependente-nu_cod_cid').prop('readonly', true); "
                . "$('#dependente-nm_des_cid').prop('readonly', true); "
                . "$('#dependente-nu_cod_cid').val(''); "
                . "$('#dependente-nm_des_cid').val(''); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', false); "
                . "}"
                . "}",
            ]
        ])
        ?>
    </div>
    <div class="col-sm-2">
        <?=
        $form->field($modelD, 'bo_ade_vis')->widget(SwitchInput::class, [
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
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', true); "
                . "} else { "
                . "$('#dependente-nu_cod_cid').prop('readonly', true); "
                . "$('#dependente-nm_des_cid').prop('readonly', true); "
                . "$('#dependente-nu_cod_cid').val(''); "
                . "$('#dependente-nm_des_cid').val(''); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_mul').bootstrapSwitch('disabled', false); "
                . "}"
                . "}",
            ]
        ])
        ?>
    </div>
    <div class="col-sm-2">
        <?=
        $form->field($modelD, 'bo_ade_mul')->widget(SwitchInput::class, [
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
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-nu_cod_cid').prop('readonly', false); "
                . "$('#dependente-nm_des_cid').prop('readonly', false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', true); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('state', false, false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', true); "
                . "} else { "
                . "$('#dependente-nu_cod_cid').prop('readonly', true); "
                . "$('#dependente-nm_des_cid').prop('readonly', true); "
                . "$('#dependente-nu_cod_cid').val(''); "
                . "$('#dependente-nm_des_cid').val(''); "
                . "$('#dependente-bo_ade_aud').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_fis').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_int').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_nan').bootstrapSwitch('disabled', false); "
                . "$('#dependente-bo_ade_vis').bootstrapSwitch('disabled', false); "
                . "}"
                . "}",
            ]
        ])
        ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?=
                $form->field($modelD, 'nu_cod_cid')
                ->textInput([
                    'maxlength' => true,
                    'readOnly' => true,
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase']
                ])
        ?>
    </div>
    <div class="col-sm-8">
        <?=
                $form->field($modelD, 'nm_des_cid')
                ->textInput([
                    'maxlength' => true,
                    'readOnly' => true,
                    'class' => 'form-control form-control-sm',
                    'style' => ['text-transform' => 'uppercase']
                ])
        ?>
    </div>
</div>