<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\web\Response;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\JsExpression;
use yii\httpclient\Client;
use app\models\ContactForm;
use yii\filters\VerbFilter;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use app\components\MarArtHelpers;
use app\modules\user\models\User;
use app\modules\auxiliar\models\GerCras;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     *
     **/
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index', 'signup', 'login', 'login-nav', 'about', 'contact', 'create-email', 'user-session-update',
                            'captcha', 'error', 'request-password-reset', 'reset-password', 'get-system', 'get-signup', 'get-cras',
                        ],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'index', 'signup', 'login', 'login-nav', 'indicador', 'about', 'contact', 'get-cras',
                            'get-system', 'get-signup', 'user-session-update', 'captcha', 'error', 'logout', 'about',
                            'get-deficiencia', 'get-escolaridade', 'get-genero', 'get-naturalidade',
                            'get-nacionalidade', 'get-pessoa', 'get-renda'
                        ],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * actions
     *
     * @return void
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            /*Yii::$app->session->setFlash('', [
                'title' => 'Iniciando...',
                'html' => 'Favor aguarde...',
                'icon' => 'info',
                'allowEscapeKey' => false,
                'allowOutsideClick' => false,
                'backdrop' => 'rgba(91,192,222,0.4)',
                'didOpen' => new JsExpression(
                    "
                    () => {
                        Swal.showLoading();
                    }"
                ),
            ]);*/
            /* Schedules */

            /*$dateYear = date('Y');

            $all_dat_hol = ['results' => ['dt_age_fer' => '']];
            $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl([
                    'api/agendas/get-all-holiday',
                    'dateYear' =>  $dateYear,
                ])
                ->send();
            if ($response->isOk) {
                $all_dat_hol = $response->data['data'];
            }
            Yii::$app->session->set('all_date_holiday', $all_dat_hol);


            $all_dat_dis = ['results' => ['dt_age_dat' => '']];
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl([
                    'api/agendas/get-all-date-disable',
                ])
                ->send();
            if ($response->isOk) {
                $all_dat_dis = $response->data['data'];
            }
            Yii::$app->session->set('all_date_disable', $all_dat_dis);

            $all_subject = ['results' => ['id_num_ass' => '', 'nm_nom_ass' => '']];
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl([
                    'api/agendas/get-all-subject',
                ])
                ->send();
            if ($response->isOk) {
                $all_subject = $response->data['data'];
            }
            Yii::$app->session->set('all_subject', $all_subject);

            $all_month = ['results' => ['nu_num_mes' => '']];
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl([
                    'api/agendas/get-all-enable-month'
                ])
                ->send();
            if ($response->isOk) {
                $all_month = $response->data['data'];
            }
            Yii::$app->session->set('all_month', $all_month);*/
            /* Schedules */
        }
        //return true;
        return parent::beforeAction($action);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if ($exception->statusCode == 403) {
                return $this->render('error/error', ['exception' => $exception]);
            } elseif ($exception == 404) {
                return $this->render('error/error', ['exception' => $exception]);
            }
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws Exception
     */
    public function actionIndex()
    {
        /* Schedules 

        $dateYear = date('Y');

        $all_dat_hol = ['results' => ['dt_age_fer' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'api/agendas/get-all-holiday',
                'dateYear' =>  $dateYear,
            ])
            ->send();
        if ($response->isOk) {
            $all_dat_hol = $response->data['data'];
        }
        Yii::$app->session->set('all_date_holiday', $all_dat_hol);


        $all_dat_dis = ['results' => ['dt_age_dat' => '']];
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'api/agendas/get-all-date-disable',
            ])
            ->send();
        if ($response->isOk) {
            $all_dat_dis = $response->data['data'];
        }
        Yii::$app->session->set('all_date_disable', $all_dat_dis);

        $all_subject = ['results' => ['id_num_ass' => '', 'nm_nom_ass' => '']];
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'api/agendas/get-all-subject',
            ])
            ->send();
        if ($response->isOk) {
            $all_subject = $response->data['data'];
        }
        Yii::$app->session->set('all_subject', $all_subject);

        $all_month = ['results' => ['nu_num_mes' => '']];
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl([
                'api/agendas/get-all-enable-month'
            ])
            ->send();
        if ($response->isOk) {
            $all_month = $response->data['data'];
        }
        Yii::$app->session->set('all_month', $all_month);
        /* Schedules */
        return $this->render('index');
    }

    /* Busca CRAS do Município. */

    public function actionGetCras()
    {
        $resultCra = [];
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



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $modelU = new User();
        $modelU->scenario = User::SCENARIO_LOGIN;
        if ($modelU->load(Yii::$app->request->post()) && $modelU->login()) {
            if ($modelU->systemlog === '2') {
                Yii::$app->session->set('sistema', 'MCMV');
            } else if ($modelU->systemlog === '3') {
                Yii::$app->session->set('sistema', 'PAC');
            } else if ($modelU->systemlog === '5') {
                Yii::$app->session->set('sistema', 'PHPMI');
            }
            return $this->redirect('\site\index');
            // return $this->goBack();
        } else {
            return $this->render('login', [
                'modelU' => $modelU,
            ]);
        }
    }

    /**
     * LoginNav action.
     *
     * @return Response|string
     */
    public function actionLoginNav()
    {
        if (Yii::$app->request->post()) {
            $model = new User();
            $model->scenario = User::SCENARIO_LOGIN;
            $model->systemlog = Yii::$app->request->post('systemlog');
            $model->userlog = Yii::$app->request->post('userlog');
            $model->password = Yii::$app->request->post('password');
            if (Yii::$app->request->post('systemlog') === '2') {
                Yii::$app->session->set('sistema', 'MCMV');
            } else if (Yii::$app->request->post('systemlog') === '3') {
                Yii::$app->session->set('sistema', 'PAC');
            } else if (Yii::$app->request->post('systemlog') === '5') {
                Yii::$app->session->set('sistema', 'PHPMI');
            }
            if ($model->login()) {
                return $this->redirect("\site\index");
            } else {
                Yii::$app->session->setFlash('error', 'Usuário ou Senha incorretos.');
                return $this->redirect('\site\index');
            }
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Obrigado por nos contatar. Nós responderemos o mais rápido possível.');
            } else {
                Yii::$app->session->setFlash('error', 'Houve um erro ao enviar a sua mensagem');
            }
            return $this->redirect("\site\index");
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Choice System
     *
     * @return mixed
     */
    public function actionGetSystem()
    {
        $idSis = Yii::$app->request->post('idSis');
        if ($idSis === '2') {
            Yii::$app->session->set('sistema', 'MCMV');
        } else if ($idSis === '3') {
            Yii::$app->session->set('sistema', 'PAC');
        } else if ($idSis === '5') {
            Yii::$app->session->set('sistema', 'PHPMI');
        }
        return $this->redirect('\site\index');
    }

    /**
     * Choice SignUp
     *
     * @return mixed
     */
    public function actionGetSignup()
    {
        $idSig = Yii::$app->request->post('idSig');
        if ($idSig === '2') {
            Yii::$app->session->set('signup', 'CIDADAO');
        } else if ($idSig === '3') {
            Yii::$app->session->set('signup', 'FUNCIONARIO');
        }
        return $this->redirect('\web\user\user\create');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect("\site\index");
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
