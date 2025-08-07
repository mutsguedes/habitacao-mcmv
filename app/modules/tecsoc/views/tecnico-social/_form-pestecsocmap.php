<?php

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\modules\auxiliar\models\GerTecsocCurso;
use app\modules\auxiliar\models\GerAcompanhamento;
use app\modules\auxiliar\models\GerTecsocAtividade;
use app\modules\auxiliar\models\GerTecsocAgriZoonoze;
use app\modules\auxiliar\models\GerTecsocBeneficioSoc;
use app\modules\auxiliar\models\GerTecsocEquipamentoPub;

/* @var $form ActiveForm */

/* @var $modelTS TecnicoSocial */

/* @var $nuRes  */
?>
<div class="card-header">
    <h4 style="color: red; text-align: left">Mapeamento</h4>
</div>
<div class="card-body">
    <h5 class="card-title" style="color: blue; text-align: left;">Social</h5>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelTS, 'id_num_equ')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'toggleAllSettings' => [
                    'selectLabel' => '<i class="fas fa-check-circle"></i> Selecionar todos',
                    'unselectLabel' => '<i class="fas fa-times-circle"></i> Deselecionar todos',
                    'selectOptions' => ['class' => 'text-success'],
                    'unselectOptions' => ['class' => 'text-danger'],
                ],
                'options' => [
                    'placeholder' => '-- Sel. e. público --',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'tag' => true,
                    'tokenSeparators' => [',', ' '],
                ],
                'pluginEvents' => [
                    "select2:select" => "function(e) { "
                        . "sel = e.params.data.id; "
                        . "if ((sel == '1') || (sel == '2') || (sel == '20')) { "
                        . "$(this).val(null).trigger('change'); "
                        . "$(this).val(sel).trigger('change'); "
                        . "} else {"
                        . "$('#tecnicosocial-id_num_equ option[value=1]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_equ option[value=2]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_equ option[value=20]').prop('selected', false).trigger('change'); "
                        . "}; "
                        . "console.log(sel); }"
                ],
                'data' => ArrayHelper::map(GerTecsocEquipamentoPub::find()->orderBy('id_num_equ')
                    ->asArray()->all(), 'id_num_equ', 'nm_nom_equ'),
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelTS, 'id_num_ati')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. atividade --',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'tokenSeparators' => [',', ' '],
                    'tags' => true,
                ],
                'pluginEvents' => [
                    "select2:select" => "function(e) { "
                        . "sel = e.params.data.id; "
                        . "if ((sel == 1) || (sel == 2) || (sel == 20)) { "
                        . "$(this).val(null).trigger('change'); "
                        . "$(this).val(sel).trigger('change'); "
                        . "} else {"
                        . "$('#tecnicosocial-id_num_ati option[value=1]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_ati option[value=2]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_ati option[value=20]').prop('selected', false).trigger('change'); "
                        . "}; "
                        . "console.log(sel); }"
                ],
                'data' => ArrayHelper::map(GerTecsocAtividade::find()->orderBy('id_num_ati')
                    ->asArray()->all(), 'id_num_ati', 'nm_nom_ati'),
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelTS, 'id_num_cur')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. curso --',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'tokenSeparators' => [',', ' '],
                    'tags' => true,
                ],
                'pluginEvents' => [
                    "select2:select" => "function(e) { "
                        . "sel = e.params.data.id; "
                        . "if ((sel == 1) || (sel == 2) || (sel == 20)) { "
                        . "$(this).val(null).trigger('change'); "
                        . "$(this).val(sel).trigger('change'); "
                        . "} else {"
                        . "$('#tecnicosocial-id_num_cur option[value=1]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_cur option[value=2]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_cur option[value=20]').prop('selected', false).trigger('change'); "
                        . "}; "
                        . "console.log(sel); }"
                ],
                'data' => ArrayHelper::map(GerTecsocCurso::find()->orderBy('id_num_cur')
                    ->asArray()->all(), 'id_num_cur', 'nm_nom_cur'),
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelTS, 'id_num_ben')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. benefício --',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'tokenSeparators' => [',', ' '],
                    'tags' => true,
                ],
                'pluginEvents' => [
                    "select2:select" => "function(e) { "
                        . "sel = e.params.data.id; "
                        . "if ((sel == 1) || (sel == 2) || (sel == 20)) { "
                        . "$(this).val(null).trigger('change'); "
                        . "$(this).val(sel).trigger('change'); "
                        . "} else {"
                        . "$('#tecnicosocial-id_num_ben option[value=1]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_ben option[value=2]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_ben option[value=20]').prop('selected', false).trigger('change'); "
                        . "}; "
                        . "console.log(sel); }"
                ],
                'data' => ArrayHelper::map(GerTecsocBeneficioSoc::find()->orderBy('id_num_ben')
                    ->asArray()->all(), 'id_num_ben', 'nm_nom_ben'),
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelTS, 'id_num_zoo')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. zoonoze --',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'tokenSeparators' => [',', ' '],
                    'tags' => true,
                ],
                'pluginEvents' => [
                    "select2:select" => "function(e) { "
                        . "sel = e.params.data.id; "
                        . "if ((sel == 1) || (sel == 2) || (sel == 20)) { "
                        . "$(this).val(null).trigger('change'); "
                        . "$(this).val(sel).trigger('change'); "
                        . "} else {"
                        . "$('#tecnicosocial-id_num_zoo option[value=1]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_zoo option[value=2]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_zoo option[value=20]').prop('selected', false).trigger('change'); "
                        . "}; "
                        . "console.log(sel); }"
                ],
                'data' => ArrayHelper::map(GerTecsocAgriZoonoze::find()->orderBy('id_num_zoo')
                    ->asArray()->all(), 'id_num_zoo', 'nm_nom_zoo'),
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?=
            $form->field($modelTS, 'id_num_aco')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'options' => [
                    'prompt' => '-- Sel. acompanhamento --',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'tokenSeparators' => [',', ' '],
                    'tags' => true,
                ],
                'pluginEvents' => [
                    "select2:select" => "function(e) { "
                        . "sel = e.params.data.id; "
                        . "if ((sel == 1) || (sel == 2) || (sel == 20)) { "
                        . "$(this).val(null).trigger('change'); "
                        . "$(this).val(sel).trigger('change'); "
                        . "} else {"
                        . "$('#tecnicosocial-id_num_ben option[value=1]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_ben option[value=2]').prop('selected', false).trigger('change'); "
                        . "$('#tecnicosocial-id_num_ben option[value=20]').prop('selected', false).trigger('change'); "
                        . "}; "
                        . "console.log(sel); }"
                ],
                'data' => ArrayHelper::map(GerAcompanhamento::find()->orderBy('id_num_aco')
                    ->asArray()->all(), 'id_num_aco', 'nm_nom_aco'),
            ])
            ?>
        </div>
    </div>
</div>