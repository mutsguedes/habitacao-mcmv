<?php

namespace app\modules\imprel\controllers;

use app\modules\auxiliar\models\GerCras;
use app\modules\res\models\Responsavel;
use Mpdf\Mpdf;
use PHPUnit\Framework\Constraint\IsNull;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Description of RelatoriosController
 *
 * @author marcos
 */
class RelatoriosController extends Controller
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
     * Displays a single Inumados model.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRelView()
    {
        return $this->render('_relatorio');
    }

    /**
     * Displays a single Relatorios Dependente model.
     * @return mixed
     * @throws NotFoundHttpException if the model$pdfP->AddPage('L') cannot be found
     */
    public function actionRelatorio()
    {
        $modelR = new Responsavel;
        $_conteudos = Yii::$app->request->post('conteudos');
        $_tipos = Yii::$app->request->post('tipos');
        $_situacoes = Yii::$app->request->post('situacoes');
        $_listaapto = Yii::$app->request->post('listaapto');
        $_listapen = Yii::$app->request->post('listapen');
        $_listasorte = Yii::$app->request->post('listasorte');
        $_quadra = Yii::$app->request->post('quadra');
        $_lote = Yii::$app->request->post('lote');
        $_bloco = Yii::$app->request->post('bloco');
        $stylebootstrap = file_get_contents('css/main.css');
        $nomCla = '';
        if ($_tipos == 'fampri') {
            $nomCla = 'Prioridade';
        } else if ($_tipos == 'famger') {
            $nomCla = 'Geral';
        } else {
            $nomCla = 'Todos';
        }

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
        $pdf->SetTitle('MarArt - Relatório');
        $pdfE->WriteHTML($stylebootstrap, 1);
        $pdfE->SetTitle('MarArt - Relatório');

        switch ($_conteudos) {
            case 'princi':
                $_princi = 1;
                $_pricon = 0;
                break;
            case 'pricon':
                $_princi = 0;
                $_pricon = 1;
                break;
        }
        switch ($_tipos) {
            case 'fampri':
                $_fampri = 1;
                $_famger = 0;
                break;
            case 'famger':
                $_fampri = 0;
                $_famger = 1;
                break;
            case 'todoscont':
                $_fampri = 0;
                $_famger = 0;
                break;
        }
        //$_liscra = 1;
        if (!empty($_listapen)) {
            $_listaapto = null;
            $_listasorte = null;
            switch ($_listapen) {
                case 'lispub':
                    $_lispub = 1;
                    $_lisass = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                case 'lisass':
                    $_lispub = 0;
                    $_lisass = 1;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                case 'liscra':
                    $_lispub = 0;
                    $_lisass = 0;
                    $_liscra = 1;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                case 'liscrm':
                    $_lispub = 0;
                    $_lisass = 0;
                    $_liscra = 0;
                    $_liscrm = 1;
                    $_listel = 0;
                    break;
                case 'listel':
                    $_lispub = 0;
                    $_lisass = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 1;
                    break;
                case 'todosapto':
                    $_lispub = 0;
                    $_lisass = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                default:
                    $_lispub = 0;
                    $_lisass = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
            }
        }
        if (!empty($_listaapto)) {
            $_listapen = null;
            $_listasorte = null;
            switch ($_listaapto) {
                case 'liscpf':
                    $_liscpf = 1;
                    $_lispub = 0;
                    $_lisuas = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                case 'lispub':
                    $_liscpf = 0;
                    $_lispub = 1;
                    $_lisuas = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                case 'lisuas':
                    $_liscpf = 0;
                    $_lispub = 0;
                    $_lisuas = 1;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                case 'liscra':
                    $_liscpf = 0;
                    $_lispub = 0;
                    $_lisuas = 0;
                    $_liscra = 1;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                case 'liscrm':
                    $_liscpf = 0;
                    $_lispub = 0;
                    $_lisuas = 0;
                    $_liscra = 0;
                    $_liscrm = 1;
                    $_listel = 0;
                    break;
                case 'listel':
                    $_liscpf = 0;
                    $_lispub = 0;
                    $_lisuas = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 1;
                    break;
                case 'todosapto':
                    $_liscpf = 0;
                    $_lispub = 0;
                    $_lisuas = 0;
                    $_liscra = 0;
                    $_liscrm = 0;
                    $_listel = 0;
                    break;
                default:
                    $_liscpf = 0;
                    $_lispub = 0;
                    $_lisuas = 0;
                    $_liscra = 0;
                    $_listel = 0;
                    break;
            }
        }
        if (!empty($_listasorte)) {
            $_listapen = null;
            $_listaapto = null;

            switch ($_listasorte) {
                case 'lisalf':
                    $_lisalf = 1;
                    $_lisblo = 0;
                    $_lissin = 0;
                    break;
                case 'lisblo':
                    $_lisalf = 0;
                    $_lisblo = 1;
                    $_lissin = 0;
                    break;
                case 'lissin':
                    $_lisalf = 0;
                    $_lisblo = 0;
                    $_lissin = 1;
                    break;
                case 'todossorte':
                    $_lisalf = 0;
                    $_lisblo = 0;
                    $_lissin = 0;
                    break;
            }
        }
        $qtlin = 1;
        if (!empty($_situacoes)) {
            if ($_situacoes == 'aptsor') {
                $idSit = 2;
            } elseif ($_situacoes == 'penden') {
                $idSit = 8;
            } elseif ($_situacoes == 'sortea') {
                $idSit = 11;
            };
            switch ($_situacoes) {
                case 'sortea':
                    if (($_fampri === 1) and ($_famger === 0)) {
                        //SORTEADO
                        $modelR = Responsavel::find()
                            ->orderBy('nm_nom_res')
                            ->orWhere([
                                'between', 'dt_nas_res',
                                date('Y-m-d', strtotime('-150 year')), date('Y-m-d', strtotime('-65 year')),
                            ])
                            ->orWhere(['bo_cal_urg' => 1])
                            ->orWhere(['bo_mem_def' => 1])
                            //->andWhere(['bo_imp_res' => 1])
                            ->andWhere(['bo_imp_res1' => 1])
                            ///->andWhere(['id_cor_sit' => $idSit])
                           // ->andWhere(['not', ['id_con_ocu' => '000000000']])
                            ->all();
                    } elseif (($_fampri === 0) and ($_famger === 1)) {
                        //SORTEADO
                        $modelR = Responsavel::find()
                            ->orderBy('nm_nom_res')
                            ->andWhere(['not', [
                                'between', 'dt_nas_res',
                                date('Y-m-d', strtotime('-150 year')), date('Y-m-d', strtotime('-65 year')),
                            ]])
                            ->andWhere(['bo_cal_urg' => 0])
                            ->andWhere(['bo_mem_def' => 0])
                            //->andWhere(['bo_imp_res' => 1])
                            ->andWhere(['bo_imp_res1' => 1])
                           
              /*               ->orWhere('not', [
                                'between', 'dt_nas_res',
                                date('Y-m-d', strtotime('-150 year')), date('Y-m-d', strtotime('-65 year')),
                            ]) */
                           /// ->andWhere(['id_cor_sit' => $idSit])
                            ///->andWhere(['not', ['id_con_ocu' => '000000000']])
                            ->all();
                    } elseif (($_fampri === 0) and ($_famger === 0)) {
                        //SORTEADO
                        $modelR = Responsavel::find('id_num_res', 'nm_nom_res', 'nu_num_cpf')
                            ->orderBy('nm_nom_res')
                            //->andWhere(['bo_imp_res' => 1])
                            ->andWhere(['bo_imp_res1' => 1])
                           // ->andWhere(['id_cor_sit' => $idSit])
                           // ->andWhere(['not', ['id_con_ocu' => '000000000']])
                            ->all();
                    };
                    break;
                case 'aptsor':
                    if (($_fampri === 1) and ($_famger === 0)) {
                        //APTO
                        $modelR = Responsavel::find()
                            ->select([
                                '*', // select all columns
                                '("Idoso") AS nm_nom_cla', // inclui coluna nm_nom_cla
                                'id_num_cra_f' => GerCras::find()
                                    ->select(['id_tip_ent'])
                                    ->where('ger_cras.nm_nom_bai = res.nm_nom_bai OR ger_cras.nm_nom_loc = res.nm_nom_bai')
                                    ->limit(1)
                            ])
                            ->orderBy('nm_nom_res')
                            ->orWhere([
                                'between', 'dt_nas_res',
                                date('Y-m-d', strtotime('-150 year')), date('Y-m-d', strtotime('-65 year')),
                            ])
                            ->andWhere(['bo_imp_res' => 1])
                            ->orWhere(['bo_cal_urg' => 1])
                            ->orWhere(['bo_mem_def' => 1])
                            ->andWhere(['id_cor_sit' => $idSit])
                            ->alias('res')
                            ->all();
                    } elseif (($_fampri === 0) and ($_famger === 1)) {
                        //APTO
                        $modelR = Responsavel::find()
                            ->select([
                                '*', // select all columns
                                '("Geral") AS nm_nom_cla', // inclui coluna nm_nom_cla
                                'id_num_cra_f' => GerCras::find()
                                    ->select(['id_tip_ent'])
                                    ->where('ger_cras.nm_nom_bai = res.nm_nom_bai OR ger_cras.nm_nom_loc = res.nm_nom_bai')
                                    ->limit(1)
                            ])
                            ->orderBy('nm_nom_res')
                            ->andWhere(['not', [
                                'between', 'dt_nas_res',
                                date('Y-m-d', strtotime('-150 year')), date('Y-m-d', strtotime('-65 year')),
                            ]])
                            ->andWhere(['bo_imp_res' => 1])
                            ->andWhere(['bo_cal_urg' => 0])
                            ->andWhere(['bo_mem_def' => 0])
                            ->andWhere(['id_cor_sit' => $idSit])
                            ->alias('res')
                            ->all();
                    } elseif (($_fampri === 0) and ($_famger === 0)) {
                        //APTO
                        $modelR = Responsavel::find()
                            ->select([
                                '*', // select all columns
                                '("Todos") AS nm_nom_cla', // inclui coluna nm_nom_cla
                                'id_num_cra_f' => GerCras::find()
                                    ->select(['id_tip_ent'])
                                    ->where('ger_cras.nm_nom_bai = res.nm_nom_bai OR ger_cras.nm_nom_loc = res.nm_nom_bai')
                                    ->limit(1)
                            ])
                            ->orderBy('nm_nom_res')
                            ->andWhere(['bo_imp_res' => 1])
                            ->andWhere(['id_cor_sit' => $idSit])
                            ->alias('res')
                            ->all();
                    };
                    break;
                case 'penden':
                    if (($_fampri === 1) and ($_famger === 0)) {
                        // PENDÊNCIA
                        $modelR = Responsavel::find()
                            ->select([
                                '*', // select all columns
                                '("Idoso") AS nm_nom_cla', // inclui coluna nm_nom_cla
                                'id_num_cra_f' => GerCras::find()
                                    ->select(['id_tip_ent'])
                                    ->where('ger_cras.nm_nom_bai = res.nm_nom_bai OR ger_cras.nm_nom_loc = res.nm_nom_bai')
                                    ->limit(1)
                            ])
                            ->orderBy('nm_nom_res')
                            ->orWhere([
                                'between', 'dt_nas_res',
                                date('Y-m-d', strtotime('-150 year')), date('Y-m-d', strtotime('-65 year')),
                            ])
                            ->andWhere(['bo_imp_res' => 1])
                            ->orWhere(['bo_cal_urg' => 1])
                            ->orWhere(['bo_mem_def' => 1])
                            ->andWhere(['id_cor_sit' => $idSit])
                            ->alias('res')
                            ->all();
                    } elseif (($_fampri === 0) and ($_famger === 1)) {
                        // PENDÊNCIA
                        $modelR = Responsavel::find()
                            ->select([
                                '*', // select all columns
                                '("Geral") AS nm_nom_cla', // inclui coluna nm_nom_cla
                                'id_num_cra_f' => GerCras::find()
                                    ->select(['id_tip_ent'])
                                    ->where('ger_cras.nm_nom_bai = res.nm_nom_bai OR ger_cras.nm_nom_loc = res.nm_nom_bai')
                                    ->limit(1)
                            ])
                            ->orderBy('nm_nom_res')
                            ->andWhere(['bo_cal_urg' => 0])
                            ->andWhere(['bo_mem_def' => 0])
                            ->andWhere(['not', [
                                'between', 'dt_nas_res',
                                date('Y-m-d', strtotime('-150 year')), date('Y-m-d', strtotime('-65 year')),
                            ]])
                            ->andWhere(['id_cor_sit' => $idSit])
                            ->alias('res')
                            ->all();
                    } elseif (($_fampri === 0) and ($_famger === 0)) {
                        // PENDÊNCIA
                        $modelR = Responsavel::find()
                            ->select([
                                '*', // select all columns
                                '("Todos") AS nm_nom_cla', // inclui coluna nm_nom_cla
                                'id_num_cra_f' => GerCras::find()
                                    ->select(['id_tip_ent'])
                                    ->where('ger_cras.nm_nom_bai = res.nm_nom_bai OR ger_cras.nm_nom_loc = res.nm_nom_bai')
                                    ->limit(1)
                            ])
                            ->orderBy('nm_nom_res')
                            ->andWhere(['id_cor_sit' => $idSit])
                            ->alias('res')
                            ->all();
                    };
                    break;
                case 'restod':
                    set_time_limit(500);
                    ini_set("memory_limit", "1024M");
                    ini_set("pcre.backtrack_limit", "5000000");
                    $modelR = Responsavel::find()
                        ->orderBy('nm_nom_res')
                        ->all();
                    break;
                default:
                    break;
            };
            if (!empty($modelR)) {
                if ($qtlin > 1) {
                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                };
                if ((!empty($_listasorte)) and (empty($_listaapto)) and (empty($_listapen))) {
                    //SORTEADO
                    if (($_lisalf === 1) and ($_lisblo === 0) and ($_lissin === 0)) {
                        $pdf->AddPageByArray([
                            'orientation' => 'P',
                            'margin-left' => '5',
                            'margin-right' => '5',
                            'margin-top' => '5',
                            'margin-bottom' => '5',
                        ]);

                        $html = '<html>
                                    <body>
                                    <div class="col-12" style="text-align: center; font-size: 80px; padding-top: 100px">
                                    Listagem com os Sorteados Ass. Contrato.
                                    </div>
                                    <div class="col-12" style="text-align: center; font-size: 100px;">'
                            . $nomCla .
                            '<div class="col-12" style="text-align: center; font-size: 100px;">
                                      18/12/2021 
                                    </div>
                                    </body>
                                </html>';
                        $pdf->WriteHTML($html);

                        $pdf->AddPageByArray([
                            'orientation' => 'P',
                            'margin-left' => '5',
                            'margin-right' => '5',
                            'margin-top' => '5',
                            'margin-bottom' => '5',
                        ]);

                        $modelRU =  end($modelR);
                        $letraAnt = $modelRU["nm_nom_res"][0];
                        for ($letra = 0; $letra <= 25; $letra++) {
                            // print(chr(65 + $letra));
                            $modelRN = array_filter($modelR, function ($value) use ($letra) {
                                return ($value["nm_nom_res"][0] == chr(65 + $letra));
                            });
                            if (sizeof($modelRN)) {
                                $html = '<html>
                                    <body>
                                        <div class="col-12" style="text-align: center; font-size: 500px;">'
                                    . chr(65 + $letra) .
                                    '</div>
                                    </body>
                                </html>';
                                $pdf->WriteHTML($html);
                                $pdf->AddPageByArray([
                                    'margin-left' => '8',
                                    'margin-right' => '10',
                                    'margin-top' => '15',
                                    'margin-bottom' => '10',
                                ]);
                                $pdf->WriteHTML($this->renderPartial('lisass', [
                                    'modelR' => $modelRN,
                                ]), 2);
                                if (chr(65 + $letra) == $letraAnt) {
                                    break;
                                }

                                $pdf->SetHTMLHeader('');
                                $pdf->WriteHTML('<pagebreak type="NEXT-ODD" resetpagenum = "1"/>');
                                $pdf->SetHTMLFooter('');
                            }
                        }
                    } elseif (($_lisalf === 0) and ($_lisblo === 1) and ($_lissin === 0)) {
                        if (!empty($_quadra)) {
                            //foreach ($_quadra as $q) {
                            if (strlen(strval($_quadra)) === 1) {
                                $_q = '0' . $_quadra;
                            } else {
                                $_q = '' . $_quadra;
                            }
                            foreach ($_lote as $l) {
                                if (strlen(strval($l)) === 1) {
                                    $_l = '0' . $l;
                                } else {
                                    $_l = '' . $l;
                                }
                                foreach ($_bloco as $b) {
                                    if (strlen(strval($b)) === 1) {
                                        $_b = '0' . $b;
                                    } else {
                                        $_b = '' . $b;
                                    }
                                    $quaLotblo = $_q . $_l . $_b . '%';
                                    $modelR = Responsavel::find()
                                        // ->orderBy(['id_con_ocu' => SORT_DESC])
                                        ->with('corSit')
                                        ->select(['id_num_res', 'dt_nas_res', 'bo_cal_urg', 'bo_mem_def', 'id_cor_sit', 'nm_nom_res', 'nu_num_cpf', 'id_con_ocu'])
                                        ->addOrderBy(['nm_nom_res' => SORT_ASC])
                                        ->groupBy('id_con_ocu')
                                        // ->andWhere(['id_cor_sit' => $idSit])
                                        ->andWhere(['not', ['id_con_ocu' => '000000000']])
                                        ->andWhere(['like', 'id_con_ocu', $quaLotblo, false])
                                        ->all();
                                    if (count($modelR) != 0) {
                                        $pdf->AddPageByArray([
                                            'margin-left' => '8',
                                            'margin-right' => '10',
                                            'margin-top' => '15',
                                            'margin-bottom' => '10',
                                        ]);
                                        $pdf->WriteHTML($this->renderPartial('lisblo', [
                                            'modelR' => $modelR,
                                        ]), 2);
                                    } else {
                                        $pdf->WriteHTML('<h1>Não existe(m) responsável(is) alocado(s) nesse endereço !!!</h1>');
                                        break;
                                    }
                                }
                                //}
                            }
                        } else {
                            $pdf->WriteHTML('<h1>Não existe(m) responsável(is) alocado(s) nesse endereço !!!</h1>');
                        }
                    } elseif (($_lisalf === 0) and ($_lisblo === 0) and ($_lissin === 1)) {
                        //SORTEADO
                        if (!empty($_quadra)) {
                            //foreach ($_quadra as $q) {
                            if (strlen(strval($_quadra)) === 1) {
                                $_q = '0' . $_quadra;
                            } else {
                                $_q = '' . $_quadra;
                            }
                            foreach ($_lote as $l) {
                                if (strlen(strval($l)) === 1) {
                                    $_l = '0' . $l;
                                } else {
                                    $_l = '' . $l;
                                }
                                foreach ($_bloco as $b) {
                                    if (strlen(strval($b)) === 1) {
                                        $_b = '0' . $b;
                                    } else {
                                        $_b = '' . $b;
                                    }
                                    $quaLotblo = $_q . $_l . $_b . '%';
                                    $quaLotblo = $_q . $_l . $_b . '%';
                                    $modelR = Responsavel::find()
                                        // ->orderBy(['id_con_ocu' => SORT_DESC])
                                        ->with('corSit')
                                        ->select(['id_num_res', 'dt_nas_res', 'bo_cal_urg', 'bo_mem_def', 'id_cor_sit', 'nm_nom_res', 'nu_num_cpf', 'id_con_ocu'])
                                        ->addOrderBy(['nm_nom_res' => SORT_ASC])
                                        ->groupBy('id_con_ocu')
                                        // ->andWhere(['id_cor_sit' => $idSit])
                                        ->andWhere(['not', ['id_con_ocu' => '000000000']])
                                        ->andWhere(['like', 'id_con_ocu', $quaLotblo, false])
                                        ->all();
                                    if (count($modelR) != 0) {
                                        $pdf->AddPageByArray([
                                            'margin-left' => '8',
                                            'margin-right' => '10',
                                            'margin-top' => '15',
                                            'margin-bottom' => '10',
                                        ]);
                                        $pdf->WriteHTML($this->renderPartial('lissin', [
                                            'modelR' => $modelR,
                                        ]), 2);
                                    } else {
                                        $pdf->WriteHTML('<h1>Não existe(m) responsável(is) alocado(s) nesse endereço !!!</h1>');
                                        break;
                                    }
                                }
                                //}
                            }
                        } else {
                            $pdf->WriteHTML('<h1>Não existe(m) responsável(is) alocado(s) nesse endereço !!!</h1>');
                        }
                        /*  foreach ($_quadra as $q) {
                            if (strlen(strval($q)) === 1) {
                                $_q = '0' . $q;
                            } else {
                                $_q = '' . $q;
                            }
                            foreach ($_lote as $l) {
                                if (strlen(strval($l)) === 1) {
                                    $_l = '0' . $l;
                                } else {
                                    $_l = '' . $l;
                                }
                                foreach ($_bloco as $b) {
                                    if (strlen(strval($b)) === 1) {
                                        $_b = '0' . $b;
                                    } else {
                                        $_b = '' . $b;
                                    }
                                    $quaLotblo = $_q . $_l . $_b . '%';
                                    $modelR = Responsavel::find('id_num_res', 'nm_nom_res', 'nu_num_cpf')
                                        ->orderBy('id_con_ocu')
                                        ->addOrderBy('nm_nom_res')
                                        ->groupBy('id_con_ocu')
                                        ->andWhere(['id_cor_sit' => $idSit])
                                        ->andWhere(['not', ['id_con_ocu' => '000000000']])
                                        ->andWhere(['like', 'id_con_ocu', $quaLotblo, false])
                                        ->all();
                                    if (count($modelR) != 0) {
                                        $pdf->AddPageByArray([
                                            'margin-left' => '8',
                                            'margin-right' => '10',
                                            'margin-top' => '15',
                                            'margin-bottom' => '10',
                                        ]);
                                        $pdf->WriteHTML($this->renderPartial('lissin', [
                                            'modelR' => $modelR,
                                        ]), 2);
                                    }
                                }
                            }
                        } */
                    } elseif (($_lisalf === 0) and ($_lisblo === 0) and ($_lissin === 0)) {
                        //SORTEADO
                        foreach ($_quadra as $q) {
                            if (strlen(strval($q)) === 1) {
                                $_q = '0' . $q;
                            } else {
                                $_q = '' . $q;
                            }
                            foreach ($_lote as $l) {
                                if (strlen(strval($l)) === 1) {
                                    $_l = '0' . $l;
                                } else {
                                    $_l = '' . $l;
                                }
                                foreach ($_bloco as $b) {
                                    if (strlen(strval($b)) === 1) {
                                        $_b = '0' . $b;
                                    } else {
                                        $_b = '' . $b;
                                    }
                                    $quaLotblo = $_q . $_l . $_b . '%';
                                    $modelR = Responsavel::find()
                                        // ->orderBy(['id_con_ocu' => SORT_DESC])
                                        ->with('corSit')
                                        ->select(['id_num_res', 'dt_nas_res', 'bo_cal_urg', 'bo_mem_def', 'id_cor_sit', 'nm_nom_res', 'nu_num_cpf', 'id_con_ocu'])
                                        ->addOrderBy(['nm_nom_res' => SORT_ASC])
                                        ->groupBy('id_con_ocu')
                                        // ->andWhere(['id_cor_sit' => $idSit])
                                        ->andWhere(['not', ['id_con_ocu' => '000000000']])
                                        ->andWhere(['like', 'id_con_ocu', $quaLotblo, false])
                                        ->all();
                                    $pdf->AddPageByArray([
                                        'margin-left' => '8',
                                        'margin-right' => '10',
                                        'margin-top' => '15',
                                        'margin-bottom' => '10',
                                    ]);
                                    if (count($modelR) != 0) {
                                        $pdf->WriteHTML($this->renderPartial('lisblo', [
                                            'modelR' => $modelR,
                                        ]), 2);
                                        $pdf->WriteHTML($this->renderPartial('lissin', [
                                            'modelR' => $modelR,
                                        ]), 2);
                                    }
                                }
                            }
                        }
                    }
                    $qtlin++;
                } else if ((empty($_listasorte)) and (!empty($_listaapto)) and (empty($_listapen))) {
                    if (($_liscpf === 1) and ($_lispub === 0) and ($_lisuas === 0) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 0)) {
                        //APTO
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('liscpf', [
                            'modelR' => $modelR,
                        ]), 2);
                    } elseif (($_liscpf === 0) and ($_lispub === 1) and ($_lisuas === 0) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 0)) {
                        //APTO
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('lispub', [
                            'modelR' => $modelR,
                        ]), 2);
                    } else if (($_liscpf === 0) and ($_lispub === 0) and ($_lisuas === 1) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 0)) {
                        //APTO
                        $pdf->AddPageByArray([
                            'orientation' => 'L',
                            'margin-left' => '5',
                            'margin-right' => '5',
                            'margin-top' => '5',
                            'margin-bottom' => '5',
                        ]);

                        $html = '<html>
                                    <body>
                                    <div class="col-12" style="text-align: center; font-size: 80px; padding-top: 100px">
                                    Listagem com os Aptos para o Sorteio.
                                    </div>
                                    <div class="col-12" style="text-align: center; font-size: 100px;">'
                            . $nomCla .
                            '<div class="col-12" style="text-align: center; font-size: 100px;">
                                      20/08/2021 
                                    </div>
                                    </body>
                                </html>';
                        $pdf->WriteHTML($html);

                        $pdf->AddPageByArray([
                            'orientation' => 'L',
                            'margin-left' => '5',
                            'margin-right' => '5',
                            'margin-top' => '5',
                            'margin-bottom' => '5',
                        ]);
                        for ($letra = 0; $letra < 26; $letra++) {
                            // print(chr(65 + $letra));
                            $modelRN = array_filter($modelR, function ($value) use ($letra) {
                                return ($value["nm_nom_res"][0] == chr(65 + $letra));
                            });
                            if (sizeof($modelRN)) {
                                $html = '<html>
                                    <body>
                                        <div class="col-12" style="text-align: center; font-size: 500px;">'
                                    . chr(65 + $letra) .
                                    '</div>
                                    </body>
                                </html>';
                                $pdf->WriteHTML($html);
                                $pdf->AddPageByArray([
                                    'orientation' => 'L',
                                    'margin-left' => '15',
                                    'margin-right' => '8',
                                    'margin-top' => '5',
                                    'margin-bottom' => '5',
                                ]);
                                $pdf->WriteHTML($this->renderPartial('lisuas', [
                                    'modelR' => $modelRN,
                                ]), 2);
                            }
                        }
                    } else if (($_liscpf === 0) and ($_lispub === 0) and ($_lisuas === 0) and ($_liscra === 1) and ($_liscrm === 0) and ($_listel === 0)) {
                        //APTO
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        ArrayHelper::multisort($data, ['id_num_cra_f', 'nm_nom_res'], [SORT_ASC, SORT_ASC]);
                        for ($crasId = 1; $crasId <= 8; $crasId++) {
                            $modelRN = array_filter($modelR, function ($value) use ($crasId) {
                                if ($crasId == 1) {
                                    return ($value["id_num_cra_f"] == 'N0000000000000' . strval($crasId));
                                } else {
                                    return ($value["id_num_cra_f"] == 'C0000000000000' . strval($crasId));
                                }
                            });
                            if (count($modelRN) != 0) {
                                $pdf->WriteHTML($this->renderPartial('liscra', [
                                    'modelR' => $modelRN,
                                ]), 2);

                                if ($crasId < 8) {
                                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                                }
                            }
                        }
                    } else if (($_liscpf === 0) and ($_lispub === 0) and ($_lisuas === 0) and ($_liscra === 0) and ($_liscrm === 1) and ($_listel === 0)) {
                        //APTO
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        ArrayHelper::multisort($data, ['id_num_cra_f', 'nm_nom_res'], [SORT_ASC, SORT_ASC]);
                        for ($crasId = 1; $crasId <= 8; $crasId++) {
                            $modelRN = array_filter($modelR, function ($value) use ($crasId) {
                                if ($crasId == 1) {
                                    return ($value["id_num_cra_f"] == 'N0000000000000' . strval($crasId));
                                } else {
                                    return ($value["id_num_cra_f"] == 'C0000000000000' . strval($crasId));
                                }
                            });
                            if (count($modelRN) != 0) {
                                $pdf->WriteHTML($this->renderPartial('liscrm', [
                                    'modelR' => $modelRN,
                                ]), 2);

                                if ($crasId < 8) {
                                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                                }
                            }
                        }
                    } else if (($_liscpf === 0) and ($_lispub === 0) and ($_lisuas === 0) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 1)) {
                        //APTO
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('listel', [
                            'modelR' => $modelR,
                        ]), 2);
                    } else if (($_liscpf === 0) and ($_lispub === 0) and ($_lisuas === 0) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 0)) {
                        //APTO
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('liscpf', [
                            'modelR' => $modelR,
                        ]), 2);
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('lispub', [
                            'modelR' => $modelR,
                        ]), 2);
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('lisuas', [
                            'modelR' => $modelR,
                        ]), 2);
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        for ($crasId = 1; $crasId <= 8; $crasId++) {
                            $modelRN = array_filter($modelR, function ($value) use ($crasId) {
                                if ($crasId == 1) {
                                    return ($value["id_num_cra_f"] == 'N0000000000000' . strval($crasId));
                                } else {
                                    return ($value["id_num_cra_f"] == 'C0000000000000' . strval($crasId));
                                }
                            });
                            if (sizeof($modelRN)) {
                                $pdf->WriteHTML($this->renderPartial('liscra', [
                                    'modelR' => $modelRN,
                                ]), 2);

                                if ($crasId < 8) {
                                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                                }
                            }
                        }
                    };
                } else if ((empty($_listasorte)) and (empty($_listaapto)) and (!empty($_listapen))) {
                    if (($_lispub === 1) and ($_lisass === 0) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 0)) {
                        //PENDÊNCIA
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('lispub', [
                            'modelR' => $modelR,
                        ]), 2);
                    } else if (($_lispub === 0) and ($_lisass === 1) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 0)) {
                        //PENDÊNCIA
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        for ($letra = 0; $letra < 26; $letra++) {
                            print(chr(65 + $letra));
                            $modelRN = array_filter($modelR, function ($value) use ($letra) {
                                return ($value["nm_nom_res"][0] == chr(65 + $letra));
                            });
                            /* print_r($modelRN);
                                die(); */
                            if (sizeof($modelRN)) {
                                $html = '<html>
                                    <body>
                                        <div class="col-12" style="text-align: center;font-size: 500px; padding: 25%">'
                                    . chr(65 + $letra) .
                                    '</div>
                                        </div>
                                    </body>
                                </html>';

                                $pdf->WriteHTML($html);
                                // if ($letra < $contPag) {
                                $pdf->AddPageByArray([
                                    'margin-left' => '8',
                                    'margin-right' => '10',
                                    'margin-top' => '15',
                                    'margin-bottom' => '10',
                                ]);
                                // }

                                $pdf->WriteHTML($this->renderPartial('lisass', [
                                    'modelR' => $modelRN,
                                ]), 2);

                                if ($letra < 25) {
                                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                                }
                            }
                        }
                    } else if (($_lispub === 0) and ($_lisass === 0) and ($_liscra === 1) and ($_liscrm === 0) and ($_listel === 0)) {
                        //PENDÊNCIA
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        ArrayHelper::multisort($data, ['id_num_cra_f', 'nm_nom_res'], [SORT_ASC, SORT_ASC]);
                        for ($crasId = 1; $crasId <= 8; $crasId++) {
                            $modelRN = array_filter($modelR, function ($value) use ($crasId) {
                                if ($crasId == 1) {
                                    return ($value["id_num_cra_f"] == 'N0000000000000' . strval($crasId));
                                } else {
                                    return ($value["id_num_cra_f"] == 'C0000000000000' . strval($crasId));
                                }
                            });
                            if (count($modelRN) != 0) {
                                $pdf->WriteHTML($this->renderPartial('liscra', [
                                    'modelR' => $modelRN,
                                ]), 2);

                                if ($crasId < 8) {
                                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                                }
                            }
                        }
                    } else if (($_lispub === 0) and ($_lisass === 0) and ($_liscra === 0) and ($_liscrm === 1) and ($_listel === 0)) {
                        //PENDÊNCIA
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        ArrayHelper::multisort($data, ['id_num_cra_f', 'nm_nom_res'], [SORT_ASC, SORT_ASC]);
                        for ($crasId = 1; $crasId <= 8; $crasId++) {
                            $modelRN = array_filter($modelR, function ($value) use ($crasId) {
                                if ($crasId == 1) {
                                    return ($value["id_num_cra_f"] == 'N0000000000000' . strval($crasId));
                                } else {
                                    return ($value["id_num_cra_f"] == 'C0000000000000' . strval($crasId));
                                }
                            });
                            if (count($modelRN) != 0) {
                                $pdf->WriteHTML($this->renderPartial('liscrm', [
                                    'modelR' => $modelRN,
                                ]), 2);

                                if ($crasId < 8) {
                                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                                }
                            }
                        }
                    } else if (($_lispub === 0) and ($_lisass === 0) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 1)) {
                        //PENDÊNCIA
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('listel', [
                            'modelR' => $modelR,
                        ]), 2);
                    } else if (($_lispub === 0) and ($_lisass === 0) and ($_liscra === 0) and ($_liscrm === 0) and ($_listel === 0)) {
                        //PENDÊNCIA
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('liscpf', [
                            'modelR' => $modelR,
                        ]), 2);
                        $pdf->AddPageByArray([
                            'margin-left' => '8',
                            'margin-right' => '10',
                            'margin-top' => '15',
                            'margin-bottom' => '10',
                        ]);
                        $pdf->WriteHTML($this->renderPartial('lisass', [
                            'modelR' => $modelR,
                        ]), 2);
                        $pdf->AddPageByArray([
                            'orientation' => 'L',
                            'margin-left' => '5',
                            'margin-right' => '5',
                            'margin-top' => '5',
                            'margin-bottom' => '5',
                        ]);
                        for ($crasId = 1; $crasId <= 8; $crasId++) {
                            $modelRN = array_filter($modelR, function ($value) use ($crasId) {
                                if ($crasId == 1) {
                                    return ($value["id_num_cra_f"] == 'N0000000000000' . strval($crasId));
                                } else {
                                    return ($value["id_num_cra_f"] == 'C0000000000000' . strval($crasId));
                                }
                            });
                            if (sizeof($modelRN)) {
                                $pdf->WriteHTML($this->renderPartial('liscra', [
                                    'modelR' => $modelRN,
                                ]), 2);

                                if ($crasId < 8) {
                                    $pdf->WriteHTML('<pagebreak resetpagenum="1" />');
                                }
                            }
                        }
                    };
                } else {
                    $pdfE->AddPage('P');
                    $pdfE->WriteHTML('<h1>Favor selecionar um tipo de listagem !!!</h1>');
                    return $pdfE->Output();
                };
            }
        } else {
            $pdfE->AddPage('P');
            $pdfE->WriteHTML('<h1>Favor selecionar um tipo de situação !!!</h1>');
            return $pdfE->Output();
        };
        return $pdf->Output();
    }
}
