<?php

namespace app\modules\user\models;

use yii\base\Model;
use BadMethodCallException;
use app\modules\user\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

    public $password;
    public $passwordRepeat;

    /**
     * @var $model User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws BadMethodCallException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new BadMethodCallException('O token de redefinição de senha não pode ficar em branco.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new BadMethodCallException('Token de redefinição de senha incorreto.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['passwordRepeat'], 'required', 'skipOnEmpty' => false],
            [['passwordRepeat'], 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Senha:',
            'passwordRepeat' => 'Repetir senha',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
}
