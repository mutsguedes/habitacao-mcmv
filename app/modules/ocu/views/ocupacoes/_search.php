<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model OcupacoesSearch */
/* @var $form ActiveForm */
?>

<div class="ocupacoes-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id_num_ocu') ?>

    <?= $form->field($model, 'bo_reg_exc') ?>

    <?= $form->field($model, 'id_num_res') ?>

    <?= $form->field($model, 'id_num_apa') ?>

    <?= $form->field($model, 'nm_nom_obs') ?>

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