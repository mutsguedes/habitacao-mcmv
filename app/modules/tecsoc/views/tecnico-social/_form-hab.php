<?php

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\modules\auxiliar\models\GerTecsocHabSerAgua;
use app\modules\auxiliar\models\GerTecsocHabSerLixo;
use app\modules\auxiliar\models\GerTecsocHabSerEsgoto;
use app\modules\auxiliar\models\GerTecsocHabTipOcupacao;
use app\modules\auxiliar\models\GerTecsocHabSerEnergiaEletrica;

/* @var $form ActiveForm */

/* @var $modelTS TecnicoSocial */
?>
<div class="card-header">
    <h4 style="color: red; text-align: left">Moradia</h4>
</div>
<div class="card-body">
    <h5 class="card-title" style="color: blue; text-align: left;">Serviços</h5>
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelTS, 'id_ser_agu')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Sel. s. água --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerTecsocHabSerAgua::find()->orderBy('id_ser_agu')
                    ->asArray()->all(), 'id_ser_agu', 'nm_ser_agu'),
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-3 ">
            <?=
            $form->field($modelTS, 'id_ser_ele')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Sel. s. elétrica --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerTecsocHabSerEnergiaEletrica::find()->orderBy('id_ser_ele')
                    ->asArray()->all(), 'id_ser_ele', 'nm_ser_ele'),
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-3 ">
            <?=
            $form->field($modelTS, 'id_ser_esg')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Sel. s. esgoto --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerTecsocHabSerEsgoto::find()->orderBy('id_ser_esg')
                    ->asArray()->all(), 'id_ser_esg', 'nm_ser_esg'),
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-3 ">
            <?=
            $form->field($modelTS, 'id_ser_lix')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Sel. m. lixo --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerTecsocHabSerLixo::find()->orderBy('id_ser_lix')
                    ->asArray()->all(), 'id_ser_lix', 'nm_ser_lix'),
            ])
            ?>
        </div>
    </div>
    <h5 class="card-title" style="color: blue; text-align: left;">Condições da Moradia</h5>
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <?=
            $form->field($modelTS, 'id_tip_ocu')->widget(Select2::class, [
                'size' => Select2::SMALL,
                'theme' => Select2::THEME_KRAJEE_BS5,
                'hideSearch' => true,
                'options' => [
                    'prompt' => '-- Sel. t. ocupação --',
                ],
                'pluginOptions' => [
                    'class' => 'form-horizontal',
                    'language' => 'pt-BR',
                    'allowClear' => true,
                ],
                'data' => ArrayHelper::map(GerTecsocHabTipOcupacao::find()->orderBy('id_tip_ocu')
                    ->asArray()->all(), 'id_tip_ocu', 'nm_tip_ocu'),
                'pluginEvents' => [
                    "select2:select" => "function(e) { "
                        . "if ((e.params.data.id) == 20) { "
                        . "$('#tecnicosocial-nm_ocu_out').prop('disabled', false); "
                        . "} else { "
                        . "$('#tecnicosocial-nm_ocu_out').prop('value', ''); "
                        . "$('#tecnicosocial-nm_ocu_out').prop('disabled', true); "
                        . "console.log(e.params.data.id); "
                        . "}"
                        . "console.log(e.params.data.id); }",
                    "select2:unselect" => "function(e) { "
                        . "$('#tecnicosocial-nm_ocu_out').prop('value', ''); "
                        . "$('#tecnicosocial-nm_ocu_out').prop('disabled', true); "
                        . "}"
                ],
            ])
            ?>
        </div>
        <div class="col-xs-12 col-md-6 ">
            <?=
            $form->field($modelTS, 'nm_ocu_out')->textInput([
                'class' => 'form-control-sm',
                'disabled' => true,
                'maxlength' => true,
                'style' => ['text-transform' => 'uppercase']
            ])
            ?>
        </div>
    </div>
</div>
<?php
if (!$modelTS->isNewRecord) {
    $script = <<< JS
    $('#tecnicosocial-nm_ocu_out').ready(function() {
        id_tip_ocu = $('#tecnicosocial-id_tip_ocu');
        if (id_tip_ocu.val() == 20) {
            $('#tecnicosocial-nm_ocu_out').prop("disabled", false);
        } else {
             $('#tecnicosocial-nm_ocu_out').prop("disabled", true);
        }
    });
JS;
    $this->registerJs($script);
}
?>