<?php

namespace app\controllers;

use Yii;
use sizeg\jwt\Jwt;
use yii\web\Response;
use yii\rest\Controller;
use sizeg\jwt\JwtHttpBearerAuth;

class RestController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'auth',
            ],
        ];

        return $behaviors;
    }

    /**
     * @return Response
     */
    public function actionAuth() {
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $dataini = strtotime('now');
        $dataexp = strtotime('+20 minutes');
        // Adoption for lcobucci/jwt ^4.0 version
        $token = $jwt->getBuilder()
                ->issuedBy('https://mcmvws.itaborai.rj.gov.br') // Configures the issuer (iss claim)
                ->permittedFor('https://mcmvws.itaborai.rj.gov.br') // Configures the audience (aud claim)
                //  ->issuedBy('https://mcmv-api.hab.lan') // Configures the issuer (iss claim)
                // ->permittedFor('https://mcmv-api.hab.lan') // Configures the audience (aud claim)
                ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                ->issuedAt($dataini) // Configures the time that the token was issue (iat claim)
                ->expiresAt($dataexp) // Configures the expiration time of the token (exp claim)
                ->withClaim('uid', 4) // Configures a new claim, called "uid"
                ->getToken($signer, $key); // Retrieves the generated token

        return $this->asJson([
                    'token' => (string) $token,
                    'success' => true,
                    'status' => 'Ok'
        ]);
    }

    /**
     * @return Response
     */
    public function actionData() {
        return $this->asJson([
                    'success' => true,
                    'status' => 'Ok'
        ]);
    }

}
