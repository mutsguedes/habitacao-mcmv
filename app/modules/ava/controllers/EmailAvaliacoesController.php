<?php

namespace app\modules\ava\controllers;

use Yii;
use Exception;
use yii\base\Controller;
use yii\web\NotFoundHttpException;
use app\modules\email\models\Email;
use app\modules\ava\models\EmailAvaliacao;
use app\modules\emares\models\EmailResposta;
use app\modules\ava\models\EmailAvaliacaoSearch;



/**
 * EmailAvaliacoesController implements the CRUD actions for EmailAvaliacoes model.
 */
class EmailAvaliacoesController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all EmailAvaliacoes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailAvaliacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmailAvaliacao model.
     * @param integer $idEA
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEA)
    {
        return $this->render('viewAvaliacao', [
            'modelEA' => $this->findModel($idEA),
            //                    'idEma' => $this->findModel($idEA)->id_num_ema
        ]);
    }

    /**
     * Displays a single EmailAvaliacao model.
     * @param integer $idEA
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewAvaliacao($idEA)
    {
        return $this->render('viewAvaliacaoHis', [
            'modelEA' => $this->findModel($idEA),
            //                    'idEma' => $this->findModel($idEA)->id_num_ema
        ]);
    }

    /**
     * Creates a new EmailAvaliacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $idEma
     * @return mixed
     */
    public function actionCreate($idEma)
    {
        $modelEA = new EmailAvaliacao();
        if ($modelEA->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post('btn_criar') === 'criar') {
                $transaction = $modelEA::getDb()->beginTransaction();
                $modelEA->id_num_ema = $idEma;
                try {
                    if ($modelEA->save()) {
                        $transaction->commit();
                        $modelE = Email::findOne($idEma);
                        $modelE->bo_ema_fin = 1;
                        $modelE->bo_ema_ava = 1;
                        $modelE->id_ema_sit = 5;
                        $modelE->save(false);
                        $modelER = new EmailResposta();
                        $modelER->id_num_ema = $idEma;
                        $modelER->id_ema_and = 7;
                        $modelER->nm_nom_resp = '';
                        $modelER->save(false);
                        Yii::$app->session->setFlash('success', 'Avaliação eviado com susesso.');
                    } else {
                        Yii::$app->session->setFlash('error', 'Avaliação não eviada com susesso.');
                    }
                    return $this->render('viewAvaliacao', ['idEA' => $modelEA->id_ema_ava]);
                } catch (Exception $e) {
                    Yii::$app->session->setFlash($e);
                    // If there are any problems then we will do a rollBack to the transaction, reverting the changes made during the transaction.
                    $transaction->rollBack();
                }
            }
            //            } else if (Yii::$app->request->post('btn_cancelar') === 'cancelar') {
            //                $modelE = Emails::findOne($idEma);
            //                $modelE->bo_ema_fin = 1;
            //                $modelE->bo_ema_ava = 0;
            //                $modelE->id_ema_sit = 4;
            //                $modelE->save(false);
            //                $modelER = new EmailRespostas();
            //                $modelER->id_num_ema = $idEma;
            //                $modelER->id_ema_and = 7;
            //                $modelER->nm_nom_resp = '';
            //                $modelER->save(false);
            //                return $this->redirect('/site/index');
            //            }
        }
        return $this->render('formAvaliacao', [
            'modelEA' => $modelEA,
            'idEma' => $idEma
        ]);
    }

    /**
     * Cancel a new EmailAvaliacao model.
     * If cancel is successful, the browser will be redirected to the 'home' page.
     * @param integer $idEma
     * @return mixed
     */
    public function actionCancelCreate($idEma)
    {
        $modelEA = new EmailAvaliacao();
        if ($modelEA->load(Yii::$app->request->post())) {
            $modelE = Email::findOne($idEma);
            $modelE->bo_ema_fin = 1;
            $modelE->bo_ema_ava = 0;
            $modelE->id_ema_sit = 4;
            $modelE->save(false);
            $modelER = new EmailResposta();
            $modelER->id_num_ema = $idEma;
            $modelER->id_ema_and = 7;
            $modelER->nm_nom_resp = '';
            $modelER->save(false);
            return $this->redirect('/site/index');
        } else {
        }
        return $this->render('formCancel', [
            'modelEA' => $modelEA,
            'idEma' => $idEma
        ]);
    }

    /**
     * Updates an existing EmailAvaliacoes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_ema_ava]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EmailAvaliacoes model.
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
     * Finds the EmailAvaliacoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmailAvaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmailAvaliacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
