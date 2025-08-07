<?php

use yii\bootstrap5\Html;

/* @var $this View */
/* @var $modelO Ocupacoes */
/* @var $idOcu */

$this->title = 'Update Ocupacoes: ' . $modelO->id_num_ocu;
$this->params['breadcrumbs'][] = ['label' => 'Ocupacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelO->id_num_ocu, 'url' => ['view', 'id' => $modelO->id_num_ocu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ocupacoes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'modelO' => $modelO,
        'idOcu' => $idOcu,
    ])
    ?>

</div>