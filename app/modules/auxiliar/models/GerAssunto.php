<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\agenda\models\Agenda;
use app\modules\auxiliar\models\GerAssuntoQuery;

/**
 * This is the model class for table "ger_assunto".
 *
 * @property int $id_num_ass Id tabela ger_assunto.
 * @property string $nm_nom_ass Assunto:
 * @property string $nm_res_aut Resposta:
 *
 * @property Agenda[] $agendas
 */
class GerAssunto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_assunto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_ass', 'nm_nom_ass', 'nm_res_aut'], 'required'],
            [['id_num_ass'], 'integer'],
            [['nm_nom_ass'], 'string', 'max' => 60],
            [['nm_res_aut'], 'string', 'max' => 255],
            [['id_num_ass'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_ass' => 'Id tabela ger_assunto.',
            'nm_nom_ass' => 'Assunto:',
            'nm_res_aut' => 'Resposta:',
        ];
    }

    /**
     * Gets query for [[Agendas]].
     *
     * @return \yii\db\ActiveQuery|AgendaQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agenda::class, ['id_num_ass' => 'id_num_ass']);
    }

    /**
     * {@inheritdoc}
     * @return GerAssuntoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerAssuntoQuery(get_called_class());
    }
}
