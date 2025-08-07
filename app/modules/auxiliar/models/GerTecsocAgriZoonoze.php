<?php

namespace app\modules\auxiliar\models;

use yii\db\ActiveRecord;
use app\modules\auxiliar\models\GerTecsocAgriZoonozeQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_agri_zoonoze}}".
 *
 * @property int $id_num_zoo Id tabela zoonozes
 * @property string $nm_nom_zoo Zoonozes:
 *
 */
class GerTecsocAgriZoonoze extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_agri_zoonoze}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_zoo'], 'required'],
            [['nm_nom_zoo'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_zoo' => 'Id tabela zoonozes',
            'nm_nom_zoo' => 'Zoonozes:',
        ];
    }


    /**
     * {@inheritdoc}
     * @return GerTecsocAgriZoonozeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocAgriZoonozeQuery(get_called_class());
    }
}
