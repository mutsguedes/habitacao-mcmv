<?php

namespace app\modules\ocu\controllers;

use app\modules\auxiliar\models\Apartamento;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\modules\ocu\models\OcupacoesSearch;
use app\modules\ocu\models\Ocupacao;

/**
 * OcupacoesController implements the CRUD actions for Ocupacao model.
 */
class OcupacoesController extends Controller
{
    /*
      /**
     * {@inheritdoc}
     *
      public function behaviors() {
      return [
      'verbs' => [
      'class' => VerbFilter::class,
      'actions' => [
      'delete' => ['POST'],
      ],
      ],
      ];
      } */

    public function behaviors()
    {
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        $module = Yii::$app->controller->module->id;
                        $action = Yii::$app->controller->action->id;
                        $controller = Yii::$app->controller->id;
                        $route = "$module/$controller/$action";
                        $post = Yii::$app->request->post();
                        if (\Yii::$app->user->can($route)) {
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Ocupacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OcupacoesSearch();
        // $searchModel->bo_reg_exc = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 20, 'pageSizeLimit' => 200,];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays and Save Dependente model.
     * @param integer $idOcu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIndexOcupacao($idOcu)
    {
        $searchModel = new OcupacoesSearch();
        $query = Ocupacao::find()->where(['id_num_ocu' => $idOcu]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 10, 'pageSizeLimit' => 200];
        $dataProvider->query = $query;
        //$dataProvider->query->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ocupacao model.
     * @param integer $idOcu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idOcu)
    {
        return $this->render('view', [
            'modelO' => $this->findModel($idOcu),
        ]);
    }

    /**
     * Creates a new Ocupacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelO = new Ocupacao();
        if ($modelO->load(Yii::$app->request->post()) && $modelO->save()) {
            return $this->redirect(['view', 'idOcu' => $modelO->id_num_ocu]);
        }
        return $this->render('create', [
            'modelO' => $modelO,
        ]);
    }

    /**
     * Updates an existing Ocupacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idOcu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idOcu)
    {
        $modelO = $this->findModel($idOcu);
        if ($modelO->load(Yii::$app->request->post()) && $modelO->save()) {
            return $this->redirect(['view', '$idOcu' => $modelO->id_num_ocu]);
        }
        return $this->render('update', [
            'modelO' => $modelO,
            'idOcu' => $idOcu,
        ]);
    }

    /**
     * Deletes an existing Ocupacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idOcu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idOcu)
    {
        $this->findModel($idOcu)->delete();
        $modelO = $this->findModel($idOcu);
        $modelO->bo_reg_exc = 1;
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Inumados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idOcu
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteFake($idOcu)
    {
        if (\Yii::$app->user->can('administrativo')) {
            $dataTime = date("Y-m-d H:i:s");
            Ocupacao::updateAll(
                [
                    'bo_reg_exc' => 1,
                    'id_num_mod' => Yii::$app->user->identity->getId(),
                    'dt_tim_mod' => $dataTime
                ],
                'id_num_ocu= "' . $idOcu . '"'
            );
            Apartamento::updateAll(
                [
                    'bo_loc_apa' => 0,
                    'id_num_ocu' => 0,
                    'id_num_mod' => Yii::$app->user->identity->getId(),
                    'dt_tim_mod' => $dataTime
                ],
                'id_num_ocu= "' . $idOcu . '"'
            );
        } elseif (\Yii::$app->user->can('administrador')) {
            $this->findModel($idOcu)->delete();
        };
        return $this->redirect(['index']);
    }

    /**
     * Finds the Ocupacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idOcu
     * @return Ocupacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idOcu)
    {
        if (($model = Ocupacao::findOne($idOcu)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPopulateClientCode($nuNumQua, $nuNumLot)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $locacoes = Apartamento::find()
            ->where('nu_num_qua = :nuNumQua and nu_num_lot = :nuNumLot and bo_loc_apa = 0', [':nuNumQua' => $nuNumQua, ':nuNumLot' => $nuNumLot,])
            ->all();
        if (count($locacoes) > 0) {
            $results = [['id' => '', 'text' => '']];
            foreach ($locacoes as $itens) {
                $results[] = [
                    'id' => (string) $itens->id_num_apa,
                    'text' => 'Quadra: ' . $itens->nu_num_qua
                        . ' - Lote: ' . $itens->nu_num_lot
                        . ' - Bloco: ' . $itens->nu_num_blo
                        . ' - Apt.: ' . $itens->nu_num_apa
                ];
            }
            $out['results'] = $results;
            return $out;
        } else {
            $results[] = ['id' => 0, 'text' => 'NÃO HÁ VAGAS'];
            return false;
        }
    }
}
