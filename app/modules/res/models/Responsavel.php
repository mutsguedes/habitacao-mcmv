<?php

namespace app\modules\res\models;

use Yii;
use DateTime;
use yii\db\ActiveRecord;
use app\myBehaviors\GetCras;
use app\myBehaviors\UpperCase;
use app\modules\user\models\User;
use app\myBehaviors\GeraInscricao;
use app\modules\ocu\models\Ocupacao;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\dep\models\Dependente;
use app\components\validador\ValidarCpf;
use app\components\validador\ValidarNis;
use app\modules\auxiliar\models\GerEtnia;
use app\modules\auxiliar\models\GerEstado;
use app\modules\auxiliar\models\GerGenero;
use app\modules\auxiliar\models\GerProjeto;
use app\modules\auxiliar\models\Apartamento;
use app\modules\auxiliar\models\GerOriRenda;
use app\modules\res\models\ResponsavelQuery;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerTabUniCbo;
use app\modules\auxiliar\models\GerTipoRenda;
use app\modules\auxiliar\models\GerCorSituacao;
use app\modules\auxiliar\models\GerEstadoCivil;
use app\modules\auxiliar\models\GerNatOcupacao;
use app\modules\tecsoc\models\TecsocEnfermidade;
use app\modules\auxiliar\models\GerGrauInstrucao;
use app\modules\auxiliar\models\GerNacionalidade;

/**
 * This is the model class for table "responsavel".
 *
 * @property int $id_num_res Id da tabela responsaveis:
 * @property string $nm_ide_pes T. pessoa:
 * @property string $nu_num_seq Sequencial:
 * @property string $nu_num_ins Inscrição:
 * @property int $bo_reg_exc Excluído:
 * @property int|null $bo_tec_soc Tec. sosial:
 * @property int|null $bo_imp_res Imprimir:
 * @property int $bo_imp_res1 Imprimir:
 * @property int $id_num_proj Projetos:
 * @property int $id_cor_sit Situação:
 * @property string|null $id_con_ocu Ocupação:
 * @property string|null $dt_sor_res D. sorteio:
 * @property string|null $dt_com_res D. contemplação:
 * @property string $nm_nom_res Nome:
 * @property string|null $nu_num_cep CEP.:
 * @property string|null $nm_nom_log Logradouro:
 * @property string|null $nu_num_cas Nº.:
 * @property string|null $nm_nom_com Complemento:
 * @property string|null $nm_nom_bai Bairro:
 * @property string|null $nm_nom_mun Município:
 * @property string|null $nm_nom_est UF.:
 * @property string|null $nu_num_tel Telefone:
 * @property string|null $nu_num_tel_1 Telefone:
 * @property string|null $dt_nas_res D.N.:
 * @property string|null $nm_nom_ema Email:
 * @property string|null $nu_num_ide R.G.:
 * @property string $nu_num_cpf CPF:
 * @property string|null $nu_num_nis NIS:
 * @property int $id_num_gen Gênero:
 * @property int $id_est_civ E. Cívil:
 * @property int $id_gra_ins G. instrução:
 * @property int $id_num_nat Naturalidade:
 * @property int $id_num_nac Nacionalidade:
 * @property int $id_num_etn Etnia:
 * @property int $id_nat_ocu Ocupação:
 * @property int $id_ori_ren O. R. cliente:
 * @property int $bo_car_ass C.Assinada:
 * @property int $bo_pag_inss Pg. INSS:
 * @property int $bo_con_est Cont. estudos:
 * @property int $id_tip_ren Tipo renda:
 * @property int $bo_res_ati Em atividade:
 * @property int $bo_cal_urg Calamidade/Emergência:
 * @property int|null $id_num_cbo Profissão:
 * @property string|null $nm_nom_pro Profissão:
 * @property float|null $nu_ren_res R. cliente:
 * @property float $nu_ren_fam 	R. familiar:
 * @property string|null $nm_des_cid Des. CID:
 * @property string|null $nu_cod_cid Cod. CID:
 * @property int $bo_mem_def Membro familiar def.:
 * @property int $bo_ade_fis Física:
 * @property int $bo_ade_vis Visual:
 * @property int $bo_ade_int Intelectual:
 * @property int $bo_ade_aud Auditiva:
 * @property int $bo_ade_nan Nanismo:
 * @property int $bo_ade_mul Múltipla:
 * @property string|null $nm_nom_obs Obs:
 * @property int $id_num_cri Id do criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Id do modificador:
 * @property string $dt_tim_mod Data do modificador:
 *
 * @property Apartamento $conOcu
 * @property GerCorSituacao $corSit
 * @property Dependente[] $dependentes
 * @property GerEstadoCivil $estCiv
 * @property GerGrauInstrucao $graIns
 * @property GerNatOcupacao $natOcu
 * @property GerTabUniCbo $numCbo
 * @property User $numCri
 * @property GerEtnia $numEtn
 * @property GerGenero $numGen
 * @property User $numMod
 * @property GerNacionalidade $numNac
 * @property GerEstado $numNat
 * @property GerProjeto $numProj
 * @property Ocupacao[] $ocupacaos
 * @property GerOriRenda $oriRen
 * @property TecnicoSocial $tecnicoSocial
 * @property TecsocEnfermidade $tecsocEnfermidade
 * @property GerTipoRenda $tipRen
 */
