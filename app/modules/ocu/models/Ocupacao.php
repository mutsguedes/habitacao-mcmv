<?php

namespace app\modules\ocu\models;

use Yii;
use app\modules\user\models\User;
use app\modules\res\models\Responsavel;
use app\modules\ocu\models\OcupacaoQuery;

/**
 * This is the model class for table "{{%ocupacao}}".
 *
 * @property int $id_num_ocu Id tabela ocupacoes:
 * @property bool|null $bo_reg_exc Excluído:
 * @property int|null $id_num_res Responsável:
 * @property int|null $id_num_apa Apartamento:
 * @property string $dt_ocu_apa Data ocupação:
 * @property string|null $nm_nom_obs Obs.:
 * @property string|null $nu_num_cpf
 * @property int|null $id_num_cri Id do criador:
 * @property string|null $dt_tim_cri Data criação:
 * @property int|null $id_num_mod Id do modificador:
 * @property string|null $dt_tim_mod Data modificação:
 *
 * @property Responsavel $numRes
 * @property User $numCri
 * @property User $numMod
 */
class Ocupacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ocupacao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bo_reg_exc'], 'boolean'],
            [['id_num_res', 'id_num_apa', 'id_num_cri', 'id_num_mod'], 'default', 'value' => null],
            [['id_num_res', 'id_num_apa', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['dt_ocu_apa'], 'string', 'max' => 7],
            [['nm_nom_obs'], 'string', 'max' => 255],
            [['nu_num_cpf'], 'string', 'max' => 11],
            [['id_num_res'], 'exist', 'skipOnError' => true, 'targetClass' => Responsavel::class, 'targetAttribute' => ['id_num_res' => 'id_num_res']],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_cri' => 'id']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_mod' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_ocu' => 'Id tabela ocupacoes:',
            'bo_reg_exc' => 'Excluído:',
            'id_num_res' => 'Responsável:',
            'id_num_apa' => 'Apartamento:',
            'dt_ocu_apa' => 'Data ocupação:',
            'nm_nom_obs' => 'Obs.:',
            'nu_num_cpf' => 'Nu Num Cpf',
            'id_num_cri' => 'Id do criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Id do modificador:',
            'dt_tim_mod' => 'Data modificação:',
        ];
    }

    /**
     * Gets query for [[NumRes]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getNumRes()
    {
        return $this->hasOne(Responsavel::class, ['id_num_res' => 'id_num_res']);
    }

    /**
     * Gets query for [[NumCri]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getNumCri()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_cri']);
    }

    /**
     * Gets query for [[NumMod]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getNumMod()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_mod']);
    }

    /**
     * {@inheritdoc}
     * @return OcupacaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OcupacaoQuery(get_called_class());
    }
}
