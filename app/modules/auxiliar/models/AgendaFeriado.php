<?php

namespace app\modules\auxiliar\models;

use Yii;

/**
 * This is the model class for table "{{%agenda_feriado}}".
 *
 * @property int $nu_num_ano Ano:
 * @property int $nu_num_mes Mês:
 * @property int $nu_num_dia Dia:
 * @property int $id_tip_fer Tipo:
 * @property string $nm_des_fer Feriado:
 * @property string $nm_nom_est Estado:
 * @property string|null $dt_age_fer Data:
 * @property int $id_num_cri Criador:
 * @property string $dt_tim_cri Criação:
 * @property int $id_num_mod Modificador:
 * @property string $dt_tim_mod Modificação:
 */
class AgendaFeriado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%agenda_feriado}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nu_num_ano', 'nu_num_mes', 'nu_num_dia', 'id_tip_fer', 'nm_des_fer', 'nm_nom_est', 'id_num_cri', 'dt_tim_cri', 'id_num_mod', 'dt_tim_mod'], 'required'],
            [['nu_num_ano', 'nu_num_mes', 'nu_num_dia', 'id_tip_fer', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['dt_age_fer', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nm_des_fer'], 'string', 'max' => 100],
            [['nm_nom_est'], 'string', 'max' => 2],
            [['nu_num_ano', 'nu_num_mes', 'nu_num_dia', 'nm_nom_est'], 'unique', 'targetAttribute' => ['nu_num_ano', 'nu_num_mes', 'nu_num_dia', 'nm_nom_est']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nu_num_ano' => 'Ano:',
            'nu_num_mes' => 'Mês:',
            'nu_num_dia' => 'Dia:',
            'id_tip_fer' => 'Tipo:',
            'nm_des_fer' => 'Feriado:',
            'nm_nom_est' => 'Estado:',
            'dt_age_fer' => 'Data:',
            'id_num_cri' => 'Criador:',
            'dt_tim_cri' => 'Criação:',
            'id_num_mod' => 'Modificador:',
            'dt_tim_mod' => 'Modificação:',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['dt_age_fer'] = function ($model) {
            if ($model->dt_age_fer == null) {
                $ano = date('Y');
                //$date =  date('Y-m-d', strtotime($ano . '-' . $model->nu_num_mes . '-' . $model->nu_num_dia));
                $date =  date('d-m-Y', strtotime($model->nu_num_dia . '-' . $model->nu_num_mes . '-' . $ano));
                return $date;
            } else {
            $ano = date('Y');
            $date =  date('d-m-Y', strtotime($model->nu_num_dia . '-' . $model->nu_num_mes . '-' . $ano));
                //return $model->dt_age_fer;
                return $date;
            }
        };
        return $fields;
    }

    /**
     * {@inheritdoc}
     * @return AgendaFeriadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgendaFeriadoQuery(get_called_class());
    }
}
