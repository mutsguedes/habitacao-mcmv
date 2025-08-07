<?php

namespace app\modules\email\models;

use Yii;

/**
 * This is the model class for table "{{%email_situacao}}".
 *
 * @property int $id_ema_sit Id tabela emailSituacoes:
 * @property string $nm_ema_sit
 *
 * @property Email[] $emails
 */
class EmailSituacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_situacao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ema_sit'], 'required'],
            [['nm_ema_sit'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ema_sit' => 'Id tabela emailSituacoes:',
            'nm_ema_sit' => 'Nm Ema Sit',
        ];
    }

    /**
     * Gets query for [[Emails]].
     *
     * @return \yii\db\ActiveQuery|EmailQuery
     */
    public function getEmails()
    {
        return $this->hasMany(Email::className(), ['id_ema_sit' => 'id_ema_sit']);
    }

    /**
     * {@inheritdoc}
     * @return EmailSituacaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailSituacaoQuery(get_called_class());
    }
}
