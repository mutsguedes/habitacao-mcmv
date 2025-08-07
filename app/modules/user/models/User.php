<?php

namespace app\modules\user\models;

use Yii;
use yii\db\Query;
use bizley\jwt\Jwt;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\components\MarArtHelpers;
use app\modules\email\models\Email;
use yii\base\NotSupportedException;
use yii\web\ForbiddenHttpException;
use app\modules\ocu\models\Ocupacao;
use app\modules\agenda\models\Agenda;
use app\modules\dep\models\Dependente;
use app\modules\user\models\UserQuery;
use app\modules\res\models\Responsavel;
use app\modules\ava\models\EmailAvaliacao;
use app\modules\auxiliar\models\Apartamento;
use app\modules\emares\models\EmailResposta;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\tecsoc\models\TecsocFamilia;
use app\modules\auxiliar\models\GerTabUniCbo;
use app\modules\tecsoc\models\TecsocDocumento;
use app\modules\tecsoc\models\TecsocEnfermidade;



/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property int $bo_use_log Logado:
 * @property int $nu_use_lim User limite:
 * @property string $username
 * @property int $nu_use_cont_log Logado cont:
 * @property string|null $nm_use_log Sessão:
 * @property string $name Nome do Usuário.
 * @property string $nu_num_cpf CPF:.
 * @property string $nu_num_ide R.G.:
 * @property string $nu_num_mat Mat.:
 * @property string|null $nm_nom_arq Nome do Arquivo do Avatar.
 * @property resource|null $bi_arq_ava Binário do arquivo avatar.
 * @property string|null $nm_tip_arq Tipo do arquivo avatar.
 * @property int $id_num_cbo Profissão:
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $nu_num_tel Telefone
 * @property string $email
 * @property int $status
 * @property int|null $user_level
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Agenda[] $agendas
 * @property Agenda[] $agendas0
 * @property Apartamento[] $apartamentos
 * @property Apartamento[] $apartamentos0
 * @property Dependente[] $dependentes
 * @property Dependente[] $dependentes0
 * @property Email[] $emails
 * @property Email[] $emails0
 * @property EmailAvaliacao[] $emailAvaliacaos
 * @property EmailAvaliacao[] $emailAvaliacaos0
 * @property EmailResposta[] $emailRespostas
 * @property EmailResposta[] $emailRespostas0
 * @property Ocupacao[] $ocupacaos
 * @property Ocupacao[] $ocupacaos0
 * @property Responsavel[] $responsavels
 * @property Responsavel[] $responsavels0
 * @property TecnicoSocial[] $tecnicoSocials
 * @property TecnicoSocial[] $tecnicoSocials0
 * @property TecsocDocumento[] $tecsocDocumentos
 * @property TecsocDocumento[] $tecsocDocumentos0
 * @property TecsocEnfermidade[] $tecsocEnfermidades
 * @property TecsocEnfermidade[] $tecsocEnfermidades0
 * @property TecsocFamilia[] $tecsocFamilias
 * @property TecsocFamilia[] $tecsocFamilias0
 */
class User extends ActiveRecord implements IdentityInterface
{

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_CREATE_CIDADAO = 'create_cidadao';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_UPDATE_CIDADAO = 'update_cidadao';
    const SCENARIO_CHANGEPWD = 'changePwd';
    const SCENARIO_RESETPWD = 'resetPwd';

    // Usamos $hash para salvar a senha com hashed que já salvamos no banco de dados
    public $hash;
    public $passwordRepeat;
    public $password;
    public $user;
    public $rememberMe = false;
    public $systemlog;
    public $userlog;
    public $old_password;
    public $new_password;
    public $repeat_password;

    /**
     * @var string the name of the table storing authorization item hierarchy. Defaults to "auth_item_child".
     */
    public $itemChildTable = '{{%auth_item_child}}';

