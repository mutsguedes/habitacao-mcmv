<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\UnidadesQuery;
use app\modules\fun\models\Funcionarios;
use app\modules\user\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%unidades}}".
 *
 * @property int $id_num_uni Id da tabela Unidades.
 * @property string $nm_nom_uni Nome da unidade.
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
 * @property Funcionarios[] $funcionarios
 * @property User $numCri
 * @property User $numMod
 * @property Inumados[] $inumados
 * @property LocInumacoes[] $locInumacoes
 */
class Unidades extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%unidades}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [[
            'nm_nom_uni', 'nu_num_cep', 'nm_nom_log', 'nu_num_cas', 'nm_nom_com',
            'nm_nom_bai', 'nm_nom_mun', 'nm_nom_est',
            'nu_num_tel', 'nu_num_tel_1'
                ], 'required'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['id_num_cri', 'id_num_mod'], 'integer'],
            [['nu_num_cep'], 'string', 'max' => 11],
            [['nm_nom_log'], 'string', 'max' => 80],
            [['nu_num_cas'], 'string', 'max' => 4],
            [['nm_nom_com'], 'string', 'max' => 50],
            [['nm_nom_bai', 'nm_nom_mun'], 'string', 'max' => 40],
            [['nm_nom_est'], 'string', 'max' => 2],
            [['nu_num_tel', 'nu_num_tel_1'], 'string', 'max' => 15],
            [
                ['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['id_num_cri' => 'id']
            ],
            [
                ['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['id_num_mod' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_num_uni' => 'Id da tabela Unidades.',
            'nm_nom_uni' => 'Nome da unidade.',
            'nu_num_cep' => 'CEP:',
            'nm_nom_log' => 'Logradouro:',
            'nu_num_cas' => 'Número:',
            'nm_nom_com' => 'Complemento:',
            'nm_nom_bai' => 'Bairro:',
            'nm_nom_mun' => 'Município:',
            'nm_nom_est' => 'GerEstado:',
            'nu_num_tel' => 'Telefone:',
            'nu_num_tel_1' => 'Telefone:',
            'dt_tim_cri' => 'Data da criação:',
            'id_num_cri' => 'Id do criador:',
            'dt_tim_mod' => 'Data modificação:',
            'id_num_mod' => 'Id do modificador:',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getFuncionarios() {
        return $this->hasMany(Funcionarios::class, ['id_num_uni' => 'id_num_uni']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumCri() {
        return $this->hasOne(User::class, ['id' => 'id_num_cri']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNumMod() {
        return $this->hasOne(User::class, ['id' => 'id_num_mod']);
    }

    /**
     * @return ActiveQuery
     */
    public function getInumados() {
        return $this->hasMany(Inumados::class, ['id_num_uni' => 'id_num_uni']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLocInumacoes() {
        return $this->hasMany(LocInumacoes::class, ['id_num_uni' => 'id_num_uni']);
    }

    /**
     * @inheritdoc
     * @return UnidadesQuery the active query used by this AR class.
     */
    public static function find() {
        return new UnidadesQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $dataTime = date("Y-m-d H:i:s");
            $this->nm_nom_log = strtoupper($this->nm_nom_log);
            $this->nm_nom_com = strtoupper($this->nm_nom_com);
            $this->nm_nom_bai = strtoupper($this->nm_nom_bai);
            $this->nm_nom_mun = strtoupper($this->nm_nom_mun);
            $this->nm_nom_est = strtoupper($this->nm_nom_est);
            if ($this->isNewRecord) {
                //In case its a new;)
                $this->dt_tim_cri = $dataTime; // Data de criação.
                $this->dt_tim_mod = $dataTime; // Data de modificação.;
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
