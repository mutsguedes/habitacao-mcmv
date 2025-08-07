<?php

namespace app\modules\api\controllers;

use Yii;
use Mpdf\Tag\U;
use yii\web\Response;
use yii\rest\Controller;
use yii\web\UploadedFile;
use app\modules\user\models\User;
use bizley\jwt\JwtHttpBearerAuth;
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
     * @inheritdoc
     */
   /*  public function behaviors()
    {
        /* $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login', 'create-app',
                'request-password-reset',
                'logout',
            ],
        ];

        return $behaviors; 

        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => \bizley\jwt\JwtHttpBearerAuth::class,
            'optional' => [
                'login', 'create-app',
                'request-password-reset',
                'logout',
            ],
        ];

        return $behaviors;
    } */

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
     * Displays a single User model.
     * @return mixed
     */
    public function actionView()
    {
        $id = Yii::$app->getRequest()->getQueryParams();
        $modelU = $this->findModel($id);
        return $this->asJson($modelU->fields());
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $modelU = new User();
        $modelU->scenario = $modelU::SCENARIO_CREATE;
        if (!empty($_FILES['User']['tmp_name']['bi_arq_ava'])) {
            $file = UploadedFile::getInstance($modelU, 'bi_arq_ava');
            $modelU->nm_nom_arq = $file->nm_nom_arq;
            $modelU->nm_tip_arq = $file->nm_tip_arq;
            $fp = fopen($file->tempName, 'r');
            $content = fread($fp, filesize($file->tempName));
            fclose($fp);
            $modelU->bi_arq_ava = $content;
        }

        if ($modelU->load(Yii::$app->getRequest()->getBodyParams()) && $modelU->save()) {
            $person = User::find()->where(['nu_num_cpf' => $this->nu_num_cpf])->all();
            $auth = Yii::$app->authManager;
            $visitante = $auth->getRole('visitante');
            $auth->assign($visitante, $modelU->getId());
            $modelU->inscricaoEnvio(Yii::$app->params['adminEmail']);
            $token = (string) User::generateUserToken($modelU);
            return $this->asJson([
                'created' => true,
                'nome' => Yii::$app->user->identity->name,
                'token' => $token,
                'message' => 'SignUp Válido',
                'data' => $person,
                'code' => 200,
            ]);
        } else {
            return $this->asJson([
                'created' => false,
                'message' => 'SignUp Inválido',
            ]);
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateApp()
    {
        $modelU = new User();
        $modelU->scenario = $modelU::SCENARIO_CREATE;
        if (!empty($_FILES['User']['tmp_name']['bi_arq_ava'])) {
            $file = UploadedFile::getInstance($modelU, 'bi_arq_ava');
            $modelU->nm_nom_arq = $file->nm_nom_arq;
            $modelU->nm_tip_arq = $file->nm_tip_arq;
            $fp = fopen($file->tempName, 'r');
            $content = fread($fp, filesize($file->tempName));
            fclose($fp);
            $modelU->bi_arq_ava = $content;
        }

        $user = Yii::$app->getRequest()->getBodyParams();
        if ($modelU->load(Yii::$app->getRequest()->getBodyParams(), '') && $modelU->save()) {
            //$person = User::find()->where(['nu_num_cpf' => $user['nu_num_cpf']])->all();
            $auth = Yii::$app->authManager;
            $visitante = $auth->getRole('visitante');
            $auth->assign($visitante, $modelU->getId());
            $modelU->inscricaoEnvio(Yii::$app->params['adminEmail']);
            $token = (string) User::generateUserToken($modelU);
            return $this->asJson([
                'created' => true,
                'token' => $token,
                'message' => 'SignUp Válido',
                'data' => $modelU->fields(),
                'code' => 200,
            ]);
        } else {
            $msg = '';
            $error = $modelU->getErrors();
            foreach ($error as $val) {
                $msg .= implode('[', $val);
                $msg .= ' '; // add separator between sub-arrays
            }
            $msg = rtrim($msg, '['); // remove last separator

            Yii::$app->response->statusCode = $error === null ? 400 : 422;
            return $this->asJson([
                'created' => false,
                'message' => $msg,
                'code' => $error === null ? 400 : 422,
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $user = Yii::$app->getRequest()->getQueryParams();
        $modelU = new User();
        $modelU->scenario = User::SCENARIO_LOGIN;
        if ($modelU->load(Yii::$app->getRequest()->getQueryParams(), '') && $modelU->login()) {
            $modelU = $this->findModel(Yii::$app->user->id);
            $token = (string) User::generateUserToken($modelU);
            return $this->asJson([
                'authenticated' => true,
                'token' => $token,
                'message' => 'Login Válido',
                'userData' => [$modelU->fields()],
            ]);
        } else {
            Yii::$app->response->statusCode = 401;
            return $this->asJson([
                'authenticated' => false,
                'message' => 'Login Inválido',
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response|string
     */
    public function actionLogout()
    {
        $sis = Yii::$app->getRequest()->getQueryParams();
        if ((!Yii::$app->user->isGuest) && ($sis['systemlog'] == 'APP')){
            $useName = Yii::$app->user->identity->name ?? 'No Login';
            Yii::$app->user->logout(true);
            return $this->asJson([
                'logoutData' => [
                    [
                        'name' => $useName,
                        'message' => 'Logout feito com sucesso.',
                        'success' => true,
                        'status' => 'Ok',
                    ],
                ]
            ]);
        } else {
            Yii::$app->response->statusCode = 423;
            return $this->asJson([
                'logoutData' => [
                    [
                        'name' => 'Falha Logout',
                        'message' => 'Logout falhou.',
                        'success' => false,
                        'status' => 'Ok',
                    ],
                ]
            ]);
        }
    }

    /**
     * Requests password reset.
     *
     * @return Response|string
     */
    public function actionRequestPasswordReset()
    {
        $email = Yii::$app->getRequest()->getQueryParam('email');
        $modelRPW = new PasswordResetRequestForm();

        if ($modelRPW->load(Yii::$app->getRequest()->getQueryParams(), '') && $modelRPW->validate()) {
            if ($modelRPW->sendEmail()) {
                return $this->asJson([
                    'resetData' => [
                        [
                            'name' => 'Localizado',
                            'message' => 'Verifique seu e-mail para obter mais instruções.',
                            'success' => true,
                            'status' => 'Ok',
                        ],
                    ],
                ]);
            } else {
                Yii::$app->response->statusCode = 423;
                return $this->asJson([
                    'resetData' => [
                        [
                            'name' => 'Não localizado',
                            'message' => 'Desculpe, não podemos redefinir a senha para o endereço de e-mail fornecido.',
                            'success' => false,
                            'status' => 'Erro',
                        ],
                    ],
                ]);
            }
        } else {
            Yii::$app->response->statusCode = 423;
            return $this->asJson([
                'resetData' => [
                    [
                        'name' => 'Não localizado',
                        'message' => 'Desculpe, não há usuário com este endereço de e-mail.',
                        'success' => false,
                        'status' => 'Erro',
                    ],
                ],
            ]);
        }
    }

    /**
     * Requests password reset desk.
     *
     * @return mixed
     */
    public function actionRequestPasswordResetDesk()
    {
        $modelU = new PasswordResetRequestForm();
        if ($modelU->load(Yii::$app->request->post()) && $modelU->validate()) {
            if ($modelU->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Verifique seu e-mail para obter mais instruções.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Desculpe, não podemos redefinir a senha para o endereço de e-mail fornecido.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'modelU' => $modelU,
        ]);
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

    /**
     * Change User password.
     *
     * @return mixed
     * @param integer $id
     * @return mixed
     */
    public function actionChangePassword($id)
    {
        $modelU = $this->findModel($id);
        $modelU->scenario = $modelU::SCENARIO_CHANGEPWD;
        if ($modelU->load(Yii::$app->request->post()) && $modelU->save()) {
            if ($modelU->validate()) {
                $modelU->password = $modelU->setPassword($modelU->new_password);
                if ($modelU->save()) {
                    Yii::$app->session->setFlash('success', 'Senha alterada com sucesso.');
                    return $this->redirect(['/site/index']);
                } else {
                    Yii::$app->session->setFlash('success', 'Senha não alterada.');
                    return $this->redirect(['/site/index']);
                }
            }
        }
        return $this->render('changepassword', ['modelU' => $modelU]);
    }

    /* public function actionLoadImage($id) {
    $model=$this->findModel($id);
    $this->renderPartial('avatar', array(
    'model'=>$model
    ));
    } */

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
