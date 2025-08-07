<?php

use kartik\nav\NavX;

include 'itensMenu.php';

$role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

$admM = array_merge_recursive($itensLogadoMCMV, $itensAdminMCMV);
$admP = array_merge_recursive($itensLogadoMCMV, $itensAdminPAC);
$admH = array_merge_recursive($itensLogadoMCMV, $itensAdminPHPMI);

/* print_r($adm);
exit; */

if (Yii::$app->user->isGuest) {
    echo NavX::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'nav nav-pills'],
        'items' => $itens,
    ]);
} else {
    if (Yii::$app->session->get('sistema') === 'MCMV') {
        echo NavX::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'nav nav-pills'],
            'items' => (array_key_exists('administrador', $role)) ? $admM : $itensLogadoMCMV,
        ]);
    } else if (Yii::$app->session->get('sistema') === 'PAC') {
        echo NavX::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'nav nav-pills'],
            'items' => (array_key_exists('administrador', $role)) ? $admP : $itensLogadoPAC,
        ]);
    } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
        echo NavX::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'nav nav-pills'],
            'items' => (array_key_exists('administrador', $role)) ? $admH : $itensLogadoPHPMI,
        ]);
    };
}
