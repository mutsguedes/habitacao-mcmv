<?php

use app\assets\AppAsset;
use kartik\helpers\Html;
use yii\bootstrap5\Breadcrumbs;
use dominus77\sweetalert2\Alert;
use kartik\icons\FontAwesomeAsset;


/* @var $this View */
/* @var $content string */

AppAsset::register($this);
FontAwesomeAsset::register($this);
?>
<?php
$this->beginPage();
$this->title = 'MarArt - Habitação Pública';
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (!Yii::$app->user->isGuest) {
        // echo Yii::$app->user->identity->name;
    ?>
        <script language="JavaScript" src="/js/mararttimeout.js"></script>
    <?php } ?>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">
    <?php $this->beginBody() ?>
    <?= $this->render('head.php') ?>
    <div class="card-body nowrap navbar" style="background-color: #eaebe6; padding: 0px;">
        <div class="container content-container espacorow" style="padding: 0px;">
            <div id="specificElement" class="card-body" style="padding: 0px; margin: 0px; background-color: #f7f7f7">
                <?=
                Breadcrumbs::widget([
                    //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <div class="card-body" style="padding: 0px; margin: 0px; background-color: #f4d884">
                    <?= $this->render('menu.php') ?>
                </div>
                <div style="margin: 12px;">
                    <?php echo Alert::widget(['useSessionFlash' => true]);
                    if (!Yii::$app->user->isGuest) { ?>
                        <div class="card text-center" style="margin-bottom: 10px; background-color: #5bc0de">
                            <?php
                            if (Yii::$app->session->get('sistema') === 'MCMV') { ?>
                                <h6 class="card-title" style="margin: 0px">Olá <strong style="color: red">
                                        <?= Yii::$app->user->identity->username ?> </strong>
                                    você está logado no sistema <strong style="color: blue">MCMV</strong>.</h6>
                            <?php } else if (Yii::$app->session->get('sistema') === 'PAC') { ?>
                                <h6 class="card-title" style="margin: 0px">Olá <strong style="color: red">
                                        <?= Yii::$app->user->identity->username ?> </strong>
                                    você está logado no sistema <strong style="color: blue">PAC</strong>.</h6>
                            <?php } else if (Yii::$app->session->get('sistema') === 'PHPMI') { ?>
                                <h6 class="card-title" style="margin: 0px">Olá <strong style="color: red">
                                        <?= Yii::$app->user->identity->username ?> </strong>
                                    você está logado no sistema <strong style="color: blue">PHPMI</strong>.</h6>
                            <?php }; ?>
                        </div>
                    <?php };
                    echo $content ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('footer.php') ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>