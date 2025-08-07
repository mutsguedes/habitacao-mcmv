<?php

namespace app\modules\tecsoc\models;

use Yii;
use app\myBehaviors\UpperCase;
use app\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\tecsoc\models\TecsocDocumentoQuery;

/**
 * This is the model class for table "{{%tecsoc_documento}}".
 *
 * @property int $id_num_doc Id tabela documentos:
 * @property int $bo_reg_exc Excluído:
 * @property string $id_num_pes Pessoa:
 * @property int $bo_reg_ger RG:
 * @property int $bo_car_tra CT.:
 * @property int $bo_cad_cpf CPF.:
 * @property int $bol_cer_nas CN:
 * @property int $bo_cer_cas CC:
 * @property int $bo_tit_ele TE:
 * @property int $bo_ine_nis NIS:
 * @property int $id_num_cri Id criação:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Id modificador:
 * @property string $dt_tim_mod Data modificação:
 *
 * @property Responsavel $numPes
 * @property Dependente $numPes0
 * @property User $numCri
 * @property User $numMod
 */
class TecsocDocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tecsoc_documento}}';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'bo_reg_exc','bo_reg_ger', 'bo_car_tra', 'bo_cad_cpf', 'bol_cer_nas',
                'bo_cer_cas', 'bo_tit_ele', 'bo_ine_nis', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
             
            [['id_num_pes',], 'string', 'max' => 23],
            [['id_num_pes',], 'required'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
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
            'id_num_doc' => 'Id tabela documentos:',
            'bo_reg_exc' => 'Excluído:',
            'id_num_pes' => 'Pessoa:',
            'bo_reg_ger' => 'RG:',
            'bo_car_tra' => 'CT.:',
            'bo_cad_cpf' => 'CPF.:',
            'bol_cer_nas' => 'CN:',
            'bo_cer_cas' => 'CC:',
            'bo_tit_ele' => 'TE:',
            'bo_ine_nis' => 'NIS:',
            'id_num_cri' => 'Id criação:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Id modificador:',
            'dt_tim_mod' => 'Data modificação:',
        ];
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
     * @return TecsocDocumentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TecsocDocumentoQuery(get_called_class());
    }
}
