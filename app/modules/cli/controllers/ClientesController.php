<?php

namespace app\modules\cli\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\components\MarArtHelpers;
use yii\web\NotFoundHttpException;
use app\modules\cli\models\Mcmvws;
use app\modules\cli\models\McmvwsSearch;
use app\modules\auxiliar\models\ConsultaForm;




/**
 * ClientesController implements the CRUD actions for Mcmvws model.
 */
class ClientesController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new McmvwsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays consulata.
     * @return string
     */
    public function actionConsulta() {
        $modelCF = new ConsultaForm();
       /*  if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelCF->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $modelCF->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelCF->scenario = 'phpmi';
        } else{
            $modelCF->scenario = 'mcmv';
        } */
        if ($modelCF->load(Yii::$app->request->post())) { 
            $pageId = 'consulta';
            //$visitorIp = $_SERVER['REMOTE_ADDR']; // stores IP address of visitor in variable
            $visitorIp = '170.247.40.193'; // stores IP address of visitor in variable
            MarArtHelpers::addView($pageId, $visitorIp);
            $modelC = Mcmvws::findOne(['nu_num_cpf' => $modelCF->cpfcid]);
            if (!empty($modelC)) {
                return $this->render('resultado-sucesso', [
                            'data' => $modelC->fields(),
                ]);
            } else {
                $data['CPF'] = MarArtHelpers::mascaraString('###.###.###-##', $modelCF->cpfcid);
                $data['Atualização'] = date('d/m/Y', strtotime("last friday"));
                return $this->render('resultado-error', [
                            'data' => $data
                ]);
            }
        }
        return $this->render('consulta', [
                    'modelCF' => $modelCF,
        ]);
    }

    /**
     * Pesquisa CPF.
     */
    /* public function actionPesquisa() {
      if (Yii::$app->request->post('btn') === 'buscar') {
      $cpfR = Yii::$app->request->post('cpf');
      $dados = Mcmvws::find()->where(['nu_num_cpf' => $cpfR])->one();
      if (!empty($dados)) {
      $data = $dados->fields();
      return $this->render('resultado-susesso', [
      'data' => $data,
      ]);
      } else {
      $data['CPF'] = MarArtHelpers::mascaraString('###.###.###-##', $cpfR);
      $data['Atualização'] = date('d/m/Y', strtotime("last friday"));
      return $this->render('resultado-error', [
      'data' => $data
      ]);
      }
      }
      } */

    /**
     * Displays a single Mcmvws model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mcmvws model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Mcmvws();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_num_res]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mcmvws model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_num_res]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mcmvws model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mcmvws model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mcmvws the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Mcmvws::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
