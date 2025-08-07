<?php

namespace app\modules\agenda\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;


/**
 * AdmAgendaController implements the ADM actions for Agenda model.
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
}