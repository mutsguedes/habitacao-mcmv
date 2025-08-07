<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\auxiliar\models\PageUser;
use app\modules\auxiliar\models\PageQuery;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $id_num_pag Id da tabela paginas.
 * @property string $nm_nom_pag Páginas:
 * @property int $nu_num_con Total:
 *
 * @property PageUser[] $pageUsers
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_pag', 'nu_num_con'], 'required'],
            [['nu_num_con'], 'default', 'value' => null],
            [['nu_num_con'], 'integer'],
            [['nm_nom_pag'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_pag' => 'Id da tabela paginas.',
            'nm_nom_pag' => 'Páginas:',
            'nu_num_con' => 'Total:',
        ];
    }

    /**
     * Gets query for [[PageUsers]].
     *
     * @return \yii\db\ActiveQuery|PageUserQuery
     */
    public function getPageUsers()
    {
        return $this->hasMany(PageUser::className(), ['id_num_pag' => 'id_num_pag']);
    }

    /**
     * {@inheritdoc}
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }
}
