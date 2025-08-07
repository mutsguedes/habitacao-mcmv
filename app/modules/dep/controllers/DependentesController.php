<?php

namespace app\modules\dep\controllers;

use Yii;
use Exception;
use Throwable;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use dominus77\sweetalert2\Alert;
use yii\web\NotFoundHttpException;
use app\modules\dep\models\Dependente;
use app\modules\dep\models\DependenteSearch;

/**
 * DependentesController implements the CRUD actions for Dependente model.
 */
class DependentesController extends Controller
{

    public $msgError = [
        'title' => 'Error Salvar Dependente',
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
    //public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     *
     **/
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
                    },
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Dependente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DependenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 12, 'pageSizeLimit' => 200];
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
    public function actionListaDependentesResp($idRes)
    {
        $searchModel = new DependenteSearch();
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT id_num_res AS id_num_pes, "R" AS nm_ide_pes,
             bo_reg_exc, nm_nom_res AS nm_nom_pes, nu_num_cpf,
             dt_nas_res AS dt_nas_pes, "n" AS id_num_par FROM responsavel
             WHERE id_num_res=:idres AND bo_reg_exc = 0
             UNION
             SELECT id_num_dep AS id_num_pes, "D" AS nm_ide_pes,
             bo_reg_exc, nm_nom_dep AS nm_nom_pes, nu_num_cpf,
             dt_nas_dep AS dt_nas_pes, id_num_par FROM dependente
             WHERE id_num_res=:idres AND bo_reg_exc = 0',
            'params' => [':idres' => $idRes],
        ]);
        $modelD = $dataProvider->getModels();
        return $this->render('_form-listadepresp', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelD' => $modelD,
            'idRes' => $idRes,
        ]);
    }

    /**
     * Displays and Save Dependentes model.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionListaDependentes($idRes)
    {
        $searchModel = new DependenteSearch();
        $query = Dependente::find()->where(['id_num_res' => $idRes, 'bo_reg_exc' => 0]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 5]);
        $dataProvider->query = $query;
        $modelD = Dependente::find()->where(['id_num_res' => $idRes])->one();
        $pkCount = (is_array($modelD) ? count($modelD) : 0);
        if ($pkCount == 0) {
            $modelD = new DependenteSearch();
        }
        return $this->render('_form-listadep', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelD' => $modelD,
            'idRes' => $idRes,
        ]);
    }

    /**
     * Displays and Save Dependente model.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionListaDependentes($idRes)
    {
    $searchModel = new DependenteSearch();
    $query = Dependente::find()->where(['id_num_res' => $idRes]);
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->pagination = ['defaultPageSize' => 10, 'pageSizeLimit' => 200];
    $dataProvider->query = $query;

    return $this->render('index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    ]);
    } */

    /**
     * Displays a single Dependente model.
     * @param integer $idDep
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idDep)
    {
        return $this->render('view', [
            'modelD' => $this->findModel($idDep),
        ]);
    }

    /**
     * Creates a new Dependente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $idRes
     * @return mixed
     */
    public function actionCreate($idRes)
    {
        $modelD = new Dependente();
        $modelD->id_num_res = $idRes;
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelD->scenario = 'mcmv';
        } elseif (Yii::$app->session->get('sistema') === 'PAC') {
            $modelD->scenario = 'pac';
        } elseif (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelD->scenario = 'phpmi';
        }
        $transaction = $modelD::getDb()->beginTransaction();
        if ($modelD->load(Yii::$app->request->post())) {
            try {
                if ($modelD->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'idDep' => $modelD->id_num_dep]);
                };
            } catch (Exception $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Dependente ' . $e]
                    )
                ]);
                $transaction->rollBack();
            } catch (Throwable $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Dependente ' . $e]
                    )
                ]);
                $transaction->rollBack();
            }
        }
        return $this->render('_form', [
            'modelD' => $modelD,
            'idRes' => $idRes,
        ]);
    }

    /** Updates an existing Dependente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idDep
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($idDep)
    {
        $modelD = $this->findModel($idDep);
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelD->scenario = 'mcmv';
        } elseif (Yii::$app->session->get('sistema') === 'PAC') {
            $modelD->scenario = 'pac';
        } elseif (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelD->scenario = 'phpmi';
        }
        if ($modelD->load(Yii::$app->request->post()) && $modelD->save()) {
            return $this->redirect(['view', 'idDep' => $modelD->id_num_dep]);
        }

        $transaction = $modelD::getDb()->beginTransaction();
        if ($modelD->load(Yii::$app->request->post())) {
            try {
                if ($modelD->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'idDep' => $modelD->id_num_dep]);
                };
            } catch (Exception $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Dependente ' . $e]
                    )
                ]);
                $transaction->rollBack();
            } catch (Throwable $e) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    array_push(
                        $this->msgError,
                        ['text' => 'Existem erros em salvar Dependente ' . $e]
                    )
                ]);
                $transaction->rollBack();
            }
        }
        return $this->render('update', [
            'modelD' => $modelD,
            'idRes' => $modelD->id_num_res,
            'idDep' => $modelD->id_num_dep,
        ]);
    }

    /**
     * Deletes an existing Inumados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idDep
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteFake($idDep)
    {
        $modelD = $this->findModel($idDep);
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelD->scenario = 'mcmv';
        } elseif (Yii::$app->session->get('sistema') === 'PAC') {
            $modelD->scenario = 'pac';
        } elseif (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelD->scenario = 'phpmi';
        }
        $isRes = $modelD->id_num_res;
        $modelD->bo_reg_exc = 1;
        $modelD->save(false);
    }

    /**
     * Deletes an existing Dependente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idDep
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idDep)
    {
        //$this->findModel($id)->delete();
        $modelD = $this->findModel($idDep);
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $modelD->scenario = 'mcmv';
        } elseif (Yii::$app->session->get('sistema') === 'PAC') {
            $modelD->scenario = 'pac';
        } elseif (Yii::$app->session->get('sistema') === 'PHPMI') {
            $modelD->scenario = 'phpmi';
        }
        $modelD->bo_reg_exc = 1;

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dependente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dependente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dependente::findOne($id)) !== null) {
            return $model;
        }

        if (($model = Dependente::findOne($id)) !== null) {
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
}
