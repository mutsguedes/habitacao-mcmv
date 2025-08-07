<?php

namespace app\modules\email\models;

use Yii;
use yii\db\ActiveRecord;
use app\myBehaviors\GeraNumero;
use app\components\MarArtHelpers;
use app\modules\ava\models\EmailAvaliacao;
use app\myBehaviors\GeraDataMani;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use himiklab\yii2\recaptcha\ReCaptchaValidator2;



/**
 * This is the model class for table "emails".
 *
 * @property int $id_num_ema Id tabela Emails.
 * @property int $bo_ema_ava Avaliado:
 * @property int $bo_ema_fin Finalizado:
 * @property string $nu_num_seq seqüencial:
 * @property string $nu_num_num Numero
 * @property int $id_ema_ass Assunto:
 * @property string $nm_men_ema Menssagem:
 * @property int $id_pag_usu Ip:
 * @property int $id_ema_sit Situação:
 * @property string|null $dt_ema_man Prazo manifestação:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Modificador:
 * @property string $dt_tim_mod Data edição:
 *
 * @property EmailAvaliacao[] $emailAvaliacso
 * @property EmailResposta[] $emailResposta
 * @property EmailAssuntos $emaAss
 * @property PageUser $pagUsu
 * @property EmailSituacao $emaSit
 * @property User $numMod
 * @property User $numCri
 */
class Email extends ActiveRecord
{

    public $reCaptcha;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'useCriAtu' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'id_num_cri',
                'updatedByAttribute' => 'id_num_mod',
            ],
            'datCriAtu' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'dt_tim_cri',
                'updatedAtAttribute' => 'dt_tim_mod',
                'value' => date("Y-m-d H:i:s"),
            ],
            'geraNumero' => [
                'class' => GeraNumero::class,
            ],
            'geraDataMani' => [
                'class' => GeraDataMani::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bo_ema_ava', 'bo_ema_fin', 'id_ema_ass', 'id_pag_usu', 'id_ema_sit', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['id_ema_ass', 'nm_men_ema', 'id_pag_usu'], 'required'],
            [['dt_tim_cri', 'dt_tim_mod', 'dt_ema_man'], 'safe'],
            [['nm_men_ema'], 'string', 'max' => 5000],
            [
                ['reCaptcha'], ReCaptchaValidator2::class,
                'secret' => '6LdAT-gUAAAAAOMcDbT4QOS-KnrRBepMpiQcTlFm', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Por favor, confirme que você não é um robô.'
            ],
            // verifyCode needs to be entered correctly
            // ['verifyCode', 'captcha'],
            [['id_ema_ass'], 'exist', 'skipOnError' => true, 'targetClass' => EmailAssunto::class, 'targetAttribute' => ['id_ema_ass' => 'id_ema_ass']],
            [['id_pag_usu'], 'exist', 'skipOnError' => true, 'targetClass' => PageUser::class, 'targetAttribute' => ['id_pag_usu' => 'id_pag_usu']],
            [['id_ema_sit'], 'exist', 'skipOnError' => true, 'targetClass' => EmailSituacao::class, 'targetAttribute' => ['id_ema_sit' => 'id_ema_sit']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_mod' => 'id']],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_num_cri' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_ema' => 'Id tabela Emails.',
            'bo_ema_ava' => 'Avaliado:',
            'bo_ema_fin' => 'Finalizado:',
            'nu_num_seq' => 'Sequencial:',
            'nu_num_num' => 'Numero',
            'id_ema_ass' => 'Assunto:',
            'nm_men_ema' => 'Menssagem:',
            'id_pag_usu' => 'Ip:',
            'id_ema_sit' => 'Situação:',
            'dt_ema_man' => 'Prazo manifestação:',
            'id_num_cri' => 'Criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Modificador:',
            'dt_tim_mod' => 'Data edição:',
        ];
    }

    /**
     * Gets query for [[EmailAvaliacao]].
     *
     * @return ActiveQuery|EmailAvaliacaoQuery
     */
    public function getEmailAvaliacao()
    {
        return $this->hasMany(EmailAvaliacao::class, ['id_num_ema' => 'id_num_ema']);
    }

    /**
     * Gets query for [[EmailResposta]].
     *
     * @return ActiveQuery|EmailRespostaQuery
     */
    public function getEmailResposta()
    {
        return $this->hasMany(EmailResposta::class, ['id_num_ema' => 'id_num_ema']);
    }

    /**
     * Gets query for [[EmaAss]].
     *
     * @return ActiveQuery|EmailAssuntoQuery
     */
    public function getEmaAss()
    {
        return $this->hasOne(EmailAssunto::class, ['id_ema_ass' => 'id_ema_ass']);
    }

    /**
     * Gets query for [[PagUsu]].
     *
     * @return ActiveQuery|PageUserQuery
     */
    public function getPagUsu()
    {
        return $this->hasOne(PageUser::class, ['id_pag_usu' => 'id_pag_usu']);
    }

    /**
     * Gets query for [[EmaSit]].
     *
     * @return ActiveQuery|EmailSituacaoQuery
     */
    public function getEmaSit()
    {
        return $this->hasOne(EmailSituacao::class, ['id_ema_sit' => 'id_ema_sit']);
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
     * Gets query for [[NumCri]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getNumCri()
    {
        return $this->hasOne(User::class, ['id' => 'id_num_cri']);
    }

    /**
     * Gets fields for contato.
     *
     * @return $fields
     */
    public function fields()
    {
        $fields = parent::fields();
        $fields['numEmail'] = $this->nu_num_seq . '/' . MarArtHelpers::mascaraString('##.##.####', $this->nu_num_num);
        $fields['nm_nom_cid'] = ltrim($this->numCri->name);
        $fields['nu_num_cpf'] = MarArtHelpers::mascaraString('###.###.###-##', Yii::$app->user->identity->nu_num_cpf);
        $fields['nu_num_tel'] = MarArtHelpers::mascaraString(MarArtHelpers::mascTel(Yii::$app->user->identity->nu_num_tel), Yii::$app->user->identity->nu_num_tel);
        $fields['nm_nom_ema'] = Yii::$app->user->identity->email;
        $fields['nm_nom_sub'] = ltrim($this->emaAss->nm_ema_ass);
        $fields['nm_nom_bod'] = ltrim($this->nm_men_ema);
        $fields['nm_ema_sit'] = $this->emaSit->nm_ema_sit;
        $fields['dataEmail'] = date('d/m/Y', strtotime($this->dt_tim_cri));
        $fields['dataManif'] = date('d/m/Y', strtotime($this->dt_ema_man));
        $fields['dt_tim_mod'] = date('d/m/Y', strtotime($this->dt_tim_mod));

        // remove campos que contém informações confidenciais        
        unset($fields['id_num_ema']);
        unset($fields['nu_num_seq']);
        unset($fields['nu_num_num']);
        unset($fields['bo_ema_ava']);
        unset($fields['id_ema_ass']);
        unset($fields['id_pag_usu']);
        unset($fields['reCaptcha']);

        return $fields;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contatoEnvio($email)
    {
        if ($this->validate()) {
            /* @var $res */
            $res = $this->fields();
            Yii::$app->mailer->compose(['html' => 'contato-html'], ['res' => $res, 'imageFileName' => 'img/habitacaoLogo.png'])
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName'] . ' - appita-mcmv'])
                ->setTo(Yii::$app->user->identity->email)
                //->setReplyTo([$this->nm_nom_ema => $this->nm_nom_cid])
                ->setSubject($this->emaAss->nm_ema_ass)
                //->setTextBody($this->nm_men_ema)
                ->send();
            return true;
        }
        return false;
    }
}
