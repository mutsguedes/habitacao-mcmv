<?php

namespace app\modules\res\controllers;

use Yii;
use Exception;
use Throwable;
use yii\web\Controller;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use dominus77\sweetalert2\Alert;
use yii\web\NotFoundHttpException;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerCras;
use app\modules\res\models\ResponsavelSearch;

/**
 * ResponsaveisController implements the CRUD actions for Responsavel model.
 */
class ResponsaveisController extends Controller
{
    public $msgError = [
        'title' => 'Error Salvar Responsável',
        'buttonsStyling' => false,
        'confirmButtonClass' => "btn btn-md btn-outline-success mr-md-2",
        'animation' => false,
        'customClass' => "animated wobble",
        'allowOutsideClick' => false,
        'allowEscapeKey' => false,
        'customClass' => "animated wobble",
        'backdrop' => "rgba(217, 83, 79, 0.4)",
        'confirmButtonText' => 'Ok',
    ];
    /**
     * {@inheritdoc}
     *
     **/
    public function behaviors()
    {
        /* return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update'],
                'rules' => [
                    // permite aos usuários autenticados
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // todos os outros usuários são negados por padrão 
                ],
            ],
        ]; */

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
     * Lists all Responsavel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResponsavelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 18, 'pageSizeLimit' => 200];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays and Save Dependente model.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIndexResponsavel($idRes)
    {
        $searchModel = new ResponsavelSearch();
        $query = Responsavel::find()->where(['id_num_res' => $idRes]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 10, 'pageSizeLimit' => 200];
        $dataProvider->query = $query;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Responsavel model.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idRes)
    {
        return $this->render('view', [
            'modelR' => $this->findModel($idRes),
        ]);
    }

    /**
     * Displays a form search.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPesquisaRCras()
    {
        $modelR = new ResponsavelSearch();
        return $this->render('_form-pesquisarrcras', [
            'modelR' => $modelR,
        ]);
    }

    /**
     * Displays a news ResponsavelSearch.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionResultadoRCras()
    {
        $searchModel = new ResponsavelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 6, 'pageSizeLimit' => 200];
        if (Yii::$app->request->get('btn') != 'cancelar') {
            if ($dataProvider->getCount() != 0) {
                return $this->render('_form-resultadorcras', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                return $this->redirect(['res/responsaveis/create']);
            }
        } else {
            return $this->redirect('site/index');
        }
    }

    /* Busca CRAS do Município. */

    public function actionGetCras()
    {
        $resultCra = [];
        //mb_convert_case($content, MB_CASE_UPPER, "UTF-8");
        //$nmC = mb_convert_case(Yii::$app->request->post('nmCra'), MB_CASE_UPPER, "UTF-8");
        $nmC = Yii::$app->request->post('nmCra');
        $resultC = GerCras::find()
            ->select('nm_nom_cra')
            ->orWhere(['nm_nom_bai' => $nmC])
            ->orWhere(['nm_nom_loc' => $nmC])
            ->all();
        if (empty($resultC)) {
            $resultCra['nomeCras'] = 'BAIRRO NÃO VINCULADO';
        } else {
            $resultCra['nomeCras'] = $resultC[0]->nm_nom_cra;
        }
        echo json_encode($resultCra);
    }

    /* Busca CRAS do Responsável. */

    public function actionGetCrasRes()
    {
        $resultCra = [];
        $nmC = mb_convert_case(Yii::$app->request->post('nmCra'), MB_CASE_UPPER, "UTF-8");
        $resultC = GerCras::find()
            ->select('nm_nom_cra')
            ->orWhere(['=', 'nm_nom_bai', $nmC])
            ->orWhere(['=', 'nm_nom_loc', $nmC])
            ->all();
        if (empty($resultC)) {
            $resultCra['nomeCras'] = 'BAIRRO NÃO VINCULADO';
        } else {
            $resultCra['nomeCras'] = $resultC[0]->nm_nom_cra;
        }
        echo json_encode($resultCra);
    }

    /**
     * Displays a form search.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPesquisa()
    {
        //$modelR = new Responsavel();
        $modelR = new ResponsavelSearch();
        return $this->render('_form-pesquisarres', [
            'modelR' => $modelR,
        ]);
    }

    /**
     * Displays a news ResponsavelSearch.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionResultado()
    {
        $searchModel = new ResponsavelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 6, 'pageSizeLimit' => 200];
        if (Yii::$app->request->get('btn') != 'cancelar') {
            if ($dataProvider->getCount() != 0) {
                return $this->render('_form-resultadores', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                return $this->redirect('create');
            }
        } else {
            return $this->redirect('index');
        }
    }

    /**
     * Creates a new Responsavel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelR = new Responsavel();
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelR->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $modelR->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelR->scenario = 'phpmi';
        }
        $transaction = $modelR::getDb()->beginTransaction();
        if ($modelR->load(Yii::$app->request->post())) {
            try {
                if ($modelR->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'idRes' => $modelR->id_num_res]);
                }
            } catch (Exception $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Responsável ' . $e]
                    )
                ]);
                $transaction->rollBack();
            } catch (Throwable $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Responsável ' . $e]
                    )
                ]);
                $transaction->rollBack();
            }
        }
        return $this->render('create', [
            'modelR' => $modelR,
        ]);
    }

    /** Updates an existing Responsavel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionUpdateInscricao()
    {
        $pro = date('Ymd') . str_pad((intval($this->GerSeqIns()) + 1), 5, '0', STR_PAD_LEFT);
        //var_dump($pro);
    }

    public function GerSeqIns()
    {
        $serInsUlt = Responsavel::find()
            ->max('nu_num_seq');
        return $serInsUlt;
    }

    /** Updates an existing Responsavel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException
     */

