<?php


/* @var $this View */
/* @var $modelO Ocupacoes */

$this->title = 'Nova Ocupação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocupacões-create">
    <?=
    $this->render('_form', [
        'modelO' => $modelO,
    ])
    ?>
</div>