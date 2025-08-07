<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\email\models\Email;
use app\modules\auxiliar\models\Page;
use app\modules\auxiliar\models\PageUserQuery;

/**
 * This is the model class for table "{{%page_user}}".
 *
 * @property int $id_pag_usu Id tabela paginausuarios.
 * @property string $nu_num_ip Ip:
 * @property int $id_num_pag Id da tabela paginas.
 * @property string $dt_tim_cri Criação:
 * @property string $dt_tim_mod Modificação:
 *
 * @property Email[] $emails
 * @property Page $numPag
 */
class PageUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%page_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nu_num_ip', 'id_num_pag', 'dt_tim_cri', 'dt_tim_mod'], 'required'],
            [['id_num_pag'], 'default', 'value' => null],
            [['id_num_pag'], 'integer'],
            [['dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nu_num_ip'], 'string', 'max' => 25],
            [['id_num_pag'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['id_num_pag' => 'id_num_pag']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pag_usu' => 'Id tabela paginausuarios.',
            'nu_num_ip' => 'Ip:',
            'id_num_pag' => 'Id da tabela paginas.',
            'dt_tim_cri' => 'Criação:',
            'dt_tim_mod' => 'Modificação:',
        ];
    }

    /**
     * Gets query for [[Emails]].
     *
     * @return \yii\db\ActiveQuery|EmailQuery
     */
    public function getEmails()
    {
        return $this->hasMany(Email::className(), ['id_pag_usu' => 'id_pag_usu']);
    }

    /**
     * Gets query for [[NumPag]].
     *
     * @return \yii\db\ActiveQuery|PageQuery
     */
    public function getNumPag()
    {
        return $this->hasOne(Page::className(), ['id_num_pag' => 'id_num_pag']);
    }

    /**
     * {@inheritdoc}
     * @return PageUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageUserQuery(get_called_class());
    }
}
