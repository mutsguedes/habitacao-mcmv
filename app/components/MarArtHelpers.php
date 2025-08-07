<?php

namespace app\components;

use Yii;
use DateTime;
use Exception;
use DateInterval;
use yii\db\Query;
use IntlDateFormatter;
use yii\data\ActiveDataProvider;
use app\modules\auxiliar\models\Page;
use app\modules\auxiliar\models\PageUser;

class MarArtHelpers
{

    /**
     * Return the specified multiple columns in the array
     *
     * @param    Array $input needs to take out the multidimensional array of the array column
     * @param    String $column_keys The column names to be retrieved, separated by commas, if not passed, all columns will be returned
     * @param    String $index_key as the index column of the returned array
     * @return Array
     */
    public static function array_columns($input, $column_keys = null, $index_key = null)
    {
        $result = array();

        $keys = isset($column_keys) ? explode(',', $column_keys) : array();

        if ($input) {
            foreach ($input as $k => $v) {

                // Specify the return column
                if ($keys) {
                    $tmp = array();
                    foreach ($keys as $key) {
                        $tmp[$key] = $v[$key];
                    }
                } else {
                    $tmp = $v;
                }

                // Specify the index column
                if (isset($index_key)) {
                    $result[$v[$index_key]] = $tmp;
                } else {
                    $result[] = $tmp;
                }
            }
        }

        return $result;
    }

    /**
     * @param integer $nuRes
     * @return ActiveDataProvider
     */
    public static function GetFamilia($nuRes)
    {
        $queryR = (new Query())
            ->from(['responsavel'])
            ->select([
                'id_num_res AS id_num_pes', 'nm_ide_pes', 'nm_nom_res AS nm_nom_pes',
                'nu_num_cpf', 'dt_nas_res AS dt_nas_pes', 'bo_mem_def',
            ])
            ->where(['id_num_res' => $nuRes]);
        $queryD = (new Query())
            ->from(['dependente'])
            ->select([
                'id_num_dep AS id_num_pes', 'nm_ide_pes', 'nm_nom_dep AS nm_nom_pes',
                'nu_num_cpf', 'dt_nas_dep AS dt_nas_pes', 'bo_mem_def',
                //  'ger_parentesco.nm_nom_par AS nm_nom_par'
            ])
            // ->innerJoin('ger_parentesco','dependente.id_num_par=ger_parentesco.id_num_par')
            ->where(['id_num_res' => $nuRes]);
        $queryR->union($queryD);
        $dataProviderF = new ActiveDataProvider([
            'query' => $queryR,
            /* 'sort' => [
                'attributes' => [
                    'nm_nom_pes' => [
                        'asc' => ['nm_nom_pes' => SORT_ASC],
                        'desc' => ['nm_nom_pes' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'Nome:',
                    ],
                    'dt_nas_pes' => [
                        'asc' => ['dt_nas_pes' => SORT_ASC],
                        'desc' => ['dt_nas_pes' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'D.N.:',
                    ],
                ],
            ], */
            'pagination' => [
                'defaultPageSize' => 6,
                'pageSizeLimit' => 200,
            ],
        ]);
        return $dataProviderF;
    }
    ////INÍCO DAS FUNÇÕES DO CONTADOR

