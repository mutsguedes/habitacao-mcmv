<?php

namespace app\modules\fun\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\modules\fun\models\Funcionarios;
use app\modules\fun\models\FuncionariosSearch;

/**
 * FuncionariosController implements the CRUD actions for Funcionarios model.
 */
class FuncionariosController extends Controller
{

    /**
     * @inheritdoc
     */
    /* public function behaviors()
      {
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
     * Lists all Funcionarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FuncionariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 10, 'pageSizeLimit' => 200];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Funcionarios model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'modelF' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Funcionarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelF = new Funcionarios();
        if ($modelF->load(Yii::$app->request->post()) && $modelF->save()) {
            return $this->redirect(['view', 'id' => $modelF->id_num_fun]);
        }
        return $this->render('create', [
            'modelF' => $modelF,
        ]);
    }

    /**
     * Updates an existing Funcionarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelF = $this->findModel($id);
        if ($modelF->load(Yii::$app->request->post()) && $modelF->save()) {
            return $this->redirect(['view', 'id' => $modelF->id_num_fun]);
        }
        return $this->render('update', [
            'modelF' => $modelF,
        ]);
    }

    /**
     * Deletes an existing Funcionarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Funcionarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Funcionarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Funcionarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página requisitada não existe.');
        }
    }

    /* public function actionGetDesOrg() {
      $DesOrg = $_POST["Funcionarios"]["id_num_org"];

      $query = OrgReguladores::find()
      ->select(['nm_nom_org'])
      ->where('id_num_org = :DesOrg', [':DesOrg' => $DesOrg])
      ->column();
      print json_encode(array('r' => $query));
      } */
}
