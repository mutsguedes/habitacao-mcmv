<?php

namespace app\modules\agenda\models;

use Yii;
use app\modules\user\models\User;
use app\modules\auxiliar\models\GerState;
use app\modules\agenda\models\AgendaDateDisableQuery;

/**
 * This is the model class for table "agenda_date_disable".
 *
 * @property int $id_age_dis Id tabela agenda_date_disable.
 * @property int $bo_reg_exc Excluído:
 * @property int $id_num_sta Status:
 * @property string $dt_age_dat Data:
 * @property string $id_age_des Descrição:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Modificador:
 * @property string $dt_tim_mod Data modificação:
 *
 * @property GerState $numSta
 * @property User $numCri
 * @property User $numMod
 */
class AgendaDateDisable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda_date_disable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bo_reg_exc', 'id_num_sta', 'dt_age_dat', 'id_age_des', 'id_num_cri', 'dt_tim_cri', 'id_num_mod', 'dt_tim_mod'], 'required'],
            [['bo_reg_exc', 'id_num_sta', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['dt_age_dat', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['id_age_des'], 'string', 'max' => 80],
            [['id_num_sta'], 'exist', 'skipOnError' => true, 'targetClass' => GerState::class, 'targetAttribute' => ['id_num_sta' => 'id_num_sta']],
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
            'id_age_dis' => 'Id tabela agenda_date_disable.',
            'bo_reg_exc' => 'Excluído:',
            'id_num_sta' => 'Status:',
            'dt_age_dat' => 'Data:',
            'id_age_des' => 'Descrição:',
            'id_num_cri' => 'Criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Modificador:',
            'dt_tim_mod' => 'Data modificação:',
        ];
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
     * @return AgendaDateDisableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgendaDateDisableQuery(get_called_class());
    }
}
