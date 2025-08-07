<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;
use app\modules\cliente\models\GerTabUniCbo;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $bi_arq_ava;
    public $name;
    public $nu_cpf_use;
    public $nu_mat_use;
    public $email;
    public $password;
    public $passwordRepeat;
    public $user_level;
    public $nu_num_cbo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'filter', 'filter' => 'trim'],
            [['username'], 'required', 'message' => 'O Login do Usuário não pode estar em branco'],
            [['username'], 'string', 'length' => [3, 20], 'message' => 'O Login do Usuário não deve ter entre 3 e 20 caracteres'],
            [['username'], 'unique', 'targetClass' => '\app\modules\user\models\User', 'message' => 'Este login de Usuário já foi cadastrado.'],
            [
                ['bi_arq_ava'], 'file', 'extensions' => ['jpg', 'gif', 'png', 'bmp', 'jpeg'],
                'maxSize' => [1024 * 1024 * 10], 'message' => 'O arquivo era maior que 10MB. Carregue um arquivo menor.'
            ],
            [['name'], 'string', 'min' => 6, 'max' => 60],
            [['name'], 'required', 'message' => 'O Nome do Usuário não pode estar em branco'],
            [['name'], 'unique', 'targetClass' => '\app\modules\user\models\User', 'message' => 'Este nome de Usuário já foi cadastrado.'],
            [['nu_num_use'], 'string', 'max' => 6],
            [['nu_num_ide'], 'string', 'max' => 14],
            [['nu_cpf_use'], 'string', 'max' => 14],
            [['email'], 'filter', 'filter' => 'trim'],
            [['email'], 'required', 'message' => 'O Email do Usuário não pode estar em branco.'],
            [['email'], 'string', 'min' => 3, 'max' => 60, 'message' => 'O Email do Usuário não deve ter entre 3 e 60 caracteres'],
            [['email'], 'unique', 'targetClass' => '\app\modules\user\models\User', 'message' => 'Este email de Usuário já foi cadastrado.'],
            [['password'], 'required', 'message' => 'A Senha do Usuário não pode estar em branco.'],
            [['password'], 'string', 'min' => 3, 'max' => 20, 'message' => 'A Senha do Usuário não deve ter entre 3 e 20 caracteres'],
            [['passwordRepeat'], 'required', 'message' => 'A Senha do Usuário não pode estar em branco.'],
            [['passwordRepeat'], 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "As senhas não combinam"],
            //        [['user_level'], 'exist', 'skipOnError' => true, 'targetClass' => RoleTypes::class, 'targetAttribute' => ['user_level' => 'role_id']],
            [['nu_num_cbo'], 'exist', 'skipOnError' => true, 'targetClass' => GerTabUniCbo::class, 'targetAttribute' => ['nu_num_cbo' => 'nu_num_cbo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Nome do Usuário.',
            'nu_cpf_use' => 'CPF:.',
            'nu_mat_use' => 'Mat.:',
            'nm_nom_arq' => 'Nome do Arquivo do Avatar.',
            'bi_arq_ava' => 'Binário do arquivo avatar.',
            'nm_tip_arq' => 'Tipo do arquivo avatar.',
            'nu_num_cbo' => 'Número da Ocupação Tabela Unificada.',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'user_level' => 'User Level',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->name = strtoupper($this->name);
            $user->nu_cpf_use = $this->nu_cpf_use;
            $user->nu_mat_use = $this->nu_mat_use;
            $user->username = $this->username;
            $user->bi_arq_ava = $this->bi_arq_ava;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            // foram adicionadas as seguintes quarto linhas:
            $user->save(false);
            $auth = Yii::$app->authManager;
            $visitante = $auth->getRole('visitante');
            $auth->assign($visitante, $user->getId());

            //  if ($user->save()) {
            return $user;
            //}
        }

        return null;
    }
}
