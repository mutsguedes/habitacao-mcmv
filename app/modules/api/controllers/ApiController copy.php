<?php

namespace app\modules\api\controllers;

use app\modules\auxiliar\models\GerActionServico;
use app\modules\auxiliar\models\GerEndereco;
use app\modules\auxiliar\models\GerEntidade;
use app\modules\auxiliar\models\GerServico;
use Yii;
use yii\rest\Controller;

class ApiController extends Controller
{
    /**
     * GetEntity action.
     * Busca de Entidades.
     *
     * @return Response|string
     */

    public function actionGetAuxilioPMunicipio()
    {
        $endpoint = "http://www.transparencia.gov.br/api-de-dados/auxilio-emergencial-por-municipio";



        # Captura o período a ser consultado, formato AAAAMM
        $mesAno = 202008;
        # Captura o código IBGE
        $codigoIbge = 3550308;
        # Valor fixo na consulta, já que o serviço retorna somente uma página
        $pagina = 1;
        # Cria o dicionário com as informações capturadas
        $params = ['codigoIbge' => $codigoIbge, 'mesAno' => $mesAno, 'pagina' => $pagina];

        $url = $endpoint . '?' . http_build_query($params);

        $client = curl_init($url);

        $headers = ['chave-api-dados: c8581ca8831b94469e7d346511f23ba7'];


        curl_setopt($client, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);


        $orgaos = json_decode($response);


       /*  foreach ($orgaos as &$orgao) {

            echo "<p>Código: $orgao->codigo</p>";

            echo "<p>Descrição: $orgao->descricao</p>";
        } */


        curl_close($client);

        return $orgaos;
    }



    /**
     * GetEntity action.
     * Busca de Entidades.
     *
     * @return Response|string
     */

    public function actionGetEntity()
    {
        /* $codEntity = Yii::$app->getRequest()->getQueryParam('codEntity');
        $resultE = GerEntidade::find()
            ->Where(['=', 'id_tip_ent', $codEntity])
            ->all(); */
        $resultE = GerEntidade::find()
            ->all();
        if (empty($resultE)) {
            Yii::$app->response->statusCode = 423;
            return [
                'search' => false,
                'message' => "Entidade não encontrado.",
            ];
        } else {
            return [
                'search' => true,
                'entity' => $resultE,
            ];
        }
    }

    /**
     * GetEntAdress action.
     * Busca Endereço de Entidades.
     *
     * @return Response|string
     */

    public function actionGetEntAddress()
    {
        $codEntity = Yii::$app->getRequest()->getQueryParam('codEntidade');
        $resultA = GerEndereco::find()
            ->Where(['=', 'id_tip_ent', $codEntity])
            ->all();
        if (empty($resultA)) {
            Yii::$app->response->statusCode = 423;
            return [
                'search' => false,
                'message' => "Endereço não encontrado.",
            ];
        } else {
            return [
                'search' => true,
                'address' => $resultA,
            ];
        }
    }

    /**
     * GetEntAdress action.
     * Busca Endereço de Entidades.
     *
     * @return Response|string
     */

    public function actionGetEntService()
    {
        $codEntity = Yii::$app->getRequest()->getQueryParam('codEntity');
        $resultS = GerServico::find()
            ->Where(['=', 'id_tip_ent', $codEntity])
            ->all();
        if (empty($resultS)) {
            Yii::$app->response->statusCode = 423;
            return [
                'search' => false,
                'message' => "Serviço(s) não encontrado(s).",
            ];
        } else {
            return [
                'search' => true,
                'service' => $resultS,
            ];
        }
    }

    /**
     * GetActAdress action.
     * Busca Ações do Serviços das Entidades.
     *
     * @return Response|string
     */

    public function actionGetActService()
    {
        $idActService = Yii::$app->getRequest()->getQueryParam('idActService');
        $resultAS = GerActionServico::find()
            ->Where(['=', 'id_ent_ser', $idActService])
            ->all();
        if (empty($resultAS)) {
            Yii::$app->response->statusCode = 423;
            return [
                'search' => false,
                'message' => "Ações Serviço(s) não encontrado(s).",
            ];
        } else {
            return [
                'search' => true,
                'actService' => $resultAS,
            ];
        }
    }
}
