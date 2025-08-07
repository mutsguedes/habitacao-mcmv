<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model common/modules/user/models/PasswordResetRequestForm */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/user/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Olá <b><?= Html::encode($user->name) ?></b> para mudar a Senha do seu Usuário <b><?= Html::encode($user->username) ?></b>,</p>

    <p>Siga o link abaixo e redefinirá sua senha:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
