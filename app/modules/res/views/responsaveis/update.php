<?php

use yii\bootstrap5\Html;
use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelR Responsavel */
/* @var $idRes */

$tit = 'Editar Responsável: ' . $modelR->nm_nom_res;
$this->params['breadcrumbs'][] = ['label' => 'Responsavel', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => MarArtHelpers::titleCase($modelR->nm_nom_res), 'url' => ['view', 'idRes' => $modelR->id_num_res]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="responsaveis-update">
    <div class="card-header">
        <h4 id="nomeRes" style="color: red; text-align: right"><?= Html::encode($tit) ?></h4>
    </div>
    <?=
    $this->render('_form', [
        'modelR' => $modelR,
        'idRes' => $idRes,
    ])
    ?>

</div>