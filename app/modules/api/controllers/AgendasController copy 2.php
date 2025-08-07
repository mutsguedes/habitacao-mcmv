<?php

namespace app\modules\api\controllers;

use Yii;
use DateTime;
use DateInterval;
use yii\db\Query;
use DateTimeImmutable;
use yii\rest\Controller;
use yii\httpclient\Client;
use yii\helpers\ArrayHelper;
use app\components\MarArtHelpers;
use bizley\jwt\JwtHttpBearerAuth;
use app\modules\api\models\Agenda;
use yii\web\NotFoundHttpException;
use app\modules\api\models\GerState;
use app\modules\api\models\AgendaSearch;
use app\modules\api\models\AgendaHorario;
use app\modules\auxiliar\models\GerAssunto;
use app\modules\api\models\AgendaDateDisable;
use app\modules\api\models\AgendaMonthDisable;
use app\modules\auxiliar\models\AgendaFeriado;

/**
 * AgendasController implements the CRUD actions for Agendas model.
 */
class AgendasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                //'get-person',
                'get-all-schedule',
                'get-all-holiday',
                'get-all-date-disable',
                'get-all-day-time',
                'get-all-subject',
                'get-user-schedule',
                'set-user-schedule',
                'put-user-schedule',
                'get-all-full-date',
                'get-all-full-vacancies',
                'get-all-enable-month',
                'get-counter-month'
            ],
        ];

        return $behaviors;
    }

    /**
     * GetAllSchedule action.
     *
     * @return Response|string
     */
    public function actionGetAllSchedule()
    {
        $date = Yii::$app->getRequest()->getQueryParam('date');
        $mes = date('m', strtotime($date));
        $ano = date('Y', strtotime($date));

        $modelA = Agenda::find()
            ->select('')
            ->where(['=', 'bo_reg_exc', 0])
            ->andWhere(['=', 'YEAR(dt_age_dat)', $ano])
            ->andWhere(['=', 'MONTH(dt_age_dat)', $mes])
            ->orderBy(['dt_age_dat' => 'SORT_ASC', 'ti_age_hor' => 'SORT_ASC'])
            ->all();

        $totDay = (new Query())
            ->select(['dt_age_dat', 'COUNT(*) AS nu_tot_day'])
            ->from('agenda')
            ->where(['=', 'bo_reg_exc', 0])
            ->andWhere(['=', 'YEAR(dt_age_dat)', $ano])
            ->andWhere(['=', 'MONTH(dt_age_dat)', $mes])
            ->orderBy(['dt_age_dat' => 'SORT_ASC', 'ti_age_hor' => 'SORT_ASC'])
            ->groupBy('dt_age_dat')
            ->having(['>=', 'nu_tot_day', 1])
            ->all();

        $totTime = (new Query())
            ->select(['dt_age_dat', 'ti_age_hor', 'COUNT(*) AS nu_tot_tim'])
            ->from('agenda')
            ->where(['=', 'bo_reg_exc', 0])
            ->andWhere(['=', 'YEAR(dt_age_dat)', $ano])
            ->andWhere(['=', 'MONTH(dt_age_dat)', $mes])
            ->orderBy(['dt_age_dat' => 'SORT_ASC', 'ti_age_hor' => 'SORT_ASC'])
            ->groupBy(['dt_age_dat', 'ti_age_hor'])
            ->having(['>=', 'nu_tot_tim', 1])
            ->all();

        //Pega de qtd horário por dia do mês
        $ti_in_day = MarArtHelpers::getGroupArray('dt_age_dat', $totTime);

        //Pega data modificação qtd horário
        $modelT = AgendaHorario::find()
            ->select(['dt_qtd_mod'])
            ->limit(1)
            ->all();

        $dateQtd = ArrayHelper::getColumn($modelT, 'dt_qtd_mod');

        $dt_use_mon = array_keys($ti_in_day);

        $dt_use_mon = array_map(function ($value) {
            return date('d-m-Y', strtotime($value));
        }, $dt_use_mon);

        $dateYear = date('Y', strtotime($date));
        $dateMonth = date('n', strtotime($date));

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

        $all_dt_dis = ['results' => ['dt_age_dat' => '']];
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl([
                'api/agendas/get-all-date-disable',
                'dateYear' =>  $dateYear,
                'dateMonth' =>  $dateMonth,
            ])
            ->send();
        if ($response->isOk) {
            $all_dt_dis = $response->data['data'];
        }

        $in_mon =
            ArrayHelper::getColumn(MarArtHelpers::getFullDays($dateYear, $dateMonth, '01'), 'dt_age_dat');
        $in_hol =
            ArrayHelper::getColumn($all_dat_hol, 'dt_age_fer');

        $in_dis =
            ArrayHelper::getColumn($all_dt_dis, 'dt_age_dat');

        $dt_in_mon = array_values(array_diff(
            empty(implode($in_mon)) ? ['01-01-2000'] : $in_mon,
            empty(implode($in_hol)) ? ['01-01-2000'] : $in_hol,
            empty(implode($in_dis)) ? ['01-01-2000'] : $in_dis,
            //empty(implode($dt_use_mon)) ? ['01-01-2000'] : $dt_use_mon,
        ));

        if (count($modelA) > 0) {
            return [
                'name' => 'Localizada',
                'message' => 'Agenda localizada.',
                'success' => true,
                'status' => 'Ok',
                'dtserver' => date("Y-m-d H:i:s"),
                'dt_qtd_mod' => $dateQtd[0],
                'nu_tot_mon' => count($modelA),
                'nu_tot_day' => $totDay/* array_merge($totDay,array_values($ti_in_day)) */,
                'in_mon' => $in_mon,
                'in_hol' => $in_hol,
                'in_n_dis' => $in_dis,
                'dt_in_mon' => $dt_in_mon,
                'dt_use_mon' => $dt_use_mon,
                'ti_in_day' => $ti_in_day,
                'data' => $modelA,
            ];
        } else if (count($modelA) === 0) {
            return [
                'name' => 'Não localizado',
                'message' => 'Agenda não localizada para este mês.',
                'success' => false,
                'status' => 'Erro',
                'dtserver' => date("Y-m-d H:i:s"),
                'dt_qtd_mod' => '0000-00-00',
                'nu_tot_mon' => 0,
                'nu_tot_day' => 0,
                'ti_in_day' => '',
                'data' => $modelA,
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Agenda não localizada, algum error inesperado.',
                'success' => false,
                'status' => 'Erro',
                'dtserver' => date("Y-m-d H:i:s"),
                'dt_qtd_mod' => '0000-00-00',
                'nu_tot_mon' => 0,
                'nu_tot_day' => 0,
                'ti_in_day' => '',
            ];
        }
    }

    /**
     * Creates a new Agendas model.
     * If creation is successful.
     * @return Response|string
     */
    public function actionSetUserSchedule()
    {
        $modelA = new Agenda();
        $sheduleUser = date_create(Yii::$app->getRequest()->getBodyParam('dt_age_dat'));
        $nuCpf = Yii::$app->getRequest()->getBodyParam('nu_num_cpf');
        $datelibsub = date_create(Yii::$app->getRequest()->getBodyParam('dt_age_dat'));
        $datelibadd = date_create(Yii::$app->getRequest()->getBodyParam('dt_age_dat'));
        $datelibsub->sub(new DateInterval('P1M'));
        $datelibadd->add(new DateInterval('P1M'));
        $dateSearch = Agenda::find()
            ->orWhere(['between', 'dt_age_dat', $datelibsub->format('Y-m-d'), $sheduleUser->format('Y-m-d')])
            ->orWhere(['between', 'dt_age_dat', $sheduleUser->format('Y-m-d'), $datelibadd->format('Y-m-d')])
            ->andWhere(['=', 'nu_num_cpf', $nuCpf])
            ->andWhere(['in', 'id_num_sta', [1, 2]])
            ->orderBy('dt_age_dat', 'ti_age_hor')
            ->all();

        if (count($dateSearch) == 0) {
            $params = Yii::$app->getRequest()->getBodyParams();
            if ($modelA->load($params, '')) {
                $modelA->save();
                $schedule = Agenda::find()->where(['id_num_age' => $modelA->id_num_age])->all();
                return $this->asJson([
                    'created' => true,
                    'message' => 'Agenda do cidadão ' . $modelA->nm_nom_cid . ' CRIADA com sussesso',
                    'data' => $schedule,
                ]);
            } else {
                Yii::$app->response->statusCode = 423;
                return $this->asJson([
                    'created' => false,
                    'message' => 'Falha ao criar agenda.',
                ]);
            };
        } else {
            Yii::$app->response->statusCode = 423;
            $dateultage = date_create($dateSearch[0]['dt_age_dat']);
            $datelibage = date_create($dateSearch[0]['dt_age_dat']);;
            $datelibage->add(new DateInterval('P1M1D'));
            return $this->asJson([
                'created' => false,
                'message' => 'Cidadão com Agenda aberta ou com Agenda no ultimos 30(trinta) dias.',
                'dtUltAge' => 'Última agenda realizada dia ' . $dateultage->format('d-m-Y') .  ' ás ' . $dateSearch[0]['ti_age_hor'] . '.',
                'dtLibAge' => 'Liberação para Agendamento aparti do dia ' . $datelibage->format('d-m-Y') . '.',
            ]);
        }
    }

    /**
     * Updates an existing Agenda model.
     * If update is successful,
     * @return Response|string
     */
    public function actionPutUserSchedule()
    {
        $modelA = Agenda::findOne(Yii::$app->getRequest()->getBodyParam('id_num_age'));

        $oldDate = Yii::$app->getRequest()->getBodyParam('dt_age_dat');
        $oldTime = Yii::$app->getRequest()->getBodyParam('ti_age_hor');
        $sheduleUser = date_create(Yii::$app->getRequest()->getBodyParam('dt_age_dat'));
        $nuCpf = Yii::$app->getRequest()->getBodyParam('nu_num_cpf');
        $datelibsub = date_create(Yii::$app->getRequest()->getBodyParam('dt_age_dat'));
        $datelibadd = date_create(Yii::$app->getRequest()->getBodyParam('dt_age_dat'));
        $datelibsub->sub(new DateInterval('P1M'));
        $datelibadd->add(new DateInterval('P1M'));
        $dateSearch = Agenda::find()
            ->andWhere(['between', 'dt_age_dat', $datelibsub->format('Y-m-d'), $sheduleUser->format('Y-m-d')])
            ->andWhere(['between', 'dt_age_dat', $sheduleUser->format('Y-m-d'), $datelibadd->format('Y-m-d')])
            ->andWhere(['=', 'nu_num_cpf', $nuCpf])
            ->andWhere(['<>', 'dt_age_dat', $oldDate])
            ->andWhere(['<>', 'ti_age_hor', $oldTime])
            ->andWhere(['in', 'id_num_sta', [1, 2, 10, 15]])
            ->orderBy('dt_age_dat', 'ti_age_hor')
            ->all();

        if (count($dateSearch) == 0) {
            if ($modelA->load(Yii::$app->getRequest()->getBodyParams(), '') && $modelA->save()) {
                $schedule = $modelA;
                return $this->asJson([
                    'updated' => true,
                    'message' => 'Agenda do cidadão ' . $modelA->nm_nom_cid . ' EDITADO com sussesso',
                    'data' => $schedule,
                ]);
            } else {
                Yii::$app->response->statusCode = 423;
                return $this->asJson([
                    'updated' => false,
                    'message' => 'Falha ao editar agenda.',
                ]);
            };
        } else {
            Yii::$app->response->statusCode = 423;
            $dateultage = date_create($dateSearch[0]['dt_age_dat']);
            $datelibage = date_create($dateSearch[0]['dt_age_dat']);;
            $datelibage->add(new DateInterval('P1M1D'));
            return $this->asJson([
                'updated' => false,
                'message' => 'Cidadão com Agenda aberta ou com Agenda no ultimos 30(trinta) dias.',
                'dtUltAge' => 'Última agenda realizada dia ' . $dateultage->format('d-m-Y') .  ' ás ' . $dateSearch[0]['ti_age_hor'] . '.',
                'dtLibAge' => 'Liberação para Agendamento aparti do dia ' . $datelibage->format('d-m-Y') . '.',
            ]);
        }
    }

    /**
     * GetALLHoliday action.
     *
     * @return Response|string
     */
    public function actionGetAllHoliday()
    {
        $dateYear = Yii::$app->getRequest()->getQueryParam('dateYear');
        $ano = $dateYear;
        $modelH = AgendaFeriado::find()
            ->orWhere(['=', 'id_tip_fer', '1'])
            ->orWhere(['=', 'id_tip_fer', '3'])
            ->orWhere(['=', 'nm_nom_est', 'RJ'])
            ->orWhere(['=', 'YEAR(dt_age_fer)', $ano])
            ->orderBy('nu_num_mes', 'nu_num_dia')
            ->all();
        if (count($modelH) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Feriados localizados.',
                'success' => true,
                'status' => 'Ok',
                'data' => $modelH,
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Feriados não localizados para este ano.',
                'success' => false,
                'status' => 'Erro',
            ];
        }
    }

    /**
     * Lists all vacancies in Month.
     * 
     * @return Response|string
     */
    public function actionGetAllFullVacancies()
    {
        $dateYear = Yii::$app->getRequest()->getQueryParam('dateYear');
        $dateMonth = Yii::$app->getRequest()->getQueryParam('dateMonth');

        $datesFullMonth = MarArtHelpers::getFullDays($dateYear, $dateMonth, '01');

        if (sizeof($datesFullMonth)) {
            return [
                'name' => 'Localizado',
                'message' => 'Data(s) localizadas.',
                'success' => true,
                'status' => 'Ok',
                'data' => $datesFullMonth
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Data(s) não localizada(s) para este mês.',
                'success' => false,
                'status' => 'Erro',
                'data' => ['dt_age_dat' => ''],
            ];
        }
    }


    /**
     * Get Counter Vacancies for Month.
     * 
     * @return Response|string
     */
    public function actionGetCounterMonth()
    {
        $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
        $dt = [];
        $enbMonth = Yii::$app->runAction('/api/agendas/get-all-enable-month');
        $dates = ArrayHelper::getColumn($enbMonth['data'], 'nu_num_mes');
        foreach ($dates as $value) {
            // for ($i = 1; $i <= 12; $i++) {
            $dateNow = date("Y-m-d");
            $date = date("Y-m-d", strtotime('01-' . $value . '-' . date('Y', strtotime($dateNow))));
            $dateYear = date('Y', strtotime($date));
            $dateMonth = date('n', strtotime($date));

            $datesFullMonth = ArrayHelper::getColumn($datesFullMonth = MarArtHelpers::getFullDays($dateYear, $dateMonth, '01'), 'dt_age_dat');

            $datesDisableFer = ['results' => ['dt_age_fer' => '']];
            $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl([
                    'api/agendas/get-all-holiday',
                    'dateYear' =>  $dateYear,
                ])
                ->send();
            if ($response->isOk) {
                $datesDisableFer = $response->data['data'];
            }

            $datesDisableDay = ['results' => ['dt_age_dat' => '']];
            $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl([
                    'api/agendas/get-all-date-disable',
                    'dateYear' =>  $dateYear,
                    'dateMonth' =>  $dateMonth,
                ])
                ->send();
            if ($response->isOk) {
                $datesDisableDay = $response->data['data'];
            }

            $datesDisableDate = ['results' => ['dt_age_dat' => '']];
            $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl([
                    'api/agendas/get-all-full-date',
                    'dateYear' =>  $dateYear,
                    'dateMonth' =>  $dateMonth,
                ])
                ->send();
            if ($response->isOk) {
                $datesDisableDate = $response->data['data'];
            }

            $holidays = ArrayHelper::getColumn($datesDisableFer, 'dt_age_fer');
            $disabledays = ArrayHelper::getColumn($datesDisableDay, 'dt_age_dat');
            $disabledates = ArrayHelper::getColumn($datesDisableDate, 'dt_age_dat');

            $qtdTotal = 0;

            $datesValidate = array_diff(
                empty(implode($datesFullMonth)) ? ['01-01-2000'] : $datesFullMonth,
                empty(implode($holidays)) ? ['01-01-2000'] : $holidays,
                empty(implode($disabledays)) ? ['01-01-2000'] : $disabledays,
                empty(implode($disabledates)) ? ['01-01-2000'] : $disabledates
            );


            if (in_array($dateMonth, $dates)) {
                foreach ($datesValidate as $dtm) {
                    $timesMonth = ['results' => ['nu_qtd_hor' => '0']];
                    $client = new Client(['baseUrl' => Yii::$app->params['BASE_URL']]);
                    $response = $client->createRequest()
                        ->setMethod('POST')
                        ->setUrl([
                            '/api/agendas/get-all-day-time',
                            'dt' => date('Y-m-d', strtotime($dtm)),
                        ])
                        ->send();
                    if ($response->isOk) {
                        $timesMonth = $response->data['data'];
                    }
                    $times = ArrayHelper::getColumn($timesMonth, 'nu_qtd_hor');

                    $qdtTimes = array_sum($times);

                    $qtdTotal = $qtdTotal + $qdtTimes;
                }
            } else {
                $qtdTotal = 0;
            }

            array_push($dt, [
                'nu_num_mes' => $value,
                'nu_num_ano' => $dateYear, 'nm_nom_mes' => ucfirst(Yii::$app->formatter->asDate(strtotime($date), 'php:F')),
                'nu_qtd_tot' => $qtdTotal
            ]);
        }
        if (count($dt) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Horários localizados.',
                'success' => true,
                'status' => 'Ok',
                'data' => $dt,
            ];
        } else {
            // Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Horários não localizados para data selecionada.',
                'success' => false,
                'status' => 'Erro',
                'data' => ['ti_age_hor' => ''],
            ];
        }
    }

    /**
     * Get all dates in Month.
     * 
     * @return Response|string
     */
    function actionGetAllFullDate()
    {
        $dateYear = Yii::$app->getRequest()->getQueryParam('dateYear');
        $dateMonth = Yii::$app->getRequest()->getQueryParam('dateMonth');
        $date = [];
        $countDate = [];
        $dateFull = [];

        //$sem = date('w', strtotime($date));
        $modelA = Agenda::find()
            //->select(['("day") AS DAY(dt_age_dat), ("week") AS WEEK(dt_age_dat)'])
            ->select(['dt_age_dat'])
            ->andWhere(['=', 'bo_reg_exc', '0'])
            ->andWhere(['=', 'id_num_sta', '1'])
            ->andWhere(['=', 'YEAR(dt_age_dat)', $dateYear])
            // ->andWhere(['=', 'MONTH(dt_age_dat)', $dateMonth])
            ->orderBy('dt_age_dat')
            ->all();

        $date = ArrayHelper::getColumn($modelA, 'dt_age_dat');

        $countDate = array_count_values($date);

        //Pega data modificação qtd horário
        $modelT = AgendaHorario::find()
            ->select(['dt_qtd_mod'])
            ->limit(1)
            ->all();

        $dateQtd = ArrayHelper::getColumn($modelT, 'dt_qtd_mod');

        foreach ($countDate as $key => $value) {
            if (strtotime($key) > strtotime($dateQtd[0])) {
                if (($value >= 9) && (in_array(date('w', strtotime($key)), [1]))) {
                    array_push($dateFull, ['dt_age_dat' => date('d-m-Y', strtotime($key))]);
                }
                if (($value >= 8) && (in_array(date('w', strtotime($key)), [5]))) {
                    array_push($dateFull, ['dt_age_dat' => date('d-m-Y', strtotime($key))]);
                }
                if (($value >= 11) && (in_array(date('w', strtotime($key)), [2, 3, 4]))) {
                    array_push($dateFull, ['dt_age_dat' => date('d-m-Y', strtotime($key))]);
                }
            } else {
                if (($value >= 16) && (in_array(date('w', strtotime($key)), [1, 5]))) {
                    if (in_array(date('w', strtotime($key)), [1, 5])) {
                        array_push($dateFull, ['dt_age_dat' => date('d-m-Y', strtotime($key))]);
                    }
                }
                if (($value >= 24) && (in_array(date('w', strtotime($key)), [2, 3, 4]))) {
                    array_push($dateFull, ['dt_age_dat' => date('d-m-Y', strtotime($key))]);
                }
            }
        }

        if (sizeof($dateFull)) {
            return [
                'name' => 'Localizado',
                'message' => 'Data(s) localizadas.',
                'success' => true,
                'status' => 'Ok',
                'data' => $dateFull
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Data(s) não localizada(s) para este ano.',
                'success' => false,
                'status' => 'Erro',
                'data' => ['dt_age_dat' => ''],
            ];
        }
    }

    /**
     * Get all Dates disabled in Month.
     *
     * @return Response|string
     */
    public function actionGetAllDateDisable()
    {
        $dateYear = Yii::$app->getRequest()->getQueryParam('dateYear');
        $dateMonth = Yii::$app->getRequest()->getQueryParam('dateMonth');
        $ano = $dateYear;
        $mes = $dateMonth;
        $modelD = AgendaDateDisable::find()
            ->andWhere(['=', 'bo_reg_exc', '0'])
            ->orWhere(['=', 'id_num_sta', '7'])
            ->orWhere(['=', 'YEAR(dt_age_dat)', $ano])
            //->orWhere(['=', 'MONTH(dt_age_dat)', $mes])
            ->orderBy('dt_age_dat')
            ->all();
        if (count($modelD) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Dias localizados.',
                'success' => true,
                'status' => 'Ok',
                'data' => $modelD,
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Dias não localizados para este ano.',
                'success' => false,
                'status' => 'Erro',
                'data' => ['dt_age_dat' => ''],
            ];
        }
    }

    /**
     * Get all Subject.
     *
     * @return Response|string
     */
    public function actionGetAllSubject()
    {
        $modelS = GerAssunto::find()
            ->all();
        if (count($modelS) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Assunto localizado.',
                'success' => true,
                'status' => 'Ok',
                'data' => $modelS,
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Assunto não localizado.',
                'success' => false,
                'status' => 'Erro',
            ];
        }
    }

    /**
     * Get all State.
     *
     * @return Response|string
     */
    public function actionGetAllState()
    {
        $modelS = GerState::find()
            ->all();
        if (count($modelS) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Estado localizado.',
                'success' => true,
                'status' => 'Ok',
                'data' => $modelS,
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Estado não localizado.',
                'success' => false,
                'status' => 'Erro',
            ];
        }
    }

    /**
     * Get all Eneble Month.
     *
     * @return Response|string
     */
    public function actionGetAllEnableMonth()
    {
        $date = [];
        $enableMonth = [];
        $modelADM = AgendaMonthDisable::find()
            ->andWhere(['=', 'bo_mes_dis', '0'])
            ->all();

        $date = ArrayHelper::getColumn($modelADM, 'nu_num_mes');

        foreach ($date as  $value) {
            array_push($enableMonth,  ['nu_num_mes' => $value]);
        }

        /*  echo print_r('$modelADM - ' . implode(",", $enableMonth)) . "<br>";

        die(); */

        if (count($enableMonth) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Mês Habilitado localizado.',
                'success' => true,
                'status' => 'Ok',
                'data' => $enableMonth,
            ];
        } else {
            Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Mês Abilitado não localizado.',
                'success' => false,
                'status' => 'Erro',
            ];
        }
    }

    /**
     * Get all Times valid in Month.
     *
     * @return Response|string
     */
    public function actionGetAllMonthTime()
    {
        $dateYear = Yii::$app->getRequest()->getQueryParam('dateYear');
        $dateMonth = Yii::$app->getRequest()->getQueryParam('dateMonth');
        $date = Yii::$app->getRequest()->getQueryParam('date');
    }

    /**
     * Get all Times valid in Day.
     *
     * @return Response|string
     */
    public function actionGetAllDayTime()
    {
        $date = date("Y-m-d", strtotime(Yii::$app->getRequest()->getQueryParam('date')));
        $dia = date('d', strtotime($date));
        $mes = date('m', strtotime($date));
        $ano = date('Y', strtotime($date));
        $sem = date('w', strtotime($date));

        //Todos os agendas da Data fornecida.
        $modelA = Agenda::find()
            ->andWhere(['=', 'bo_reg_exc', '0'])
            ->andWhere(['=', 'YEAR(dt_age_dat)', $ano])
            ->andWhere(['=', 'MONTH(dt_age_dat)', $mes])
            ->andWhere(['=', 'DAY(dt_age_dat)', $dia])
            ->andWhere(['=', 'id_num_sta', 1])
            ->andwhere(['in', 'id_num_sta', [1, 2, 10]])
            /*  ->orWhere(['=', 'id_num_sta', 1])
            ->orWhere(['=', 'id_num_sta', 10]) */
            ->all();

        //Pega todos os horários agendados na Data fornecida.
        $dt = [];
        foreach ($modelA as $value) {
            //  array_push($dt, date('H:i', strtotime($value['ti_age_hor'])));
            array_push($dt, $value['ti_age_hor']);
        }

        //Pega todos os horáros abertos
        $modelT = AgendaHorario::find()
            ->andWhere(['=', 'bo_reg_exc', '0'])
            ->andWhere(['=', 'nu_num_sem', $sem])
            ->andWhere(['=', 'bo_stu_hor', '1'])
            ->orderBy('ti_age_hor')
            ->all();

        $dtOutFaker = [];
        $dtOut = [];

        // Qtd de vagas por horário.

        $qdtHorVag = 1;

        //Fornece todos os horaŕios Válidos e Vagas existente.
        foreach ($modelT as $value) {
            $qtHor = count(array_keys($dt, $value['ti_age_hor']));
            if ($qtHor < $qdtHorVag) {
                if ($date < strtotime('dt_qtd_mod')) {
                    $value['nu_qtd_hor'] = (intval($value['nu_qtd_hor_old']) - $qtHor);
                } else {
                    $value['nu_qtd_hor'] = (intval($value['nu_qtd_hor']) - $qtHor);
                }
                array_push($dtOutFaker, $value['ti_age_hor']);
                array_push($dtOut, $value);
            };
        }
        if (count($dtOut) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Horários localizados.',
                'success' => true,
                'status' => 'Ok',
                'data' => $dtOut,
            ];
        } else {
            // Yii::$app->response->statusCode = 423;
            return [
                'name' => 'Não localizado',
                'message' => 'Horários não localizados para data selecionada.',
                'success' => false,
                'status' => 'Erro',
                'data' => ['ti_age_hor' => ''],
            ];
        }
    }

    /**
     * GetUserSchedule action.
     *
     * @return Response|string
     */
    public function actionGetUserSchedule()
    {
        $cpf = Yii::$app->getRequest()->getQueryParams('cpf');
        $modelA =  Agenda::find()->where(['nu_num_cpf' => $cpf])->all();
        if (count($modelA) > 0) {
            return [
                'name' => 'Localizado',
                'message' => 'Histórico localizado.',
                'success' => true,
                'status' => 'Ok',
                'dtserver' => date("Y-m-d H:i:s"),
                'arr_dat_age' => $modelA,
            ];
        } else {
            return [
                'name' => 'Não localizado',
                'message' => 'Histórico não localizado.',
                'success' => false,
                'dtserver' => date("Y-m-d H:i:s"),
                'status' => 'Erro',
            ];
        }
    }
}
