<?php

use yii\bootstrap5\Html;

/* @var $this View */
/* @var $modelF Funcionarios */

$this->title = 'Novo Funcionario';
$this->params['breadcrumbs'][] = ['label' => 'Funcionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionarios-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?=
    $this->render('_form', [
        'modelF' => $modelF,
    ])
    ?>

</div>