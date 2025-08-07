<?php

namespace app\modules\dep\models;

use Yii;
use yii\db\ActiveRecord;
use app\myBehaviors\UpperCase;
use app\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\res\models\Responsavel;
use app\components\validador\ValidarCpf;
use app\modules\auxiliar\models\GerEtnia;
use app\modules\auxiliar\models\GerEstado;
use app\modules\auxiliar\models\GerGenero;
use app\modules\dep\models\DependenteQuery;
use app\modules\auxiliar\models\GerOriRenda;
use app\modules\auxiliar\models\GerTabUniCbo;
use app\modules\auxiliar\models\GerTipoRenda;
use app\modules\auxiliar\models\GerParentesco;
use app\modules\auxiliar\models\GerEstadoCivil;
use app\modules\auxiliar\models\GerNatOcupacao;
use app\modules\auxiliar\models\GerGrauInstrucao;
use app\modules\auxiliar\models\GerNacionalidade;


/**
 * This is the model class for table "{{%dependente}}".
 *
 * @property int $id_num_dep Id da tabela dependentes:
 * @property string $nm_ide_pes T. pessoa:
 * @property int $id_num_res Responsáveis
 * @property int $bo_reg_exc Excluído:
 * @property int $id_num_par Parentesco:
 * @property string $nm_nom_dep Nome:
 * @property string|null $dt_nas_dep D.N.:
 * @property int $id_num_nat Naturalidade:
 * @property int $id_num_nac Nacionalidade:
 * @property int $id_gra_ins G. instrução:
 * @property int $id_est_civ E. CÍvil:
 * @property int $id_num_gen Gênero:
 * @property int $id_num_etn Etnia:
 * @property int $id_nat_ocu N. ocupação:
 * @property int $id_ori_ren O. R. dependente:
 * @property int $id_tip_ren Tipo renda:
 * @property int $bo_pag_inss Paga INSS:
 * @property int $bo_dep_ati Em atividade:
 * @property int $bo_car_ass C. assinada:
 * @property string|null $nu_num_cpf CPF:
 * @property string|null $nu_num_ide R.G.:
 * @property string|null $nm_nom_obs Obs:
 * @property int|null $id_num_cbo Profissão:
 * @property float $nu_ren_dep R. dependente:
 * @property string|null $nm_des_cid Des. CID:
 * @property string|null $nu_cod_cid Cod. CID:
 * @property int $bo_mem_def Membro familiar def.:
 * @property int $bo_ade_fis Física:
 * @property int $bo_ade_vis Visual:
 * @property int $bo_ade_int Intelectual:
 * @property int $bo_ade_aud Auditiva:
 * @property int $bo_ade_nan Nanismo:
 * @property int $bo_ade_mul Múltipla:
 * @property int $id_num_cri Id do criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Id do criador:
 * @property string $dt_tim_mod Id do criador:
 *
 * @property GerEstadoCivil $estCiv
 * @property GerEstado $numNat
 * @property GerParentesco $numPar
 * @property Responsavel $numRes
 * @property GerOriRenda $oriRen
 * @property GerTipoRenda $tipRen
 * @property GerGrauInstrucao $graIns
 * @property GerNatOcupacao $natOcu
 * @property GerTabUniCbo $numCbo
 * @property User $numCri
 * @property GerEtnia $numEtn
 * @property GerGenero $numGen
 * @property User $numMod
 * @property GerNacionalidade $numNac
 */
class Dependente extends ActiveRecord
{

