<?php

namespace app\modules\emares\models;

use Yii;
use yii\debug\models\search\User;
use app\modules\email\models\Email;
use app\modules\emares\models\EmailAndamento;
use app\modules\emares\models\EmailRespostaQuery;

/**
 * This is the model class for table "{{%email_resposta}}".
 *
 * @property int $id_ema_res Id tabela emailRespostas:
 * @property int $id_num_ema Email:
 * @property int $id_ema_and Andamento:
 * @property string $nm_nom_resp Resposta:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Modificador:
 * @property string $dt_tim_mod Data edição:
 *
 * @property Email $numEma
 * @property EmailAndamento $emaAnd
 * @property User $numCri
 * @property User $numMod
 */
class EmailResposta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_resposta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_ema', 'id_ema_and', 'nm_nom_resp', 'id_num_cri', 'dt_tim_cri', 'id_num_mod', 'dt_tim_mod'], 'required'],
            [['id_num_ema', 'id_ema_and', 'id_num_cri', 'id_num_mod'], 'default', 'value' => null],
            [['id_num_ema', 'id_ema_and', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nm_nom_resp'], 'string', 'max' => 5000],
            [['id_num_ema'], 'exist', 'skipOnError' => true, 'targetClass' => Email::class, 'targetAttribute' => ['id_num_ema' => 'id_num_ema']],
            [['id_ema_and'], 'exist', 'skipOnError' => true, 'targetClass' => EmailAndamento::class, 'targetAttribute' => ['id_ema_and' => 'id_ema_and']],
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
            'id_ema_res' => 'Id tabela emailRespostas:',
            'id_num_ema' => 'Email:',
            'id_ema_and' => 'Andamento:',
            'nm_nom_resp' => 'Resposta:',
            'id_num_cri' => 'Criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Modificador:',
            'dt_tim_mod' => 'Data edição:',
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
     * Gets query for [[EmaAnd]].
     *
     * @return \yii\db\ActiveQuery|EmailAndamentoQuery
     */
    public function getEmaAnd()
    {
        return $this->hasOne(EmailAndamento::class, ['id_ema_and' => 'id_ema_and']);
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
     * @return EmailRespostaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailRespostaQuery(get_called_class());
    }
}
