<?php

use yii\bootstrap5\Html;

/* @var $this View */
/* @var $modelF Funcionarios */

$this->title = 'Editar Funcionário: ' . $modelF->nm_nom_fun;
$this->params['breadcrumbs'][] = ['label' => 'Funcionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ucwords(strtolower($modelF->nm_nom_fun)), 'url' => ['view', 'id' => $modelF->id_num_fun]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="funcionarios-update">

    <h4 style="color: red; text-align: center"><?= Html::encode($this->title) ?></h4>

    <?=
    $this->render('_form', [
        'modelF' => $modelF,
    ])
    ?>

</div>