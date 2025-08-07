<?php

namespace app\modules\fun\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\modules\user\models\User;
use app\modules\age\models\Agendas;
use app\modules\inu\models\Inumados;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\auxiliar\models\Cargos;
use app\components\validador\ValidarCpf;
use app\modules\auxiliar\models\Funcoes;
use app\modules\auxiliar\models\Regimes;
use app\modules\auxiliar\models\Unidades;
use app\modules\locinu\models\LocInumacoes;
use app\modules\fun\models\FuncionariosQuery;
use app\modules\auxiliar\models\CargaHorarias;

/**
 * This is the model class for table "{{%funcionarios}}".
 *
 * @property int $id_num_fun Id da tabela Funcionários da Saúde.
 * @property string $nu_mat_fun Matrícula:
 * @property string $nm_nom_fun Nome:
 * @property string $dt_nas_fun D.N .:
 * @property string $nu_cpf_fun CPF:
 * @property string $nu_ide_fun Identidade:
 * @property int $id_num_uni Id da tabela Unidades.
 * @property int $id_num_car Id da tabela Cargo.
 * @property int $id_num_fuc Id da tabela Função.
 * @property int $id_num_reg Id da tabela Regimes.
 * @property int $id_car_hor Id da tabela Carga Horária.
 * @property string $nm_nom_mae Mãe:
 * @property string $nm_nom_pai Pai:
 * @property string $nm_nom_ema E-mail:
 * @property string $nu_num_cep CEP:
 * @property string $nm_nom_log Logradouro:
 * @property string $nu_num_cas Número:
 * @property string $nm_nom_com Complemento:
 * @property string $nm_nom_bai Bairro:
 * @property string $nm_nom_mun Município:
 * @property string $nm_nom_est GerEstado:
 * @property string $nu_num_tel Telefone:
 * @property string $nu_num_tel_1 Telefone:
 * @property string $dt_tim_cri Data da criação:
 * @property int $id_num_cri Id do criador:
 * @property string $dt_tim_mod Data modificação:
 * @property int $id_num_mod Id do modificador:
 *
 * @property Agendas[] $agendas
 * @property Funcoes $numFuc
 * @property User $numCri
 * @property User $numMod
 * @property Cargos $numCar
 * @property CargaHorarias $carHor
 * @property Regimes $numReg
 * @property Unidades $numUni
 * @property Inumados[] $inumados
 */
