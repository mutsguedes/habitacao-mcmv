<?php

namespace app\modules\emares\models;

use Yii;
use app\modules\emares\models\EmailAndamentoQuery;

/**
 * This is the model class for table "{{%email_andamento}}".
 *
 * @property int $id_ema_and Id tabela emalAdamentos:
 * @property string $nm_ema_and Descrição:
 *
 * @property EmailResposta[] $emailResposta
 */
class EmailAndamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email_andamento}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ema_and'], 'required'],
            [['nm_ema_and'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ema_and' => 'Id tabela emalAdamentos:',
            'nm_ema_and' => 'Descrição:',
        ];
    }

    /**
     * Gets query for [[EmailResposta]].
     *
     * @return \yii\db\ActiveQuery|EmailRespostaQuery
     */
    public function getEmailResposta()
    {
        return $this->hasMany(EmailResposta::class, ['id_ema_and' => 'id_ema_and']);
    }

    /**
     * {@inheritdoc}
     * @return EmailAndamentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmailAndamentoQuery(get_called_class());
    }
}
