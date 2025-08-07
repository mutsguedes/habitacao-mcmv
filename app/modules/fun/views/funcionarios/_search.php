<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model FuncionariosSearch */
/* @var $form ActiveForm */
?>

<div class="funcionarios-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]);
    ?>

    <?= $form->field($model, 'id_num_fun') ?>

    <?= $form->field($model, 'nu_mat_fun') ?>

    <?= $form->field($model, 'nm_nom_fun') ?>

    <?= $form->field($model, 'nu_cpf_fun') ?>

    <?= $form->field($model, 'nu_ide_fun') ?>

    <?php // echo $form->field($model, 'id_num_end') 
    ?>

    <?php // echo $form->field($model, 'id_num_uni') 
    ?>

    <?php // echo $form->field($model, 'id_num_car') 
    ?>

    <?php // echo $form->field($model, 'id_num_fuc') 
    ?>

    <?php // echo $form->field($model, 'id_num_reg') 
    ?>

    <?php // echo $form->field($model, 'id_num_hor') 
    ?>

    <?php // echo $form->field($model, 'nm_mae_fun') 
    ?>

    <?php // echo $form->field($model, 'nm_pai_fun') 
    ?>

    <?php // echo $form->field($model, 'nm_ema_fun') 
    ?>

    <?php // echo $form->field($model, 'id_num_cri') 
    ?>

    <?php // echo $form->field($model, 'dt_cri_fun') 
    ?>

    <?php // echo $form->field($model, 'id_num_mod') 
    ?>

    <?php // echo $form->field($model, 'dt_mod_fun')  
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>