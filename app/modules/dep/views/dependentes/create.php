<?php

use kartik\helpers\Html;

/* @var $this View */
/* @var $modelD Dependente */
/* @var $idRes */

$this->title = 'Novo Dependente';
$this->params['breadcrumbs'][] = ['label' => 'Dependente', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'modelD' => $modelD,
        'idRes' => $idRes,
    ])
    ?>

</div>