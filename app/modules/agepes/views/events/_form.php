<?php

use app\modules\agepes\models\Events;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Events */
/* @var $form ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'id_user')->textInput() ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'start')->textInput() ?>

<?= $form->field($model, 'end')->textInput() ?>

<?= $form->field($model, 'all_day')->dropDownList(['0', '1',], ['prompt' => '']) ?>

<?= $form->field($model, 'color_background')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'color_text')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->dropDownList(['0', '1',], ['prompt' => '']) ?>
</div>
<?php ActiveForm::end(); ?>