    /**
     * @var string the name of the table storing authorization item hierarchy. Defaults to "auth_assignment".
     */
    public $itemAuthAssignment = '{{%auth_assignment}}';

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_LOGIN] = ['systemlog', 'userlog', 'password'];
        $scenarios[self::SCENARIO_CREATE] = ['username', 'name', 'nu_num_mat', 'nu_num_ide', 'nu_num_cpf', 'id_num_cbo', 'password', 'passwordRepeat', 'email',];
        $scenarios[self::SCENARIO_CREATE_CIDADAO] = ['username', 'name', 'nu_num_cpf', 'password', 'passwordRepeat', 'email',];
        $scenarios[self::SCENARIO_UPDATE] = ['user', 'username', 'name', 'password', 'passwordRepeat', 'email'];
        $scenarios[self::SCENARIO_RESETPWD] = ['email'];
        $scenarios[self::SCENARIO_CHANGEPWD] = ['old_password', 'new_password', 'repeat_password'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['username', 'name', 'id_num_cbo', 'auth_key', 'password_hash', 'email'], 'required'],
            [['username', 'user', 'userlog'], 'filter', 'filter' => 'trim'],
            [['username', 'user', 'userlog'], 'string', 'length' => [3, 20]],
            [['username', 'user', 'email', 'nu_num_mat', 'nu_num_ide', 'nu_num_cpf'], 'unique', 'on' => self::SCENARIO_CREATE, 'on' => self::SCENARIO_UPDATE],
            [['username', 'user', 'email', 'nu_num_cpf'], 'unique', 'on' => self::SCENARIO_CREATE_CIDADAO, 'on' => self::SCENARIO_UPDATE_CIDADAO],
            [['bo_use_log'], 'integer'],
            [['nm_use_log'], 'string'],
            [
                ['bi_arq_ava'], 'file', 'extensions' => ['jpg', 'gif', 'png', 'bmp', 'jpeg'],
                'maxSize' => [1024 * 1024 * 10], 'message' => 'O arquivo era maior que 10MB. Carregue um arquivo menor.'
            ],
            [['name'], 'string', 'min' => 6, 'max' => 60],
            [['nu_num_mat'], 'string', 'max' => 6],
            [['nu_num_ide'], 'string', 'max' => 14],
            [['nu_num_cpf'], 'string', 'max' => 14],
            [['id_num_cbo', 'status', 'bo_use_log', 'user_level', 'created_at', 'updated_at'], 'integer'],
            [['id_tip_use'], 'each', 'rule' => ['in', 'range' => ['adm', 'user', 'pop']]],
            [['email'], 'filter', 'filter' => 'trim'],
            [['email'], 'string'],
            [['password'], 'string', 'min' => 3, 'max' => 20],
            [['password'], 'validatePasswordLogin', 'on' => self::SCENARIO_LOGIN],
            [['password_reset_token'], 'unique'],
            [['systemlog', 'userlog', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            [['username', 'name', 'nu_num_mat', 'nu_num_ide', 'nu_num_cpf', 'id_num_cbo', 'password', 'passwordRepeat', 'email'], 'required', 'on' => self::SCENARIO_CREATE],
            [['username', 'name', 'nu_num_cpf', 'password', 'passwordRepeat', 'email'], 'required', 'on' => self::SCENARIO_CREATE_CIDADAO],
            [['username', 'user', 'email', 'nu_num_mat', 'nu_num_ide', 'nu_num_cpf'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['username', 'user', 'email', 'nu_num_cpf'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['old_password', 'new_password', 'repeat_password'], 'required', 'on' => self::SCENARIO_CHANGEPWD],
            [['old_password'], 'validatePasswordLogin', 'on' => self::SCENARIO_CHANGEPWD],
            [['repeat_password'], 'compare', 'compareAttribute' => 'new_password', 'on' => self::SCENARIO_CHANGEPWD],
            [['passwordRepeat'], 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "As senhas não combinam"],
            [['id_num_cbo'], 'exist', 'skipOnError' => true, 'targetClass' => GerTabUniCbo::class, 'targetAttribute' => ['id_num_cbo' => 'id_num_cbo']],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['id'] = $this->id;
        $fields['photo'] = base64_encode($this->bi_arq_ava ?? '');
        $fields['nu'] = ltrim($this->name);
        $fields['un'] = ltrim($this->username);
        $fields['cpf'] = MarArtHelpers::mascaraString('###.###.###-##', $this->nu_num_cpf);
        $fields['ide'] = MarArtHelpers::mascaraString(MarArtHelpers::masId($this->nu_num_ide), $this->nu_num_ide);
        $fields['mat'] = $this->nu_num_mat;
        $fields['phone'] = (strlen($this->nu_num_tel) == 11) ?
            MarArtHelpers::mascaraString('(##) #####-####', $this->nu_num_tel) :
            MarArtHelpers::mascaraString('(##) ####-####', $this->nu_num_tel);
        $fields['email'] = ltrim($this->email);
        $fields['date_at'] = date("d-m-Y", $this->created_at);
        $fields['date_up'] = date("d-m-Y", $this->updated_at);
        // remove campos que contém informações confidenciais
        unset(
            $fields['auth_key'],
            $fields['password_hash'],
            $fields['password_reset_token'],
            $fields['bi_arq_ava'],
            $fields['username'],
            $fields['name'],
            $fields['nu_num_mat'],
            $fields['nu_num_ide'],
            $fields['nu_num_cpf'],
            $fields['id_num_cbo'],
            $fields['password'],
            $fields['passwordRepeat'],
            $fields['bo_use_log'],
            $fields['nu_use_lim'],
            $fields['nu_use_cont_log'],
            $fields['nm_use_log'],
            $fields['nm_nom_arq'],
            $fields['nm_tip_arq'],
            $fields['nu_num_tel'],
            $fields['status'],
            $fields['user_level'],
            $fields['created_at'],
            $fields['updated_at']
        );

        return $fields;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bo_use_log' => 'Logado:',
            'nu_use_lim' => 'User limite:',
            'nu_use_cont_log' => 'Logado cont:',
            'nm_use_log' => 'Sessão:',
            'userlog' => 'Usuário:',
            'systemlog' => 'Sistema',
            'username' => 'Username:',
            'name' => 'Nome do Usuário:',
            'nu_num_cpf' => 'CPF:.',
            'nu_num_ide' => 'R.G.:',
            'nu_num_mat' => 'Mat.:',
            'nm_nom_arq' => 'Nome do Arquivo do Avatar.',
            'bi_arq_ava' => 'Binário do arquivo avatar.',
            'nm_tip_arq' => 'Tipo do arquivo avatar.',
            'id_num_cbo' => 'Profissão:',
            'auth_key' => 'Auth Key',
            'password' => 'Senha:',
            'old_password' => 'Senha anterior:',
            'new_password' => 'Senha nova:',
            'repeat_password' => 'Repetir senha:',
            'passwordRepeat' => 'Repetir senha:',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'nu_num_tel' => 'Telefone:',
            'email' => 'Email',
            'status' => 'Status',
            'id_tip_use' => 'T. usuário',
            'user_level' => 'User Level',
            'access_token' => 'Token:',
            'expire_at' => 'Token expiration time:',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Agendas]].
     *
     * @return \yii\db\ActiveQuery|AgendaQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agenda::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[Agendas0]].
     *
     * @return \yii\db\ActiveQuery|AgendaQuery
     */
    public function getAgendas0()
    {
        return $this->hasMany(Agenda::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[Apartamentos]].
     *
     * @return \yii\db\ActiveQuery|ApartamentoQuery
     */
    public function getApartamentos()
    {
        return $this->hasMany(Apartamento::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[Apartamentos0]].
     *
     * @return \yii\db\ActiveQuery|ApartamentoQuery
     */
    public function getApartamentos0()
    {
        return $this->hasMany(Apartamento::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[Dependentes]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[Dependentes0]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes0()
    {
        return $this->hasMany(Dependente::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[Emails]].
     *
     * @return \yii\db\ActiveQuery|EmailQuery
     */
    public function getEmails()
    {
        return $this->hasMany(Email::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[Emails0]].
     *
     * @return \yii\db\ActiveQuery|EmailQuery
     */
    public function getEmails0()
    {
        return $this->hasMany(Email::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[EmailAvaliacaos]].
     *
     * @return \yii\db\ActiveQuery|EmailAvaliacaoQuery
     */
    public function getEmailAvaliacaos()
    {
        return $this->hasMany(EmailAvaliacao::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[EmailAvaliacaos0]].
     *
     * @return \yii\db\ActiveQuery|EmailAvaliacaoQuery
     */
    public function getEmailAvaliacaos0()
    {
        return $this->hasMany(EmailAvaliacao::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[EmailRespostas]].
     *
     * @return \yii\db\ActiveQuery|EmailRespostaQuery
     */
    public function getEmailRespostas()
    {
        return $this->hasMany(EmailResposta::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[EmailRespostas0]].
     *
     * @return \yii\db\ActiveQuery|EmailRespostaQuery
     */
    public function getEmailRespostas0()
    {
        return $this->hasMany(EmailResposta::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[Ocupacaos]].
     *
     * @return \yii\db\ActiveQuery|OcupacaoQuery
     */
    public function getOcupacaos()
    {
        return $this->hasMany(Ocupacao::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[Ocupacaos0]].
     *
     * @return \yii\db\ActiveQuery|OcupacaoQuery
     */
    public function getOcupacaos0()
    {
        return $this->hasMany(Ocupacao::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[Responsavels0]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels0()
    {
        return $this->hasMany(Responsavel::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[TecnicoSocials0]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials0()
    {
        return $this->hasMany(TecnicoSocial::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[TecsocDocumentos]].
     *
     * @return \yii\db\ActiveQuery|TecsocDocumentoQuery
     */
    public function getTecsocDocumentos()
    {
        return $this->hasMany(TecsocDocumento::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[TecsocDocumentos0]].
     *
     * @return \yii\db\ActiveQuery|TecsocDocumentoQuery
     */
    public function getTecsocDocumentos0()
    {
        return $this->hasMany(TecsocDocumento::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[TecsocEnfermidades]].
     *
     * @return \yii\db\ActiveQuery|TecsocEnfermidadeQuery
     */
    public function getTecsocEnfermidades()
    {
        return $this->hasMany(TecsocEnfermidade::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[TecsocEnfermidades0]].
     *
     * @return \yii\db\ActiveQuery|TecsocEnfermidadeQuery
     */
    public function getTecsocEnfermidades0()
    {
        return $this->hasMany(TecsocEnfermidade::class, ['id_num_mod' => 'id']);
    }

    /**
     * Gets query for [[TecsocFamilias]].
     *
     * @return \yii\db\ActiveQuery|TecsocFamiliaQuery
     */
    public function getTecsocFamilias()
    {
        return $this->hasMany(TecsocFamilia::class, ['id_num_cri' => 'id']);
    }

    /**
     * Gets query for [[TecsocFamilias0]].
     *
     * @return \yii\db\ActiveQuery|TecsocFamiliaQuery
     */
    public function getTecsocFamilias0()
    {
        return $this->hasMany(TecsocFamilia::class, ['id_num_mod' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @param Token $token
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return self::findIdentity($token->getClaim('uid'));
        $claims = \Yii::$app->jwt->parse($token)->claims();
        $uid = $claims->get('uid');
        if (!is_numeric($uid)) {
            throw new ForbiddenHttpException('Invalid token provided');
        }

        return static::findOne(['id' => $uid]);
    }

    public static function generateUserToken(\app\modules\user\models\User $user)
    {
        // /** @var Jwt $jwt */
        /*  $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $dataini = strtotime('now');
        $dataexp = strtotime('+3 hours');
        // Adoption for lcobucci/jwt ^4.0 version
        $token = $jwt->getBuilder()
            ->issuedBy('https://mcmv.itaborai.rj.gov.br') // Configures the issuer (iss claim)
            ->permittedFor('https://mcmv.itaborai.rj.gov.br') // Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->issuedAt($dataini) // Configures the time that the token was issue (iat claim)
            ->expiresAt($dataexp) // Configures the expiration time of the token (exp claim)
            ->withClaim('uid', 4) // Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token

        return $token; */
        $now = new \DateTimeImmutable('now', new \DateTimeZone(\Yii::$app->timeZone));
        $jt = Yii::$app->jwt;
        $token = Yii::$app->jwt->getBuilder()
            // Configures the time that the token was issued
            ->issuedAt($now)
            // Configures the time that the token can be used
            ->canOnlyBeUsedAfter($now)
            // Configures the expiration time of the token
            ->expiresAt($now->modify('+1 hour'))
            // Configures a new claim, called "uid", with user ID, assuming $user is the authenticated user object
            ->withClaim('uid', $user->id)
            // Builds a new token
            ->getToken(
                Yii::$app->jwt->getConfiguration()->signer(),
                Yii::$app->jwt->getConfiguration()->signingKey()
            );
        $tokenString = $token->toString();
        return $tokenString;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     *
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }



    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     *
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array  $params    the additional name-value pairs given in the rule
     */
    public function validatePasswordLogin($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($attribute === 'password') {
                if (!$user || !$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Usuário ou senha incorretos.');
                }
            } elseif ($attribute === 'old_password') {
                $user = User::find()->where([
                    'username' => Yii::$app->user->identity->username
                ])->one();
                if (!$user || !$user->validatePassword($this->old_password)) {
                    $this->addError($attribute, 'A senha antiga não é correta.');
                }
            }
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function inscricaoEnvio($email)
    {
        if ($this->validate()) {
            /* @var $res */
            $cid = $this->name;
            $dat = $this->created_at;
            $ema = $this->email;
            $res = ['nm_nom_cid' => $cid, 'nm_nom_ema' => $ema, 'dataEmail' => date('d/m/Y', $dat)];
            Yii::$app->mailer->compose(['html' => 'inscricao-html'], ['res' => $res, 'imageFileName' => 'img/habitacaoLogo.png'])
                ->setFrom([$email => Yii::$app->params['senderName'] . ' - appita-mcmv'])
                ->setTo($res['nm_nom_ema'])
                // ->setReplyTo([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setSubject('Conta Criada - SMHSS')
                //  ->setTextBody($res['nm_nom_bod'])
                ->send();
            return true;
        }
        return false;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $this::SCENARIO_LOGIN;
        if ($this->validate()) {
            //return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 0 * 0 * 0 : 10);
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     *
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     *
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     *
     * @throws Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->user === null) {
            $this->user = User::findByUsername($this->userlog);
        }
        return $this->user;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     * Pegar o Pai do Usuaŕio
     */
    public function getPai()
    {
        $query = new Query();
        $pai = $query->select(['child'])
            ->from($this->itemChildTable)
            ->where(['parent' => $this->username])
            ->one();
        return $pai[0];
    }

    /**
     * @inheritdoc
     * Pegar o Pai do criador(Papel) do Usuaŕio
     */
    public function getPaiCri()
    {
        $query = new Query;
        $paiCri = $query->select(['user_id'])
            ->from($this->itemAuthAssignment)
            ->where(['item_name' => $this->getPai()])
            ->one();
        return $paiCri;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->name = strtoupper($this->name);
            if ($this->isNewRecord) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->created_at = time();
            } else {
                $this->updated_at = time();
            }
        } else {
            return false;
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changeAttributes)
    {
        if ($this->isNewRecord) {
            $auth = Yii::$app->authManager;
            $visitante = $auth->getRole('visitante');
            $auth->assign($visitante, $this->getId());
        }
        return true;
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
