<?php

use kartik\helpers\Html;
use app\components\MarArtHelpers;
use app\modules\res\models\Responsavel;

/* @var $this View */

/* @var $modelTC TecnicoSocial */

/* @var $searchModelF FamiliasSearch */
/* @var $dataProviderF ActiveDataProvider */

$modelR = Responsavel::findOne($nuRes);
$tit = 'Editar Pesquisa Família: ' . $modelR->nm_nom_res;
$this->params['breadcrumbs'][] = ['label' => 'Responsaveis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => MarArtHelpers::titleCase($modelR->nm_nom_res), 'url' => ['view', 'idRes' => $modelR->id_num_res]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tecsoc-update">
    <br>
    <h4 id="nomeRes" style="color: red; text-align: right"><?= Html::encode($tit) ?></h4>
    <?=
    $this->render('_form', [
        'modelTC' => $modelTC,
        'searchModelF' => $searchModelF,
        'dataProviderF' => $dataProviderF,
        'nuFam' => $nuRes,
    ])
    ?>

</div>