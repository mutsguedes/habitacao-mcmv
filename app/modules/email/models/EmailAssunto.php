<?php

namespace app\modules\email\models;

use Yii;
use app\modules\email\models\Email;
use app\modules\email\models\EmailAssuntoQuery;

/**
 * This is the model class for table "{{%email_assunto}}".
 *
 * @property int $id_ema_ass Id tabela emailAssuntos.
 * @property string $nm_ema_ass Assunto:
 * @property string $nm_res_aut Resposta:
 *
 * @property Email[] $emails
 */
class EmailAssunto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_assunto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ema_ass', 'nm_ema_ass', 'nm_res_aut'], 'required'],
            [['id_ema_ass'], 'default', 'value' => null],
            [['id_ema_ass'], 'integer'],
            [['nm_ema_ass'], 'string', 'max' => 60],
            [['nm_res_aut'], 'string', 'max' => 255],
            [['id_ema_ass'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ema_ass' => 'Id tabela emailAssuntos.',
            'nm_ema_ass' => 'Assunto:',
            'nm_res_aut' => 'Resposta:',
        ];
    }

    /**
     * Gets query for [[Emails]].
     *
     * @return \yii\db\ActiveQuery|EmailQuery
     */
    public function getEmails()
    {
        return $this->hasMany(Email::className(), ['id_ema_ass' => 'id_ema_ass']);
    }

    /**
     * {@inheritdoc}
     * @return EmailAssuntoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailAssuntoQuery(get_called_class());
    }
}
