<?php

namespace app\modules\agenda\controllers;

use Yii;
use DateTime;
use Exception;
use Mpdf\Mpdf;
use Mpdf\Tag\Br;
use DateInterval;
use Da\QrCode\Label;
use yii\helpers\Url;
use Da\QrCode\QrCode;
use yii\web\Response;
use yii\base\Security;
use yii\web\Controller;
use yii\web\JsExpression;
use yii\httpclient\Client;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use dominus77\sweetalert2\Alert;
use app\components\MarArtHelpers;
use yii\web\NotFoundHttpException;
use app\modules\res\models\Responsavel;
use app\modules\agenda\models\AgendaSearch;
use Da\QrCode\Contracts\ErrorCorrectionLevelInterface;
use app\modules\agenda\models\Agenda;

/**
 * AgendaController implements the CRUD actions for Agenda model.
 */
class AgendasController extends Controller
{
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
                    }
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Agenda models.
     * @return mixed
     */
    public function actionIndex()
    {
        try {
            $searchModel = new AgendaSearch();

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination = ['defaultPageSize' => 17, 'pageSizeLimit' => 200];

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e);
        }
    }

    /**
     * Lists all Vacancies models.
     * @param array month
     * @return mixed
     */
    public function actionIndexVag(array $month)
    {
        return $this->render('_form-month-vacancies', [
            'month' =>  $month,
        ]);
    }


    /**
     * Lists all Vacancies models.
     * @return mixed
     */
    public function actionIndexIni()
    {
        $month = Yii::$app->request->post();

        //Url::to(['post/index'], 'https')

        return $this->redirect(['pre-create', 'month' =>  $month['data'],]);
    }


    /**
     * Lists all Vacancies models.
     * @return mixed
     */
    public function actionTeste2()
    {
        /* $security = new Security();
        $string = Yii::$app->request->post('string');
        $stringHash = '';
        if (!is_null($string)) {
            $stringHash = $security->generatePasswordHash($string);
        }
        return $this->render('form-submission', [
            'stringHash' => $stringHash,
        ]); */
    }


    /**
     * Lists all Agenda models for person.
     * @param integer $cpfCid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIndexCidadao($cpfCid)
    {
        try {
            $searchModel = new AgendaSearch();
            $query = Agenda::find()
                ->where(['nu_num_cpf' => $cpfCid])
                ->andWhere(['in', 'id_num_sta', [1, 2, 10, 15]])
                ->orderBy('dt_age_dat', 'ti_age_hor');
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination = ['defaultPageSize' => 17, 'pageSizeLimit' => 200];
            $dataProvider->query = $query;

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e);
        }
    }

    /**
     * Before Creates a new Agenda model.
     * 
     * @param array month
     * @return mixed
     */
    public function actionPreCreate()
    {
        $modelA = new Agenda();
        $modelA->id_num_ass = 10;
        $modelA->id_num_sta = 1;
        $datesValidate = [];
        $datesDisableFer = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-holiday'), 'dt_age_fer');
        $datesDisableDay = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-date-disable'), 'dt_age_dat');
        $datesDisableDate = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-full-date'), 'dt_age_dat');

        $datesValidate = array_merge($datesDisableFer, $datesDisableDay, $datesDisableDate);


/*         echo print_r('$datesDisableFer - ' . implode(",", $datesDisableFer)) . "<br>";
        echo print_r('$datesDisableDay - ' . implode(",", $datesDisableDay)) . "<br>";
        echo print_r('$datesDisableDate - ' . implode(",", $datesDisableDate)) . "<br>";
        echo print_r('$datesValidate - ' . implode(",", $datesValidate)) . "<br>";

        die(); */

        unset($datesValidate['results']);

        return $this->render('_form_dados_appointments', [
            'modelA' => $modelA,
            'datesValidate' => $datesValidate,
            // 'month' =>  $month['data'],
        ]);
    }

    /**
     * Creates a new Agenda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param string $date
     * @param string $time
     * @return mixed
     */
    public function actionCreate($date, $time)
    {

        $modelA = new Agenda();
        $modelA->dt_age_dat = date('Y-m-d', strtotime($date));
        $modelA->ti_age_hor = $time;
        $modelA->id_num_ass = 10;
        $modelA->id_num_sta = 1;

        $data = Yii::$app->request->post();

        if (count($data) != 0) {
            $idUser = Yii::$app->user->identity->id;
            $data['Agenda'] += ['dt_age_dat' => $modelA->dt_age_dat];
            $data['Agenda'] += ['ti_age_hor' => $modelA->ti_age_hor];
            $data['Agenda'] += ['id_num_sta' => $modelA->id_num_sta];
            $data['Agenda'] += ['id_num_cri' => $idUser];
            $data['Agenda'] += ['id_num_mod' => $idUser];
            // array_push($data['Agenda'], ['nu_num_mes' => $modelA->dt_age_dat,  'ti_age_hor' => $modelA->ti_age_hor,]);
            $agenda = Yii::$app->runAction('/agenda/agendas/set-schedule', ['schedule' => $data]);


            if ($agenda['created']) {
                Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, [
                    'title' => 'Criar Agenda',
                    'text' => $agenda['message'],
                    'buttonsStyling' => false,
                    'confirmButtonClass' => "btn btn-md btn-outline-success mr-md-2",
                    'animation' => false,
                    'customClass' => "animated wobble",
                    'allowOutsideClick' => false,
                    'allowEscapeKey' => false,
                    'backdrop' => "rgba(92, 184, 92, 0.4)",
                    'confirmButtonText' => 'Ok',
                    /* 'callback' => new \yii\web\JsExpression(
                            "function (result) {window.history.back()}"
                        ), */
                ]);
                $idAge = $agenda['data'][0]['id_num_age'];
                return $this->redirect(['view', 'idAge' => $idAge]);
            } else {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    'title' => 'Error Criar Agenda',
                    'text' => $agenda['message'],
                    'buttonsStyling' => false,
                    'confirmButtonClass' => "btn btn-md btn-outline-success mr-md-2",
                    'animation' => false,
                    'customClass' => "animated wobble",
                    'allowOutsideClick' => false,
                    'allowEscapeKey' => false,
                    'backdrop' => "rgba(217, 83, 79, 0.4)",
                    'confirmButtonText' => 'Ok',
                    'footer' => $agenda['dtUltAge'] . '<br>' . $agenda['dtLibAge'],
                    /* 'callback' => new \yii\web\JsExpression(
                        "function() {window.history.back()}"
                    ), */

                ]);
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            return $this->render('_form_dados_age', [
                'modelA' => $modelA,
            ]);
        }
    }

    /**
     * Before Update a Agenda model.
     * 
     * @param integer $idAge
     * @return mixed
     */
    public function actionPreUpdate($idAge)
    {
        $modelA = $this->findModel($idAge);

        $datesValidate = [];
        $datesDisableFer = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-holiday'), 'dt_age_fer');
        $datesDisableDay = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-date-disable'), 'dt_age_dat');
        //$datesDisableDay = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-validate-day'), 'dt_age_dat');
        $datesDisableDate = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-full-date'), 'dt_age_dat');

        $datesValidate = array_merge($datesDisableFer, $datesDisableDay, $datesDisableDate);

        unset($datesValidate['results']);

        return $this->render('_form_dados_appointments', [
            'modelA' => $modelA,
            'datesValidate' => $datesValidate,
        ]);
    }

    /**
     * Updates an existing Agenda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idAge
     * @param string $date
     * @param string $time
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idAge, $date, $time)
    {
        $modelA = $this->findModel($idAge);

        if (strlen($date) != 0) {
            $modelA->dt_age_dat = date('Y-m-d', strtotime($date));
            $modelA->ti_age_hor = $time;
        }

        $data = Yii::$app->request->post();

        if (count($data) != 0) {
            $idUser = Yii::$app->user->identity->id;
            $data['Agenda'] += ['id_num_age' => $modelA->id_num_age];
            $data['Agenda'] += ['dt_age_dat' => $modelA->dt_age_dat];
            $data['Agenda'] += ['dt_age_old' => $modelA->getOldAttribute('dt_age_dat')];
            $data['Agenda'] += ['ti_age_hor' => $modelA->ti_age_hor];
            $data['Agenda'] += ['ti_age_old' => $modelA->getOldAttribute('ti_age_hor')];
            $data['Agenda'] += ['id_num_sta' => $modelA->id_num_sta];
            $data['Agenda'] += ['id_num_cri' => $modelA->id_num_cri];
            $data['Agenda'] += ['id_num_mod' => $idUser];

            $agenda = Yii::$app->runAction('/agenda/agendas/put-schedule', ['schedule' => $data]);

            if ($agenda['updated']) {
                Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, [
                    'title' => 'Editar Agenda',
                    'text' => $agenda['message'],
                    'buttonsStyling' => false,
                    'confirmButtonClass' => "btn btn-md btn-outline-success mr-md-2",
                    'animation' => false,
                    'customClass' => "animated wobble",
                    'allowOutsideClick' => false,
                    'allowEscapeKey' => false,
                    'backdrop' => "rgba(92, 184, 92, 0.4)",
                    'confirmButtonText' => 'Ok',
                    /* 'callback' => new \yii\web\JsExpression(
                            "function (result) {window.history.back()}"
                        ), */
                ]);
                $idAge = $agenda['data']['id_num_age'];
                return $this->redirect(['view', 'idAge' => $idAge]);
            } else {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
                    'title' => 'Error Editar Agenda',
                    'text' => $agenda['message'],
                    'buttonsStyling' => false,
                    'confirmButtonClass' => "btn btn-md btn-outline-success mr-md-2",
                    'animation' => false,
                    'customClass' => "animated wobble",
                    'allowOutsideClick' => false,
                    'allowEscapeKey' => false,
                    'backdrop' => "rgba(217, 83, 79, 0.4)",
                    'confirmButtonText' => 'Ok',
                    'footer' => $agenda['dtUltAge'],
                    /* 'callback' => new \yii\web\JsExpression(
                            "function (result) {window.history.back()}"
                        ), */
                ]);
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            return $this->render('_form_dados_age', [
                'modelA' => $modelA,
            ]);
        }
    }

    /**
     * Create schedule of User
     * @param array schedule
     * @return Response|string
     */
    public function actionSetSchedule(array $schedule)
    {
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/set-user-schedule',
            ])
            ->setData($schedule['Agenda'])
            ->send();

        return $response->data;
    }

    /**
     * Update schedule of User
     * @param array schedule
     * @return Response|string
     */
    public function actionPutSchedule(array $schedule)
    {
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/put-user-schedule',
            ])
            ->setData($schedule['Agenda'])
            ->send();

        return $response->data;
    }

    /**
     * Lists all Subject.
     * @return Response|string
     */
    public function actionGetSubject()
    {
        $out = ['results' => ['id_num_ass' => '', 'nm_nom_ass' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/get-all-subject',
            ])
            ->send();
        if ($response->isOk) {
            $out = $response->data['data'];
        }
        return $out;
    }

    /**
     * Lists all State.
     * @return Response|string
     */
    public function actionGetState()
    {
        $out = ['results' => ['id_num_sta' => '', 'nm_nom_sta' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/get-all-state',
            ])
            ->send();
        if ($response->isOk) {
            $out = $response->data['data'];
        }
        return $out;
    }

    /**
     * Lists all validate allTime.
     * @param string $dt
     * @return Response|string
     */
    public function actionGetTime($dt)
    {
        $out = ['results' => ['id_age_hor' => '', 'ti_age_hor' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/get-all-day-time',
                'date' => date_format(date_create($dt), 'Y-m-d')
            ])
            ->send();
        if ($response->isOk) {
            $out = $response->data['data'];
        }
        return $out;
    }

    /**
     * Lists all validate allTime.
     * @return Response|string
     */
    public function actionGetHoliday()
    {
        $dateNow = date("Y-m-d");
        $dateYear = date('Y', strtotime($dateNow));
        $out = ['results' => ['dt_age_fer' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/get-all-holiday',
                'dateYear' =>  $dateYear,
            ])
            ->send();
        if ($response->isOk) {
            $out = $response->data['data'];
        }
        return $out;
    }

    /**
     * Lists all full date.
     * @return Response|string
     */
    function actionGetFullDate()
    {
        $dateNow = date("Y-m-d");
        $dateYear = date('Y', strtotime($dateNow));
        $dateMonth = date('m', strtotime($dateNow));
        $out = ['results' => ['dt_age_dat' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/get-all-full-date',
                'dateYear' =>  $dateYear,
                'dateMonth' =>  $dateMonth,
            ])
            ->send();
        if ($response->isOk) {
            $out = $response->data['data'];
        }
        return $out;
    }


    /**
     * Lists all Date Disable.
     * @return Response|string
     */
    public function actionGetDateDisable()
    {
        $dateNow = date("Y-m-d");
        $dateYear = date('Y', strtotime($dateNow));
        $dateMonth = date('m', strtotime($dateNow));
        $out = ['results' => ['dt_age_dat' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'agendas/get-all-date-disable',
                'dateYear' =>  $dateYear,
                'dateMonth' =>  $dateMonth,
            ])
            ->send();
        if ($response->isOk) {
            $out = $response->data['data'];
        }
        return $out;
    }

    /**
     * Lists all validate Dates for Month.
     * 
     * @param string $dateYear, $dateMonth
     * @return mixed
     */
    public function actionGetValidateDates($dateYear, $dateMonth)
    {
        $datesFullMonth = ArrayHelper::getColumn($datesFullMonth = MarArtHelpers::getFullDays($dateYear, $dateMonth, '01'), 'dt_age_dat');
        $datesDisableFer = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-holiday'), 'dt_age_fer');
        $datesDisableDay = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-validate-day'), 'dt_age_dat');
        $datesDisableDate = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-full-date'), 'dt_age_dat');

        $datesValidate = array_diff(
            empty(implode($datesFullMonth)) ? ['01-01-2000'] : $datesFullMonth,
            empty(implode($datesDisableFer)) ? ['01-01-2000'] : $datesDisableFer,
            empty(implode($datesDisableDay)) ? ['01-01-2000'] : $datesDisableDay,
            empty(implode($datesDisableDate)) ? ['01-01-2000'] : $datesDisableDate
        );

        /* return $this->render('_form_dados_appointments', [
            'datesValidate' => $datesValidate,
        ]); */

        return $this->render('_form-day-vacancies', [
            'datesValidate' => $datesValidate,
        ]);
    }

    /**
     * Get Counter Vacancies for Month.
     * 
     * @return response|string
     */
    public function actionGetCounterMonth()
    {
        $dt = [];
        $enbMonth = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-enable-month'), 'nu_num_mes');
        for ($i = 1; $i <= 12; $i++) {
            $dateNow = date("Y-m-d");
            $date = date("Y-m-d", strtotime('01-' . $i . '-' . date('Y', strtotime($dateNow))));
            $dateYear = date('Y', strtotime($date));
            $dateMonth = date('n', strtotime($date));
            if (in_array($dateMonth, $enbMonth)) {
                $datesFullMonth = ArrayHelper::getColumn($datesFullMonth = MarArtHelpers::getFullDays($dateYear, $dateMonth, '01'), 'dt_age_dat');
                $datesDisableFer = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-holiday'), 'dt_age_fer');
                $datesDisableDay = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-validate-day'), 'dt_age_dat');
                $datesDisableDate = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-full-date'), 'dt_age_dat');
                $qtdTotal = 0;

                $datesValidate = array_diff(
                    empty(implode($datesFullMonth)) ? ['01-01-2000'] : $datesFullMonth,
                    empty(implode($datesDisableFer)) ? ['01-01-2000'] : $datesDisableFer,
                    empty(implode($datesDisableDay)) ? ['01-01-2000'] : $datesDisableDay,
                    empty(implode($datesDisableDate)) ? ['01-01-2000'] : $datesDisableDate
                );
                foreach ($datesValidate as $value) {
                    $timesMonth = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-time', ['dt' => $value]), 'nu_qtd_hor');

                    $qdtTimes = count($timesMonth);

                    $qtdTotal = $qtdTotal + $qdtTimes;
                }
            } else {
                $qtdTotal = 0;
            }

            array_push($dt, ['nu_num_mes' => $i,  'nu_num_ano' => $dateYear, 'nm_nom_mes' => ucfirst(Yii::$app->formatter->asDate(strtotime($date), 'php:F')), 'nu_qtd_tot' => $qtdTotal]);
        }
        return $dt;
    }

    /**
     * Get Counter Vacancies for Month.
     * 
     * @param string $date
     * @return mixed
     */
    public function actionGetCounterDay($date)
    {
        $timesMonth = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-time', $params = ['dt' => $date]), 'nu_qtd_hor');

        $qdtTimes = count($timesMonth);

        return $qdtTimes;
    }

    /**
     * Lists all validate Times for Day.
     * 
     * @param string $date
     * @return mixed
     */
    public function actionGetValidateTimes($date)
    {

        $timesDay = ArrayHelper::getColumn(Yii::$app->runAction('/agenda/agendas/get-time', ['dt' => $date]), 'ti_age_hor');
        return $this->render('_form-time-vacancies', [
            'timesDay' => $timesDay,
            'date' => $date,
        ]);
    }


    /**
     * Lists all enable month.
     * 
     * @return Response|string
     */
    function actionGetEnableMonth()
    {
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL_API']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                '/agendas/get-all-enable-month'
            ])
            ->send();
        if ($response->isOk) {
            $out = $response->data['data'];
        }
        return $out;
    }

    /**
     * Displays a single Agenda PDF.
     * 
     * @param integer $idAge
     * @return mixed
     * @throws NotFoundHttpException 
     */
    public function actionImpComAge($idAge)
    {
        $stylebootstrap = file_get_contents('css/main.css');
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'tempDir' => __DIR__ . '/temp',
            'orientation' => 'P'
        ]);
        $pdf->WriteHTML($stylebootstrap, 1);
        $pdf->AddPageByArray([
            'margin-top' => '8',
            'margin-bottom' => '8',
        ]);
        $pdf->WriteHTML($this->renderPartial('comage', [
            'modelA' => Agenda::findOne($idAge),
        ]), 2);
        return $pdf->Output();
    }

    /**
     * Displays a single Agenda QrCode.
     * 
     * @param integer $idAge
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQrcode($idAge)
    {
        $qr = Yii::$app->get('qr');

        $url = Url::toRoute(['agenda/agendas/view', 'idAge' => $idAge], 'https');

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', $qr->getContentType());

        return $qr
            ->setText($url)
            ->setEncoding('UTF-8')
            ->writeString();
    }

    /**
     * Displays a single Agenda model.
     * @param integer $idAge
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idAge)
    {
        $label = (new Label('2amigos'))
            ->setFontSize(12);

        $qrCode = (new QrCode('https://2amigos.us'))
            ->setLogo(Yii::getAlias('@webroot') . '/img/habitacaoLogo.png')
            ->setForegroundColor(51, 153, 255)
            ->setBackgroundColor(200, 220, 210)
            ->setEncoding('UTF-8')
            ->setErrorCorrectionLevel(ErrorCorrectionLevelInterface::HIGH)
            ->setLogoWidth(60)
            ->setSize(300)
            ->setMargin(5)
            ->setLabel($label);

        $qrCode->writeFile(Yii::getAlias('@webroot') . '/assets/my-code.png');

        return $this->render('view', [
            'modelA' => $this->findModel($idAge),
        ]);
    }

    /**
     * Displays a single Relatorios Agenda do dia model.
     * 
     * @return mixed
     * @throws NotFoundHttpException if the model$pdfP->AddPage('L') cannot be found
     */
    public function actionPrintScheduleDay()
    {
        $modelA = new Agenda();

        $stylebootstrap = file_get_contents('css/main.css');
        //Pdf success.
        $pdf = new Mpdf([
            'mode' => 'utf-8', 'tempDir' => __DIR__ . '/temp',
            'margin_header' => 5,
            'margin_footer' => 5,
        ]);
        //Pdf erro.
        $pdfE = new Mpdf([
            'mode' => 'utf-8', 'tempDir' => __DIR__ . '/temp',
            'margin_header' => 5,
            'margin_footer' => 5,
        ]);
        $pdf->WriteHTML($stylebootstrap, 1);
        $pdf->SetTitle('MarArt - Agenda do Dia');
        $pdfE->WriteHTML($stylebootstrap, 1);
        $pdfE->SetTitle('MarArt - Agenda do Dia');

        $date = date("Y-m-d");
        $modelA = Agenda::find()
            ->andWhere(['=', 'bo_reg_exc', '0'])
            ->orderBy('ti_age_hor')
            ->andWhere(['dt_age_dat' => $date])
            ->all();

        $pdf->AddPageByArray([
            'margin-left' => '8',
            'margin-right' => '10',
            'margin-top' => '15',
            'margin-bottom' => '10',
        ]);


        $pdf->WriteHTML($this->renderPartial('lisagedia', [
            'modelA' => $modelA,
        ]), 2);

        return $pdf->Output();
    }


    /**
     * Deletes an existing Inumados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idAge
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteFake($idAge)
    {
        $modelA = $this->findModel($idAge);
        $modelA->bo_reg_exc = 1;
        $modelA->id_num_sta = 20;
        $modelA->save(false);
        //return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Agenda model.
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
     * Finds the Agenda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agenda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agenda::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