    /**
     * @return string
     */
    public static function getVisIpAddr()
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
        return '';
    }

    /**
     * Contado total da visitas na página.
     *
     * @param[string] $pageId
     * 
     * @return mixed
     */
    public static function totalViews($pageId = null)
    {
        if ($pageId === null) {
            // count total website views
            $result = Page::find()
                ->sum('nu_num_con');
            if ($result > 0) {
                return $result;
            } else {
                return 0;
            }
        } else {
            // count specific page views
            $result = Page::find()
                ->where(['nm_nom_pag' => $pageId])
                ->all();

            if (!empty($result)) {
                foreach ($result as $row) {
                    if ($row['nu_num_con'] === null) {
                        return 0;
                    } else {
                        return $row['nu_num_con'];
                    }
                }
            } else {
                return "Sem registros encontrados!";
            }
        }
    }

    /**
     * Verifica se em determinado tempo a página foi visitada e atualiza o contador.
     *
     * @param[string] $modelP
     * @param[string] $visitorIp
     *
     * @return boolean
     * @throws \Exception
     */
    static function isUniqueView($modelP, $visitorIp)
    {
        $modelPU = PageUser::find()
            ->where(['id_num_pag' => $modelP->id_num_pag])
            ->andWhere(['nu_num_ip' => $visitorIp])->one();

        if (!empty($modelPU->id_pag_usu)) {
            $dt = new DateTime($modelPU->dt_tim_mod);
            $dtnova = $dt->add(new DateInterval('PT1M0S'));
            $dtatual = new DateTime();
            if ($dtatual > $dtnova) {
                $modelP->nu_num_con = $modelP->nu_num_con + 1;
                $modelP->save();
                $modelPU->dt_tim_mod = date("Y-m-d H:i:s");
                $modelPU->save();
            } else {
                $modelPU->dt_tim_mod = date("Y-m-d H:i:s");
                $modelPU->save();
            }
            return false;
        } else {
            return true;
        }
    }

    /**
     * Undocumented function
     *
     * @param[string] pageId
     * @param[string] visitorIp
     *
     * @return void
     * @throws Exception2
     * @throws \Exception
     */
    static public function addView($pageId, $visitorIp)
    {
        $modelP = Page::find()->where(['nm_nom_pag' => $pageId])->one();
        if (MarArtHelpers::isUniqueView($modelP, $visitorIp) === true) {
            // insert unique visitor record for checking whether the visit is unique or not in future.
            $modelPU = new PageUser;
            $transaction = $modelPU::getDb()->beginTransaction();
            try {
                // At this point unique visitor record is created successfully. Now update total_views of specific page.
                $modelPU->id_num_pag = $modelP->id_num_pag;
                $modelPU->nu_num_ip = $visitorIp;
                $modelPU->save();
                $transaction->commit();
                //  $modelP = Paginas::find()->where(['nm_nom_pag' => $pageId])->one();
                $modelP->nu_num_con = $modelP->nu_num_con + 1;
                $modelP->save();
            } catch (Exception $e) {
                echo $e;
            }
        }
    }

    ////FIM DAS FUNÇÕES DO CONTADOR

    /**
     * Undocumented function
     *
     * @param $name
     *
     * @return string
     */
    static function hello($name)
    {
        return "Hello $name";
    }

    /**
     * Marscara para Indentidade(ID)
     * @param string $string
     * @return string
     */
    public static function masId($string)
    {
        $masc = '';
        if (strlen($string) == 6) {
            $masc = '##.###-#';
        } elseif (strlen($string) == 7) {
            $masc = '###.###-#';
        } elseif (strlen($string) == 8) {
            $masc = '#.###.###-#';
        } elseif (strlen($string) == 9) {
            $masc = '##.###.###-#';
        } elseif (strlen($string) == 10) {
            $masc = '###.###.###-#';
        } elseif (strlen($string) == 11) {
            $masc = '#.###.###.###-#';
        } elseif (strlen($string) == 12) {
            $masc = '##.###.###.###-#';
        } elseif (strlen($string) == 13) {
            $masc = '###.###.###.###-#';
        } elseif (strlen($string) == 14) {
            $masc = '#.###.###.###.###-#';
        } else {
            $masc = '#.###.###.###.###-#';
        };
        return $masc;
    }

    /**
     * Marscara para Matrícula
     * @param string $string
     * @return string
     */
    public static function masMat($string)
    {
        $masc = '';
        if (strlen($string) == 4) {
            $masc = '#.###';
        } elseif (strlen($string) == 5) {
            $masc = '##.###';
        } elseif (strlen($string) == 6) {
            $masc = '###.###';
        } else {
            $masc = '#.###.###';
        }
        return $masc;
    }

    /**
     * Marscara para Indentidade(ID)
     */
    public static function masEdId()
    {
        $masc = [
            '99999-9', '999999-9', '9999999-9', '99999999-9', '999999999-9', '9999999999-9',
            '99999999999-9', '999999999999-9', '9999999999999-9'
        ];
        return $masc;
    }

    /**
     * Marscara para Matrícula
     */
    public static function masEdMat()
    {
        $masc = [
            '9', '99', '999', '9.999', '99.999', '999.999'
        ];
        return $masc;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function mascaraCpf($string)
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $string);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function mascaraFakerCpf($string)
    {
        // return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $string);
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.###.###-\$4", $string);
    }

    /**
     * @param string $datnas
     *
     * @return string
     * @throws \Exception
     */
    public static function getIdade($datnas)
    {
        $datatu = new DateTime($datnas);
        $idade = new DateTime();
        $diff = $datatu->diff($idade);
        return $diff->y;
    }

    /**
     * @param string $format
     * @return array
     * @throws \Exception
     */
    public static function getDateStartEnd($format)
    {
        $startDay = new DateTime(date($format));
        $startDay->add(new DateInterval('P1D'));
        $day = $startDay->format('d');
        $dates = [
            'startDate' => date($format, mktime(0, 0, 0, date('m'), $day, date('Y'))),
            'nowDate' => date($format),
            // Variável 't' retorna o quantidade dia do mês.
            'endDate' => date($format, mktime(23, 59, 59, date('m'), date("t"), date('Y')))
            /*  'startDate' => date('Y-m-d'),
            'endDate' => date('Y-m-d') */
        ];
        return $dates;
    }

    /**
     * Get all days in Month
     * 
     * @param string $month, $year, $day
     * @return array
     * @throws \Exception
     */
    public static function getFullDays($year, $month, $day)
    {
        $dates = [];
        $date = new DateTime();
        //for ($month; $month <= 12; $month++) {
        $days = cal_days_in_month(CAL_GREGORIAN, strVal($month), $year);
        for ($day; $day <= $days; $day++) {
            $date->setDate(strVal($year), strVal($month), strVal($day));
            //print_r(($date->format("w")));
            // die();
            if (($date->format("w") != 0) && ($date->format("w") != 6)) {
                array_push($dates,  ['dt_age_dat' => date('d-m-Y', strtotime(strVal($day) . '-' .  strVal($month) . '-' . $year))]);
                // array_push($dates,  ['dt_age_dat' => date('Y-m-d', strtotime(strVal($day) . '-' .  strVal($month) . '-' . $year))]);
            }
            //    }
            //   $day = '01';
        }


        /* for( $d = mktime( 0,0,0,intVal($month),intVal($day),intVal($year) ); date( 'Y', $d ) == $year; $d += 86400 )
		date( 'N', $d ) < 6 ? $dates[] = date( 'd/m/Y', $d ) : $d += 86400; */


        //print_r($dates);   
        return $dates;
    }

    /**
     * Get all days in array Month
     * 
     * @param string $year, $day
     * @param array $month
     * @return array
     * @throws \Exception
     */
    public static function getAllMonthsDays($year, $month, $day)
    {
        $dates = [];
        $date = new DateTime();
        foreach ($month as $value) {
            $days = cal_days_in_month(CAL_GREGORIAN, strVal($value), $year);
            for ($d = 1; $d <= $days; $d++) {
                $date->setDate(strVal($year), strVal($value), strVal($d));
                //print_r(($date->format("w")));
                // die();
                if (($date->format("w") != 0) && ($date->format("w") != 6)) {
                    array_push($dates,  ['dt_age_dat' => date('d-m-Y', strtotime(strVal($d) . '-' .  strVal($value) . '-' . $year))]);
                }
            }
        }
        return $dates;
    }


    /**
     * Get Group a Given Array 
     * 
     * @param string $property
     * @param array $data
     * @return array
     */
    public static function getGroupArray($property, $data)
    {
        $grouped_array = [];

        $contItem = 0;
        $oldValue = '';

        foreach ($data as $value) {
            if (array_key_exists($property, $value)) {

                $grouped_array[$value[$property]][] = $value;

                //Retira o item que do agrupaemnto.
                if ($contItem == 0) {
                    $oldValue = $value[$property];
                }
                if ($oldValue !== $value[$property]) {
                    $contItem = 0;
                }
                unset($grouped_array[$value[$property]][$contItem][$property]);
                $contItem++;
                $oldValue = $value[$property];
            } else {
                $grouped_array[""][] = $value;
            }
        }

        return $grouped_array;
    }

    /**
     * Format Dates to pt_BR
     * 
     * @return mixed
     */
    public static function dateBr()
    {
        $formatter = new IntlDateFormatter(
            'pt_BR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'America/Sao_Paulo',
            IntlDateFormatter::GREGORIAN
        );
        return $formatter;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function mascTel($string)
    {
        $masc = '';
        if (strlen($string) == 10) {
            $masc = '(##) ####-####';
        } elseif (strlen($string) == 11) {
            $masc = '(##) #####-####';
        }
        return $masc;
    }

    /**
     * @param string $mascara
     * @param string $string
     * @return string
     */
    public static function mascaraString($mascara, $string)
    {
        // Exemplos
        //echo mascara_string(“(##)####-####”,$telefone);
        //$string = str_replace(" ","",$string);
        for ($i = 0; $i < strlen($string); $i++) {
            $mascara[strpos($mascara, "#")] = $string[$i];
        }
        return $mascara;
    }

    public static function validaCNS($cns)
    {
        if ((strlen(trim($cns))) != 15) {
            return false;
        }
        if ((substr($cns, 0, 1) == '1') || (substr($cns, 0, 1) == '2')) {
            //Rotina de validação de Números que iniciam com "1" ou "2"
            $pis = substr($cns, 0, 11);
            $soma = (((substr($pis, 0, 1)) * 15) +
                ((substr($pis, 1, 1)) * 14) +
                ((substr($pis, 2, 1)) * 13) +
                ((substr($pis, 3, 1)) * 12) +
                ((substr($pis, 4, 1)) * 11) +
                ((substr($pis, 5, 1)) * 10) +
                ((substr($pis, 6, 1)) * 9) +
                ((substr($pis, 7, 1)) * 8) +
                ((substr($pis, 8, 1)) * 7) +
                ((substr($pis, 9, 1)) * 6) +
                ((substr($pis, 10, 1)) * 5));
            $resto = fmod($soma, 11);
            $dv = 11 - $resto;
            if ($dv == 11) {
                $dv = 0;
            }
            if ($dv == 10) {
                $soma = ((((substr($pis, 0, 1)) * 15) +
                    ((substr($pis, 1, 1)) * 14) +
                    ((substr($pis, 2, 1)) * 13) +
                    ((substr($pis, 3, 1)) * 12) +
                    ((substr($pis, 4, 1)) * 11) +
                    ((substr($pis, 5, 1)) * 10) +
                    ((substr($pis, 6, 1)) * 9) +
                    ((substr($pis, 7, 1)) * 8) +
                    ((substr($pis, 8, 1)) * 7) +
                    ((substr($pis, 9, 1)) * 6) +
                    ((substr($pis, 10, 1)) * 5)) + 2);
                $resto = fmod($soma, 11);
                $dv = 11 - $resto;
                $resultado = $pis . "001" . $dv;
            } else {
                $resultado = $pis . "000" . $dv;
            }
            if ($cns != $resultado) {
                return false;
            } else {
                return true;
            }
        } else if ((substr($cns, 0, 1) == '7') || (substr($cns, 0, 1) == '8') || (substr($cns, 0, 1) == '9')) {
            // Rotina de validação de Números que iniciam com "7", "8" ou "9"
            $soma = (((substr($cns, 0, 1)) * 15) +
                ((substr($cns, 1, 1)) * 14) +
                ((substr($cns, 2, 1)) * 13) +
                ((substr($cns, 3, 1)) * 12) +
                ((substr($cns, 4, 1)) * 11) +
                ((substr($cns, 5, 1)) * 10) +
                ((substr($cns, 6, 1)) * 9) +
                ((substr($cns, 7, 1)) * 8) +
                ((substr($cns, 8, 1)) * 7) +
                ((substr($cns, 9, 1)) * 6) +
                ((substr($cns, 10, 1)) * 5) +
                ((substr($cns, 11, 1)) * 4) +
                ((substr($cns, 12, 1)) * 3) +
                ((substr($cns, 13, 1)) * 2) +
                ((substr($cns, 14, 1)) * 1));
            $resto = fmod($soma, 11);
            if ($resto != 0) {
                return false;
            } else {
                return true;
            }
        }
        return null;
    }

    /**
     * extenso
     *
     * @param  mixed $value
     * @param  mixed $uppercase
     * @return void
     */
    public static function extenso($value, $uppercase = 0)
    {
        if (strpos($value, ",") > 0) {
            $value = str_replace(".", "", $value);
            $value = str_replace(",", ".", $value);
        }
        $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
        $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];

        $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
        $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
        $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];
        $u = ["", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove"];

        $z = 0;

        $value = number_format($value, 2, ".", ".");
        $integer = explode(".", $value);
        $cont = count($integer);
        for ($i = 0; $i < $cont; $i++)
            for ($ii = strlen($integer[$i]); $ii < 3; $ii++)
                $integer[$i] = "0" . $integer[$i];

        $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
        $rt = '';
        for ($i = 0; $i < $cont; $i++) {
            $value = $integer[$i];
            $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
            $rd = ($value[1] < 2) ? "" : $d[$value[1]];
            $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                $ru) ? " e " : "") . $ru;
            $t = $cont - 1 - $i;
            $r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
            if (
                $value == "000"
            )
                $z++;
            elseif ($z > 0)
                $z--;
            if (($t == 1) && ($z > 0) && ($integer[0] > 0))
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                    ($integer[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$uppercase) {
            return trim($rt ? $rt : "zero");
        } elseif ($uppercase == "2") {
            return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
        } else {
            return trim(ucwords($rt) ? ucwords($rt) : "Zero");
        }
    }

    /**
     * titleCase
     *
     * @param  mixed $string
     * @param  mixed $delimiters
     * @param  mixed $exceptions
     * @return void
     */
    public static function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = [
        "and", "to", "of", "da", "das", "do", "dos",
        "de", "des", "BB", "CEF", "NI", "I", "II", "III", "IV", "V", "VI"
    ])
    {
        /*
         * Exceptions in lower case are words you don't want converted
         * Exceptions all in upper case are any words you don't want converted to title case
         *   but should be converted to upper case, e.g.:
         *   king henry viii or king henry Viii should be King Henry VIII
         */
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
        } //foreach
        return $string;
    }

    /**
     * ler_tabela
     * Leitura da linha do nome da tabela    
     *
     * @param  mixed $tabela
     * @return void
     */
    public function ler_tabela($tabela = '')
    {
        return ('CREATE TABLE IF NOT EXISTS ' . $tabela . ' (');
    }

    /**
     * ler_campo
     * Leitura da linha das colunas    
     *
     * @param  mixed $campo
     * @param  mixed $last
     * @return void
     */
    public static function ler_campo($campo, $last = false)
    {
        list($coluna, $tamanho, $inicio, $fim, $tipo) = $campo;
        $ret = strtolower($coluna) . ' ' . MarArtHelpers::mysql_types($coluna, $tipo, $tamanho);
        if (!$last)
            $ret .= ', ';
        return ($ret);
    }

    /**
     * carrega_dados
     *
     * @param  mixed $sigtap_dir
     * @param  mixed $tabelas
     * @param  mixed $tabela_nome
     * @return void
     */
    public static function carrega_dados($sigtap_dir, $tabelas, $tabela_nome)
    {
        $lay_linha = $tabelas[$tabela_nome]['campos'];
        $arq_dados = file($sigtap_dir . $tabela_nome . '.txt');
        $insert_sql_ar = array();
        $insert_sql = '';
        $count_lin = 1;
        foreach ($arq_dados as $linha) {
            $insert_sql .= 'INSERT INTO ' . $tabela_nome . ' VALUES ';
            $insert_sql .= ' ( ';
            $count_col = 1;
            foreach ($lay_linha as $coluna) {
                $insert_sql .= MarArtHelpers::mysql_col_types($linha, $coluna);
                if ($count_col < count($lay_linha))
                    $insert_sql .= ', ';
                $count_col++;
            }
            $insert_sql .= ' ); ';
            array_push($insert_sql_ar, $insert_sql);
            $insert_sql = '';
            $count_lin++;
            $count_col = 0;
        }
        return ($insert_sql_ar);
    }

    /**
     * pr
     * Funções de Apoio    
     *
     * @param  mixed $mixed
     * @return void
     */
    public static function pr($mixed)
    {
        echo '<pre>';
        print_r($mixed);
        echo '</pre>';
    }

    /**
     * mysql_types
     * Tipos de colunas e conversão para mySQL    
     *
     * @param  mixed $name
     * @param  mixed $type
     * @param  mixed $size
     * @return void
     */
    public static function mysql_types($name, $type, $size)
    {
        switch ($type) {
            case 'VARCHAR2':
                return ('VARCHAR(' . $size . ')');
                break;
            case 'NUMBER':
                return ('INT');
                break;
            case 'CHAR':
                if (substr($name, 0, 3) == 'DT_')
                    return ('DATE');
                else
                    return ('VARCHAR(' . $size . ')');
                break;
            default:
                return ('');
                break;
        }
    }

    /**
     * mysql_col_types
     *
     * @param  mixed $text
     * @param  mixed $coluna
     * @return void
     */
    static function mysql_col_types($text, $coluna = array())
    {
        list($name, $size, $ini, $end, $type) = $coluna;
        $ini--;
        switch ($type) {
            case 'VARCHAR2':
                return (utf8_encode('"' . trim(substr($text, $ini, $size)) . '"'));
                break;
            case 'NUMBER':
                return (utf8_encode(substr($text, $ini, $size)));
                break;
            case 'CHAR':
                if (substr($name, 0, 3) == 'DT_')
                    $ret = utf8_encode('"' . substr($text, $ini, $size - 2) . '-' . substr($text, $ini + 4, $size - 4) . '-01"');
                else
                    $ret = utf8_encode('"' . trim(substr($text, $ini, $size)) . '"');
                return ($ret);
                break;
            default:
                return (utf8_encode('"' . trim(substr($text, $ini, $size)) . '"'));
                break;
        }
    }

    /**
     * validarCPF
     *
     * @param  mixed $cpf
     * @return void
     */
    public static function validarCPF($cpf = '')
    {

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
            return FALSE;
        } else { // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return FALSE;
                }
            }
            return TRUE;
        }
    }
}
