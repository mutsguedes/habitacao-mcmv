<?php

namespace app\modules\api\models;

use Yii;
use app\myBehaviors\UpperCase;
use app\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\api\models\AgendaMonthDisableQuery;

/**
 * This is the model class for table "agenda_month_disable".
 *
 * @property int $id_age_mon Id da  tabela agenda_month_disable.
 * @property string $nu_num_mes Mês:
 * @property int $bo_mes_dis Disabilitado:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Modificador:
 * @property string $dt_tim_mod Data modificação:
 *
 * @property User $numCri
 * @property User $numMod
 */
class AgendaMonthDisable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda_month_disable';
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
            [['nu_num_mes', 'id_num_cri', 'dt_tim_cri', 'id_num_mod', 'dt_tim_mod'], 'required'],
            [['bo_mes_dis', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nu_num_mes'], 'string', 'max' => 2],
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
            'id_age_mon' => 'Id Age Mon',
            'nu_num_mes' => 'Nu Num Mes',
            'bo_mes_dis' => 'Bo Mes Dis',
            'id_num_cri' => 'Id Num Cri',
            'dt_tim_cri' => 'Dt Tim Cri',
            'id_num_mod' => 'Id Num Mod',
            'dt_tim_mod' => 'Dt Tim Mod',
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
     * @return AgendaMonthDisableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgendaMonthDisableQuery(get_called_class());
    }
}
