<?php

$url_base = (YII_ENV_DEV) ?
'https://mcmv.hab.lan/web/' :
'https://mcmv.itaborai.rj.gov.br/web/';

$url_base_api = (YII_ENV_DEV) ?
'https://mcmv.hab.lan/web/api/' :
'https://mcmv.itaborai.rj.gov.br/web/api/';


return [
    'adminEmail' => 'habitacao.mcmv@itaborai.rj.gov.br',
    'senderEmail' => 'habitacao.mcmv@itaborai.rj.gov.br',
    'senderName' => 'SMHSS - Secretaria Municipal de Habitação e Serviços Sociais',
    'sistema' => '',
    'bsDependencyEnabled' => false,
    'bsVersion' => '5.x', // this will set globally `bsVersion` to Bootstrap 5.x for all Krajee Extensions
    'BASE_URL' => $url_base,
    'BASE_URL_API' => $url_base_api,
    'user.passwordResetTokenExpire' => 3600,
];
