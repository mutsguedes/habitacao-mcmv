<?php

use yii\helpers\Html;

/* @var $this View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row marcador align-items-center">
        <div class="col mx-auto text-center">
            <img class="img-responsive" src="/img/roboErrorN.png" alt="Erro">
        </div>
    </div>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>

        O erro acima ocorreu enquanto o servidor Web estava processando sua solicitação.
        <!-- The above error occurred while the Web server was processing your request. -->
    </p>
    <p>
        Entre em contato conosco se achar que isso é um erro do servidor. Obrigado.
        <!-- Please contact us if you think this is a server error. Thank you. -->
    </p>

</div>