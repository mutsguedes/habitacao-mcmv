<?php

namespace app\modules\api\controllers;

use yii\web\Controller;

class TransparenciaController extends Controller
{
 
    public function actionGetAuxilioPMunicipio()
    {
        /* //CEP e ser consultado
        $cep = "13180400";

        //Link do webservice com a variável $cep
        $link = "https://api.portaldatransparencia.gov.br/api-de-dados/orgaos-siafi?pagina=1";

        //Chama a biblioteca passando o link
        $ch = curl_init($link);

         $headers = ['chave-api-dados: c8581ca8831b94469e7d346511f23ba7'];


        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 


        /* Passamos a biblioteca ($ch), esperando um retorno (CURLOPT_RETURNTRANSFER), 
        esperando uma resposta (1) 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //Não verifica o SSL, já que os dados trafegados não são sensíveis (0)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //Executa
        $response = curl_exec($ch);

        //Fecha conexão
        curl_close($ch);

        //Converte o JSON em array
        $data = json_decode($response, true);

        print_r($data); */

        $url = "https://api.portaldatransparencia.gov.br/api-de-dados/orgaos-siafi?pagina=1";

        $client = curl_init($url);


        $headers = ['chave-api-dados:c8581ca8831b94469e7d346511f23ba7'];


        curl_setopt($client, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);


        $orgaos = json_decode($response);


        foreach ($orgaos as &$orgao) {

            echo "<p>Código: $orgao->codigo</p>";

            echo "<p>Descrição: $orgao->descricao</p>";
        }


        curl_close($client);
    }
}
