<?php

use kartik\helpers\Html;
use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelD Dependente */

$tit = 'Editar Dependente: ' . $modelD->nm_nom_dep;
$this->params['breadcrumbs'][] = ['label' => 'Dependente', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => MarArtHelpers::titleCase($modelD->nm_nom_dep), 'url' => ['view', 'idRes' => $modelD->id_num_dep]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="dependente-update">
    <br>
    <h4 style="color: red; text-align: right"><?= Html::encode($tit) ?></h4>
    <?=
    $this->render('_form', [
        'modelD' => $modelD,
        'idRes' => $idRes,
    ])
    ?>

</div>