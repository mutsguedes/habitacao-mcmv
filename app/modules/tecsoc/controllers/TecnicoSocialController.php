<?php

namespace app\modules\tecsoc\controllers;

use Yii;
use Exception;
use yii\base\Model;
use yii\web\Controller;
use yii\filters\VerbFilter;
use dominus77\sweetalert2\Alert;
use yii\web\NotFoundHttpException;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\tecsoc\models\TecnicoSocialSearch;
use app\modules\tecsoc\models\TecsocDocumento;
use app\modules\tecsoc\models\TecsocEnfermidade;

/**
 * TecnicoSocialController implements the CRUD actions for TecnicoSocial model.
 */
class TecnicoSocialController extends Controller
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
     * Lists all TecnicoSocial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TecnicoSocialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TecnicoSocial model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TecnicoSocial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $idRes
     * @return mixed
     */
    public function actionCreate($idRes)
    {
        $modelTS = new TecnicoSocial();
        $modelTSE = new TecsocEnfermidade();
        $modelTS->id_num_res = intval($idRes);
        $modelTSE->id_num_res = intval($idRes);
        $postData = Yii::$app->request->post();
        $transaction = $modelTS::getDb()->beginTransaction();
        try {
            if (
                $modelTS->load($postData) && $modelTSE->load($postData) &&
                Model::validateMultiple([$modelTS, $modelTSE])
            ) {
                $modelR = Responsavel::findOne($idRes);
                $modelR->bo_tec_soc = 1;
                $modelR->save(false);

                $transaction->commit();
                return;
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                [
                    'title' => 'Error Salva Pesquisa',
                    'text' => 'Existem erros form. Pes. Família',
                    'confirmButtonText' => 'Ok!',
                ]
            ]);
            $transaction->rollBack();
        }

        return $this->render('_form', [
            'modelTS' => $modelTS,
            'modelTSE' => $modelTSE,
            'idRes' => $idRes,
        ]);
    }

    /**
     * Updates an existing TecnicoSocial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idRes
     * @return mixed
     */
    public function actionUpdate($idRes)
    {
        $model = TecnicoSocial::findOne(['id_num_res' => $idRes]);
        $modelTS = $this->findModel($model->id_tec_soc);
        $modelTSE = TecsocEnfermidade::findOne(['id_num_res' => $idRes]);
        $modelTS->id_num_equ = (explode(',', $modelTS->id_num_equ)); // Carrega os Sistemas que o procedimeto se encontra.
        $modelTS->id_num_ati = (explode(',', $modelTS->id_num_ati)); // Carrega os Sistemas que o procedimeto se encontra.
        $modelTS->id_num_cur = (explode(',', $modelTS->id_num_cur)); // Carrega os Sistemas que o procedimeto se encontra.
        $modelTS->id_num_ben = (explode(',', $modelTS->id_num_ben)); // Carrega os Sistemas que o procedimeto se encontra.
        $modelTS->id_num_zoo = (explode(',', $modelTS->id_num_zoo)); // Carrega os Sistemas que o procedimeto se encontra.
        $modelTS->id_num_aco = (explode(',', $modelTS->id_num_aco)); // Carrega os Sistemas que o procedimeto se encontra.

        $postData = Yii::$app->request->post();

        $transaction = $modelTS::getDb()->beginTransaction();
        $transaction1 = $modelTSE::getDb()->beginTransaction();
        try {
            //if ($modelTS->load(Yii::$app->request->post()) && $modelTS->save()) {
            if (
                $modelTS->load($postData) &&
                $modelTSE->load($postData) &&
                Model::validateMultiple([$modelTS, $modelTSE]) &&
                $modelTS->save() &&
                $modelTSE->save()
            ) {
                $transaction->commit();
                $transaction1->commit();
                return $this->redirect(['view', 'idTecSoc' => $modelTS->id_tec_soc]);
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                [
                    'title' => 'Error Salva Pesquisa',
                    'text' => 'Existem erros form. Pes. Família ' . $e,
                    'confirmButtonText' => 'Ok!',
                ]
            ]);
            $transaction->rollBack();
            $transaction1->rollBack();
        }
        return $this->render('_form', [
            'modelTS' => $modelTS,
            'modelTSE' => $modelTSE,
            'idRes' => $idRes,
        ]);
    }

    /**
     * Creates a new TecsocDocumento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $idPes
     * @param string $idTip
     * @return mixed
     */
    public function actionCreateTecsocDocument($idPes, $idTip)
    {
        if ($idTip == 'R') {
            $idRes = str_pad($idPes, 11, '0', STR_PAD_LEFT);
            $idDep = '00000000000';
        } else {
            $idDep = str_pad($idPes, 11, '0', STR_PAD_LEFT);
            $idRes = str_pad(Dependente::findOne(['id_num_dep' => $idPes])->id_num_res, 11, '0', STR_PAD_LEFT);
        }
        $pes = $idRes . '-' . $idDep;
        $modelTSD = new TecsocDocumento();
        $modelTSD->id_num_pes =  $pes;
        $transaction = $modelTSD::getDb()->beginTransaction();
        try {
            if (
                $modelTSD->load(Yii::$app->request->post()) &&
                $modelTSD->save()
            ) {
                $transaction->commit();
                return;
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                [
                    'title' => 'Documento Familiar Criar - Error',
                    'text' => 'Existem erros no formulário de Doc. Membro Famíliar',
                    'confirmButtonText' => 'Ok!',
                ]
            ]);
            $transaction->rollBack();
        }
        return $this->render('_form-ts-doc-fam', [
            'modelTSD' => $modelTSD,
            'idRes' => $idRes,
            'idPes' => $idPes,
            'idTip' => $idTip,
        ]);
    }

    /**
     * Updates an existing TecsocDocumento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idPes
     * @param integer $idTip
     * @return mixed the model cannot be found
     */
    public function actionUpdateTecsocDocument($idPes, $idTip)
    {
        if ($idTip == 'R') {
            $idRes = str_pad($idPes, 11, '0', STR_PAD_LEFT);
            $idDep = '00000000000';
        } else {
            $idDep = str_pad($idPes, 11, '0', STR_PAD_LEFT);
            $idRes = str_pad(Dependente::findOne(['id_num_dep' => $idPes])->id_num_res, 11, '0', STR_PAD_LEFT);
        }
        $pes = $idRes . '-' . $idDep;
        $modelTSD = TecsocDocumento::findOne(['id_num_pes' => $pes]);
        $transaction = $modelTSD::getDb()->beginTransaction();
        try {
            if (
                $modelTSD->load(Yii::$app->request->post()) &&
                $modelTSD->save()
            ) {
                $transaction->commit();
                return;
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                [
                    'title' => 'Documento Familiar Editar - Error',
                    'text' => 'Existem erros no formulário de Doc. Membro Famíliar',
                    'confirmButtonText' => 'Ok!'
                ]
            ]);
            $transaction->rollBack();
        }
        return $this->render('_form-ts-doc-fam', [
            'modelTSD' => $modelTSD,
            'idRes' => $idRes,
            'idPes' => $idPes,
            'idTip' => $idTip,
        ]);
    }

    /**
     * Deletes an existing TecnicoSocial model.
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
     * Finds the TecnicoSocial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TecnicoSocial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TecnicoSocial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
