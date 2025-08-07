<?php

namespace app\modules\tecsoc\models;

use Yii;
use app\myBehaviors\UpperCase;
use app\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\res\models\Responsavel;
use app\modules\tecsoc\models\TecsocEnfermidadeQuery;

/**
 * This is the model class for table "{{%tecsoc_enfermidade}}".
 *
 * @property int $id_num_enf Id da tabela tecsoc_enfermidade.
 * @property int $id_num_res Responsável:
 * @property int $bo_reg_exc Excluído:
 * @property int $bo_cro_nen Nenhum:
 * @property int $bo_cro_alc Álcool/drogas:
 * @property int $bo_cro_alz Alzheimer:
 * @property int $bo_cro_can Câncer
 * @property int $bo_cro_car Cardiovasculares:
 * @property int $bo_cro_dep Depressão:
 * @property int $bo_cro_dia Diabetes:
 * @property int $bo_cro_hip Hipertensão:
 * @property int $bo_cro_par Parkinson:
 * @property int $bo_cro_pul Pulmonar:
 * @property int $bo_cro_ren Renal:
 * @property string|null $nm_cro_out Outras:
 * @property int $bo_ger_nen Nenhum:
 * @property int $bo_ger_chi Chikungunya:
 * @property int $bo_ger_col Cólera:
 * @property int $bo_ger_den Dengue:
 * @property int $bo_ger_dia Diarréia:
 * @property int $bo_ger_dif Difteria:
 * @property int $bo_ger_feb Febre amarela:
 * @property int $bo_ger_hep Hepatite:
 * @property int $bo_ger_lep Leptospirose:
 * @property int $bo_ger_mal Malária:
 * @property int $bo_ger_res Respiratório:
 * @property int $bo_ger_tif Tifo:
 * @property int $bo_ger_ver Verminose
 * @property int $bo_ger_zic Zica:
 * @property string|null $nm_ger_pel Pele:
 * @property string|null $nm_ger_out Outras:
 * @property int $id_num_cri Id do criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Id do modificador:
 * @property string $dt_tim_mod Data modificação:
 *
 * @property Responsavel $numRes
 * @property User $numCri
 * @property User $numMod
 */
class TecsocEnfermidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tecsoc_enfermidade}}';
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
            [['id_num_res',], 'required'],
            [[
                'id_num_res', 'bo_reg_exc', 'bo_cro_nen', 'bo_cro_alc', 'bo_cro_alz', 'bo_cro_can', 'bo_cro_car',
                'bo_cro_dep', 'bo_cro_dia', 'bo_cro_hip', 'bo_cro_par', 'bo_cro_pul', 'bo_cro_ren',
                'bo_ger_nen', 'bo_ger_chi', 'bo_ger_col', 'bo_ger_den', 'bo_ger_dia', 'bo_ger_dif',
                'bo_ger_feb', 'bo_ger_hep', 'bo_ger_lep', 'bo_ger_mal', 'bo_ger_res', 'bo_ger_tif',
                'bo_ger_ver', 'bo_ger_zic', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nm_cro_out', 'nm_ger_pel', 'nm_ger_out'], 'string', 'max' => 30],
            [['id_num_res'], 'unique'],
            [
                ['id_num_res'], 'exist', 'skipOnError' => true, 'targetClass' => Responsavel::class,
                'targetAttribute' => ['id_num_res' => 'id_num_res']
            ],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_enf' => 'Id da tabela tecsoc_enfermidade.',
            'id_num_res' => 'Responsável:',
            'bo_reg_exc' => 'Excluído:',
            'bo_cro_nen' => 'Nenhum:',
            'bo_cro_alc' => 'Álcool/drogas:',
            'bo_cro_alz' => 'Alzheimer:',
            'bo_cro_can' => 'Câncer',
            'bo_cro_car' => 'Cardiovasculares:',
            'bo_cro_dep' => 'Depressão:',
            'bo_cro_dia' => 'Diabetes:',
            'bo_cro_hip' => 'Hipertensão:',
            'bo_cro_par' => 'Parkinson:',
            'bo_cro_pul' => 'Pulmonar:',
            'bo_cro_ren' => 'Renal:',
            'nm_cro_out' => 'Outras:',
            'bo_ger_nen' => 'Nenhum:',
            'bo_ger_chi' => 'Chikungunya:',
            'bo_ger_col' => 'Cólera:',
            'bo_ger_den' => 'Dengue:',
            'bo_ger_dia' => 'Diarréia:',
            'bo_ger_dif' => 'Difteria:',
            'bo_ger_feb' => 'Febre amarela:',
            'bo_ger_hep' => 'Hepatite:',
            'bo_ger_lep' => 'Leptospirose:',
            'bo_ger_mal' => 'Malária:',
            'bo_ger_res' => 'Respiratório:',
            'bo_ger_tif' => 'Tifo:',
            'bo_ger_ver' => 'Verminose',
            'bo_ger_zic' => 'Zica:',
            'nm_ger_pel' => 'Pele:',
            'nm_ger_out' => 'Outras:',
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
     * @return TecsocEnfermidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TecsocEnfermidadeQuery(get_called_class());
    }
}