    const SCENARIO_MCMV = 'mcmv';
    const SCENARIO_PAC = 'pac';
    const SCENARIO_PHPMI = 'phpmi';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        if (Yii::$app->session->get('sistema') === 'PHPMI') {
            return '{{%dependents_reserves}}';
        } else {
            return '{{%dependente}}';
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
            'id_num_dep', 'id_num_res', 'bo_reg_exc', 'id_num_par', 'id_num_nat', 'id_num_nac',
            'id_gra_ins', 'id_est_civ', 'id_num_gen', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
            'id_tip_ren', 'bo_pag_inss', 'bo_dep_ati', 'bo_car_ass', 'id_num_cbo', 'bo_mem_def',
            'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int', 'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul',
            'id_num_cri', 'id_num_mod',
            'nu_ren_dep',
            'dt_nas_dep',  'dt_tim_cri', 'dt_tim_mod',
            'nm_ide_pes', 'nm_nom_dep', 'nu_num_cpf', 'nu_num_ide', 'nm_nom_obs', 'nm_des_cid',
            'nu_cod_cid',
        ];
        $scenarios[self::SCENARIO_PAC] = [
            'id_num_dep', 'id_num_res', 'bo_reg_exc', 'id_num_par', 'id_num_nat', 'id_num_nac',
            'id_gra_ins', 'id_est_civ', 'id_num_gen', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
            'id_tip_ren', 'bo_pag_inss', 'bo_dep_ati', 'bo_car_ass', 'id_num_cbo', 'bo_mem_def',
            'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int', 'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul',
            'id_num_cri', 'id_num_mod',
            'nu_ren_dep',
            'dt_nas_dep',  'dt_tim_cri', 'dt_tim_mod',
            'nm_ide_pes', 'nm_nom_dep', 'nu_num_cpf', 'nu_num_ide', 'nm_nom_obs', 'nm_des_cid',
            'nu_cod_cid',
        ];
        $scenarios[self::SCENARIO_PHPMI] = [
            'id_num_dep', 'id_num_res', 'bo_reg_exc', 'id_num_par', 'id_num_nat', 'id_num_nac',
            'id_gra_ins', 'id_est_civ', 'id_num_gen', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
            'id_tip_ren', 'bo_pag_inss', 'bo_dep_ati', 'bo_car_ass', 'id_num_cbo', 'bo_mem_def',
            'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int', 'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul',
            'id_num_cri', 'id_num_mod',
            'nu_ren_dep',
            'dt_nas_dep',  'dt_tim_cri', 'dt_tim_mod',
            'nm_ide_pes', 'nm_nom_dep', 'nu_num_cpf', 'nu_num_ide', 'nm_nom_obs', 'nm_des_cid',
            'nu_cod_cid',
        ];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ide_pes'], 'string'],
            [[
                'id_num_res', 'bo_reg_exc', 'id_num_par', 'id_num_nat', 'id_num_nac',
                'id_gra_ins', 'id_est_civ', 'id_num_gen', 'id_num_etn', 'id_nat_ocu',
                'id_ori_ren', 'id_tip_ren', 'bo_pag_inss', 'bo_dep_ati', 'bo_car_ass',
                'id_num_cbo', 'bo_mem_def', 'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int',
                'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [[
                'id_num_res', 'nm_nom_dep', 'id_num_par', 'id_num_nat', 'id_gra_ins', 'id_est_civ',
                'id_num_gen', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren', 'id_num_cbo',
                'bo_mem_def', 'dt_nas_dep'
            ], 'required', 'on' => self::SCENARIO_MCMV],
            [[
                'id_num_res', 'nm_nom_dep', 'id_num_par', 'id_num_nat', 'id_gra_ins', 'id_est_civ',
                'id_num_gen', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren', 'id_num_cbo',
                'bo_mem_def', 'dt_nas_dep'
            ], 'required', 'on' => self::SCENARIO_PAC],
            [[
                'id_num_res', 'nm_nom_dep', 'id_num_par', 'id_num_nat', 'id_gra_ins', 'id_est_civ',
                'id_num_gen', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren', 'id_num_cbo',
                'bo_mem_def', 'dt_nas_dep'
            ], 'required', 'on' => self::SCENARIO_PHPMI],
            [['dt_nas_dep', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nu_ren_dep'], 'number'],
            [['nm_nom_dep'], 'string', 'max' => 60],
            [['nu_num_cpf'], 'string', 'max' => 14],
            ['nu_num_cpf', 'unique'],
            // ['nu_num_cpf', 'unique', 'filter' => ['!=', 'bo_reg_exc', 1]],
            ['nu_num_cpf', ValidarCpf::class],
            [['nu_num_ide'], 'string', 'max' => 14],
            ['nu_num_ide', 'unique'],
            [['nm_nom_obs', 'nm_des_cid'], 'string', 'max' => 255],
            [['nu_cod_cid'], 'string', 'max' => 35],
            [['id_est_civ'], 'exist', 'skipOnError' => true, 'targetClass' => GerEstadoCivil::class, 'targetAttribute' => ['id_est_civ' => 'id_est_civ']],
            [['id_num_nat'], 'exist', 'skipOnError' => true, 'targetClass' => GerEstado::class, 'targetAttribute' => ['id_num_nat' => 'id_num_est']],
            [['id_num_par'], 'exist', 'skipOnError' => true, 'targetClass' => GerParentesco::class, 'targetAttribute' => ['id_num_par' => 'id_num_par']],
            [['id_num_res'], 'exist', 'skipOnError' => true, 'targetClass' => Responsavel::class, 'targetAttribute' => ['id_num_res' => 'id_num_res']],
            [['id_ori_ren'], 'exist', 'skipOnError' => true, 'targetClass' => GerOriRenda::class, 'targetAttribute' => ['id_ori_ren' => 'id_ori_ren']],
            [['id_tip_ren'], 'exist', 'skipOnError' => true, 'targetClass' => GerTipoRenda::class, 'targetAttribute' => ['id_tip_ren' => 'id_tip_ren']],
            [['id_gra_ins'], 'exist', 'skipOnError' => true, 'targetClass' => GerGrauInstrucao::class, 'targetAttribute' => ['id_gra_ins' => 'id_gra_ins']],
            [['id_nat_ocu'], 'exist', 'skipOnError' => true, 'targetClass' => GerNatOcupacao::class, 'targetAttribute' => ['id_nat_ocu' => 'id_nat_ocu']],
            [['id_num_cbo'], 'exist', 'skipOnError' => true, 'targetClass' => GerTabUniCbo::class, 'targetAttribute' => ['id_num_cbo' => 'id_num_cbo']],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_cri' => 'id']],
            [['id_num_etn'], 'exist', 'skipOnError' => true, 'targetClass' => GerEtnia::class, 'targetAttribute' => ['id_num_etn' => 'id_num_etn']],
            [['id_num_gen'], 'exist', 'skipOnError' => true, 'targetClass' => GerGenero::class, 'targetAttribute' => ['id_num_gen' => 'id_num_gen']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_mod' => 'id']],
            [['id_num_nac'], 'exist', 'skipOnError' => true, 'targetClass' => GerNacionalidade::class, 'targetAttribute' => ['id_num_nac' => 'id_num_nac']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_dep' => 'Id da tabela dependentes:',
            'nm_ide_pes' => 'T. pessoa:',
            'id_num_res' => 'Responsáveis',
            'bo_reg_exc' => 'Excluído:',
            'id_num_par' => 'Parentesco:',
            'nm_nom_dep' => 'Nome:',
            'dt_nas_dep' => 'D.N.:',
            'id_num_nat' => 'Naturalidade:',
            'id_num_nac' => 'Nacionalidade:',
            'id_gra_ins' => 'G. instrução:',
            'id_est_civ' => 'E. CÍvil:',
            'id_num_gen' => 'Gênero:',
            'id_num_etn' => 'Etnia:',
            'id_nat_ocu' => 'N. ocupação:',
            'id_ori_ren' => 'O. R. dependente:',
            'id_tip_ren' => 'Tipo renda:',
            'bo_pag_inss' => 'Paga INSS:',
            'bo_dep_ati' => 'Em atividade:',
            'bo_car_ass' => 'C. assinada:',
            'nu_num_cpf' => 'CPF:',
            'nu_num_ide' => 'R.G.:',
            'nm_nom_obs' => 'Obs:',
            'id_num_cbo' => 'Profissão:',
            'nu_ren_dep' => 'R. dependente:',
            'nm_des_cid' => 'Des. CID:',
            'nu_cod_cid' => 'Cod. CID:',
            'bo_mem_def' => 'Membro familiar def.:',
            'bo_ade_fis' => 'Física:',
            'bo_ade_vis' => 'Visual:',
            'bo_ade_int' => 'Intelectual:',
            'bo_ade_aud' => 'Auditiva:',
            'bo_ade_nan' => 'Nanismo:',
            'bo_ade_mul' => 'Múltipla:',
            'id_num_cri' => 'Id do criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Id do criador:',
            'dt_tim_mod' => 'Id do criador:',
        ];
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
     * Gets query for [[NumNat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumNat()
    {
        return $this->hasOne(GerEstado::class, ['id_num_est' => 'id_num_nat']);
    }

    /**
     * Gets query for [[NumPar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumPar()
    {
        return $this->hasOne(GerParentesco::class, ['id_num_par' => 'id_num_par']);
    }

    /**
     * Gets query for [[NumRes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumRes()
    {
        return $this->hasOne(Responsavel::class, ['id_num_res' => 'id_num_res']);
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
     * {@inheritdoc}
     * @return DependenteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DependenteQuery(get_called_class());
    }
}
