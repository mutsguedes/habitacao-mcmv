<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use app\modules\user\models\User;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidArgumentException;
use app\modules\user\models\UserSearch;
use app\modules\user\models\ResetPasswordForm;
use app\modules\user\models\PasswordResetRequestForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    /**
     * {@inheritdoc}
     *
     **/
    public function behaviors()
    {
        /*  $behaviors['access'] = [
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
        return $behaviors; */

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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionCollaborator()
    {
        /* $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('_formcollaborator', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); */


        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT username, name, nu_num_mat, nu_num_ide, 
             nu_num_cpf, nu_num_tel, id_num_cbo, email, bi_arq_ava, status
             FROM user
             WHERE status <> 9 AND id_tip_use <> "adm"
             ORDER BY name'
        ]);
        $modelU = $dataProvider->getModels();
        return $this->render('_formcollaborator', [
            'modelU' => $modelU,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = $model::SCENARIO_CREATE;
        if (!empty($_FILES['User']['tmp_name']['bi_arq_ava'])) {
            $file = UploadedFile::getInstance($model, 'bi_arq_ava');
            $model->nm_nom_arq = $file->nm_nom_arq;
            $model->nm_tip_arq = $file->nm_tip_arq;
            $fp = fopen($file->tempName, 'r');
            $content = fread($fp, filesize($file->tempName));
            fclose($fp);
            $model->bi_arq_ava = $content;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $auth = Yii::$app->authManager;
            $visitante = $auth->getRole('visitante');
            $auth->assign($visitante, $model->getId());
            $identity = User::findOne(['username' => $model->username]);
            if (Yii::$app->getUser()->login($identity)) {
                $model->inscricaoEnvio(Yii::$app->params['adminEmail']);
                return $this->redirect('\site\index');
            }
        }
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Verifique seu e-mail para obter mais instruções.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Desculpe, não podemos redefinir a senha para o endereço de e-mail fornecido.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     * @param integer $id
     * @return mixed
     */
    public function actionPerfil($id)
    {
        $model = $this->findModel($id);
        return $this->render('perfil', ['model' => $model]);
    }

    /**
     * Change User password.
     *
     * @return mixed
     * @param integer $id
     * @return mixed
     */
    public function actionChangePassword($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_CHANGEPWD;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate()) {
                $model->password = $model->setPassword($model->new_password);
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Senha alterada com sucesso.');
                    return $this->redirect(['\site\index']);
                } else {
                    Yii::$app->session->setFlash('success', 'Senha não alterada.');
                    return $this->redirect(['\site\index']);
                }
            }
        }
        return $this->render('changepassword', ['model' => $model]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nova senha salva.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionLoadImage()
    {
        $nama_file = yii::$app->user->identity->username . '.jpg';
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