class Responsavel extends ActiveRecord
{

    const SCENARIO_MCMV = 'mcmv';
    const SCENARIO_PAC = 'pac';
    const SCENARIO_PHPMI = 'phpmi';

    public $id_num_cra_f, $nm_nom_cla, $nu_num_ida;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        if (Yii::$app->session->get('sistema') === 'PHPMI') {
            return '{{%persons_reserves}}';
        } else {
            return '{{%responsavel}}';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'id_num_cri',
                'updatedByAttribute' => 'id_num_mod',
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'dt_tim_cri',
                'updatedAtAttribute' => 'dt_tim_mod',
                'value' => date("Y-m-d H:i:s"),
            ],
            'geraInscricao' => [
                'class' => GeraInscricao::class,
            ],
            /* 'getCras' => [
                'class' => GetCras::class,
            ], */
            'upperCase' => [
                'class' => UpperCase::class,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_MCMV] = [
            'bo_reg_exc', 'bo_tec_soc', 'id_num_proj', 'id_cor_sit', 'id_num_gen', 'id_est_civ',
            'id_gra_ins', 'id_num_nat', 'id_num_nac', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
            'bo_car_ass', 'bo_pag_inss', 'bo_con_est', 'id_tip_ren', 'bo_res_ati',
            'bo_cal_urg', 'id_num_cbo', 'bo_mem_def', 'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int',
            'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul', 'id_num_cri', 'id_num_mod',
            'nu_ren_res', 'nu_ren_fam',
            'dt_sor_res', 'dt_com_res', 'dt_nas_res', 'dt_tim_cri', 'dt_tim_mod',
            'nm_ide_pes', 'nu_num_seq', 'nu_num_ins', 'id_con_ocu', 'nm_nom_res', 'nu_num_cep',
            'nm_nom_log', 'nu_num_cas', 'nm_nom_com', 'nm_nom_bai', 'nm_nom_mun', 'nm_nom_est',
            'nu_num_tel', 'nu_num_tel_1', 'nm_nom_ema', 'nu_num_ide', 'nu_num_cpf', 'nu_num_nis',
            'nm_nom_pro', 'nm_des_cid', 'nu_cod_cid', 'nm_nom_obs', 'nm_nom_cla', 'id_num_cra_f', 'nu_num_ida',
        ];
        $scenarios[self::SCENARIO_PAC] = [
            'bo_reg_exc', 'bo_tec_soc', 'id_num_proj', 'id_cor_sit', 'id_num_gen', 'id_est_civ',
            'id_gra_ins', 'id_num_nat', 'id_num_nac', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
            'bo_car_ass', 'bo_pag_inss', 'bo_con_est', 'id_tip_ren', 'bo_res_ati',
            'bo_cal_urg', 'id_num_cbo', 'bo_mem_def', 'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int',
            'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul', 'id_num_cri', 'id_num_mod',
            'nu_ren_res', 'nu_ren_fam',
            'dt_nas_res', 'dt_tim_cri', 'dt_tim_mod',
            'nm_ide_pes', 'nu_num_seq', 'nu_num_ins', 'id_con_ocu', 'nm_nom_res', 'nu_num_cep',
            'nm_nom_log', 'nu_num_cas', 'nm_nom_com', 'nm_nom_bai', 'nm_nom_mun', 'nm_nom_est',
            'nu_num_tel', 'nu_num_tel_1', 'nm_nom_ema', 'nu_num_ide', 'nu_num_cpf', 'nu_num_nis',
            'nm_nom_pro', 'nm_des_cid', 'nu_cod_cid', 'nm_nom_obs',
        ];
        $scenarios[self::SCENARIO_PHPMI] = [
            'bo_reg_exc', 'bo_tec_soc', 'id_num_proj', 'id_cor_sit', 'id_num_gen', 'id_est_civ',
            'id_gra_ins', 'id_num_nat', 'id_num_nac', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
            'bo_car_ass', 'bo_pag_inss', 'bo_con_est', 'id_tip_ren', 'bo_res_ati',
            'bo_cal_urg', 'id_num_cbo', 'bo_mem_def', 'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int',
            'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul', 'id_num_cri', 'id_num_mod',
            'nu_ren_res', 'nu_ren_fam',
            'dt_sor_res', 'dt_com_res', 'dt_nas_res', 'dt_tim_cri', 'dt_tim_mod',
            'nm_ide_pes', 'nu_num_seq', 'nu_num_ins', 'id_con_ocu', 'nm_nom_res', 'nu_num_cep',
            'nm_nom_log', 'nu_num_cas', 'nm_nom_com', 'nm_nom_bai', 'nm_nom_mun', 'nm_nom_est',
            'nu_num_tel', 'nu_num_tel_1', 'nm_nom_ema', 'nu_num_ide', 'nu_num_cpf', 'nu_num_nis',
            'nm_nom_pro', 'nm_des_cid', 'nu_cod_cid', 'nm_nom_obs', 'nm_nom_cla', 'id_num_cra_f', 'nu_num_ida',
        ];

