<?php

namespace app\modules\tecsoc\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\myBehaviors\UpperCase;
use app\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\user\models\UserQuery;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\tecsoc\models\TecsocFamiliaQuery;

/**
 * This is the model class for table "{{%tecsoc_familia}}".
 *
 * @property int $id_doc_ser Id da tabela tecsoc_familia_doc_ser.
 * @property int $id_tec_soc Pesquisa:
 * @property int $id_res_dep Pessoa:
 * @property int $bo_reg_ger RG:
 * @property int $bo_car_tra CT.:
 * @property int $bo_cad_cpf CPF.:
 * @property int $bol_cer_nas CN:
 * @property int $bo_cer_cas CC:
 * @property int $bo_tit_ele TE:
 * @property int $bo_ine_nis NIS:
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
 * @property int $bo_ger_dia Diarreia:
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
 * @property User $numCri
 * @property User $numMod
 * @property TecnicoSocial $tecSoc
 */
class TecsocFamilia extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tecsoc_familia}}';
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
            [['id_tec_soc', 'id_res_dep'], 'required'],
            [[
                'id_tec_soc', 'id_res_dep', 'bo_reg_ger', 'bo_car_tra', 'bo_cad_cpf', 'bol_cer_nas', 'bo_cer_cas',
                'bo_tit_ele', 'bo_ine_nis', 'bo_cro_nen', 'bo_cro_alc', 'bo_cro_alz', 'bo_cro_can', 'bo_cro_car', 'bo_cro_dep',
                'bo_cro_dia', 'bo_cro_hip', 'bo_cro_par', 'bo_cro_pul', 'bo_cro_ren', 'bo_ger_nen', 'bo_ger_chi', 'bo_ger_col',
                'bo_ger_den', 'bo_ger_dia', 'bo_ger_dif', 'bo_ger_feb', 'bo_ger_hep', 'bo_ger_lep', 'bo_ger_mal', 'bo_ger_res',
                'bo_ger_tif', 'bo_ger_ver', 'bo_ger_zic', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nm_cro_out', 'nm_ger_pel', 'nm_ger_out'], 'string', 'max' => 30],
            [['id_doc_ser'], 'unique'],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_cri' => 'id']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_mod' => 'id']],
            [['id_tec_soc'], 'exist', 'skipOnError' => true, 'targetClass' => TecnicoSocial::class, 'targetAttribute' => ['id_tec_soc' => 'id_tec_soc']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_doc_ser' => 'Id da tabela tecsoc_familia_doc_ser.',
            'id_tec_soc' => 'Pesquisa:',
            'id_res_dep' => 'Pessoa:',
            'bo_reg_ger' => 'RG:',
            'bo_car_tra' => 'CT.:',
            'bo_cad_cpf' => 'CPF.:',
            'bol_cer_nas' => 'CN:',
            'bo_cer_cas' => 'CC:',
            'bo_tit_ele' => 'TE:',
            'bo_ine_nis' => 'NIS:',
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
            'bo_ger_dia' => 'Diarreia:',
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
     * Gets query for [[NumCri]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getNumCri()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_cri']);
    }

    /**
     * Gets query for [[NumMod]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getNumMod()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_mod']);
    }

    /**
     * Gets query for [[TecSoc]].
     *
     * @return ActiveQuery|TecnicoSocialQuery
     */
    public function getTecSoc()
    {
        return $this->hasOne(TecnicoSocial::class, ['id_tec_soc' => 'id_tec_soc']);
    }

    /**
     * {@inheritdoc}
     * @return TecsocFamiliaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TecsocFamiliaQuery(get_called_class());
    }
}
