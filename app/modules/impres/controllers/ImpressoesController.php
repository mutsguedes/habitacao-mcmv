<?php

namespace app\modules\impres\controllers;

use Yii;
use Mpdf\Mpdf;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;

/**
 * Description of ImpressoesController
 *
 * @author marcos
 */
class ImpressoesController extends Controller
{
    /*
      /**
     * {@inheritdoc}
     *
      public function behaviors() {
      return [
      'verbs' => [
      'class' => VerbFilter::class,
      'actions' => [
      'delete' => ['POST'],
      ],
      ],
      ];
      } */

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
                        if (\Yii::$app->user->can($route)) {
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Displays a single Inumados model.
     * @param integer $idRes
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionImpView($idRes)
    {
        return $this->render('_impressao', [
            'modelR' => Responsavel::findOne($idRes), 'idRes' => $idRes,
        ]);
    }

    /**
     * Displays a single Responsável model.
     * @param integer $idRes
     * @param string  $dtDoc
     * @return mixed
     * @throws NotFoundHttpException if the model$pdfP->AddPage('L') cannot be found
     */
    public function actionImpFicha($idRes, $dtDoc)
    {
        $modelD = new Dependente;
        $_checkbox = Yii::$app->request->post('fichas');
        $stylebootstrap = file_get_contents('css/main.css');
        $pdf = new Mpdf([
            'mode' => 'pt_BR.utf-8',
            'tempDir' => __DIR__ . '/temp',
            // 'format' => [190, 236], 
            'orientation' => 'L'
        ]);
        $pdf->WriteHTML($stylebootstrap, 1);
        $qtlin = 1;
        if (isset($_checkbox)) {
            foreach ($_checkbox as $ficha) {
                $copdoc = 0;
                if ($ficha == 'copdoc') {
                    $pdf->AddPageByArray([
                        //'margin-left' => '8',
                        //'margin-right' => '8',
                        'margin-top' => '8',
                        'margin-bottom' => '8',
                        'orientation' => 'L'
                    ]);
                } else {
                    if ($ficha != 'todos') {
                        $pdf->AddPageByArray([
                            //'margin-left' => '8',
                            //'margin-right' => '8',
                            'margin-top' => '15',
                            'margin-bottom' => '8',
                            'orientation' => 'P'
                        ]);
                    }
                }
                switch ($ficha) {
                    case 'acocad':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'comins':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'decben':
                        $modelD = Dependente::find()
                            ->andWhere(['id_num_res' => $idRes])
                            ->andWhere(['bo_reg_exc' => 0])
                            ->all();
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                            'modelD' => $modelD,
                        ]), 2);
                        break;
                    case 'decaus':
                        $modelD = Dependente::find()
                            ->andWhere(['id_num_res' => $idRes])
                            ->andWhere([
                                'OR',
                                ['id_num_par' => 4],
                                ['id_num_par' => 9]
                            ])
                            ->andWhere(['bo_reg_exc' => 0])
                            ->one();
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                            'modelD' => $modelD,
                        ]), 2);
                        break;
                    case 'declei':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'terdespro':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'terdescad':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'terdessor':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'terdescom':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'copdoc':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'terdes':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    case 'decposuni':
                        $modelD = Dependente::find()
                            ->andWhere(['id_num_res' => $idRes])
                            ->andWhere([
                                'OR',
                                ['id_num_par' => 4],
                                ['id_num_par' => 9],
                                ['id_num_par' => 15],
                            ])
                            ->andWhere(['bo_reg_exc' => 0])
                            ->one();
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                            'modelD' => $modelD,
                        ]), 2);
                        break;
                    case 'decneguni':
                        $pdf->WriteHTML($this->renderPartial($ficha, [
                            'modelR' => Responsavel::findOne($idRes),
                            'dtDoc'=>$dtDoc,
                        ]), 2);
                        break;
                    default:
                        break;
                }
                $qtlin++;
            }
            return $pdf->Output();
        } else {
            $pdf->WriteHTML('<h1>Favor selecionar um ficha  !!!</h1>');
            return $pdf->Output();
        }
    }
}
