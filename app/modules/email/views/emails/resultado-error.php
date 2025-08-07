<?php


use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this View */
/* @var $form ActiveForm */

$this->title = 'MarArt - Habitação Pública - Error Mesnssagem';
?>
<div class="search-error">
    <?php
    $form = ActiveForm::begin([
        'id' => 'resultado-error-form',
    ]);
    ?>
    <section class="mb-4">
        <div id="jb" class="jumbotron" style="background: #d9534f">
            <i class="far fa-times-circle fa-3x"></i>
        </div>
        <h1 style="text-align: center">Mensagem não Enviada</h1>
        <p class="lead">Houve um erro ao enviar a MENSAGEM do CPF de Nº <strong><?= $data['CPF'] . ', ' ?></strong> A mensagem NÃO foi <strong>ENVIADA</strong> para
            Secretaria Municipal de Habitação e Serviços Sociais.</p>
        <p class="pmais">
            Se vc tem certeza que preencheu todos os campos do formulário corretamente ligue para Secretaria Municipal de Habitação e
            Serviços Sociais através do número (21)2635-4276, informando o acontecido, ou tente novamente mais tarde.
        </p>
        <div class="card-footer d-flex justify-content-md-end" style="padding: 10px">
            <?php
            $urlv = Yii::$app->urlManager->createUrl(['/site/index']);
            echo Html::Button(
                "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
                [
                    'id' => 'btn_voltar', 'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlv . "';",
                    'value' => 'voltar',
                    'name' => 'btn',
                    'title' => 'Voltar página inicial',
                ]
            );
            ?>
        </div>
    </section>
    <?php ActiveForm::end(); ?>
</div> <!-- search -->