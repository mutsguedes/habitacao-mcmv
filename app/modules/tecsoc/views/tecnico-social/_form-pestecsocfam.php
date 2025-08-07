<?php

use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\SwitchInput;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerMunicipio;
use app\modules\auxiliar\models\GerTipoRenda;

/* @var $form ActiveForm */

/* @var $modelTS TecnicoSocial */

/* @var $idRes  */
?>
<div class="card-header">
    <h4 style="color: red; text-align: left">Responsável
        <?=
        ' - ' . Html::label(
            Responsavel::findOne($idRes)->nm_nom_res,
            null,
            ['style' => 'color:blue']
        );
        ?></h4>
</div>
<div class="card-body">
    <h5 class="card-title" style="color: blue; text-align: left;">Dados Profissionais</h5>
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelTS, 'bo_ins_pac')->widget(SwitchInput::class, [
                'id' => 'bo_ins_pac',
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
        <div class="col-xs-12 col-md-2 ">
            <?=
            $form->field($modelTS, 'bo_ati_res')->widget(SwitchInput::class, [
                'id' => 'bo_ati_res',
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
                        . "$('#tecnicosocial-bo_pag_inss_res').bootstrapSwitch('disabled', false); "
                        . "$('#tecnicosocial-bo_aut_res').bootstrapSwitch('disabled', false); "
                        . "$('#tecnicosocial-bo_car_ass_res').bootstrapSwitch('disabled', false); "
                        . "$('#tecnicosocial-id_tip_ren_res').prop('disabled',false); "
                        . "$('#tecnicosocial-id_mun_tra_res').prop('disabled',false); "
                        . "} else { "
                        . "$('#tecnicosocial-bo_pag_inss_res').bootstrapSwitch('state', false, false); "
                        . "$('#tecnicosocial-bo_pag_inss_res').bootstrapSwitch('disabled', true); "
                        . "$('#tecnicosocial-bo_aut_res').bootstrapSwitch('state', false, false); "
                        . "$('#tecnicosocial-bo_aut_res').bootstrapSwitch('disabled', true); "
                        . "$('#tecnicosocial-bo_car_ass_res').bootstrapSwitch('state', false, false); "
                        . "$('#tecnicosocial-bo_car_ass_res').bootstrapSwitch('disabled', true); "
                        . "$('#tecnicosocial-id_tip_ren_res').prop('disabled',true); "
                        . "$('#tecnicosocial-id_mun_tra_res').prop('disabled',true); "
                        . "$('#tecnicosocial-id_tip_ren_res').value = 0; "
                        . "$('#tecnicosocial-id_mun_tra_res').value = 0; "
                        . "}"
                        . "}",
                ]
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelTS, 'bo_pag_inss_res')->widget(SwitchInput::class, [
                'id' => 'bo_pag_inss_res',
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
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelTS, 'bo_aut_res')->widget(SwitchInput::class, [
                'id' => 'bo_aut_res',
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
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelTS, 'bo_car_ass_res')->widget(SwitchInput::class, [
                'id' => 'bo_car_ass_res',
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
        <div class="col-xs-12 col-md-2">
            <?=
            $form->field($modelTS, 'id_tip_ren_res')->widget(Select2::class, [
                'disabled' => true,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'hideSearch' => true,
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. t. renda --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerTipoRenda::find()->orderBy('id_tip_ren')
                    ->asArray()->all(), 'id_tip_ren', 'nm_tip_ren'),
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?=
            $form->field($modelTS, 'id_mun_tra_res')->widget(Select2::class, [
                'disabled' => true,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'hideSearch' => false,
                'size' => Select2::SMALL,
                'options' => [
                    'prompt' => '-- Sel. m. trabalho --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerMunicipio::find()->orderBy('id_num_mun')
                    ->asArray()->all(), 'id_num_mun', 'nm_nom_mun'),
            ])
            ?>
        </div>
    </div>
</div>
<?php
$conjuge = Dependente::findOne(['id_num_res' => $idRes, 'id_num_par' => [4, 9]]);
if ($conjuge != null) {
?>
    <div class="card-header">
        <h4 style="color: red; text-align: left">Conjuge
            <?=
            ' - ' . Html::label(
                $conjuge->nm_nom_dep,
                null,
                ['style' => 'color:blue']
            );
            ?></h4>
    </div>
    <div class="card-body">
        <h5 class="card-title" style="color: blue; text-align: left;">Dados Profissionais</h5>
        <div class="row">
            <div id="bo_ati_dep" class="col-xs-12 col-md-2 ">
                <?=
                $form->field($modelTS, 'bo_ati_dep')->widget(SwitchInput::class, [
                    'id' => 'bo_ati_dep',
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
            <div id="bo_pag_inss_dep" class="col-xs-12 col-md-2">
                <?=
                $form->field($modelTS, 'bo_pag_inss_dep')->widget(SwitchInput::class, [
                    'id' => 'bo_pag_inss_dep',
                    'disabled' => true,
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
            <div id="bo_aut_dep" class="col-xs-12 col-md-2">
                <?=
                $form->field($modelTS, 'bo_aut_dep')->widget(SwitchInput::class, [
                    'id' => 'bo_aut_res',
                    'disabled' => true,
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
            <div id="bo_car_ass_dep" class="col-xs-12 col-md-2">
                <?=
                $form->field($modelTS, 'bo_car_ass_dep')->widget(SwitchInput::class, [
                    'id' => 'bo_car_ass_dep',
                    'disabled' => true,
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
            <div class="col-xs-12 col-md-4">
                <?=
                $form->field($modelTS, 'id_tip_ren_dep')->widget(Select2::class, [
                    'disabled' => true,
                    'hideSearch' => true,
                    'size' => Select2::SMALL,
                    'theme' => Select2::THEME_KRAJEE_BS5,
                    'options' => [
                        'prompt' => '-- Sel. t. renda --',
                    ],
                    'pluginOptions' => [
                        'class' => 'form-horizontal',
                        'language' => 'pt-BR',
                        'allowClear' => true,
                    ],
                    'data' => ArrayHelper::map(GerTipoRenda::find()->orderBy('id_tip_ren')
                        ->asArray()->all(), 'id_tip_ren', 'nm_tip_ren'),
                ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <?=
                $form->field($modelTS, 'id_mun_tra_dep')->widget(Select2::class, [
                    'disabled' => true,
                    'theme' => Select2::THEME_KRAJEE_BS5,
                    'hideSearch' => false,
                    'size' => Select2::SMALL,
                    'options' => [
                        'prompt' => '-- Sel. m. trabalho --',
                    ],
                    'pluginOptions' => [
                        'class' => 'form-horizontal',
                        'language' => 'pt-BR',
                        'allowClear' => true,
                    ],
                    'data' => ArrayHelper::map(GerMunicipio::find()->orderBy('id_num_mun')
                        ->asArray()->all(), 'id_num_mun', 'nm_nom_mun'),
                ])
                ?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
$script = <<< JS
    $('#tecnicosocial-bo_ati_res').ready(function() {
        bo_ati_res = $('#tecnicosocial-bo_ati_res');
        if (bo_ati_res.prop('checked')) {
            $('#tecnicosocial-bo_pag_inss_res').bootstrapSwitch('disabled', false);
            $('#tecnicosocial-bo_aut_res').bootstrapSwitch('disabled', false);
            $('#tecnicosocial-bo_car_ass_res').bootstrapSwitch('disabled', false);
            $('#tecnicosocial-id_tip_ren_res').prop('disabled',false);
            $('#tecnicosocial-id_mun_tra_res').prop('disabled',false);
        } else {
            $('#tecnicosocial-bo_pag_inss_res').bootstrapSwitch('state', false, false);
            $('#tecnicosocial-bo_pag_inss_res').bootstrapSwitch('disabled', true);
            $('#tecnicosocial-bo_aut_res').bootstrapSwitch('state', false, false);
            $('#tecnicosocial-bo_aut_res').bootstrapSwitch('disabled', true);
            $('#tecnicosocial-bo_car_ass_res').bootstrapSwitch('state', false, false);
            $('#tecnicosocial-bo_car_ass_res').bootstrapSwitch('disabled', true);
            $('#tecnicosocial-id_tip_ren_res').prop('disabled',true);
            $('#tecnicosocial-id_mun_tra_res').prop('disabled',true);
            $('#tecnicosocial-id_tip_ren_res').value = 0;
            $('#tecnicosocial-id_mun_tra_res').value = 0;;
        }
    });
    $('#tecnicosocial-bo_ati_dep').ready(function() {
        bo_ati_dep = $('#tecnicosocial-bo_ati_dep');
        if (bo_ati_dep.prop('checked')) {
             $('#tecnicosocial-bo_pag_inss_dep').bootstrapSwitch('disabled', false);
            $('#tecnicosocial-bo_aut_dep').bootstrapSwitch('disabled', false);
            $('#tecnicosocial-bo_car_ass_dep').bootstrapSwitch('disabled', false);
            $('#tecnicosocial-id_tip_ren_dep').prop('disabled',false);
            $('#tecnicosocial-id_mun_tra_dep').prop('disabled',false);
        } else {
            $('#tecnicosocial-bo_pag_inss_dep').bootstrapSwitch('state', false, false);
            $('#tecnicosocial-bo_pag_inss_dep').bootstrapSwitch('disabled', true);
            $('#tecnicosocial-bo_aut_dep').bootstrapSwitch('state', false, false);
            $('#tecnicosocial-bo_aut_dep').bootstrapSwitch('disabled', true);
            $('#tecnicosocial-bo_car_ass_dep').bootstrapSwitch('state', false, false);
            $('#tecnicosocial-bo_car_ass_dep').bootstrapSwitch('disabled', true);
            $('#tecnicosocial-id_tip_ren_dep').prop('disabled',true);
            $('#tecnicosocial-id_mun_tra_dep').prop('disabled',true);
            $('#tecnicosocial-id_tip_ren_dep').value = 0;
            $('#tecnicosocial-id_mun_tra_dep').value = 0;
        }
    });        
            
JS;
$this->registerJs($script);
?>