    public function actionUpdate($idRes)
    {
        $modelR = $this->findModel($idRes);
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelR->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $modelR->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelR->scenario = 'phpmi';
        }
        $transaction = $modelR::getDb()->beginTransaction();
        /*  $data = $modelR->load(Yii::$app->request->post());
            print_r($data);
            exit; */
        if ($modelR->load(Yii::$app->request->post())) {
            try {
                if ($modelR->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'idRes' => $modelR->id_num_res]);
                }
            } catch (Exception $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Responsável ' . $e]
                    )
                ]);
                $transaction->rollBack();
            } catch (Throwable $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Responsável ' . $e]
                    )
                ]);
                $transaction->rollBack();
            }
        }
        return $this->render('update', [
            'modelR' => $modelR,
            'idRes' => $idRes,
        ]);
    }

    /**
     * Deletes an existing Responsavel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idRes)
    {
        //$this->findModel($id)->delete();
        $modelR = $this->findModel($idRes);
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelR->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $modelR->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelR->scenario = 'phpmi';
        }
        $modelR->bo_reg_exc = 1;

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Inumados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteFake($idRes)
    {
        $modelR = $this->findModel($idRes);
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelR->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $modelR->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelR->scenario = 'phpmi';
        }
        $modelR->bo_reg_exc = 1;
        $modelR->save(false);
        // return $this->redirect(['index']);
    }

    /**
     * Finds the Responsavel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Responsavel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Responsavel::findOne($id)) !== null) {
            if (Yii::$app->session->get('sistema') === 'MCMV') {
                $model->scenario = 'mcmv';
            } else if (Yii::$app->session->get('sistema') === 'PAC') {
                $model->scenario = 'pac';
            } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
                $model->scenario = 'phpmi';
            }
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //FUNÇÕES QUE CARREGAM OS JSON

    /* Soma das rendas dos membros da Família. */

    public function actionGetRenda()
    {
        $resultRen = [];
        $idR = Yii::$app->request->post('idRes');
        $resultR = Responsavel::find()
            ->where(['id_num_res' => $idR])
            ->andWhere(['bo_reg_exc' => 0])
            ->sum('nu_ren_res');
       /*  if (Yii::$app->session->get('sistema') === 'MCMV') {
            $resultR->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $resultR->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $resultR->scenario = 'phpmi';
        } */
        $resultD = Dependente::find()
            ->where(['id_num_res' => $idR])
            ->andWhere(['bo_reg_exc' => 0])
            ->sum('nu_ren_dep');
        /* if (Yii::$app->session->get('sistema') === 'MCMV') {
            $resultD->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $resultD->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $resultD->scenario = 'phpmi';
        } */
        if (is_null($resultR)) {
            $resultR = 0;
        };
        if (is_null($resultD)) {
            $resultD = 0;
        };
        $resultRen['totalrenda'] = $resultR + $resultD;
        echo json_encode($resultRen);
    }

    public function actionGetRendaDep()
    {
        $resultRen = [];
        $idR = Yii::$app->request->post('idRes');
        $resultD = Dependente::find()
            ->where(['id_num_res' => $idR])
            ->andWhere(['bo_reg_exc' => 0])
            ->sum('nu_ren_dep');
       /*  if (Yii::$app->session->get('sistema') === 'MCMV') {
            $resultD->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $resultD->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $resultD->scenario = 'phpmi';
        } */
        $resultRen['totalrenda'] = $resultD;
        echo json_encode($resultRen);
    }

    /* Busca deficiência dos membros da Família. */

    public function actionGetDef()
    {
        $resultDef = [];
        $idR = Yii::$app->request->post('idRes');
        $resultR = Responsavel::find()
            ->where(['id_num_res' => $idR])
            ->andWhere(['bo_reg_exc' => 0])
            ->orWhere(['=', 'bo_ade_fis', '1'])
            ->orWhere(['=', 'bo_ade_int', '1'])
            ->orWhere(['=', 'bo_ade_aud', '1'])
            ->orWhere(['=', 'bo_ade_nan', '1'])
            ->orWhere(['=', 'bo_ade_mul', '1'])
            ->all();
        /* if (Yii::$app->session->get('sistema') === 'MCMV') {
            $this->resultR->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $this->resultR->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $this->resultR->scenario = 'phpmi';
        } */
        $resultD = Dependente::find()
            ->where(['id_num_res' => $idR])
            ->andWhere(['bo_reg_exc' => 0])
            ->orWhere(['=', 'bo_ade_fis', '1'])
            ->orWhere(['=', 'bo_ade_int', '1'])
            ->orWhere(['=', 'bo_ade_aud', '1'])
            ->orWhere(['=', 'bo_ade_nan', '1'])
            ->orWhere(['=', 'bo_ade_mul', '1'])
            ->all();
       /*  if (Yii::$app->session->get('sistema') === 'MCMV') {
            $this->resultD->scenario = 'mcmv';
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $this->resultD->scenario = 'pac';
        } else if (Yii::$app->session->get('sistema') === 'PHPMI') {
            $this->resultD->scenario = 'phpmi';
        } */
        $resultDef['totalDef'] = array_push($resultR, $resultD);
        echo json_encode($resultDef);
    }
}
