<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerTecsocCursoQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_curso}}".
 *
 * @property int $id_num_cur Id tabela trabRendaCursos:
 * @property string $nm_nom_cur Curso:
 */
class GerTecsocCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_curso}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_cur'], 'required'],
            [['nm_nom_cur'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_cur' => 'Id tabela trabRendaCursos:',
            'nm_nom_cur' => 'Curso:',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocCursoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocCursoQuery(get_called_class());
    }
}
