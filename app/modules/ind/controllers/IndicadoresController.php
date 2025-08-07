<?php

namespace app\modules\ind\controllers;

use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `ind` module
 */
class IndicadoresController extends Controller
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
                    },
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Displays deficiencia page.
     *
     * @return mixed
     */
    public function actionDeficiencia()
    {
        return $this->render('deficiencia');
    }

    /**
     * Displays escolaridade page.
     *
     * @return mixed
     */
    public function actionEscolaridade()
    {
        return $this->render('escolaridade');
    }

    /**
     * Displays genero page.
     *
     * @return mixed
     */
    public function actionGenero()
    {
        return $this->render('genero');
    }

    /**
     * Displays naturalidade page.
     *
     * @return mixed
     */
    public function actionNaturalidade()
    {
        return $this->render('naturalidade');
    }

    /**
     * Displays pessoa page.
     *
     * @return mixed
     */
    public function actionTotalPessoa()
    {
        return $this->render('total-pessoa');
    }

    /**
     * Displays total homens page.
     *
     * @return mixed
     */
    public function actionTotalHomem()
    {
        return $this->render('total-homem');
    }

    /**
     * Displays total mulheres page.
     *
     * @return mixed
     */
    public function actionTotalMulher()
    {
        return $this->render('total-mulher');
    }

    /**
     * Displays total cliente page.
     *
     * @return mixed
     */
    public function actionTotalResponsavel()
    {
        return $this->render('total-responsavel');
    }

    //FUNÇÕES QUE CARREGAM OS JSON

    /* Contador de deficiente físico. */

    public function actionGetDeficiencia()
    {
        $isDef = '((bo_ade_aud = 1 OR bo_ade_fis = 1 OR bo_ade_int = 1 OR bo_ade_nan = 1 OR bo_ade_vis = 1 OR bo_ade_mul = 1) AND (id_cor_sit = 9))';
        $resultDef['total'] = Responsavel::find()
            ->where($isDef)
            ->count();
        $resultDef['auditivo'] = Responsavel::find()
            ->where('bo_ade_aud = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultDef['fisico'] = Responsavel::find()
            ->where('bo_ade_fis = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultDef['intelectual'] = Responsavel::find()
            ->where(' bo_ade_int = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultDef['nanismo'] = Responsavel::find()
            ->where('bo_ade_nan = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultDef['visual'] = Responsavel::find()
            ->where('bo_ade_vis = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultDef['multipla'] = Responsavel::find()
            ->where('bo_ade_vis = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        unset($isDef);
        echo json_encode($resultDef);
    }

    /* Contador de escolaridade. */

    public function actionGetEscolaridade()
    {
        $resultEsc = [];
        $resultEsc['ninformado'] = Responsavel::find()
            ->where('id_gra_ins = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['analfabeto(a)'] = Responsavel::find()
            ->where('id_gra_ins = 2')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['pincompleto'] = Responsavel::find()
            ->where(' id_gra_ins = 3')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['pcompleto'] = Responsavel::find()
            ->where('id_gra_ins = 4')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['sincompleto'] = Responsavel::find()
            ->where('id_gra_ins = 5')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['scompleto'] = Responsavel::find()
            ->where('id_gra_ins = 6')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['tincompleto'] = Responsavel::find()
            ->where('id_gra_ins = 7')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['tcompleto'] = Responsavel::find()
            ->where('id_gra_ins = 8')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['mcompleto'] = Responsavel::find()
            ->where('id_gra_ins = 9')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultEsc['dcompleto'] = Responsavel::find()
            ->where('id_gra_ins = 10')
            ->andWhere('id_cor_sit = 2')
            ->count();
        echo json_encode($resultEsc);
    }

    /* Contador de genero. */

    public function actionGetGenero()
    {
        $resultGen = [];
        $resultGen['ninformado'] = Responsavel::find()
            ->where('id_num_gen = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultGen['feminino'] = Responsavel::find()
            ->where('id_num_gen = 2')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultGen['masculino'] = Responsavel::find()
            ->where('id_num_gen = 3')
            ->andWhere('id_cor_sit = 2')
            ->count();
        echo json_encode($resultGen);
    }

    /* Contador de Naturalidade. */

    public function actionGetNaturalidade()
    {
        $resultNac = [];
        $resultNac['ninformado'] = Responsavel::find()
            ->where('id_num_nat = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['ac'] = Responsavel::find()
            ->where('id_num_nat = 2')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['al'] = Responsavel::find()
            ->where('id_num_nat = 3')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['am'] = Responsavel::find()
            ->where('id_num_nat = 4')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['ap'] = Responsavel::find()
            ->where('id_num_nat = 5')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['ba'] = Responsavel::find()
            ->where('id_num_nat = 6')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['ce'] = Responsavel::find()
            ->where('id_num_nat = 7')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['df'] = Responsavel::find()
            ->where('id_num_nat = 8')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['es'] = Responsavel::find()
            ->where('id_num_nat = 9')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['go'] = Responsavel::find()
            ->where('id_num_nat = 10')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['ma'] = Responsavel::find()
            ->where('id_num_nat = 11')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['mg'] = Responsavel::find()
            ->where('id_num_nat = 12')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['ms'] = Responsavel::find()
            ->where('id_num_nat = 13')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['mt'] = Responsavel::find()
            ->where('id_num_nat = 14')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['pa'] = Responsavel::find()
            ->where('id_num_nat = 15')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['pb'] = Responsavel::find()
            ->where('id_num_nat = 16')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['pe'] = Responsavel::find()
            ->where('id_num_nat = 17')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['pi'] = Responsavel::find()
            ->where('id_num_nat = 18')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['pr'] = Responsavel::find()
            ->where('id_num_nat = 19')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['rj'] = Responsavel::find()
            ->where('id_num_nat = 20')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['rn'] = Responsavel::find()
            ->where('id_num_nat = 21')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['ro'] = Responsavel::find()
            ->where('id_num_nat = 22')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['rr'] = Responsavel::find()
            ->where('id_num_nat = 23')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['rs'] = Responsavel::find()
            ->where('id_num_nat = 24')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultNac['sc'] = Responsavel::find()
            ->where('id_num_nat = 25')
            ->andWhere('id_cor_sit = 2')
            ->count();
        echo json_encode($resultNac);
    }

    /* Contador de pessoa. */

    public function actionGetTotalPessoa()
    {
        $resultPes = [];
        $resultPes['totresponsavel'] = Responsavel::find()
            ->count();
        $resultPes['totdependente'] = Dependente::find()
            ->count();
        /* $resultPes['masculino'] = Responsavel::find()
        ->where('id_num_gen = 3')
        ->count(); */
        echo json_encode($resultPes);
    }

    /* Contador de total de homens. */

    public function actionGetTotalHomem()
    {
        $ninfoR = Responsavel::find()
            ->select('id_num_res')
            ->where('id_num_gen = 1')
            ->andWhere('id_cor_sit = 2')
            ->groupBy('id_num_res')
            ->all();
        $infoR = Responsavel::find()
            ->select('id_num_res')
            ->where('id_num_gen = 3')
            ->andWhere('id_cor_sit = 2')
            ->groupBy('id_num_res')
            ->all();

        $resultPesH = [];
        $resultPesH['ninformador'] = Responsavel::find()
            ->where('id_num_gen = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultPesH['ninformadod'] = Dependente::find()
            ->where('id_num_gen = 1')
            ->andWhere(['in', 'id_num_res', $ninfoR])
            ->count();
        $resultPesH['tothomemr'] = Responsavel::find()
            ->where('id_num_gen = 3')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultPesH['tothomemd'] = Dependente::find()
            ->where('id_num_gen = 3')
            ->andWhere(['in', 'id_num_res', $infoR])
            ->count();
        /* $resultPes['masculino'] = Responsavel::find()
        ->where('id_num_gen = 3')
        ->count(); */
        echo json_encode($resultPesH);
    }

    /* Contador de total de mulheres. */

    public function actionGetTotalMulher()
    {
        $ninfoR = Responsavel::find()
            ->select('id_num_res')
            ->where('id_num_gen = 1')
            ->andWhere('id_cor_sit = 2')
            ->groupBy('id_num_res')
            ->all();
        $infoR = Responsavel::find()
            ->select('id_num_res')
            ->where('id_num_gen = 2')
            ->andWhere('id_cor_sit = 2')
            ->groupBy('id_num_res')
            ->all();

        $resultPesM = [];
        $resultPesM['ninformador'] = Responsavel::find()
            ->where('id_num_gen = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultPesM['ninformadod'] = Dependente::find()
            ->where('id_num_gen = 1')
            ->andWhere(['in', 'id_num_res', $ninfoR])
            ->count();
        $resultPesM['totmulherr'] = Responsavel::find()
            ->where('id_num_gen = 2')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultPesM['totmulherd'] = Dependente::find()
            ->where('id_num_gen = 2')
            ->andWhere(['in', 'id_num_res', $infoR])
            ->count();
        /* $resultPes['masculino'] = Responsavel::find()
        ->where('id_num_gen = 3')
        ->count(); */
        echo json_encode($resultPesM);
    }

    /* Contador de total de mulheres e homens Responsáveis. */

    public function actionGetTotalResponsavel()
    {
        $resultResHM = [];
        $resultResHM['ninformado'] = Responsavel::find()
            ->where('id_num_gen = 1')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultResHM['feminino'] = Responsavel::find()
            ->where('id_num_gen = 2')
            ->andWhere('id_cor_sit = 2')
            ->count();
        $resultResHM['masculino'] = Responsavel::find()
            ->where('id_num_gen = 3')
            ->andWhere('id_cor_sit = 2')
            ->count();
        echo json_encode($resultResHM);
    }
}
