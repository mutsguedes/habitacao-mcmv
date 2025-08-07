<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use bizley\jwt\JwtHttpBearerAuth;
use app\modules\api\models\Responsavel;
use app\modules\auxiliar\models\GerCras;

class PeopleController extends Controller
{
     /*   /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'search',
                'get-person',
                'get-cras',
            ],
        ];

        return $behaviors;
    } */
    /**
     * Displays a single User model.
     * @return mixed
     */
    public function actionView()
    {
        $id = Yii::$app->getRequest()->getQueryParams();
        $modelP = $this->findModel($id);
        return $this->asJson($modelP->fields());
    }


    public function actionGetPeople()
    {
        $people = Responsavel::find()->all();
        if (count($people) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Cidadões localizado.',
                'success' => true,
                'status' => 'Ok',
                'data' => $people
            ];
        } else {
            return [
                'name' => 'Não localizado',
                'message' => 'Cidadão não localizado.',
                'success' => false,
                'status' => 'Erro',
            ];
        }
    }

    /**
     * Search action.
     *
     * @return Response|string
     */
    public function actionSearch()
    {
        $cpf = Yii::$app->getRequest()->getBodyParam('cpf');
        $modelP =  Responsavel::find()->where(['nu_num_cpf' => $cpf])->all();
        //$token = (string) Responsavel::generatePeopleToken();
        if (count($modelP) > 0) {
            return $this->asJson([
                'search' => true,
                'id' => $modelP['0']['id_num_res'],
                //'token' => $token,
                'message' => 'Localizado'
            ]);
        } else {
            Yii::$app->response->statusCode = 400;
            return $this->asJson([
                'search' => false,
                'message' => 'Não Localizado',
            ]);
        }
    }

    /**
     * GetPerson action.
     *
     * @return Response|string
     */
    public function actionGetPerson()
    {
        try {
            //$cpf = Yii::$app->getRequest()->getBodyParam('cpf');
            $cpf = Yii::$app->getRequest()->getQueryParam('cpf');;
            $modelP = new Responsavel();
            $modelP =  Responsavel::find()->where(['nu_num_cpf' => $cpf])->all();
            //$token = (string) Responsavel::generatePeopleToken();
            if (count($modelP) > 0) {
                return [
                    'name' => 'Localizado',
                    'message' => 'Cidadão localizado.',
                    //'token' => $token,
                    'success' => true,
                    'status' => 'Ok',
                    'personData' => $modelP,
                ];
            } else {
                return [
                    'name' => 'Não localizado',
                    'message' => 'Cidadão não localizado.',
                    //'token' => $token,
                    'success' => false,
                    'status' => 'Erro',
                    'data' => [],
                ];
            }
        } catch (\Throwable $th) {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                //'token' => $token,
                'message' => 'Cidadão não localizado, algum error inesperado.',
                'success' => false,
                'status' => 'Erro',
                'data' => [],
            ];
        }
    }


    /**
     * GetCras action.
     * Busca CRAS do Município.
     *
     * @return Response|string
     */

    public function actionGetCras()
    {
        //$bai = Yii::$app->getRequest()->getBodyParam('bai');
        $bai = Yii::$app->getRequest()->getQueryParam('bai');
        $resultC = GerCras::find()
            //->select('nm_nom_cra')
            ->orWhere(['=', 'nm_nom_bai', strtoupper($bai)])
            ->orWhere(['=', 'nm_nom_loc',  strtoupper($bai)])
            ->all();
        if (empty($resultC)) {
            Yii::$app->response->statusCode = 423;
            return [
                'search' => false,
                'message' => "Bairro '" . strtoupper($bai) . "' - " . "Bairro não Vinculado a nem um CRAS",
            ];
        } else {
            return [
                'search' => true,
                'cras' => "Bairro '" . strtoupper($bai) . "' Bairro Vinculado ao CRAS - " . $resultC[0]->nm_nom_cra,
                'arr_cra_loc' => $resultC,
            ];
        }
    }
}
