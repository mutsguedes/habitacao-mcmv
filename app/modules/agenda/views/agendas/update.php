<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\agenda\models\Agenda */

$this->title = 'Update Agenda: ' . $model->id_num_age;
$this->params['breadcrumbs'][] = ['label' => 'Agendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_num_age, 'url' => ['view', 'id' => $model->id_num_age]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agenda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
