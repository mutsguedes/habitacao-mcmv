<?php

namespace app\modules\tecsoc\models;

use app\modules\auxiliar\models\GerMunicipio;
use app\modules\auxiliar\models\GerMunicipioQuery;
use app\modules\auxiliar\models\GerTecsocHabSerAgua;
use app\modules\auxiliar\models\GerTecsocHabSerAguaQuery;
use app\modules\auxiliar\models\GerTecsocHabSerEnergiaEletrica;
use app\modules\auxiliar\models\GerTecsocHabSerEnergiaEletricaQuery;
use app\modules\auxiliar\models\GerTecsocHabSerEsgoto;
use app\modules\auxiliar\models\GerTecsocHabSerEsgotoQuery;
use app\modules\auxiliar\models\GerTecsocHabSerLixo;
use app\modules\auxiliar\models\GerTecsocHabSerLixoQuery;
use app\modules\auxiliar\models\GerTecsocHabTipOcupacao;
use app\modules\auxiliar\models\GerTecsocHabTipOcupacaoQuery;
use app\modules\auxiliar\models\GerTipoRenda;
use app\modules\auxiliar\models\GerTipoRendaQuery;
use app\modules\res\models\Responsavel;
use app\modules\res\models\ResponsavelQuery;
use app\modules\tecsoc\models\TecnicoSocialQuery;
use app\modules\tecsoc\models\TecsocFamilia;
use app\modules\tecsoc\models\TecsocFamiliaQuery;
use app\modules\user\models\User;
use app\modules\user\models\UserQuery;
use app\myBehaviors\UpperCase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%tecnico_social}}".
 *
 * @property int $id_tec_soc Id tabela tecnicoSociais:
 * @property int $bo_reg_exc Excluído:
 * @property int $id_num_res Responsável:
 * @property int $bo_ins_pac Inscrito PAC:
 * @property int $bo_car_ass_res C. ass. res.:
 * @property int $bo_car_ass_dep C. ass. conjuge:
 * @property int $id_mun_tra_res M. trab. res.:
 * @property int $id_mun_tra_dep M. trab. conjuge:
 * @property int $id_tip_ren_res T. renda res.:
 * @property int $id_tip_ren_dep T. renda conjuge:
 * @property int $bo_ati_dep Em ati. conjuge:
 * @property int $bo_ati_res Em ati. res.:
 * @property int $bo_pag_inss_res Pg. INSS res.:
 * @property int $bo_pag_inss_dep Pg. INSS conjuge:
 * @property int $bo_aut_res Autônomo res:
 * @property int $bo_aut_dep Autônomo conjuge:
 * @property string $id_num_aco Acompanhamentos:
 * @property string $id_num_ben Benefícios:
 * @property string $id_num_equ Equipamentos Público:
 * @property int $id_ser_agu Água:
 * @property int $id_ser_ele E. Elétrica:
 * @property int $id_ser_esg Esgoto:
 * @property int $id_ser_lix Lixo:
 * @property int $id_tip_ocu Tipo ocupação:
 * @property string $id_num_zoo Zoonozes:
 * @property string $id_num_ati Atividades:
 * @property string $id_num_cur Cursos:
 * @property string|null $id_ati_fis Atividades Físicas:
 * @property string|null $nm_nom_obs Observações:
 * @property int $id_num_cri Id do criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Id do modificador:
 * @property string $dt_tim_mod Data modificação:
 *
 * @property GerMunicipio $munTraDep
 * @property GerTecsocHabTipOcupacao $tipOcu
 * @property GerTipoRenda $tipRenDep
 * @property GerTipoRenda $tipRenRes
 * @property GerMunicipio $munTraRes
 * @property User $numCri
 * @property User $numMod
 * @property Responsavel $numRes
 * @property GerTecsocHabSerAgua $serAgu
 * @property GerTecsocHabSerEnergiaEletrica $serEle
 * @property GerTecsocHabSerEsgoto $serEsg
 * @property GerTecsocHabSerLixo $serLix
 * @property TecsocFamilia[] $tecsocFamilias
 */
