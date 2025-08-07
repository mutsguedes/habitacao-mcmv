<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerNacionalidade]].
 *
 * @see GerNacionalidade
 */
class GerNacionalidadeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerNacionalidade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerNacionalidade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
