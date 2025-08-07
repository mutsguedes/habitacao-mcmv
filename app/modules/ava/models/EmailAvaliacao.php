<?php

namespace app\modules\ava\models;

use Yii;
use app\modules\user\models\User;
use app\modules\email\models\Email;
use app\modules\ava\models\EmailAvaliacaoQuery;

/**
 * This is the model class for table "{{%email_avaliacao}}".
 *
 * @property int $id_ema_ava Id tabela emailAvaliacoes:
 * @property int $id_num_ema Email:
 * @property int $nu_ava_est Estrelas:
 * @property string $nm_ava_com Comentário:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Modificador:
 * @property int $dt_tim_mod Data modificação:
 *
 * @property Email $numEma
 * @property User $numCri
 * @property User $numMod
 */
class EmailAvaliacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_avaliacao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_ema', 'nu_ava_est', 'nm_ava_com', 'id_num_cri', 'dt_tim_cri', 'id_num_mod', 'dt_tim_mod'], 'required'],
            [['id_num_ema', 'nu_ava_est', 'id_num_cri', 'id_num_mod', 'dt_tim_mod'], 'default', 'value' => null],
            [['id_num_ema', 'nu_ava_est', 'id_num_cri', 'id_num_mod', 'dt_tim_mod'], 'integer'],
            [['dt_tim_cri'], 'safe'],
            [['nm_ava_com'], 'string', 'max' => 255],
            [['id_num_ema'], 'exist', 'skipOnError' => true, 'targetClass' => Email::class, 'targetAttribute' => ['id_num_ema' => 'id_num_ema']],
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
            'id_ema_ava' => 'Id tabela emailAvaliacoes:',
            'id_num_ema' => 'Email:',
            'nu_ava_est' => 'Estrelas:',
            'nm_ava_com' => 'Comentário:',
            'id_num_cri' => 'Criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Modificador:',
            'dt_tim_mod' => 'Data modificação:',
        ];
    }

    /**
     * Gets query for [[NumEma]].
     *
     * @return \yii\db\ActiveQuery|EmailQuery
     */
    public function getNumEma()
    {
        return $this->hasOne(Email::class, ['id_num_ema' => 'id_num_ema']);
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
     * @return EmailAvaliacaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailAvaliacaoQuery(get_called_class());
    }
}
