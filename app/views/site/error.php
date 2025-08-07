<?php

use yii\helpers\Html;

/* @var $this View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <div class="alert alert-danger align-items-center">
        <div class="col mx-auto text-center display-2">
            <?= nl2br(Html::encode($message)) ?>
        </div>
    </div>

    <div class="row marcador align-items-center">
        <div class="col mx-auto text-center">
            <img class="img-responsive" style="width: 600px; height:600px;" src="/img/roboErrorN.png" alt="Erro">
        </div>
    </div>

    <p class="fw-bold">

        O erro acima ocorreu enquanto o servidor Web estava processando sua solicitação.
        <!-- The above error occurred while the Web server was processing your request. -->
    </p>
    <p class="fw-bold">
        Entre em contato conosco se achar que isso é um erro do servidor. Obrigado.
        <!-- Please contact us if you think this is a server error. Thank you. -->
    </p>

    <div class="version">
        <?php echo date('d-m-Y H:i:s', $data['time']) . ' ' . $data['version']; ?>
    </div>

</div>