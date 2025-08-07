<?php

namespace app\modules\api\models;

use Yii;
use app\myBehaviors\UpperCase;
use app\components\MarArtHelpers;
use app\modules\user\models\User;
use app\modules\api\models\GerState;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\api\models\GerAssunto;
use app\modules\api\models\AgendaQuery;
use app\components\validador\ValidarCpf;
use app\components\validador\ValidarNis;

/**
 * This is the model class for table "agenda".
 *
 * @property int $id_num_age Id da tabela agendas..
 * @property int $bo_reg_exc Excluído:
 * @property string $nm_nom_cid Nome:
 * @property string $nu_num_cpf Cpf:
 * @property string $nu_num_nis NIS:
 * @property string $nu_num_tel Telefone:
 * @property string $nu_num_tel_1 Telefone:
 * @property string $dt_age_dat Data agendamento:
 * @property string $ti_age_hor Hora agendamento:
 * @property int $id_num_ass Assunto:
 * @property string|null $nm_nom_obs Obs.:
 * @property int $id_num_sta Status:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Modificador:
 * @property string $dt_tim_mod Data modificação:
 *
 * @property GerAssunto $numAss
 * @property GerState $numSta
 * @property User $numCri
 * @property User $numMod
 */
class Agenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /* [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'id_num_cri',
                'updatedByAttribute' => 'id_num_mod',
            ], */
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
            [['bo_reg_exc', 'id_num_ass', 'id_num_sta', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['nm_nom_cid', 'nu_num_cpf', /* 'nu_num_nis', */ 'nu_num_tel', 'dt_age_dat', 'ti_age_hor', 'id_num_ass', 'id_num_sta'], 'required'],
            [['dt_age_dat', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nm_nom_cid'], 'string', 'max' => 60],
            [['nu_num_cpf'], 'string', 'max' => 14],
            [['nu_num_nis'], 'string', 'max' => 14],
            [['nu_num_tel'], 'string', 'max' => 15],
            [['nu_num_tel_1'], 'string', 'max' => 15],
            [['ti_age_hor'], 'string', 'max' => 20],
            [['nm_nom_obs'], 'string', 'max' => 255],
            ['nu_num_cpf', ValidarCpf::class],
            ['nu_num_nis', ValidarNis::class],
            [['id_num_ass'], 'exist', 'skipOnError' => true, 'targetClass' => GerAssunto::class, 'targetAttribute' => ['id_num_ass' => 'id_num_ass']],
            [['id_num_sta'], 'exist', 'skipOnError' => true, 'targetClass' => GerState::class, 'targetAttribute' => ['id_num_sta' => 'id_num_sta']],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_cri' => 'id']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_mod' => 'id']],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id_num_age',
            'nm_nom_cid',
            'nu_num_cpf',
            'nu_num_cpf' => function (Agenda $model) {
                return MarArtHelpers::mascaraString('###.###.###-##', $model->nu_num_cpf);
            },
            'nu_num_cpf' => function (Agenda $model) {
                return MarArtHelpers::mascaraString('###.###.###-##', $model->nu_num_cpf);
            },
            'nu_num_nis',
            'nu_num_nis' => function (Agenda $model) {
                return MarArtHelpers::mascaraString('###.#####.##-#', $model->nu_num_nis);
            },
            'nu_num_tel' => function (Agenda $model) {
                return (strlen($model->nu_num_tel) == 11) ?
                    MarArtHelpers::mascaraString('(##) #####-####', $model->nu_num_tel) :
                    MarArtHelpers::mascaraString('(##) ####-####', $model->nu_num_tel);
            },
            'nu_num_tel_1' => function (Agenda $model) {
                return (strlen($model->nu_num_tel_1) == 11) ?
                    MarArtHelpers::mascaraString('(##) #####-####', $model->nu_num_tel_1) :
                    MarArtHelpers::mascaraString('(##) ####-####', $model->nu_num_tel_1);
            },
            'dt_age_dat',
            'ti_age_hor',
            'id_num_ass',
            'nm_des_ass' => function (Agenda $model) {
                return  $model->numAss->nm_nom_ass;
            },
            'id_num_sta',
            'nm_des_sta' => function (Agenda $model) {
                return $model->numSta->nm_des_sta;
            },
            'nm_nom_obs',
        ];

        /*  $fields = parent::fields();
        $fields['num_age'] = $this->id_num_age;
        $fields['nom_cid'] = $this->nm_nom_cid;
        $fields['num_cpf'] = $this->nu_num_cpf;
        $fields['num_tel'] = $this->nu_num_tel;
        $fields['age_dat'] = $this->dt_age_dat;
        $fields['age_hor'] = $this->ti_age_hor;
        $fields['num_ass'] = $this->numAss->nm_nom_ass;
        $fields['des_sta'] = $this->numSta->nm_des_sta;
        $fields['nom_obs'] = $this->nm_nom_obs;
        unset(
            $fields['id_num_age'],
            $fields['nm_nom_cid'],
            $fields['nu_num_cpf'],
            $fields['nu_num_tel'],
            $fields['dt_age_dat'],
            $fields['ti_age_hor'],
            $fields['id_num_ass'],
            $fields['id_num_sta'],
            $fields['nm_des_sta'],
            $fields['nm_nom_obs'],
            $fields['id_num_cri'],
            $fields['id_num_mod'],
            $fields['bo_reg_exc'],
            $fields['dt_tim_cri'],
            $fields['dt_tim_mod'], 
        );
        return $fields;*/
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_age' => 'Id da tabela agendas..',
            'bo_reg_exc' => 'Excluído:',
            'nm_nom_cid' => 'Nome:',
            'nu_num_cpf' => 'Cpf:',
            'nu_num_nis' => 'NIS:',
            'nu_num_tel' => 'Telefone:',
            'nu_num_tel_1' => 'Telefone:',
            'dt_age_dat' => 'Data agendamento:',
            'ti_age_hor' => 'Hora agendamento:',
            'id_num_ass' => 'Assunto:',
            'nm_nom_obs' => 'Obs.:',
            'id_num_sta' => 'Status:',
            'id_num_cri' => 'Criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Modificador:',
            'dt_tim_mod' => 'Data modificação:',
        ];
    }


    /**
     * Gets query for [[NumAss]].
     *
     * @return \yii\db\ActiveQuery|GerAssuntoQuery
     */
    public function getNumAss()
    {
        return $this->hasOne(GerAssunto::class, ['id_num_ass' => 'id_num_ass']);
    }

    /**
     * Gets query for [[NumSta]].
     *
     * @return \yii\db\ActiveQuery|GerStateQuery
     */
    public function getNumSta()
    {
        return $this->hasOne(GerState::class, ['id_num_sta' => 'id_num_sta']);
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
     * @return AgendaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgendaQuery(get_called_class());
    }
}
