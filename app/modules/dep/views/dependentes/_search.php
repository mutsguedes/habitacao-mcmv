<?php

use kartik\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this View */
/* @var $model DependentesSearch */
/* @var $form ActiveForm */
?>

<div class="dependente-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]);
    ?>

    <?= $form->field($model, 'id_num_dep') ?>

    <?= $form->field($model, 'id_num_cli') ?>

    <?= $form->field($model, 'id_num_par') ?>

    <?= $form->field($model, 'nm_nom_dep') ?>

    <?= $form->field($model, 'dt_nas_dep') ?>

    <?php // echo $form->field($model, 'id_num_nat') 
    ?>

    <?php // echo $form->field($model, 'id_gra_ins') 
    ?>

    <?php // echo $form->field($model, 'id_est_civ') 
    ?>

    <?php // echo $form->field($model, 'id_num_gen') 
    ?>

    <?php // echo $form->field($model, 'nu_num_cpf') 
    ?>

    <?php // echo $form->field($model, 'nu_num_ide') 
    ?>

    <?php // echo $form->field($model, 'nm_nom_obs') 
    ?>

    <?php // echo $form->field($model, 'txProfissao') 
    ?>

    <?php // echo $form->field($model, 'nu_ren_dep') 
    ?>

    <?php // echo $form->field($model, 'id_ori_ren') 
    ?>

    <?php // echo $form->field($model, 'txDeficiencia') 
    ?>

    <?php // echo $form->field($model, 'txDeficienciaCID') 
    ?>

    <?php // echo $form->field($model, 'bo_ade_fis') 
    ?>

    <?php // echo $form->field($model, 'bo_ade_vis') 
    ?>

    <?php // echo $form->field($model, 'bo_ade_int') 
    ?>

    <?php // echo $form->field($model, 'bo_ade_aud') 
    ?>

    <?php // echo $form->field($model, 'bo_ade_nan') 
    ?>

    <?php // echo $form->field($model, 'bo_cop_cpf') 
    ?>

    <?php // echo $form->field($model, 'bo_cop_ide') 
    ?>

    <?php // echo $form->field($model, 'bo_cop_red') 
    ?>

    <?php // echo $form->field($model, 'bo_cer_nas') 
    ?>

    <?php // echo $form->field($model, 'id_num_cri') 
    ?>

    <?php // echo $form->field($model, 'dt_tim_cri') 
    ?>

    <?php // echo $form->field($model, 'id_num_mod') 
    ?>

    <?php // echo $form->field($model, 'dt_tim_mod')  
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>