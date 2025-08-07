<?php

namespace app\modules\email\controllers;

use Yii;
use yii\base\Controller;
use yii\filters\AccessControl;
use app\components\MarArtHelpers;
use yii\web\NotFoundHttpException;
use app\modules\email\models\Email;
use app\modules\auxiliar\models\PageUser;
use app\modules\email\models\EmailSearch;
use app\modules\email\models\EmailAssunto;
use app\modules\emares\models\EmailResposta;

/**
 * EmailsController implements the CRUD actions for Emails model.
 */
class EmailsController extends Controller
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

    public function behaviors()
    {
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function () {
                        $module = Yii::$app->controller->module->id;
                        $action = Yii::$app->controller->action->id;
                        $controller = Yii::$app->controller->id;
                        $route = "$module/$controller/$action";
                        $post = Yii::$app->request->post();
                        if (Yii::$app->user->can($route)) {
                            return true;
                        }
                        return $post;
                    }
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 14, 'pageSizeLimit' => 200,];
        $dataProvider->query->andWhere(['id_num_cri' => Yii::$app->user->identity->id]);
        return $this->render('index-email', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndexEmail()
    {
        if (Yii::$app->user->can('administrativo')) {
            $searchModel = new EmailSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination = ['defaultPageSize' => 10, 'pageSizeLimit' => 200];
            //  $dataProvider->query->andWhere(['or', ['id_ema_sit' => 1], ['id_ema_sit' => 2]]);
            return $this->render('index-email', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                //  'idRes' => $idRes,
            ]);
        }
    }

    /**
     * Displays a single Emails model.
     * @param integer $idEma
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEma)
    {
        return $this->render('view', [
            'model' => $this->findModel($idEma),
        ]);
    }

    /**
     * Creates a new Emails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws Exception
     */
    public function actionCreateEmail()
    {
        $modelE = new Email();
        $modelEA = EmailAssunto::find()->all();
        if ($modelE->load(Yii::$app->request->post())) {
            $pageId = 'contato';
            //$visitorIp = $_SERVER['REMOTE_ADDR']; // stores IP address of visitor in variable
            $visitorIp = '170.247.40.196'; // stores IP address of visitor in variable
            $id = PageUser::find()->select(['id_pag_usu'])->where(['nu_num_ip' => $visitorIp])->one();
            $modelE->id_pag_usu = $id->id_pag_usu;
            $modelE->id_ema_sit = 1;
            $ass = EmailAssunto::findOne(['id_ema_ass' => $modelE->id_ema_ass])->nm_res_aut;
            if ($modelE->save()) {
                $modelER = new EmailResposta();
                $modelER->id_num_ema = $modelE->id_num_ema;
                $modelER->id_ema_and = 1;
                $modelER->nm_nom_resp = '';
                $modelER->save(false);
                //                $modelE = Email::findOne($idEma);
                if ($modelE->id_ema_ass == 1) {
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 2;
                    $modelER->nm_nom_resp = '';
                    $modelER->save(false);
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 3;
                    $modelER->nm_nom_resp = $ass;
                    $modelER->save(false);
                } else if ($modelE->id_ema_ass == 2) {
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 2;
                    $modelER->nm_nom_resp = '';
                    $modelER->save(false);
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 3;
                    $modelER->nm_nom_resp = $ass;
                    $modelER->save(false);
                } else if ($modelE->id_ema_ass == 6) {
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 2;
                    $modelER->nm_nom_resp = '';
                    $modelER->save(false);
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 3;
                    $modelER->nm_nom_resp = $ass;
                    $modelER->save(false);
                } else if ($modelE->id_ema_ass == 19) {
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 2;
                    $modelER->nm_nom_resp = '';
                    $modelER->save(false);
                    $modelER = new EmailResposta();
                    $modelER->id_num_ema = $modelE->id_num_ema;
                    $modelER->id_ema_and = 3;
                    $modelER->nm_nom_resp = $ass;
                    $modelER->save(false);
                }
            }
            MarArtHelpers::addView($pageId, $visitorIp);
            $data['CPF'] = MarArtHelpers::mascaraString('###.###.###-##', Yii::$app->user->identity->nu_num_cpf);
            if ($modelE->contatoEnvio(Yii::$app->params['adminEmail'])) {
                if (in_array($modelE->id_ema_ass, [1, 2, 6, 19])) {
                    //                    $modelER = EmailResposta::findOne([$modelE->id_num_ema]);
                    $modelER->respostaEnvioAdmin(Yii::$app->params['adminEmail']);
                    $modelE = Email::findOne([$modelE->id_num_ema]);
                    $modelE->id_ema_sit = 2;
                    $modelE->save(false);
                }
                return $this->render('resultado-sucesso', [
                    'data' => $data,
                ]);
            } else {
                return $this->render('resultado-error', [
                    'data' => $data
                ]);
            }
        } else {
            return $this->render('contato', [
                'modelE' => $modelE,
                'modelEA' => $modelEA,
            ]);
        }
        return 'Error';
    }

    /**
     * Updates an existing Email model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idEma
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idEma)
    {
        $model = $this->findModel($idEma);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_num_ema]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Email model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEma
     * @return mixed
     * @throws Throwable
     * @throws StaleObjectException
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEma)
    {
        $this->findModel($idEma)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Email model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Email the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Email::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