        return $scenarios;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'bo_reg_exc', 'bo_tec_soc', 'id_num_proj', 'id_cor_sit', 'id_num_gen', 'id_est_civ',
                'id_gra_ins', 'id_num_nat', 'id_num_nac', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
                'bo_car_ass', 'bo_pag_inss', 'bo_con_est', 'id_tip_ren', 'bo_res_ati',
                'bo_cal_urg', 'id_num_cbo', 'bo_mem_def', 'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int',
                'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [['dt_sor_res', 'dt_com_res', 'dt_nas_res', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [[
                'id_cor_sit', 'nm_nom_res', 'dt_nas_res', 'nu_num_cpf', 'nu_num_ide',
                'id_num_proj', 'id_num_gen', 'id_est_civ', 'id_gra_ins', 'id_num_nat', 'id_num_etn',
                'id_nat_ocu', 'id_ori_ren', 'bo_cal_urg', 'id_num_cbo', 'bo_mem_def',
                'nu_num_nis', 'nu_num_cep', 'nm_nom_log', 'nu_num_cas', 'nm_nom_com', 'nm_nom_bai', 'nm_nom_mun',
                'nm_nom_est', 'nu_ren_res',
            ], 'required', 'on' => self::SCENARIO_MCMV],
            [[
                'id_cor_sit', 'nm_nom_res', 'dt_nas_res', 'nu_num_cpf', 'id_num_proj', 'id_num_gen',
                'id_est_civ', 'id_gra_ins', 'id_num_nat', 'id_num_etn',
                'id_nat_ocu', 'id_ori_ren', 'id_num_cbo',
            ], 'required', 'on' => self::SCENARIO_PAC],
            [[
                'id_cor_sit', 'nm_nom_res', 'dt_nas_res', 'nu_num_cpf', 'nu_num_ide',
                'id_num_proj', 'id_num_gen', 'id_est_civ', 'id_gra_ins', 'id_num_nat', 'id_num_etn',
                'id_nat_ocu', 'id_ori_ren', 'bo_cal_urg', 'id_num_cbo', 'bo_mem_def',
                /* 'nu_num_nis', */ 'nu_num_cep', 'nm_nom_log', 'nu_num_cas', 'nm_nom_com', 'nm_nom_bai', 'nm_nom_mun',
                'nm_nom_est', 'nu_ren_res', /* 'id_num_cra_f', */
            ], 'required', 'on' => self::SCENARIO_PHPMI],
            [['nm_ide_pes'], 'string', 'max' => 1],
            [['nu_ren_res', 'nu_ren_fam'], 'number'],
            [['nu_num_seq', 'nu_num_cas'], 'string', 'max' => 5],
            [['id_num_cra_f'], 'string', 'max' => 10],
            [['nm_nom_cla'], 'string', 'max' => 10],
            [['nu_num_ida'], 'string', 'max' => 3],
            // [['nu_num_ida'], 'string', 'max' => 3],

            [
                ['dt_nas_res'], 'compare', 'compareValue' =>
                date('Y-m-d', strtotime('-18 year')), 'operator' => '<=',
                'message' => '"Data nascimento:" Responsável deve ser maior de 18 anos".'
            ],
            [['nu_num_ins'], 'string', 'max' => 11],
            [['nm_nom_res', 'nm_nom_ema'], 'string', 'max' => 60],
            [['nu_num_cep'], 'string', 'max' => 10],
            [['nm_nom_log'], 'string', 'max' => 80],
            [['nu_num_cas'], 'string', 'max' => 5],
            [['nm_nom_mun', 'nu_cod_cid'], 'string', 'max' => 50],
            [['nm_nom_com'], 'string', 'max' => 52],
            [['nm_nom_bai'], 'string', 'max' => 40],
            [['nm_nom_est'], 'string', 'max' => 2],
            [['nu_num_cpf'], 'string', 'max' => 14],
            [['id_con_ocu'], 'string', 'max' => 9],
            [['nm_nom_est'], 'string', 'max' => 2],
            ['nu_num_cpf', 'unique'],
            ['nu_num_cpf', ValidarCpf::class],
            [['nu_num_tel', 'nu_num_tel_1'], 'string', 'max' => 15],
            [['nu_num_nis'], 'string', 'max' => 14],
            ['nu_num_nis', ValidarNis::class, 'on' => self::SCENARIO_MCMV],
            ['nu_num_nis', ValidarNis::class, 'on' => self::SCENARIO_PHPMI],
            [['nu_num_ide'], 'string', 'max' => 13],
            ['nu_num_ide', 'unique'],
            [['nm_nom_obs', 'nm_des_cid'], 'string', 'max' => 255],
            [['nu_cod_cid'], 'string', 'max' => 35],
            [['id_cor_sit'], 'exist', 'skipOnError' => true, 'targetClass' => GerCorSituacao::class, 'targetAttribute' => ['id_cor_sit' => 'id_cor_sit']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_mod' => 'id']],
            [['id_num_nac'], 'exist', 'skipOnError' => true, 'targetClass' => GerNacionalidade::class, 'targetAttribute' => ['id_num_nac' => 'id_num_nac']],
            [['id_num_nat'], 'exist', 'skipOnError' => true, 'targetClass' => GerEstado::class, 'targetAttribute' => ['id_num_nat' => 'id_num_est']],
            [['id_num_proj'], 'exist', 'skipOnError' => true, 'targetClass' => GerProjeto::class, 'targetAttribute' => ['id_num_proj' => 'id_num_proj']],
            [['id_ori_ren'], 'exist', 'skipOnError' => true, 'targetClass' => GerOriRenda::class, 'targetAttribute' => ['id_ori_ren' => 'id_ori_ren']],
            [['id_tip_ren'], 'exist', 'skipOnError' => true, 'targetClass' => GerTipoRenda::class, 'targetAttribute' => ['id_tip_ren' => 'id_tip_ren']],
            [['id_con_ocu'], 'exist', 'skipOnError' => true, 'targetClass' => Apartamento::class, 'targetAttribute' => ['id_con_ocu' => 'id_con_ocu']],
            [['id_est_civ'], 'exist', 'skipOnError' => true, 'targetClass' => GerEstadoCivil::class, 'targetAttribute' => ['id_est_civ' => 'id_est_civ']],
            [['id_gra_ins'], 'exist', 'skipOnError' => true, 'targetClass' => GerGrauInstrucao::class, 'targetAttribute' => ['id_gra_ins' => 'id_gra_ins']],
            [['id_nat_ocu'], 'exist', 'skipOnError' => true, 'targetClass' => GerNatOcupacao::class, 'targetAttribute' => ['id_nat_ocu' => 'id_nat_ocu']],
            [['id_num_cbo'], 'exist', 'skipOnError' => true, 'targetClass' => GerTabUniCbo::class, 'targetAttribute' => ['id_num_cbo' => 'id_num_cbo']],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_cri' => 'id']],
            [['id_num_etn'], 'exist', 'skipOnError' => true, 'targetClass' => GerEtnia::class, 'targetAttribute' => ['id_num_etn' => 'id_num_etn']],
            [['id_num_gen'], 'exist', 'skipOnError' => true, 'targetClass' => GerGenero::class, 'targetAttribute' => ['id_num_gen' => 'id_num_gen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_res' => 'Id da tabela responsaveis:',
            'nm_ide_pes' => 'T. pessoa:',
            'nu_num_seq' => 'Sequencial:',
            'id_num_cra_f' => 'Cras',
            'nm_nom_cla' => 'Classificação',
            'nu_num_ins' => 'Inscrição:',
            'bo_reg_exc' => 'Excluído:',
            'bo_tec_soc' => 'Tec. sosial:',
            'id_num_proj' => 'Projetos:',
            'id_cor_sit' => 'Situação:',
            'id_con_ocu' => 'Ocupação:',
            'dt_sor_res' => 'D. sorteio:',
            'dt_com_res' => 'D. contemplação:',
            'nm_nom_res' => 'Nome:',
            'nu_num_cep' => 'CEP.:',
            'nm_nom_log' => 'Logradouro:',
            'nu_num_cas' => 'Nº.:',
            'nm_nom_com' => 'Complemento:',
            'nm_nom_bai' => 'Bairro:',
            'nm_nom_mun' => 'Município:',
            'nm_nom_est' => 'UF.:',
            'nu_num_tel' => 'Telefone:',
            'nu_num_tel_1' => 'Telefone:',
            'dt_nas_res' => 'D.N.:',
            /* 'nu_num_ida' => 'Idade:', */
            'nm_nom_ema' => 'Email:',
            'nu_num_ide' => 'R.G.:',
            'nu_num_cpf' => 'CPF:',
            'nu_num_nis' => 'NIS:',
            'id_num_gen' => 'Gênero:',
            'id_est_civ' => 'E. Cívil:',
            'id_gra_ins' => 'G. instrução:',
            'id_num_nat' => 'Naturalidade:',
            'id_num_nac' => 'Nacionalidade:',
            'id_num_etn' => 'Etnia:',
            'id_nat_ocu' => 'Ocupação:',
            'id_ori_ren' => 'O. R. cliente:',
            'bo_car_ass' => 'C.Assinada:',
            'bo_pag_inss' => 'Pg. INSS:',
            'bo_con_est' => 'Cont. estudos:',
            'id_tip_ren' => 'Tipo renda:',
            'bo_res_ati' => 'Em atividade:',
            'bo_cal_urg' => 'Calamidade/Emergência:',
            'id_num_cbo' => 'Profissão:',
            'nm_nom_pro' => 'Profissão:',
            'nu_ren_res' => 'R. cliente:',
            'nu_ren_fam' => 'R. familiar:',
            'nm_des_cid' => 'Des. CID:',
            'nu_cod_cid' => 'Cod. CID:',
            'bo_mem_def' => 'Membro familiar def.:',
            'bo_ade_fis' => 'Física:',
            'bo_ade_vis' => 'Visual:',
            'bo_ade_int' => 'Intelectual:',
            'bo_ade_aud' => 'Auditiva:',
            'bo_ade_nan' => 'Nanismo:',
            'bo_ade_mul' => 'Múltipla:',
            'nm_nom_obs' => 'Obs:',
            'id_num_cri' => 'Id do criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Id do modificador:',
            'dt_tim_mod' => 'Data do modificador:',
        ];
    }

    public static function generatePeopleToken()
    {
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $dataini = strtotime('now');
        $dataexp = strtotime('+3 hours');
        // Adoption for lcobucci/jwt ^4.0 version
        $token = $jwt->getBuilder()
            ->issuedBy('https://mcmvc.itaborai.rj.gov.br') // Configures the issuer (iss claim)
            ->permittedFor('https://mcmvc.itaborai.rj.gov.br') // Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->issuedAt($dataini) // Configures the time that the token was issue (iat claim)
            ->expiresAt($dataexp) // Configures the expiration time of the token (exp claim)
            ->withClaim('uid', 4) // Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token

        return $token;
    }

    /**
     * Gets query for [[ConOcu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConOcu()
    {
        return $this->hasOne(Apartamento::class, ['id_con_ocu' => 'id_con_ocu']);
    }

    /**
     * Gets query for [[Dependentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::class, ['id_num_res' => 'id_num_res']);
    }

    /**
     * Gets query for [[Ocupacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOcupacaos()
    {
        return $this->hasMany(Ocupacao::class, ['id_num_res' => 'id_num_res']);
    }

    /**
     * Gets query for [[CorSit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorSit()
    {
        return $this->hasOne(GerCorSituacao::class, ['id_cor_sit' => 'id_cor_sit']);
    }

    /**
     * Gets query for [[NumMod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumMod()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_mod']);
    }

    /**
     * Gets query for [[NumNac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumNac()
    {
        return $this->hasOne(GerNacionalidade::class, ['id_num_nac' => 'id_num_nac']);
    }

    /**
     * Gets query for [[NumNat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumNat()
    {
        return $this->hasOne(GerEstado::class, ['id_num_est' => 'id_num_nat']);
    }

    /**
     * Gets query for [[NumProj]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumProj()
    {
        return $this->hasOne(GerProjeto::class, ['id_num_proj' => 'id_num_proj']);
    }

    /**
     * Gets query for [[OriRen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriRen()
    {
        return $this->hasOne(GerOriRenda::class, ['id_ori_ren' => 'id_ori_ren']);
    }

    /**
     * Gets query for [[TipRen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipRen()
    {
        return $this->hasOne(GerTipoRenda::class, ['id_tip_ren' => 'id_tip_ren']);
    }

    /**
     * Gets query for [[EstCiv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstCiv()
    {
        return $this->hasOne(GerEstadoCivil::class, ['id_est_civ' => 'id_est_civ']);
    }

    /**
     * Gets query for [[GraIns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGraIns()
    {
        return $this->hasOne(GerGrauInstrucao::class, ['id_gra_ins' => 'id_gra_ins']);
    }

    /**
     * Gets query for [[NatOcu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNatOcu()
    {
        return $this->hasOne(GerNatOcupacao::class, ['id_nat_ocu' => 'id_nat_ocu']);
    }

    /**
     * Gets query for [[NumCbo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumCbo()
    {
        return $this->hasOne(GerTabUniCbo::class, ['id_num_cbo' => 'id_num_cbo']);
    }

    /**
     * Gets query for [[NumCri]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumCri()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_cri']);
    }

    /**
     * Gets query for [[NumEtn]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumEtn()
    {
        return $this->hasOne(GerEtnia::class, ['id_num_etn' => 'id_num_etn']);
    }

    /**
     * Gets query for [[NumGen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumGen()
    {
        return $this->hasOne(GerGenero::class, ['id_num_gen' => 'id_num_gen']);
    }

    /**
     * Gets query for [[TecnicoSocial]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTecnicoSocial()
    {
        return $this->hasOne(TecnicoSocial::class, ['id_num_res' => 'id_num_res']);
    }

    /**
     * Gets query for [[TecsocEnfermidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTecsocEnfermidade()
    {
        return $this->hasOne(TecsocEnfermidade::class, ['id_num_res' => 'id_num_res']);
    }


    /**
     * {@inheritdoc}
     * @return ResponsavelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResponsavelQuery(get_called_class());
    }

    /*  public function fields()
    {
        $fields = parent::fields();

        $fields['nu_num_ida'] =  '2';
        /* 'nu_num_ida' => function () {
                $data = new DateTime($this->dt_nas_res);
                $resultado = $data->diff(new DateTime(date('Y-m-d')));
                return $resultado->format('%Y');
            }, 
        return $fields;
    } */


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            // Place your custom code here

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return ActiveQuery
     */

    public function getDepCon()
    {
        return $this->hasMany(Dependente::class, ['id_num_res' => 'id_num_res'], ['id_num_par' => 4], ['bo_reg_exc' => 0]);
        /* $resultD = Dependente::find()
          ->where(['id_num_res' => $this->id_num_res])
          ->andWhere(['id_num_par' => 4])
          ->andWhere(['bo_reg_exc' => 0]);
          if (is_null($resultD)) {
          $resultD = 0;
          }
          return ($resultD); */
    }

    public function getRenda()
    {
        $resultR = Responsavel::find()
            ->where(['id_num_res' => $this->id_num_res])
            ->andWhere(['bo_reg_exc' => 0])
            ->sum('nu_ren_res');
        $resultD = Dependente::find()
            ->where(['id_num_res' => $this->id_num_res])
            ->andWhere(['bo_reg_exc' => 0])
            ->sum('nu_ren_dep');
        if (is_null($resultR)) {
            $resultR = 0;
        }
        if (is_null($resultD)) {
            $resultD = 0;
        }
        return ($resultR + $resultD);
    } 

    public static function getIdade($dtnas)
    {

        $data = new DateTime($dtnas);
        $resultado = $data->diff(new DateTime(date('Y-m-d')));
        return $resultado->format('%Y');

        /* $datetime1 = new DateTime($dtnas);
        $datetime2 = new DateTime();
        $diff = $datetime1->diff($datetime2);
        return $diff->y; */
    }
}
