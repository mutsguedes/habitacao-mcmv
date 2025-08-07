<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerTabUniCbo;

/* @var $sessionSystem */
?>
<?php
if (!empty(Yii::$app->user->identity->bi_arq_ava)) {
    //$avalar = base64_encode(stream_get_contents(Yii::$app->user->identity->bi_arq_ava));
    $avalar = base64_encode(Yii::$app->user->identity->bi_arq_ava);
}
?>
<!-- Navigation -->
<nav id="navbar" class="navbar navbar-expand-sm bg-warning static-top" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top"> -->
    <div class="container">
        <a id="pre" class="navbar-brand" href="https://www.itaborai.rj.gov.br">
            <img src="/img/brasao-itaboraiNovo.png" width="38" height="38" title="Prefeitura de Itaboraí">
        </a>
        <a id="pre" class="navbar-brand" href="https://mcmv.itaborai.rj.gov.br/">
            <img src="/img/habitacaoLogo.png" width="38" height="38" title="SMHPS">
        </a>
        <h5 class="m-auto d-none  d-sm-inline-block" style="font-weight: 500">SMHSS - Secretaria Municipal de Habitação e Serviços Sociais</h5>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-sm-0">
                <?php
                if (Yii::$app->user->isGuest) {/*  print_r('Entrou Não está LOGADO'); */ ?>
                    <li class="dropdown avatar">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/img/privacy2.png" class="roundedcirclenavimg" alt="Entrar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="padding: 0px 0px 0px 0px;">
                            <?= $this->render('head-form.php') ?>
                        </ul>
                    </li>
                <?php } else { /* print_r('Entrou NÃO LOGADO'); exit(); */ ?>
                    <li class="dropdown avatar">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (!empty($avalar)) { ?>
                                <img class="roundedcirclenavimg" src="data:image/jpeg;base64,
                                     <?= $avalar ?> " alt="Imagem do Usuário">
                            <?php } else { ?>
                                <img src="/img/defaultAvatar.png" class="roundedcirclenavimg" alt="Imagem do Usuário">
                            <?php } ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="padding: 0px 0px 0px 0px;">
                            <?= $this->render('head-perfil.php') ?>
                        </ul>
                    </li>
                    <!--  </ul> -->
                <?php }; ?>
            </ul>
        </div>
    </div>
</nav>