class TecnicoSocial extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tecnico_social}}';
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
                'bo_reg_exc', 'id_num_res', 'bo_ins_pac', 'bo_car_ass_res', 'bo_car_ass_dep',
                'id_mun_tra_res', 'id_mun_tra_dep', 'id_tip_ren_res', 'id_tip_ren_dep',
                'bo_ati_dep', 'bo_ati_res', 'bo_pag_inss_res', 'bo_pag_inss_dep',
                'bo_aut_res', 'bo_aut_dep', 'id_ser_agu', 'id_ser_ele', 'id_ser_esg',
                'id_ser_lix', 'id_tip_ocu', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [[
                'bo_ins_pac', 'id_num_aco', 'id_num_ben', 'id_num_equ', 'id_num_zoo',
                'id_num_ati', 'id_num_cur', 'id_ser_agu', 'id_ser_ele', 'id_ser_esg',
                'id_ser_lix', 'id_tip_ocu'
            ], 'required'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            ['bo_reg_exc', 'default', 'value' => 0],
            [['nm_ocu_out'], 'string', 'max' => 30],
            [['id_mun_tra_dep'], 'exist', 'skipOnError' => true, 'targetClass' => GerMunicipio::class, 'targetAttribute' => ['id_mun_tra_dep' => 'id_num_mun']],
            [['id_tip_ocu'], 'exist', 'skipOnError' => true, 'targetClass' => GerTecsocHabTipOcupacao::class, 'targetAttribute' => ['id_tip_ocu' => 'id_tip_ocu']],
            [['id_tip_ren_dep'], 'exist', 'skipOnError' => true, 'targetClass' => GerTipoRenda::class, 'targetAttribute' => ['id_tip_ren_dep' => 'id_tip_ren']],
            [['id_tip_ren_res'], 'exist', 'skipOnError' => true, 'targetClass' => GerTipoRenda::class, 'targetAttribute' => ['id_tip_ren_res' => 'id_tip_ren']],
            [['id_mun_tra_res'], 'exist', 'skipOnError' => true, 'targetClass' => GerMunicipio::class, 'targetAttribute' => ['id_mun_tra_res' => 'id_num_mun']],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_cri' => 'id']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_mod' => 'id']],
            [['id_num_res'], 'exist', 'skipOnError' => true, 'targetClass' => Responsavel::class, 'targetAttribute' => ['id_num_res' => 'id_num_res']],
            [['id_ser_agu'], 'exist', 'skipOnError' => true, 'targetClass' => GerTecsocHabSerAgua::class, 'targetAttribute' => ['id_ser_agu' => 'id_ser_agu']],
            [['id_ser_ele'], 'exist', 'skipOnError' => true, 'targetClass' => GerTecsocHabSerEnergiaEletrica::class, 'targetAttribute' => ['id_ser_ele' => 'id_ser_ele']],
            [['id_ser_esg'], 'exist', 'skipOnError' => true, 'targetClass' => GerTecsocHabSerEsgoto::class, 'targetAttribute' => ['id_ser_esg' => 'id_ser_esg']],
            [['id_ser_lix'], 'exist', 'skipOnError' => true, 'targetClass' => GerTecsocHabSerLixo::class, 'targetAttribute' => ['id_ser_lix' => 'id_ser_lix']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tec_soc' => 'Id tabela tecnicoSociais:',
            'bo_reg_exc' => 'Excluído:',
            'id_num_res' => 'Responsável:',
            'bo_ins_pac' => 'Inscrito PAC:',
            'bo_car_ass_res' => 'C. ass. res.:',
            'bo_car_ass_dep' => 'C. ass. conjuge:',
            'id_mun_tra_res' => 'M. trab. res.:',
            'id_mun_tra_dep' => 'M. trab. conjuge:',
            'id_tip_ren_res' => 'T. renda res.:',
            'id_tip_ren_dep' => 'T. renda conjuge:',
            'bo_ati_dep' => 'Em ati. conjuge:',
            'bo_ati_res' => 'Em ati. res.:',
            'bo_pag_inss_res' => 'Pg. INSS res.:',
            'bo_pag_inss_dep' => 'Pg. INSS conjuge:',
            'bo_aut_res' => 'Autônomo res:',
            'bo_aut_dep' => 'Autônomo conjuge:',
            'id_num_aco' => 'Acompanhamentos:',
            'id_num_ben' => 'Benefícios:',
            'id_num_equ' => 'Equipamentos Público:',
            'id_tip_ocu' => 'Tipo ocupação:',
            'nm_ocu_out' => 'Outra:',
            'id_ser_agu' => 'Água:',
            'id_ser_ele' => 'E. Elétrica:',
            'id_ser_esg' => 'Esgoto:',
            'id_ser_lix' => 'Lixo:',
            'id_num_zoo' => 'Zoonozes:',
            'id_num_ati' => 'Atividades:',
            'id_num_cur' => 'Cursos:',
            'id_ati_fis' => 'Atividades Físicas:',
            'nm_nom_obs' => 'Observações:',
            'id_num_cri' => 'Id do criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Id do modificador:',
            'dt_tim_mod' => 'Data modificação:',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (is_array($this->id_num_aco)) { //check is data is array (value is selected)
                $this->id_num_aco = implode(",", $this->id_num_aco);
            } else { //check is data is NOT array (value is NOT selected- empty)
                $this->id_num_aco = '';
            };
            if (is_array($this->id_num_ben)) { //check is data is array (value is selected)
                $this->id_num_ben = implode(",", $this->id_num_ben);
            } else { //check is data is NOT array (value is NOT selected- empty)
                $this->id_num_ben = '';
            };
            if (is_array($this->id_num_equ)) { //check is data is array (value is selected)
                $this->id_num_equ = implode(",", $this->id_num_equ);
            } else { //check is data is NOT array (value is NOT selected- empty)
                $this->id_num_equ = '';
            };
            if (is_array($this->id_num_zoo)) { //check is data is array (value is selected)
                $this->id_num_zoo = implode(",", $this->id_num_zoo);
            } else { //check is data is NOT array (value is NOT selected- empty)
                $this->id_num_zoo = '';
            };
            if (is_array($this->id_num_ati)) { //check is data is array (value is selected)
                $this->id_num_ati = implode(",", $this->id_num_ati);
            } else { //check is data is NOT array (value is NOT selected- empty)
                $this->id_num_ati = '';
            };
            if (is_array($this->id_num_cur)) { //check is data is array (value is selected)
                $this->id_num_cur = implode(",", $this->id_num_cur);
            } else { //check is data is NOT array (value is NOT selected- empty)
                $this->id_num_cur = '';
            };
            return parent::beforeSave($insert);
        }
    }

    /**
     * Gets query for [[MunTraDep]].
     *
     * @return \yii\db\ActiveQuery|GerMunicipioQuery
     */
    public function getMunTraDep()
    {
        return $this->hasOne(GerMunicipio::class, ['id_num_mun' => 'id_mun_tra_dep']);
    }

    /**
     * Gets query for [[TipOcu]].
     *
     * @return \yii\db\ActiveQuery|GerTecsocHabTipOcupacaoQuery
     */
    public function getTipOcu()
    {
        return $this->hasOne(GerTecsocHabTipOcupacao::class, ['id_tip_ocu' => 'id_tip_ocu']);
    }

    /**
     * Gets query for [[TipRenDep]].
     *
     * @return \yii\db\ActiveQuery|GerTipoRendaQuery
     */
    public function getTipRenDep()
    {
        return $this->hasOne(GerTipoRenda::class, ['id_tip_ren' => 'id_tip_ren_dep']);
    }

    /**
     * Gets query for [[TipRenRes]].
     *
     * @return \yii\db\ActiveQuery|GerTipoRendaQuery
     */
    public function getTipRenRes()
    {
        return $this->hasOne(GerTipoRenda::class, ['id_tip_ren' => 'id_tip_ren_res']);
    }

    /**
     * Gets query for [[MunTraRes]].
     *
     * @return \yii\db\ActiveQuery|GerMunicipioQuery
     */
    public function getMunTraRes()
    {
        return $this->hasOne(GerMunicipio::class, ['id_num_mun' => 'id_mun_tra_res']);
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
     * Gets query for [[NumRes]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getNumRes()
    {
        return $this->hasOne(Responsavel::class, ['id_num_res' => 'id_num_res']);
    }

    /**
     * Gets query for [[SerAgu]].
     *
     * @return \yii\db\ActiveQuery|GerTecsocHabSerAguaQuery
     */
    public function getSerAgu()
    {
        return $this->hasOne(GerTecsocHabSerAgua::class, ['id_ser_agu' => 'id_ser_agu']);
    }

    /**
     * Gets query for [[SerEle]].
     *
     * @return \yii\db\ActiveQuery|GerTecsocHabSerEnergiaEletricaQuery
     */
    public function getSerEle()
    {
        return $this->hasOne(GerTecsocHabSerEnergiaEletrica::class, ['id_ser_ele' => 'id_ser_ele']);
    }

    /**
     * Gets query for [[SerEsg]].
     *
     * @return \yii\db\ActiveQuery|GerTecsocHabSerEsgotoQuery
     */
    public function getSerEsg()
    {
        return $this->hasOne(GerTecsocHabSerEsgoto::class, ['id_ser_esg' => 'id_ser_esg']);
    }

    /**
     * Gets query for [[SerLix]].
     *
     * @return \yii\db\ActiveQuery|GerTecsocHabSerLixoQuery
     */
    public function getSerLix()
    {
        return $this->hasOne(GerTecsocHabSerLixo::class, ['id_ser_lix' => 'id_ser_lix']);
    }

    /**
     * Gets query for [[TecsocFamilias]].
     *
     * @return \yii\db\ActiveQuery|TecsocFamiliaQuery
     */
    public function getTecsocFamilias()
    {
        return $this->hasMany(TecsocFamilia::class, ['id_tec_soc' => 'id_tec_soc']);
    }

    /**
     * {@inheritdoc}
     * @return TecnicoSocialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TecnicoSocialQuery(get_called_class());
    }
}
