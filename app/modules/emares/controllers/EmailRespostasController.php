<?php

namespace app\modules\emares\controllers;

use Yii;
use Exception;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\MarArtHelpers;
use yii\web\NotFoundHttpException;
use app\modules\email\models\Email;
use app\modules\emares\models\EmailResposta;
use app\modules\emares\models\EmailRespostaSearch;



/**
 * EmailRespostasController implements the CRUD actions for EmailResposta model.
 */
class EmailRespostasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /* public function behaviors() {
      return [
      'verbs' => [
      'class' => VerbFilter::class,
      'actions' => [
      'delete' => ['POST'],
      ],
      ],
      ];
      } */

    /**
     * behaviors
     *
     * @return void
     */
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
                        if (Yii::$app->user->can($route)) {
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all EmailResposta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailRespostaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 12, 'pageSizeLimit' => 200];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays and list EmailResposta model.
     * @param integer $idEma
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionListaEmailRespostas($idEma)
    {
        $searchModel = new EmailRespostaSearch();
        $query = EmailResposta::find()->where(['id_num_ema' => $idEma]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 5]);
        $dataProvider->query = $query;
        $modelER = EmailResposta::find()->where(['id_num_ema' => $idEma])->one();
        $pkCount = (is_array($modelER) ? count($modelER) : 0);
        if ($pkCount == 0) {
            $modelER = new EmailRespostaSearch();
        }
        return $this->render('index-lista-ema-res', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelER' => $modelER,
            'idEma' => $idEma,
        ]);
    }

    /**
     * Displays and Save EmailResposta model.
     * @param integer $idEma
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionListaRespostas($idEma)
    {
        $searchModel = new EmailRespostaSearch();
        $query = EmailResposta::find()->where(['id_num_ema' => $idEma]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 10, 'pageSizeLimit' => 200];
        $dataProvider->query = $query;
        //$dataProvider->query->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //  'idRes' => $idRes,
        ]);
    }

    /**
     * Displays a single EmailResposta model.
     * @param integer $idER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewAndamento($idER)
    {
        return $this->render('viewAndamento', [
            'modelER' => $this->findModel($idER),
        ]);
    }

    /**
     * Display todo histórico do email.
     * @param integer $idEma
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionViewHistorico($idEma)
    {
        $modelERF = EmailResposta::findOne(['id_num_ema' => $idEma, 'id_ema_and' => 2]);
        if ((Yii::$app->user->can('administrativo') && (is_null($modelERF)))) {
            $modelERF = new EmailResposta();
            $modelERF->id_num_ema = $idEma;
            $modelERF->id_ema_and = 2;
            $modelERF->nm_nom_resp = '';
            $modelERF->save(false);
        }
        $searchModel = new EmailRespostaSearch();
        $query = EmailResposta::find()->where(['id_num_ema' => $idEma]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 8]);
        $dataProvider->query = $query;
        $modelER = EmailResposta::find(['id_num_ema' => $idEma])->orderBy('id_ema_res')->all();
        $modelE = Email::findOne($idEma)->fields();
        //        $pkCount = (is_array($modelER) ? count($modelER) : 0);
        //        if ($pkCount == 0) {
        //            $modelER = new EmailRespostaSearch();
        //        }
        return $this->render('formHistorico', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelER' => $modelER,
            'modelE' => $modelE,
            'idEma' => $idEma,
        ]);
    }

    /**
     * Creates a new EmailResposta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $idEma
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCreateEmailResp($idEma)
    {
        $modelER = new EmailResposta();
        if ($modelER->load(Yii::$app->request->post())) {
            $pageId = 'resposta';
            $transaction = $modelER::getDb()->beginTransaction();
            $modelER->id_num_ema = $idEma;
            //$visitorIp = $_SERVER['REMOTE_ADDR']; // stores IP address of visitor in variable
            $visitorIp = '170.247.40.196'; // stores IP address of visitor in variable
            if (Yii::$app->user->can('administrativo')) {
                $modelER->id_ema_and = 3;
            } else if (Yii::$app->user->can('visitante')) {
                $modelER->id_ema_and = 4;
            }
            try {
                if ($modelER->save()) {
                    if (Yii::$app->user->can('administrativo')) {
                        if ($transaction->commit()) {
                            $modelE = Email::findOne($idEma);
                            $modelE->id_ema_sit = 2;
                            //                            $modelE->dt_tim_mod = date("Y-m-d H:i:s");
                            $modelE->save(false);
                            MarArtHelpers::addView($pageId, $visitorIp);
                            if ($modelER->respostaEnvioAdmin(Yii::$app->params['adminEmail'])) {
                                Yii::$app->session->setFlash('success', 'Email eviado com susesso.');
                            } else {
                                Yii::$app->session->setFlash('error', 'Email não eviado com susesso..');
                            }
                        }
                    } else if (Yii::$app->user->can('visitante')) {
                        if ($transaction->commit()) {
                            $modelE = Email::findOne($idEma);
                            $modelE->id_ema_sit = 3;
                            //                            $modelE->dt_tim_mod = date("Y-m-d H:i:s");
                            $modelE->save(false);
                            if ($modelER->respostaEnvioVisit(Yii::$app->params['adminEmail'])) {
                                Yii::$app->session->setFlash('success', 'Email eviado com susesso.');
                            } else {
                                Yii::$app->session->setFlash('error', 'Email não eviado com susesso..');
                            }
                        }
                    }
                    return $this->render('viewAndamento', [
                        'modelER' => $this->findModel($modelER->id_ema_res),
                    ]);
                }
            } catch (Exception $e) {
                Yii::$app->session->setFlash($e);
                // If there are any problems then we will do a rollBack to the transaction, reverting the changes made during the transaction.
                $transaction->rollBack();
            }
        }
        $modelE = Email::findOne($idEma)->fields();
        return $this->render('formResposta', [
            'modelE' => $modelE,
            'modelER' => $modelER,
            'idEma' => $idEma,
        ]);
    }

    /** Updates an existing EmailResposta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idRE
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($idRE)
    {
        $modelER = $this->findModel($idRE);
        if ($modelER->load(Yii::$app->request->post()) && $modelER->save()) {
            return $this->redirect(['view', 'idRE' => $modelER->id_ema_res]);
        }
        return $this->render('update', [
            'modelER' => $modelER,
            'idRes' => $modelER->id_num_ema,
            'idRE' => $modelER->id_res_ema,
        ]);
    }

    /**
     * Deletes an existing EmailResposta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idRE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteFake($idRE)
    {
        if (Yii::$app->user->can('administrativo')) {
            $modelER = $this->findModel($idRE);
            $isEma = $modelER->id_num_ema;
            $modelER->bo_reg_exc = 1;
            $modelER->save(false);
        } elseif (Yii::$app->user->can('administrador')) {
            $this->findModel($idRE)->delete();
        }
        return $this->redirect(['/ema/emails/index-email', 'idEma' => $isEma]);
        //return $this->redirect(['index']);
    }

    /**
     * Deletes an existing EmailResposta model.
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
     * Finds the Dependente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmailResposta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmailResposta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
