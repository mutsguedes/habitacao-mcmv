<?php

namespace app\modules\agenda\models;

use Yii;
use app\modules\user\models\User;
use app\modules\agenda\models\AgendaHorarioQuery;

/**
 * This is the model class for table "agenda_horario".
 *
 * @property int $id_age_hor Id tabela agenda_horario.
 * @property int $bo_reg_exc Excluído:
 * @property int $nu_num_sem Semana:
 * @property int $nu_qtd_hor_old N. agendamento old:
 * @property int $nu_qtd_hor N. agendamento:
 * @property string $ti_age_hor Horário:
 * @property string $dt_qtd_mod Mod. qtd. vagas:
 * @property int $bo_stu_hor Status:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Criação:
 * @property int $id_num_mod Modificador:
 * @property string $dt_tim_mod Modificação:
 *
 * @property User $numCri
 * @property User $numMod
 */
class AgendaHorario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda_horario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bo_reg_exc', 'nu_num_sem', 'nu_qtd_hor_old', 'nu_qtd_hor', 'bo_stu_hor', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['ti_age_hor', 'dt_qtd_mod', 'id_num_cri', 'dt_tim_cri', 'id_num_mod', 'dt_tim_mod'], 'required'],
            [['dt_qtd_mod', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['ti_age_hor'], 'string'],
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
            'id_age_hor' => 'Id tabela agenda_horario.',
            'bo_reg_exc' => 'Excluído:',
            'nu_num_sem' => 'Semana',
            'nu_qtd_hor_old' => 'N. agendamento old:',
            'nu_qtd_hor' => 'N. agendamento:',
            'ti_age_hor' => 'Horário:',
            'dt_qtd_mod' => 'Mod. qtd. vagas:',
            'bo_stu_hor' => 'Status:',
            'id_num_cri' => 'Criador:',
            'dt_tim_cri' => 'Criação:',
            'id_num_mod' => 'Modificador:',
            'dt_tim_mod' => 'Modificação:',
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
     * @return AgendaHorarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgendaHorarioQuery(get_called_class());
    }
}
