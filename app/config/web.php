<?php

use yii\base\View;
use bizley\jwt\Jwt;
use Da\QrCode\Label;
use app\components\JwtValidationData;
use Da\QrCode\Contracts\ErrorCorrectionLevelInterface;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';


$key = (YII_ENV_DEV) ?
    '/var/www/html/mcmvws/mcmvcpost/web/marartti' :
    '/web/marartti';
$key_pub = (YII_ENV_DEV) ?
    '/var/www/html/mcmvws/mcmvcpost/web/marartti.pub' :
    '/web/marartti.pub';


$config = [
    'id' => 'cliente',
    'name' => 'SMHSS',
    'sourceLanguage' => 'pt-BR',
    'language' => 'pt-BR',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'America/Sao_Paulo',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'auxiliar' => [
            'class' => 'app\modules\auxiliar\Module',
        ],
        'api' => [
            'class' => 'app\modules\api\Modules',
        ],
        'user' => [
            'class' => 'app\modules\user\Modules',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',

            /*   // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'Y-m-d',
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true, */
        ],
        'social' => [
            'class' => 'kartik\social\Module',
        ],
        'auth' => [
            'class' => 'app\auth\Module',
        ],
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
        ],
        'cli' => [
            'class' => 'app\modules\cli\Module',
        ],
        'email' => [
            'class' => 'app\modules\email\Module',
        ],
        'emares' => [
            'class' => 'app\modules\emares\Module',
        ],
        'ava' => [
            'class' => 'app\modules\ava\Module',
        ],
        'res' => [
            'class' => 'app\modules\res\Modules',
        ],
        'imprel' => [
            'class' => 'app\modules\imprel\Modules',
        ],
        'impres' => [
            'class' => 'app\modules\impres\Modules',
        ],
        'dep' => [
            'class' => 'app\modules\dep\Modules',
        ],
        'end' => [
            'class' => 'app\modules\end\Modules',
        ],
        'agenda' => [
            'class' => 'app\modules\agenda\Module',
        ],
        'agepes' => [
            'class' => 'app\modules\agepes\Modules',
        ],
        'ind' => [
            'class' => 'app\modules\ind\Modules',
        ],
        'ocu' => [
            'class' => 'app\modules\ocu\Modules',
        ],
        'tecsoc' => [
            'class' => 'app\modules\tecsoc\Modules',
        ],
    ],
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'UTC',
            'dateFormat' => 'dd-MM-yyyy',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'BRL',
            'locale' => 'pt_BR',
            'defaultTimeZone' => 'America/Sao_Paulo',
            'class' => 'yii\i18n\Formatter',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'GqTLbz4aH9OTtiJGoKWFA3m28q5YZ3Hz',
            //'baseUrl' => ''
        ],
        'jwt' => [
            'class' => \bizley\jwt\Jwt::class,
            'signer' => \bizley\jwt\Jwt::HS256,
            'signingKey' => [
                'key' => $key, // path to your PRIVATE key, you can start the path with @ to indicate this is a Yii alias
                'passphrase' => '', // omit it if you are not adding any passphrase
                'method' => \bizley\jwt\Jwt::METHOD_FILE,
            ],
            'verifyingKey' => [ // required for asymmetric keys
                'key' => $key_pub, // path to your PUBLIC key, you can start the path with @ to indicate this is a Yii alias
                'passphrase' => '', // omit it if you are not adding any passphrase
                'method' => \bizley\jwt\Jwt::METHOD_FILE,
            ],
            'validationConstraints' => static function (\bizley\jwt\Jwt $jwt) {
                $config = $jwt->getConfiguration();
                return [
                    new \Lcobucci\JWT\Validation\Constraint\SignedWith($config->signer(), $config->verificationKey()),
                    new \Lcobucci\JWT\Validation\Constraint\LooseValidAt(
                        new \Lcobucci\Clock\SystemClock(new \DateTimeZone(\Yii::$app->timeZone)),
                        new \DateInterval('PT10S')
                    ),
                ];
            }
        ],
        'qr' => [
            'class' => '\Da\QrCode\Component\QrCodeComponent',
            'label' => (new Label('PMI - Habitação'))
                //->setFont(__DIR__ . '/../resources/fonts/monsterrat.otf')
                ->setFontSize(5),
            'errorCorrectionLevel' => ErrorCorrectionLevelInterface::HIGH,
            'size' => 70, // big and nice :D
            //'setEncoding'=> 'UTF-8',
            /* 'foregroundColor' =>  [
                '240', // RED
                '173', // GREEN
                '78'  // BLUE
            ], */
            /*  'backgroundColor' => [
                '200', // RED
                '220', // GREEN
                '210', // BLUE
            ], */
            'logoWidth' => 20,
            'margin' => 5,
            // ... you can configure more properties of the component here
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',

            // Set the following if you want to use DB component other than
            // default 'db'.
            // 'db' => 'mydb',

            // To override default session table, set the following
            // 'sessionTable' => 'my_session',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'],
            'identityCookie' => ['name' => '_identity-habitacao', 'httpOnly' => true],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
             'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'habitacao.mcmv@itaborai.rj.gov.br',
                'password' => 'habmcmv123@',
                'port' => '587',
                'dsn' => 'native://default',
                'encryption' => 'tls',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
            ], 
            //'dsn' => 'ses+smtp://USERNAME:PASSWORD@email-smtp.eu-west-1.amazonaws.com',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                ],
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6LdAT-gUAAAAAMuO85XV5bmH0GPrtOLc30FPH-fQ',
            'secretV2' => '6LdAT-gUAAAAAOMcDbT4QOS-KnrRBepMpiQcTlFm',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