class Funcionarios extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%funcionarios}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'id_num_cri',
                    'updatedByAttribute' => 'id_num_mod',
                ],
                [
                    'class' => TimestampBehavior::class,
                    'createdAtAttribute' => 'dt_tim_cri',
                    'updatedAtAttribute' => 'dt_tim_mod',
                    'value' => Yii::$app->formatter->asDate(new Expression('NOW()')),
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'nu_mat_fun', 'nm_nom_fun', 'dt_nas_fun', 'nu_cpf_fun', 'nu_ide_fun',
                'id_num_uni', 'id_num_car', 'id_num_fuc', 'id_num_reg', 'id_car_hor',
                'nm_nom_mae', 'nm_nom_pai', 'nm_nom_ema', 'nu_num_cep', 'nm_nom_log',
                'nu_num_cas', 'nm_nom_com', 'nm_nom_bai', 'nm_nom_mun', 'nm_nom_est',
                'nu_num_tel', 'nu_num_tel_1'
            ], 'required'],
            [['dt_nas_fun', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [[
                'id_num_uni', 'id_num_car', 'id_num_fuc', 'id_num_reg', 'id_car_hor',
                'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [['nu_mat_fun',], 'string', 'max' => 11],
            [['nu_cpf_fun'], 'string', 'max' => 14],
            [['nu_num_cep'], 'string', 'max' => 11],
            [['nm_nom_log'], 'string', 'max' => 80],
            [['nu_num_cas'], 'string', 'max' => 4],
            [['nm_nom_com'], 'string', 'max' => 50],
            [['nm_nom_bai', 'nm_nom_mun'], 'string', 'max' => 40],
            [['nm_nom_est'], 'string', 'max' => 2],
            [['nu_num_tel', 'nu_num_tel_1'], 'string', 'max' => 15],
            ['nu_cpf_fun', 'unique'],
            [['nm_nom_fun', 'nm_nom_mae', 'nm_nom_pai', 'nm_nom_ema'], 'string', 'max' => 60],
            ['nm_nom_fun', 'unique', 'targetAttribute' => ['nm_nom_mae']],
            ['nm_nom_fun', 'unique', 'targetAttribute' => ['nm_nom_pai']],
            ['nm_nom_fun', 'unique', 'targetAttribute' => ['nm_nom_ema']],
            [['nu_ide_fun'], 'string', 'max' => 14],
            [
                ['id_num_fuc'], 'exist', 'skipOnError' => true, 'targetClass' => Funcoes::class,
                'targetAttribute' => ['id_num_fuc' => 'id_num_fuc']
            ],
            [
                ['id_car_hor'], 'exist', 'skipOnError' => true, 'targetClass' => CargaHorarias::class,
                'targetAttribute' => ['id_car_hor' => 'id_car_hor']
            ],
            [
                ['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['id_num_cri' => 'id']
            ],
            [
                ['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['id_num_mod' => 'id']
            ],
            [
                ['id_num_car'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class,
                'targetAttribute' => ['id_num_car' => 'id_num_car']
            ],
            [
                ['id_num_reg'], 'exist', 'skipOnError' => true, 'targetClass' => Regimes::class,
                'targetAttribute' => ['id_num_reg' => 'id_num_reg']
            ],
            [
                ['id_num_uni'], 'exist', 'skipOnError' => true, 'targetClass' => Unidades::class,
                'targetAttribute' => ['id_num_uni' => 'id_num_uni']
            ],
            ['nu_cpf_fun', ValidarCpf::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_num_fun' => 'Id da tabela Funcionários da Saúde.',
            'nu_mat_fun' => 'Matrícula:',
            'nm_nom_fun' => 'Nome:',
            'nu_cpf_fun' => 'CPF:',
            'nu_ide_fun' => 'Identidade:',
            'id_num_uni' => 'Unidade:',
            'id_num_car' => 'Cargo:',
            'id_num_fuc' => 'Função:',
            'id_num_reg' => 'Regime:',
            'id_car_hor' => 'C.H.:',
            'nm_nom_mae' => 'Mãe:',
            'nm_nom_pai' => 'Pai:',
            'dt_nas_fun' => 'Data nascimento:',
            'nm_nom_ema' => 'E-mail:',
            'nu_num_cep' => 'CEP:',
            'nm_nom_log' => 'Logradouro:',
            'nu_num_cas' => 'Número:',
            'nm_nom_com' => 'Complemento:',
            'nm_nom_bai' => 'Bairro:',
            'nm_nom_mun' => 'Município:',
            'nm_nom_est' => 'GerEstado:',
            'nu_num_tel' => 'Telefone:',
            'nu_num_tel_1' => 'Telefone Contato:',
            'id_num_cri' => 'Id do Criador:',
            'dt_tim_cri' => 'Data da criação:',
            'id_num_mod' => 'Id do modificador:',
            'dt_tim_mod' => 'Data da modificação:',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agendas::class, ['id_num_fun' => 'id_num_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumFuc()
    {
        return $this->hasOne(Funcoes::class, ['id_num_fuc' => 'id_num_fuc']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumHor()
    {
        return $this->hasOne(CargaHorarias::class, ['id_car_hor' => 'id_car_hor']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumCri()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_cri']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumMod()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_mod']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumCar()
    {
        return $this->hasOne(Cargos::class, ['id_num_car' => 'id_num_car']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumReg()
    {
        return $this->hasOne(Regimes::class, ['id_num_reg' => 'id_num_reg']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumUni()
    {
        return $this->hasOne(Unidades::class, ['id_num_uni' => 'id_num_uni']);
    }

    /**
     * @return ActiveQuery
     */
    public function getInumados()
    {
        return $this->hasMany(Inumados::class, ['id_num_fun' => 'id_num_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLocInumacoes()
    {
        return $this->hasMany(LocInumacoes::class, ['id_num_fun' => 'id_num_fun']);
    }

    /**
     * @inheritdoc
     * @return FuncionariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FuncionariosQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $dataTime = date("Y-m-d H:i:s");
            $this->nm_nom_fun = strtoupper($this->nm_nom_fun);
            $this->nm_nom_mae = strtoupper($this->nm_nom_mae);
            $this->nm_nom_pai = strtoupper($this->nm_nom_pai);
            $this->nm_nom_log = strtoupper($this->nm_nom_log);
            $this->nm_nom_com = strtoupper($this->nm_nom_com);
            $this->nm_nom_bai = strtoupper($this->nm_nom_bai);
            $this->nm_nom_mun = strtoupper($this->nm_nom_mun);
            $this->nm_nom_est = strtoupper($this->nm_nom_est);
            if ($this->isNewRecord) {
                //In case its a new;
                $this->dt_tim_cri = $dataTime; // Data de criação.
                $this->dt_tim_mod = $dataTime; // Data de modificação.
                $this->id_num_cri = Yii::$app->user->identity->getId(); //Identifica quem criou.
                $this->id_num_mod = Yii::$app->user->identity->getId(); //Identifica quem modificou.;
            } else {
                //In case we're editing
                $this->dt_tim_mod = $dataTime; // Data de modificação;
                $this->id_num_mod = Yii::$app->user->identity->getId(); //Identifica quem modificou.
            };
        } else {
            return false;
        }
        return parent::beforeSave($insert);
    }
}
