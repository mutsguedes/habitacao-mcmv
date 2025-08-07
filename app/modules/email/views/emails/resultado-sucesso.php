<?php


use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this View */
/* @var $form ActiveForm */

$this->title = 'MarArt - Habitação Pública - Sucesso Menssagem';
?>
<div class="search-error">
    <?php
    $form = ActiveForm::begin([
        'id' => 'resultado-sucesso-form',
    ]);
    ?>
    <section class="mb-4">
        <div id="jb" class="jumbotron" style="background: #5cb85c">
            <i class="far fa-check-circle fa-3x"></i>
        </div>
        <h1 style="text-align: center">Obrigado por nos contatar</h1>
        <p class="lead">Sucesso ao enviar a MENSAGEM do CPF de Nº <strong><?= $data['CPF'] . ', ' ?></strong> A mensagem foi <strong>ENVIADA COM SUCESSO</strong> para
            Secretaria Municipal de Habitação e Serviços Sociais. Nós responderemos o mais rápido possível.</p>
        <p class="pmais">
            Qualquer dúvida ligue para Secretaria Municipal de Habitação e Serviços Sociais através do número (21)2635-4276.
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