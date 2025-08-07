<?php

namespace app\modules\auxiliar\models;

use Yii;

/**
 * This is the model class for table "{{%apartamento}}".
 *
 * @property int $id_num_apa Id tabela apartamentos:
 * @property string $id_con_ocu Apartamento:
 * @property bool $bo_loc_apa Ocupado:
 * @property string $nu_num_qua Quadra:
 * @property string $nu_num_lot Lote:
 * @property string $nu_num_blo Bloco:
 * @property string $nu_num_apa Apto:
 * @property int $id_num_cri Id do criador:
 * @property string $dt_tim_cri Data criação:
 * @property int $id_num_mod Id do modificador:
 * @property string $dt_tim_mod Data modificação:
 *
 * @property User $numCri
 * @property User $numMod
 */
class Apartamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%apartamento}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_con_ocu', 'nu_num_qua', 'nu_num_lot', 'nu_num_blo', 'nu_num_apa', 'id_num_cri', 'dt_tim_cri', 'id_num_mod', 'dt_tim_mod'], 'required'],
            [['bo_loc_apa'], 'boolean'],
            [['id_num_cri', 'id_num_mod'], 'default', 'value' => null],
            [['id_num_cri', 'id_num_mod'], 'integer'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['id_con_ocu'], 'string', 'max' => 9],
            [['nu_num_qua', 'nu_num_lot', 'nu_num_blo'], 'string', 'max' => 2],
            [['nu_num_apa'], 'string', 'max' => 3],
            [['id_num_cri'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_num_cri' => 'id']],
            [['id_num_mod'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_num_mod' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_apa' => 'Id tabela apartamentos:',
            'id_con_ocu' => 'Apartamento:',
            'bo_loc_apa' => 'Ocupado:',
            'nu_num_qua' => 'Quadra:',
            'nu_num_lot' => 'Lote:',
            'nu_num_blo' => 'Bloco:',
            'nu_num_apa' => 'Apto:',
            'id_num_cri' => 'Id do criador:',
            'dt_tim_cri' => 'Data criação:',
            'id_num_mod' => 'Id do modificador:',
            'dt_tim_mod' => 'Data modificação:',
        ];
    }

    /**
     * Gets query for [[NumCri]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getNumCri()
    {
        return $this->hasOne(User::className(), ['id' => 'id_num_cri']);
    }

    /**
     * Gets query for [[NumMod]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getNumMod()
    {
        return $this->hasOne(User::className(), ['id' => 'id_num_mod']);
    }

    /**
     * {@inheritdoc}
     * @return ApartamentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApartamentoQuery(get_called_class());
    }
}
