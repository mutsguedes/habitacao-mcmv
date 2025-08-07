<?php

use yii\web\View;

/* @var $this View */
/* @var $model common/modules/user/models/PasswordResetRequestForm */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/user/reset-password', 'token' => $user->password_reset_token]);
?>
Olá <?= $user->name ?> para mudar a Senha do seu Usuário <?= $user->username ?>,

Siga o link abaixo e redefinirá sua senha:

<?= $resetLink ?>
