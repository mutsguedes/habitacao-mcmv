<?php

namespace app\modules\agepes\controllers;

use app\modules\agepes\models\Events;
use app\modules\agepes\models\EventsSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndexCalendar() {
        $events = Events::find()->all();
        foreach ($events as $event) {
            $id = $event->id;
            $title = $event->title;
            $text = $event->text;
            $start = date("Y-d-mTG:i:sz", strtotime($event->start));
            if ($event->start < $event->end) {
                $end = date("Y-d-mTG:i:sz", strtotime($event->end));
            }
            $allDay = (bool) $event->all_day;
            $color = $event->color_background;
            $textColor = $event->color_text;
            $data[] = $event;
        };
        print_r(Json::encode($data));
        die();
//        echo Json::encode($data);
    }

    /**
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Events model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('_form', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Events();
        /** @var type $postCalendar */
        $postCalendar = Yii::$app->request->post();
        $model->title = $postCalendar->title;
        $model->text = $postCalendar->text;
        $model->start = date("Y-d-mTG:i:sz", strtotime($postCalendar->start));
        if ($postCalendar->start < $postCalendar->end) {
            $model->end = date("Y-d-mTG:i:sz", strtotime($postCalendar->end));
        }
        $model->allDay = (bool) $postCalendar->all_day;
        $model->color = $postCalendar->color_background;
        $model->textColor = $postCalendar->color_text;
        $model->save();

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//        return $this->render('create', [
//                    'model' => $model,
//        ]);
    }

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Events model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
