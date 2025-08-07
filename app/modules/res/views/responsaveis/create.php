<?php

use yii\bootstrap5\Html;

/* @var $this View */
/* @var $modelR Responsavel */

$this->title = 'Novo Responsável';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsaveis-create">
    <div class="card-header">
        <h4 id="nomeRes" style="color: red; text-align: right"><?= Html::encode($this->title) ?></h4>
    </div>
    <?=
    $this->render('_form', [
        'modelR' => $modelR,
    ])
    ?>
</div>